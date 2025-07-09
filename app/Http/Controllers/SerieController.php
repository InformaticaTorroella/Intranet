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
    public function index(Request $request)
    {
        $search = $request->input('serie');

        $query = Serie::with('subseccio');

        if ($search) {
            $query->where('serie', 'like', '%' . $search . '%');
        }

        $series = $query->orderBy('serie')->paginate(10);


        return view('series.index', compact('series'));
    }
    public function create() { 
        return view('series.create', ['subseccions' => Subseccio::all()]); 
    }
    public function store(Request $r) { 
        $serie = Serie::create($r->all()); 
        $id = $serie->serie; 
        logActivity('Crea Serie', "Serie: $id", "L'usuari ha creat una serie $id.");


        return redirect()->route('series.index'); 
    }
    public function edit($id) { 
        return view('series.edit', ['serie' => Serie::findOrFail($id), 'subseccions' => Subseccio::all()]);
    }
    public function update(Request $r, $id) { 
        Serie::findOrFail($id)->update($r->all()); 
        logActivity('Editar Serie', "ID: $id", "L'usuari ha editat una serie Nº $id.");

        return redirect()->route('series.index');
    }
    public function destroy($id) { 
        Serie::destroy($id); 
        logActivity('Elimina Serie', "ID: $id", "L'usuari ha eliminat una serie Nº $id.");

        return redirect()->route('series.index'); 
    }
}

