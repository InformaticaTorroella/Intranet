<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatNoticia;

class NoticiaCategoriaController extends Controller
{
    public function index()
    {
        $categories = CatNoticia::orderBy('nom')->get();
        return view('noticias.categorias.index', compact('categories'));
    }

    public function create()
    {
        return view('noticias.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = new CatNoticia();
        $categoria->nom = $request->input('nom');
        $categoria->save();

        logActivity('Crea Categoria Noticia', "ID: $id", "L'usuari ha creat una categoria per les noticies Nº $id.");

        return redirect()->route('categories.index')->with('success', 'Categoria creada correctament');
    }

    public function edit($id)
    {
        $categoria = CatNoticia::findOrFail($id);
        return view('noticias.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = CatNoticia::findOrFail($id);
        $categoria->nom = $request->input('nom');
        $categoria->save();

        logActivity('Edita Categoria Noticies', "ID: $id", "L'usuari ha editat una categoria per les noticies Nº $id.");

        return redirect()->route('categories.index')->with('success', 'Categoria actualitzada correctament');
    }

    public function destroy($id)
    {
        $categoria = CatNoticia::findOrFail($id);
        $categoria->delete();

        logActivity('Elimnar Categoria Noticies', "ID: $id", "L'usuari ha eliminat una categoria per les noticies Nº $id.");
        
        return redirect()->route('categories.index')->with('success', 'Categoria eliminada correctament');
    }
}