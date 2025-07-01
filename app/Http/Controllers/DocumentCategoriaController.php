<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatDocument;

class DocumentCategoriaController extends Controller
{
    public function index()
    {
        $categories = CatDocument::orderBy('nom')->get();
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

        $categoria = CatDocuments::findOrFail($id);
        $categoria->nom = $request->input('nom');
        $categoria->save();

        return redirect()->route('categoria-documents.index')->with('success', 'Categoria actualitzada correctament');
    }

    public function destroy($id)
    {
        $categoria = CatDocument::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria-documents.index')->with('success', 'Categoria eliminada correctament');
    }
}
