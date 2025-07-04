<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuadreClassificacio;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacioTipologia; // añadir para usar

// 📊 Quadres Classificacions
class QuadreClassificacioController extends Controller
{
    public function index(Request $request) {
        $orderBy = $request->get('order_by', 'id'); // columna por defecto
        $order = $request->get('order', 'asc');    // dirección por defecto

        $allowedOrderColumns = ['id', 'fk_id_seccio', 'fk_id_serie']; // columnas permitidas para ordenar
        if (!in_array($orderBy, $allowedOrderColumns)) {
            $orderBy = 'id';
        }
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        $quadres = QuadreClassificacio::with(['seccio', 'subseccio', 'serie'])
            ->orderBy($orderBy, $order)
            ->paginate(25);

        return view('quadres.index', compact('quadres', 'orderBy', 'order'));
    }

    public function create(Request $request)
    {
        $seccions = Seccio::all();

        $fk_id_seccio = $request->input('fk_id_seccio');
        $fk_id_subseccio = $request->input('fk_id_subseccio');
        $fk_id_serie = $request->input('fk_id_serie');

        $subseccions = collect();
        $series = collect();

        if ($fk_id_seccio) {
            $subseccions = Subseccio::where('fk_id_seccio', $fk_id_seccio)->get();
        }

        if ($fk_id_subseccio) {
            $series = Serie::where('fk_id_subseccio', $fk_id_subseccio)->get();
        }

        if ($fk_id_serie) {
            $serie = Serie::with('subseccio.seccio')->find($fk_id_serie);
            if ($serie) {
                $fk_id_subseccio = $serie->fk_id_subseccio;
                $fk_id_seccio = $serie->subseccio->fk_id_seccio;

                if ($subseccions->isEmpty()) {
                    $subseccions = Subseccio::where('fk_id_seccio', $fk_id_seccio)->get();
                }
                if ($series->isEmpty()) {
                    $series = Serie::where('fk_id_subseccio', $fk_id_subseccio)->get();
                }
            }
        }

        // Excluir tipologies GIAL ya vinculadas a cualquier quadre
        $usedTipologiesIds = QuadreClassificacioTipologia::pluck('fk_id_tipologia_gial')->toArray();
        $tipologies = TipologiaGial::whereNotIn('id', $usedTipologiesIds)->get();

        return view('quadres.create', compact(
            'seccions',
            'subseccions',
            'series',
            'fk_id_seccio',
            'fk_id_subseccio',
            'fk_id_serie',
            'tipologies'
        ));
    }

    public function store(Request $request)
    {
        // Crear el quadre primero
        $quadre = QuadreClassificacio::create($request->only([
            'fk_id_seccio',
            'fk_id_subseccio',
            'fk_id_serie'
        ]));

        // Asociar tipologies si hay
        if ($request->has('tipologies')) {
            $quadre->tipologies()->sync($request->input('tipologies'));
        }

        return redirect()->route('quadres.index');
    }

    public function edit($id)
    {
        $quadre = QuadreClassificacio::findOrFail($id);

        // Tipologies GIAL usadas en otros quadres (excluir)
        $usedTipologiesIds = QuadreClassificacioTipologia::where('fk_id_quadre_classificacio', '!=', $id)
            ->pluck('fk_id_tipologia_gial')->toArray();

        // Permitir incluir las tipologies ya asignadas a este quadre
        $tipologies = TipologiaGial::whereNotIn('id', $usedTipologiesIds)
            ->orWhereIn('id', $quadre->tipologies->pluck('id')->toArray())
            ->get();

        return view('quadres.edit', [
            'quadre' => $quadre,
            'seccions' => Seccio::all(),
            'subseccions' => Subseccio::all(),
            'series' => Serie::all(),
            'tipologies' => $tipologies,
        ]);
    }

    public function update(Request $r, $id) {
        $quadre = QuadreClassificacio::findOrFail($id);
        $quadre->update($r->all());

        if ($r->has('tipologies')) {
            $quadre->tipologies()->sync($r->input('tipologies'));
        }

        return redirect()->route('quadres.index');
    }

    public function destroy($id) {
        QuadreClassificacio::destroy($id);
        return redirect()->route('quadres.index');
    }

    public function getSubseccions($seccioId)
    {
        return Subseccio::where('fk_id_seccio', $seccioId)->get();
    }

    public function getSeries($subseccioId)
    {
        return Serie::where('fk_id_subseccio', $subseccioId)->get();
    }

    public function getSerieInfo($serieId)
    {
        $serie = Serie::with('subseccio.seccio')->findOrFail($serieId);
        return response()->json([
            'subseccio_id' => $serie->fk_id_subseccio,
            'seccio_id' => $serie->subseccio->fk_id_seccio,
        ]);
    }

}
