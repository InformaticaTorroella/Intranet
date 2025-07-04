<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacio;
use App\Models\QuadreClassificacioTipologia;

class TipologiaGialController extends Controller
{
    public function index() { 
        $tipologies = TipologiaGial::orderBy('codi')->paginate(10);
        return view('tipologies_gial.index', compact('tipologies')); 
    }

    public function create() { 
        return view('tipologies_gial.create'); 
    }

    public function store(Request $r) { 
        TipologiaGial::create($r->all()); 
        return redirect()->route('tipologies-gial.index'); 
    }

    public function edit($id) { 
        return view('tipologies_gial.edit', ['tipologia' => TipologiaGial::findOrFail($id)]); 
    }

    public function update(Request $r, $id) { 
        TipologiaGial::findOrFail($id)->update($r->all()); 
        return redirect()->route('tipologies-gial.index'); 
    }

    public function destroy($id) { 
        TipologiaGial::destroy($id); 
        return redirect()->route('tipologies-gial.index'); 
    }
}

