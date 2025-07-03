<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\CatDocument;



class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $categories = CatDocument::all();

        $documents = Document::query();

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $documents->where('fk_id_cat_document', $request->categoria);
        }

        // Filtro por nombre visual
        if ($request->filled('nom')) {
            $documents->where('nom_visual', 'like', '%' . $request->nom . '%');
        }

        // Ordenar por fecha de entrada
        $documents = $documents->orderBy('data_entrada', 'desc')->get();

        return view('documents.index', compact('documents', 'categories'));
    }


    public function create()
    {
        $categories = CatDocument::orderBy('nom')->get();
        return view('documents.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'nom_visual' => 'required|string|max:255',
            'data_entrada' => 'required|date',
            'categoria_id' => 'required|exists:int_cat_documents,id',
        ]);


        $file = $request->file('file');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\\-\\.]/', '', $file->getClientOriginalName());
        $ext = $file->getClientOriginalExtension();

        $folder = 'generals';
        if (session()->has('name')) {
            $name = str_replace(' ', '_', session('name'));
            $folder = preg_replace('/[^A-Za-z0-9_\\-]/', '', $name);
        }

        $path = $file->storeAs("uploads/$folder", $filename, 'public');
        $url = asset("storage/uploads/$folder/$filename");

        $dataEntrada = \Carbon\Carbon::parse($validated['data_entrada'])->format('Y-m-d H:i:s');

        $data = [
            'nom_visual' => $validated['nom_visual'],
            'nom_arxiu' => $filename,
            'data_entrada' => $dataEntrada,
            'url' => $url,
            'fk_id_cat_document' => $validated['categoria_id'],
        ];



        $document = Document::create($data);

        logActivity('Crea Document', "ID: {$document->id}", "L'usuari ha creat el document Nº {$document->id}.");

        return redirect()->back()->with('success', 'Document pujat correctament.');
    }




    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $categories = CatDocument::orderBy('nom')->get();
        return view('documents.edit', compact('document', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_visual' => 'required|string|max:200',
            'nom_arxiu' => 'nullable|string|max:200',
            'data_entrada' => 'required|date',
            'url' => 'nullable|string|max:230',
            'fk_id_cat_document' => 'required|exists:int_cat_documents,id',
        ]);



        $document = Document::findOrFail($id);
        $document->nom_visual = $validated['nom_visual'];
        $document->nom_arxiu = $validated['nom_arxiu'] ?? null;
        $document->data_entrada = $validated['data_entrada'];
        $document->extensio = $validated['extensio'] ?? null;
        $document->ordre = $validated['ordre'];
        $document->url = $validated['url'] ?? null;
        $document->fk_id_cat_document = $validated['fk_id_cat_document'];
        $document->save();

        logActivity('Edita Document', "ID: $id", "L'usuari ha editat el document Nº $id.");

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

        logActivity('Elimiar Document', "ID: $id", "L'usuari ha eliminat el document Nº $id.");

        return redirect()->route('documents.index')->with('success', 'Document eliminat correctament.');
    }



    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function view($id, $action = 'download')
    {
        $document = Document::find($id);
        if (!$document) abort(404, 'Document no trobat');

        $parsedUrl = parse_url($document->url, PHP_URL_PATH);
        $filePath = preg_replace('#^/storage/#', 'public/', $parsedUrl);
        $fullPath = storage_path('app/' . $filePath);

        if (!file_exists($fullPath)) abort(404, 'Fitxer no trobat');

        if ($action === 'view') {
            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return response()->download($fullPath, $document->nom_arxiu, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $document->nom_arxiu . '"',
        ]);
    }





}
