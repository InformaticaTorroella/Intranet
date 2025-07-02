<?php

namespace App\Http\Controllers;

use App\Models\QuadresClassificacio;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiesGial;
use Illuminate\Http\Request;

class QuadresClassificacionsController extends Controller
{
    public function index()
    {
        $quadres_classificacions = QuadresClassificacio::with(['seccio', 'subseccio', 'serie', 'tipologies_gial'])->get();
        return view('quadres_classificacions.index', compact('quadres_classificacions'));
    }

    public function create()
    {
        $seccions = Seccio::all();
        $subseccions = Subseccio::all();
        $series = Serie::all();
        $tipologies_gial = TipologiesGial::all();

        return view('quadres_classificacions.create', compact('seccions', 'subseccions', 'series', 'tipologies_gial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fk_id_seccio' => 'required|exists:seccions,id_seccio',
            'fk_id_subseccio' => 'required|exists:subseccions,id_subseccio',
            'fk_id_serie' => 'required|exists:series,id_serie',
            'tipologies_gial' => 'array',
            'tipologies_gial.*' => 'exists:tipologies_gial,id',
            // Añade validación para otros campos aquí si hay
        ]);

        $quadre = QuadresClassificacio::create($request->only('fk_id_seccio', 'fk_id_subseccio', 'fk_id_serie'));

        if ($request->has('tipologies_gial')) {
            $quadre->tipologies_gial()->sync($request->input('tipologies_gial'));
        }

        return redirect()->route('quadres_classificacions.index')->with('success', 'Registro creado.');
    }

    public function edit(QuadresClassificacio $quadres_classificacio)
    {
        $seccions = Seccio::all();
        $subseccions = Subseccio::all();
        $series = Serie::all();
        $tipologies_gial = TipologiesGial::all();

        return view('quadres_classificacions.edit', compact('quadres_classificacio', 'seccions', 'subseccions', 'series', 'tipologies_gial'));
    }

    public function update(Request $request, QuadresClassificacio $quadres_classificacio)
    {
        $request->validate([
            'fk_id_seccio' => 'required|exists:seccions,id_seccio',
            'fk_id_subseccio' => 'required|exists:subseccions,id_subseccio',
            'fk_id_serie' => 'required|exists:series,id_serie',
            'tipologies_gial' => 'array',
            'tipologies_gial.*' => 'exists:tipologies_gial,id',
            // Añade validación para otros campos aquí si hay
        ]);

        $quadres_classificacio->update($request->only('fk_id_seccio', 'fk_id_subseccio', 'fk_id_serie'));

        if ($request->has('tipologies_gial')) {
            $quadres_classificacio->tipologies_gial()->sync($request->input('tipologies_gial'));
        } else {
            $quadres_classificacio->tipologies_gial()->sync([]);
        }

        return redirect()->route('quadres_classificacions.index')->with('success', 'Registro actualizado.');
    }

    public function destroy(QuadresClassificacio $quadres_classificacio)
    {
        $quadres_classificacio->tipologies_gial()->detach();
        $quadres_classificacio->delete();

        return redirect()->route('quadres_classificacions.index')->with('success', 'Registro eliminado.');
    }
}
