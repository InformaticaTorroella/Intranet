<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipament;
// en la db equipaments son els edificis
class EdificiController extends Controller
{
    public function index()
    {
        $edificis = Equipament::orderBy('nom')->get();
        return view('telefons.edifici.index', compact('edificis'));
    }

    public function create()
    {
        return view('edifici=telefons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $edifici = new Equipament();
        $edifici->nom = $request->input('nom');
        $edifici->save();

        return redirect()->route('telefons.edifici.index')->with('success', 'Edifici creada correctament');
    }

    public function edit($id)
    {
        $edifici = Equipament::findOrFail($id);
        return view('telefons.edifici.edit', compact('edificis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $edifici = Equipament::findOrFail($id);
        $edifici->nom = $request->input('nom');
        $edifici->save();

        return redirect()->route('telefons.edifici.index')->with('success', 'Edifici actualitzada correctament');
    }

    public function destroy($id)
    {
        $edifici = Equipament::findOrFail($id);
        $edifici->delete();

        return redirect()->route('telefons.edifici.index')->with('success', 'Edifici eliminada correctament');
    }
}
