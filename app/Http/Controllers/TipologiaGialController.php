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
    public function index(Request $request) {
        $tipologies = TipologiaGial::query()
            ->when($request->filled('codi'), function ($query) use ($request) {
                $query->where('codi', 'like', '%' . $request->input('codi') . '%');
            })
            ->paginate(40); // o el nombre que vulguis

        return view('tipologies_gial.index', compact('tipologies'));
    }



    public function create() { 
        return view('tipologies_gial.create'); 
    }

    public function store(Request $r) { 
        $tipologia = TipologiaGial::create($r->all());
        $id = $tipologia->codi; 
        logActivity('Crear Tipologia GIAL', "ID: $id", "L'usuari ha creat una tipologia GIAL Nº $id.");
        return redirect()->route('tipologies-gial.index'); 
    }

    public function edit($id) { 
        return view('tipologies_gial.edit', ['tipologia' => TipologiaGial::findOrFail($id)]); 
    }

    public function update(Request $r, $id) { 
        TipologiaGial::findOrFail($id)->update($r->all()); 
        logActivity('Editar Tipologia GIAL', "ID: $id", "L'usuari ha editat la tipologia GIAL Nº $id.");
        return redirect()->route('tipologies-gial.index'); 
    }

    public function destroy($id) { 
        TipologiaGial::destroy($id); 
        logActivity('Eliminar Tipologia GIAL', "ID: $id", "L'usuari ha eliminat la tipologia GIAL Nº $id.");
        return redirect()->route('tipologies-gial.index'); 
    }
}

