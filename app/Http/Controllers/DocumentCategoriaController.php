<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatDocument;

class DocumentCategoriaController extends Controller
{
    public function index()
    {
        $categories = CatDocument::orderBy('nom')->paginate(10);
        return view('documents.categorias.index', compact('categories'));
    }

    public function create()
    {
        return view('documents.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = new CatDocument();
        $categoria->nom = $request->input('nom');
        $categoria->save();

        $id = $categoria->id;

        logActivity('Crear Categoria Document', "ID: $id", "L'usuari ha creat una categoria per els documetns Nº $id.");

        return redirect()->route('categoria-documents.index')->with('success', 'Categoria creada correctament');
    }

    public function edit($id)
    {
        $categoria = CatDocument::findOrFail($id);
        return view('documents.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = CatDocument::findOrFail($id);
        $categoria->nom = $request->input('nom');
        $categoria->save();

        logActivity('Editar Categoria Document', "ID: $id", "L'usuari ha editat una categoria per els documetns Nº $id.");

        return redirect()->route('categoria-documents.index')->with('success', 'Categoria actualitzada correctament');
    }

    public function destroy($id)
    {
        $categoria = CatDocument::findOrFail($id);
        $categoria->delete();

        logActivity('Elimina Categoria Document', "ID: $id", "L'usuari ha eliminat la categoria de documetns Nº $id.");

        return redirect()->route('categoria-documents.index')->with('success', 'Categoria eliminada correctament');
    }
}
