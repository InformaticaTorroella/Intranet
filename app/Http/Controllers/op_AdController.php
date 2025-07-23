<?php

namespace App\Http\Controllers;

use App\Models\op_Ad;
use App\Models\op_Usuari;
use App\Models\op_Partida;
use App\Models\op_Tercer;
use Illuminate\Http\Request;

class op_AdController extends Controller
{
    public function index()
    {
        $ads = op_Ad::with(['responsable', 'partidaRel', 'tercer'])->paginate(10);
        return view('op_ads.index', compact('ads'));
    }

    public function create()
    {
        $usuaris = op_Usuari::all();
        $partides = op_Partida::all();
        $tercers = op_Tercer::all();
        return view('op_ads.create', compact('usuaris', 'partides', 'tercers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'responsable_id' => 'required|exists:op_usuaris,id',
            'partida' => 'required|exists:op_partides,partida',
            'import_reserva' => 'required|numeric',
            'exp_sedipualba' => 'nullable|string',
            'concepte_despesa' => 'nullable|string',
            'cif' => 'nullable|exists:op_tercers,ter_doc',
            'rc' => 'nullable|string',
        ]);

        op_Ad::create($validated);

        return redirect()->route('op_ads.index')->with('success', 'Registre creat correctament.');
    }

    public function edit(op_Ad $ad)
    {
        $usuaris = op_Usuari::all();
        $partides = op_Partida::all();
        $tercers = op_Tercer::all();
        return view('op_ads.edit', compact('ad', 'usuaris', 'partides', 'tercers'));
    }

    public function update(Request $request, op_Ad $ad)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'responsable_id' => 'required|exists:op_usuaris,id',
            'partida' => 'required|exists:op_partides,partida',
            'import_reserva' => 'required|numeric',
            'exp_sedipualba' => 'nullable|string',
            'concepte_despesa' => 'nullable|string',
            'cif' => 'nullable|exists:op_tercers,ter_doc',
            'rc' => 'nullable|string',
        ]);

        $ad->update($validated);

        return redirect()->route('op_ads.index')->with('success', 'Registre actualitzat correctament.');
    }

    public function destroy(op_Ad $ad)
    {
        $ad->delete();
        return redirect()->route('op_ads.index')->with('success', 'Registre eliminat.');
    }
}

