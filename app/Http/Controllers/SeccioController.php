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
        $seccions = Seccio::orderby('seccio')->paginate(10); 
        return view('seccions.index', compact('seccions')); 
    }

    public function create() { 
        return view('seccions.create'); 
    }

    public function store(Request $r) { 
        $seccio = Seccio::create($r->all());
        $id = $seccio->seccio; 
        logActivity('Crear Seccio', "Seccio: $id", "L'usuari ha creat la secció $id.");


        return redirect()->route('seccions.index'); 
    }

    public function edit($id) { 
        return view('seccions.edit', ['seccio' => Seccio::findOrFail($id)]); 
    }

    public function update(Request $r, $id) { 
        Seccio::findOrFail($id)->update($r->all()); 
        logActivity('Elimina Seccio', "ID: $id", "L'usuari ha editat una seccio Nº $id.");

        return redirect()->route('seccions.index'); 
    }

    public function destroy($id) { 
        Seccio::destroy($id); 
        logActivity('Elimina Seccio', "ID: $id", "L'usuari ha eliminat una seccio Nº $id.");

        return redirect()->route('seccions.index'); 
    }
}

