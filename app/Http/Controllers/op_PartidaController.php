<?php

namespace App\Http\Controllers;

use App\Models\op_Partida;
use App\Models\op_usuari;
use Illuminate\Http\Request;

class op_PartidaController extends Controller
{
    public function index()
    {
        $partides = op_Partida::with('responsable')->paginate(15);
        return view('op_partides.index', compact('partides'));
    }

    public function create()
    {
        $usuaris = op_usuari::all();
        return view('op_partides.create', compact('usuaris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'partida' => 'required|string|max:20|unique:op_partides,partida',
            'descripcio' => 'required|string|max:255',
            'responsable_id' => 'nullable|exists:op_usuaris,id',
        ]);

        op_Partida::create($request->all());

        return redirect()->route('op_partides.index')->with('success', 'Partida creada correctament');
    }

    public function edit(op_Partida $op_partide)
    {
        $usuaris = op_usuari::all();
        return view('op_partides.edit', compact('op_partide', 'usuaris'));
    }

    public function update(Request $request, op_Partida $op_partide)
    {
        $request->validate([
            'partida' => 'required|string|max:20|unique:op_partides,partida,' . $op_partide->partida . ',partida',
            'descripcio' => 'required|string|max:255',
            'responsable_id' => 'nullable|exists:op_usuaris,id',
        ]);

        $op_partide->update($request->all());

        return redirect()->route('op_partides.index')->with('success', 'Partida actualitzada correctament');
    }

    public function destroy(op_Partida $op_partide)
    {
        $op_partide->delete();
        return redirect()->route('op_partides.index')->with('success', 'Partida eliminada');
    }
}
