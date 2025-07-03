<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacio;
use App\Models\QuadreClassificacioTipologia;


// 📦 Series
class SerieController extends Controller
{
    public function index() { 
        return view('series.index', ['series' => Serie::with('subseccio')->get()]); 
    }
    public function create() { 
        return view('series.create', ['subseccions' => Subseccio::all()]); 
    }
    public function store(Request $r) { 
        Serie::create($r->all()); 
        return redirect()->route('series.index'); 
    }
    public function edit($id) { 
        return view('series.edit', ['serie' => Serie::findOrFail($id), 'subseccions' => Subseccio::all()]);
    }
    public function update(Request $r, $id) { 
        Serie::findOrFail($id)->update($r->all()); 
        return redirect()->route('series.index');
    }
    public function destroy($id) { 
        Serie::destroy($id); 
        return redirect()->route('series.index'); 
    }
}

