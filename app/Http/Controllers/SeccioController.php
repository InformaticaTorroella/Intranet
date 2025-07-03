<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccio;
use App\Models\Subseccio;
use App\Models\Serie;
use App\Models\TipologiaGial;
use App\Models\QuadreClassificacio;
use App\Models\QuadreClassificacioTipologia;

// 📚 Seccions
class SeccioController extends Controller
{
    public function index() { 
        return view('seccions.index', ['seccions' => Seccio::all()]); 
    }

    public function create() { 
        return view('seccions.create'); 
    }

    public function store(Request $r) { 
        Seccio::create($r->all()); 
        return redirect()->route('seccions.index'); 
    }

    public function edit($id) { 
        return view('seccions.edit', ['seccio' => Seccio::findOrFail($id)]); 
    }

    public function update(Request $r, $id) { 
        Seccio::findOrFail($id)->update($r->all()); 
        return redirect()->route('seccions.index'); 
    }

    public function destroy($id) { 
        Seccio::destroy($id); 
        return redirect()->route('seccions.index'); 
    }
}

