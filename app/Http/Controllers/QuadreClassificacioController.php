<?php

namespace App\Http\Controllers;

use App\Models\QuadreClassificacio;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;

// 📊 Quadres Classificacions
class QuadreClassificacioController extends Controller
{
    public function index() {
        return view('quadres.index', [
            'quadres' => QuadreClassificacio::with(['seccio', 'subseccio', 'serie'])->get()
        ]);
    }
    public function create() {
        return view('quadres.create', [
            'seccions' => Seccio::all(),
            'subseccions' => Subseccio::all(),
            'series' => Serie::all(),
            'tipologies' => TipologiaGial::all(),
        ]);
    }
    public function store(Request $r) {
        QuadreClassificacio::create($r->all());
        return redirect()->route('quadres.index');
    }
    public function edit($id) {
        return view('quadres.edit', [
            'quadre' => QuadreClassificacio::findOrFail($id),
            'seccions' => Seccio::all(),
            'subseccions' => Subseccio::all(),
            'series' => Serie::all(),
            'tipologies' => TipologiaGial::all(),
        ]);
    }
    public function update(Request $r, $id) {
        QuadreClassificacio::findOrFail($id)->update($r->all());
        return redirect()->route('quadres.index');
    }
    public function destroy($id) {
        QuadreClassificacio::destroy($id);
        return redirect()->route('quadres.index');
    }
}


