<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('ordre', 'asc')->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'nom_visual' => 'required|string|max:255',
            'data_entrada' => 'required|date',
            'ordre' => 'required|integer',
            'fk_id_obj' => 'required|integer',
            'fk_id_tipus_obj' => 'required|integer',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '', $file->getClientOriginalName());
        $ext = $file->getClientOriginalExtension();

        $folder = 'generals';
        if (session()->has('name')) {
            $name = str_replace(' ', '_', session('name'));
            $folder = preg_replace('/[^A-Za-z0-9_\-]/', '', $name);
        }

        $path = $file->storeAs("uploads/$folder", $filename, 'public');
        $url = asset("storage/uploads/$folder/$filename");

        $dataEntrada = Carbon::parse($request->data_entrada)->format('Y-m-d H:i:s');

        Document::insertDocument([
            'nom_document' => $request->nom_visual,
            'nom_arxiu' => $filename,
            'extensio' => $ext,
            'data_entrada' => $dataEntrada,
            'ordre' => $request->ordre,
            'url_document' => $url,
            'id_obj' => $request->fk_id_obj,
            'tipus_obj' => $request->fk_id_tipus_obj,
        ]);

        return redirect()->back()->with('success', 'Document pujat correctament.');
    }



    public function edit($id)
    {
        $document = Document::find($id);
        if (!$document) abort(404);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_visual' => 'required|string|max:200',
            'nom_arxiu' => 'nullable|string|max:200',
            'data_entrada' => 'required|date',
            'extensio' => 'nullable|string|max:10',
            'ordre' => 'required|integer',
            'url' => 'nullable|string|max:230',
            'fk_id_obj' => 'nullable|integer',
            'fk_id_tipus_obj' => 'nullable|integer',
            'trial695' => 'nullable|string|size:1',
        ]);

        $document = Document::findOrFail($id);
        $document->nom_visual = $validated['nom_visual'];
        $document->nom_arxiu = $validated['nom_arxiu'] ?? null;
        $document->data_entrada = $validated['data_entrada'];
        $document->extensio = $validated['extensio'] ?? null;
        $document->ordre = $validated['ordre'];
        $document->url = $validated['url'] ?? null;
        $document->fk_id_obj = $validated['fk_id_obj'] ?? null;
        $document->fk_id_tipus_obj = $validated['fk_id_tipus_obj'] ?? null;
        $document->trial695 = $validated['trial695'] ?? null;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document actualitzat');
    }

    public function destroy($id)
    {
        $document = Document::getDocument($id);
        
        if (!$document) {
            abort(404);
        }

        // Extraiem la ruta relativa al storage a partir de la URL
        if (!empty($document->url)) {
            $parsedUrl = parse_url($document->url, PHP_URL_PATH);
            $relativePath = preg_replace('/^\/storage\//', '', $parsedUrl);

            if ($relativePath && Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        // Esborrem el registre a BD
        Document::deleteDocumentSimple($id);

        return redirect()->route('documents.index')->with('success', 'Document eliminat correctament.');
    }



    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function view($id)
    {
        $document = \App\Models\Document::find($id);
        if (!$document) {
            abort(404, 'Documento no encontrado');
        }

        $parsedUrl = parse_url($document->url, PHP_URL_PATH);

        $segments = explode('/', $parsedUrl);

        $username = count($segments) >= 4 ? $segments[3] : null;

        if (!session()->has('username')) {
            abort(403, 'Inicia sessio per descarregar aquest document');
        }

        $filePath = preg_replace('#^/storage/#', 'public/', $parsedUrl);

        $filePath = str_replace('/', DIRECTORY_SEPARATOR, $filePath);
        $fullPath = storage_path('app' . DIRECTORY_SEPARATOR . $filePath);

        $exists = file_exists($fullPath);

        if (!$exists) {
            abort(404, 'Document no trobat');
        }

        return response()->download($fullPath, $document->nom_arxiu, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $document->nom_arxiu . '"',
        ]);
    }


}
