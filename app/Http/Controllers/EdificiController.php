<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Equipament;

class EdificiController extends Controller
{
    public function index()
    {
        $equipaments = Equipament::orderBy('Equipament')->get();
        return view('telefons.edifici.index', compact('equipaments'));
    }

    public function create()
    {
        return view('telefons.edifici.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Equipament' => 'required|string|max:255',
        ]);

        $equipament = new Equipament();
        $equipament->Equipament = $request->input('Equipament');
        $equipament->save();

        return Redirect::route('edifici-telefons.index')->with('success', 'Edifici creat correctament');
    }

    public function edit(string $id)
    {
        $equipament = Equipament::findOrFail($id);
        return view('telefons.edifici.edit', compact('equipament'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'Equipament' => 'required|string|max:255',
        ]);

        $equipament = Equipament::findOrFail($id);
        $equipament->Equipament = $request->input('Equipament');
        $equipament->save();

        return Redirect::route('edifici-telefons.index')->with('success', 'Edifici actualitzat correctament');
    }

    public function destroy($id)
    {
        $equipament = Equipament::findOrFail($id);
        $equipament->delete();

        return redirect()->route('edifici-telefons.index')->with('success', 'Edifici eliminat correctament');
    }
}
