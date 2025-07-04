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
        $areas = Area::with('Equipament')->orderBy('Area')->paginate(10);
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

        $id = $area->IdArea;

        logActivity('Crea Area', "ID: $id", "L'usuari ha creat l'area Nº $id.");

        return Redirect::route('area-telefons.index')->with('success', 'Area creada correctament');
    }


    public function edit(string $id)
    {
        $area = Area::findOrFail($id);
        $edificis = Equipament::orderBy('Equipament')->get();
        return view('telefons.area.edit', compact('area', 'edificis'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'Area' => 'required|string|max:255',
            'id_equimanent' => 'required|exists:int_equipaments,id_equimanent',
        ]);

        $area = Area::findOrFail($id); 
        $area->Area = $request->input('Area');
        $area->id_equimanent = $request->input('id_equimanent');
        $area->save(); 

        logActivity('Edita Area', "ID: $id", "L'usuari ha creat l'area Nº $id.");

        return Redirect::route('area-telefons.index')->with('success', 'Àrea actualitzada correctament');
    }



    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        logActivity('Eliminar Area', "ID: $id", "L'usuari ha creat l'area Nº $id.");

        return redirect()->route('area-telefons.index')->with('success', 'Area eliminada correctament');
    }
}
