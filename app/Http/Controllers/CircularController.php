<?php

namespace App\Http\Controllers;

use App\Models\Circular;
use App\Models\CatCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CircularController extends Controller
{
    public function index(Request $request)
    {
        $categories = CatCircular::all();

        $query = Circular::query();

        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('fk_cat_circular', $request->categoria);
        }

        $circulars = $query->orderBy('fk_cat_circular')->get();

        return view('circulars.index', compact('circulars', 'categories'));
    }


    public function create()
    {
        $categories = CatCircular::all();
        return view('circulars.create', compact('categories'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'nom_visual' => 'required|string|max:200',
            'data_creacio' => 'required|date',
            'ordre' => 'required|integer',
            'fk_cat_circular' => 'required|integer',
            'publicat' => 'nullable|integer',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '', $file->getClientOriginalName());
        $ext = $file->getClientOriginalExtension();

        $folder = 'circulars';
        if (session()->has('name')) {
            $name = str_replace(' ', '_', session('name'));
            $folder = preg_replace('/[^A-Za-z0-9_\-]/', '', $name);
        }

        $path = $file->storeAs("uploads/$folder", $filename, 'public');
        $url = asset("storage/uploads/$folder/$filename");

        $circular = Circular::create([
            'nom_visual' => $validated['nom_visual'],
            'nom_arxiu' => $filename,
            'data_creacio' => Carbon::parse($validated['data_creacio'])->format('Y-m-d H:i:s'),
            'data_edicio' => null,
            'data_publicacio' => null,
            'extensio' => $ext,
            'ordre' => $validated['ordre'],
            'url' => $url,
            'publicat' => $validated['publicat'] ?? 0,
            'fk_cat_circular' => $validated['fk_cat_circular'],
        ]);

        logActivity('Crea Circular', "ID: {$circular->id}", "Usuari ha creat la circular Nº {$circular->id}.");

        return redirect()->route('circulars.index')->with('success', 'Circular creada correctament.');
    }

    public function edit($id)
    {
        $circular = Circular::findOrFail($id);
        $categories = CatCircular::all();
        return view('circulars.edit', compact('circular', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_visual' => 'required|string|max:200',
            'nom_arxiu' => 'nullable|string|max:200',
            'data_creacio' => 'required|date',
            'data_edicio' => 'nullable|date',
            'data_publicacio' => 'nullable|date',
            'extensio' => 'nullable|string|max:10',
            'ordre' => 'required|integer',
            'url' => 'nullable|string|max:255',
            'publicat' => 'nullable|integer',
            'fk_cat_circular' => 'required|integer',
        ]);

        $circular = Circular::findOrFail($id);

        $circular->nom_visual = $validated['nom_visual'];
        $circular->nom_arxiu = $validated['nom_arxiu'] ?? $circular->nom_arxiu;
        $circular->data_creacio = Carbon::parse($validated['data_creacio'])->format('Y-m-d H:i:s');
        $circular->data_edicio = $validated['data_edicio'] ? Carbon::parse($validated['data_edicio'])->format('Y-m-d H:i:s') : $circular->data_edicio;
        $circular->data_publicacio = $validated['data_publicacio'] ? Carbon::parse($validated['data_publicacio'])->format('Y-m-d H:i:s') : $circular->data_publicacio;
        $circular->extensio = $validated['extensio'] ?? $circular->extensio;
        $circular->ordre = $validated['ordre'];
        $circular->url = $validated['url'] ?? $circular->url;
        $circular->publicat = $validated['publicat'] ?? $circular->publicat;
        $circular->fk_cat_circular = $validated['fk_cat_circular'];

        $circular->save();

        logActivity('Edita Circular', "ID: $id", "Usuari ha editat la circular Nº $id.");

        return redirect()->route('circulars.index')->with('success', 'Circular actualitzada.');
    }

    public function destroy($id)
    {
        $circular = Circular::findOrFail($id);

        if (!empty($circular->url)) {
            $parsedUrl = parse_url($circular->url, PHP_URL_PATH);
            $relativePath = preg_replace('/^\/storage\//', '', $parsedUrl);

            if ($relativePath && Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        $circular->delete();

        logActivity('Elimina Circular', "ID: $id", "Usuari ha eliminat la circular Nº $id.");

        return redirect()->route('circulars.index')->with('success', 'Circular eliminada correctament.');
    }

    public function view($id, $action = 'download')
    {
        if (!session()->has('username')) {
            abort(403, 'Inicia sessió per accedir al document');
        }

        $circular = Circular::find($id);
        if (!$circular) abort(404, 'Circular no trobada');

        $parsedUrl = parse_url($circular->url, PHP_URL_PATH);
        $filePath = preg_replace('#^/storage/#', 'public/', $parsedUrl);
        $fullPath = storage_path('app/' . $filePath);

        if (!file_exists($fullPath)) abort(404, 'Fitxer no trobat');

        if ($action === 'view') {
            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return response()->download($fullPath, $circular->nom_arxiu, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $circular->nom_arxiu . '"',
        ]);
    }

}
