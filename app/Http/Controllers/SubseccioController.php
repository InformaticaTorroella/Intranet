<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacio;
use App\Models\QuadreClassificacioTipologia;

// 🧩 Subseccions
class SubseccioController extends Controller
{
    public function index() { 

        $subseccions = Subseccio::orderBy('subseccio')->paginate(10); 
        return view('subseccions.index', compact('subseccions')); 
    }

    public function create() { 
        return view('subseccions.create', ['seccions' => Seccio::all()]); 
    }

    public function store(Request $r) { 
        Subseccio::create($r->all()); 
        return redirect()->route('subseccions.index'); 
    }

    public function edit($id) { 
        return view('subseccions.edit', ['subseccio' => Subseccio::findOrFail($id), 'seccions' => Seccio::all()]); 
    }

    public function update(Request $r, $id) { 
        Subseccio::findOrFail($id)->update($r->all()); 
        return redirect()->route('subseccions.index'); 
    }

    public function destroy($id) { 
        Subseccio::destroy($id); 
        return redirect()->route('subseccions.index'); 
    }

}


