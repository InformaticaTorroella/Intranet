<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacio;
use App\Models\QuadreClassificacioTipologia;


class QuadreClassificacioTipologiaController extends Controller
{
    public function index() {
        return view('quadres_classificacions_tipologies.index', [
            'pivot' => QuadreClassificacioTipologia::with(['quadre', 'tipologia'])->get()
        ]);
    }
    public function create() {
        return view('quadres_classificacions_tipologies.create', [
            'quadres' => QuadreClassificacio::all(),
            'tipologies' => TipologiaGial::all()
        ]);
    }
    public function store(Request $r) {
        QuadreClassificacioTipologia::create($r->all());
        return redirect()->route('quadres-classificacions-tipologies.index');
    }
    public function edit($id) {
        return view('quadres_classificacions_tipologies.edit', [
            'pivotItem' => QuadreClassificacioTipologia::findOrFail($id),
            'quadres' => QuadreClassificacio::all(),
            'tipologies' => TipologiaGial::all()
        ]);
    }
    public function update(Request $r, $id) {
        QuadreClassificacioTipologia::findOrFail($id)->update($r->all());
        return redirect()->route('quadres-classificacions-tipologies.index');
    }
    public function destroy($id) {
        QuadreClassificacioTipologia::destroy($id);
        return redirect()->route('quadres-classificacions-tipologies.index');
    }
}