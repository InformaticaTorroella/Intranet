<?php
namespace App\Http\Controllers;

use App\Models\Circular;
use App\Models\CatCircular;
use App\Models\CircularFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CircularController extends Controller
{
    public function index(Request $request)
    {
        $categories = CatCircular::all();
        $circulars = Circular::query();

        if ($request->filled('categoria')) {
            $circulars->where('fk_cat_circular', $request->categoria);
        }

        if ($request->filled('nom')) {
            $circulars->where('nom_visual', 'like', '%' . $request->nom . '%');
        }

        $circulars = $circulars->orderByDesc('data_creacio')->paginate(15);

        return view('circulars.index', compact('circulars', 'categories'));
    }

    public function create()
    {
        $categories = CatCircular::orderBy('nom')->get();
        return view('circulars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_visual' => 'required|string|max:200',
            'fk_cat_circular' => 'nullable|exists:int_cat_circulars,id',
            'arxius.*' => 'required|file|max:10240',
            'descripcion' => 'nullable|string',
        ]);


        $circular = Circular::create([
            'nom_visual' => $request->nom_visual,
            'fk_cat_circular' => $request->fk_cat_circular,
            'descripcion' => $request->descripcion,
            'data_creacio' => now(),
        ]);


        if ($request->hasFile('arxius')) {
            foreach ($request->file('arxius') as $file) {
                $path = $file->store('uploads/circulars', 'public');

                CircularFile::create([
                    'circular_id' => $circular->id,
                    'nom_arxiu' => $file->getClientOriginalName(),
                    'url' => $path, 
                ]);

            }
        }

        $id = $circular->id;

        logActivity('Elimina Circular', "ID: $id", "L'usuari ha eliminat la circular Nº $id.");

        return redirect()->route('circulars.index')->with('success', 'Circular creada.');
    }

    public function edit($id)
    {
        $circular = Circular::findOrFail($id);
        $categories = CatCircular::orderBy('nom')->get();
        return view('circulars.edit', compact('circular', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $circular = Circular::findOrFail($id);

        $request->validate([
            'nom_visual' => 'required|string|max:200',
            'fk_cat_circular' => 'required|exists:int_cat_circulars,id',
            'arxius.*' => 'nullable|file|max:10240',
            'descripcion' => 'nullable|string',
            'delete_files' => 'nullable|array',
            'delete_files.*' => 'integer|exists:int_circular_files,id',
        ]);

        $circular->update([
            'nom_visual' => $request->nom_visual,
            'fk_cat_circular' => $request->fk_cat_circular,
            'descripcion' => $request->descripcion,
            'data_edicio' => now(),
        ]);

        // Eliminar archivos marcados
        if ($request->filled('delete_files')) {
            $filesToDelete = CircularFile::whereIn('id', $request->delete_files)->get();
            foreach ($filesToDelete as $file) {
                if (Storage::exists($file->url)) {
                    Storage::delete($file->url);
                }
                $file->delete();
            }
        }

        // Añadir nuevos archivos si hay
        if ($request->hasFile('arxius')) {
            foreach ($request->file('arxius') as $file) {
                $path = $file->store('uploads/circulars', 'public');

                CircularFile::create([
                    'circular_id' => $circular->id,
                    'nom_arxiu' => $file->getClientOriginalName(),
                    'url' => $path,
                ]);
            }
        }

        logActivity('Editar Circular', "ID: $id", "L'usuari ha editat el circular Nº $id.");


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

        logActivity('Elimina Circular', "ID: $id", "L'usuari ha eliminat la circular Nº $id.");

        return redirect()->route('circulars.index')->with('success', 'Circular eliminada correctament.');
    }

    public function view($id, $action = 'download')
    {
        $circular = Circular::findOrFail($id);
        $parsedUrl = parse_url($circular->url, PHP_URL_PATH);
        $filePath = preg_replace('#^/storage/#', 'public/', $parsedUrl);
        $fullPath = storage_path('app/' . $filePath);

        if (!file_exists($fullPath)) abort(404, 'Fitxer no trobat');

        if ($action === 'view') {
            logActivity('Veure Circular', "ID: $id", "L'usuari ha vist el circular Nº $id.");

            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        logActivity('Descarregar Circular', "ID: $id", "L'usuari sha descarregat el circular Nº $id.");

        return response()->download($fullPath, $circular->nom_arxiu, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $circular->nom_arxiu . '"',
        ]);
    }
}
