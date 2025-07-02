<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Area;
use App\Models\Equipament;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('Area')->get();
        return view('telefons.area.index', compact('areas'));
    }

    public function create()
    {
        $edificis = Equipament::orderBy('Equipament')->get();
        return view('telefons.area.create', compact('edificis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Area' => 'required|string|max:255',
            'id_equimanent' => 'required|exists:int_equipaments,id_equimanent',
        ]);

        $area = new Area();
        $area->Area = $request->input('Area');
        $area->id_equimanent = $request->input('id_equimanent');
        $area->save();

        return Redirect::route('area-telefons.index')->with('success', 'Area creada correctament');
    }


    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $edificis = Equipament::orderBy('equipament')->get();
        return view('telefons.area.edit', compact('area', 'edificis'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'Area' => 'required|string|max:255',
        ]);

        $area = Area::findOrFail($id);
        $area->Area = $request->input('Area');
        $area->save();

        return redirect()->route('area-telefons.index')->with('success', 'Area actualitzada correctament');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('area-telefons.index')->with('success', 'Area eliminada correctament');
    }
}
