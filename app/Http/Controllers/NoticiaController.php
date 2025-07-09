<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\CatNoticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        // Agafar categories
        $categories = CatNoticia::all();

        // Recollir filtres
        $filterCategoria = $request->input('filter_categoria');
        $filterPublicat = $request->input('filter_publicat');

        // Crear la query base
        $query = Noticia::query();

        // Filtrar per categoria si hi ha filtre
        if ($filterCategoria) {
            $query->where('cat_noticia_id', $filterCategoria);
        }

        // Filtrar per estat publicat si hi ha filtre
        if ($filterPublicat !== null && $filterPublicat !== '') {
            $query->where('publicat', $filterPublicat);
        }

        // Agafar resultats ordenats per data de publicació desc
        $noticias = $query->orderBy('data_publicacio', 'desc')->paginate(10);

        return view('noticias.index', compact('noticias', 'categories'));
    }



    public function create()
    {
        $categories = CatNoticia::all();
        return view('noticias.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_noticia' => 'required|string',
            'descripcio_noticia' => 'required|string',
            'data_pub' => 'required|date',
            'bool_pub' => 'required|boolean',
            'url_document' => 'nullable|string',
            'data_inicial' => 'required|date',
            'data_final' => 'required|date',
            'cat_noticia_id' => 'required|exists:int_cat_noticies,id',
        ]);

        $noticia = new Noticia();
        $noticia->nom = $validated['nom_noticia'];
        $noticia->descripcio = $validated['descripcio_noticia'];
        $noticia->data_publicacio = $validated['data_pub'];
        $noticia->publicat = $validated['bool_pub'];
        $noticia->url = $validated['url_document'] ?? null;
        $noticia->data_inicial = $validated['data_inicial'];
        $noticia->data_final = $validated['data_final'];
        $noticia->cat_noticia_id = $validated['cat_noticia_id'];

        try {
            $noticia->save();
            $id = $noticia->id;
            logActivity('Crear Noticia', "ID: $id", "L'usuari ha Creat la noticia Nº $id.");
            return redirect()->route('noticias.index')->with('success', 'Notícia creada');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al guardar la notícia: ' . $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $noticia = Noticia::getNoticia($id)->first();
        if (!$noticia) abort(404);

        $categories = CatNoticia::all();

        return view('noticias.edit', compact('noticia', 'categories'));
    }



    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_noticia' => 'required|string|max:255',
            'descripcio_noticia' => 'required|string',
            'data_pub' => 'required|date',
            'bool_pub' => 'required|boolean',
            'url_document' => 'nullable|string',
            'data_inicial' => 'required|date',
            'data_final' => 'required|date|after_or_equal:data_inicial',
            'cat_noticia_id' => 'required|exists:int_cat_noticies,id',
        ]);

        $noticia = Noticia::findOrFail($id);
        $noticia->nom = $validated['nom_noticia'];
        $noticia->descripcio = $validated['descripcio_noticia'];
        $noticia->data_publicacio = $validated['data_pub'];
        $noticia->publicat = $validated['bool_pub'];
        $noticia->url = $validated['url_document'] ?? null;
        $noticia->data_inicial = $validated['data_inicial'];
        $noticia->data_final = $validated['data_final'];
        $noticia->cat_noticia_id = $validated['cat_noticia_id'];

        try {
            $noticia->save();
            logActivity('Edita Noticia', "ID: $id", "L'usuari ha editat la noticia Nº $id.");
            return redirect()->route('noticias.index')->with('success', 'Notícia actualitzada');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al guardar la notícia: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();

        logActivity('Eliminar Noticia', "ID: $id", "L'usuari ha eliminat la noticia Nº $id.");

        return redirect()->route('noticias.index')->with('success', 'Notícia eliminada');
    }
    
}
