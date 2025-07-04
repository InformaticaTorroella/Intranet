<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatCircular;

class CircularCategoriaController extends Controller
{
    public function index()
    {
        $categories = CatCircular::orderBy('nom')->paginate(10);
        return view('circulars.categorias.index', compact('categories'));
    }

    public function create()
    {
        return view('circulars.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = new CatCircular();
        $categoria->nom = $request->input('nom');
        $categoria->save();

        logActivity('Crear Categoria Circular', "ID: $id", "L'usuari ha creat una nova categoria per a circulars Nº $id.");

        return redirect()->route('categoria-circular.index')->with('success', 'Categoria creada correctament');
    }

    public function edit($id)
    {
        $categoria = CatCircular::findOrFail($id);
        return view('circulars.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria = Catcircular::findOrFail($id);
        $categoria->nom = $request->input('nom');
        $categoria->save();

        logActivity('Edita Categoria Circualr', "ID: $id", "L'usuari ha editat una categoria de circular Nº $id.");

        return redirect()->route('categoria-circular.index')->with('success', 'Categoria actualitzada correctament');
    }

    public function destroy($id)
    {
        $categoria = CatCircular::findOrFail($id);
        $categoria->delete();

        logActivity('Eliminar Categoria Circualr', "ID: $id", "L'usuari ha eliminat una categoria de circular Nº $id.");

        return redirect()->route('categoria-circular.index')->with('success', 'Categoria eliminada correctament');
    }
}
