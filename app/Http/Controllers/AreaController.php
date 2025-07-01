<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Equipament;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('nom')->get();
        return view('telefons.area.index', compact('areas'));
    }

    public function create()
    {
        $edificis = Equipament::orderBy('equipament')->get();
        return view('telefons.area.create', compact('edificis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $area = new Area();
        $area->nom = $request->input('nom');
        $area->save();

        return redirect()->route('telefons.area.index')->with('success', 'Area creada correctament');
    }

    public function edit($id)
    {
        $categoria = Area::findOrFail($id);
        $edificis = Equipament::orderBy('nom')->get();
        return view('telefons.area.edit', compact('edificis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $area = Area::findOrFail($id);
        $area->nom = $request->input('nom');
        $area->save();

        return redirect()->route('telefons.area.index')->with('success', 'Area actualitzada correctament');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('telefons.area.index')->with('success', 'Area eliminada correctament');
    }
}
