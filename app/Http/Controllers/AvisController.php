<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {
        $avisos = Avis::orderBy('data_creacio', 'desc')->get();
        return view('avis.index', compact('avisos'));
    }


    public function create()
    {

        return view('avis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titol' => 'required|string|max:255',
            'contingut' => 'required|string',
            'bool_avis_info' => 'nullable|boolean',
            'bool_avis_alert' => 'nullable|boolean',
            'solucionat' => 'nullable|boolean',
            'data_creacio' => 'nullable|date',
            'data_solucionat' => 'nullable|date',
            'contingut_solucionat' => 'nullable|string',
            'titol_solucionat' => 'nullable|string|max:255',
            'bool_correu' => 'nullable|boolean',
            'trial633' => 'nullable|string|max:1',
        ]);

        $avis = new Avis();
        $avis->titol = $validated['titol'];
        $avis->contingut = $validated['contingut'];
        $avis->bool_avis_info = $validated['bool_avis_info'] ?? 0;
        $avis->bool_avis_alert = $validated['bool_avis_alert'] ?? 0;
        $avis->solucionat = $validated['solucionat'] ?? 0;
        $avis->data_creacio = $validated['data_creacio'] ?? now();
        $avis->data_solucionat = $validated['data_solucionat'] ?? null;
        $avis->contingut_solucionat = $validated['contingut_solucionat'] ?? null;
        $avis->titol_solucionat = $validated['titol_solucionat'] ?? null;
        $avis->bool_correu = $validated['bool_correu'] ?? 0;
        $avis->trial633 = $validated['trial633'] ?? null;

        $avis->save();

        $id = $avis->id;

        logActivity('Crea Avis', "ID: $id", "L'usuari ha creat l'avis Nº $id.");

        return redirect()->route('avis.index')->with('success', 'Avís creat');
    }

    public function show($id)
    {
        $avis = Avis::findOrFail($id);
        return view('avis.show', compact('avis'));
    }

    public function edit($id)
    {
        $avis = Avis::findOrFail($id);

        return view('avis.edit', compact('avis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titol' => 'required|string|max:255',
            'contingut' => 'required|string',
            'bool_avis_info' => 'nullable|boolean',
            'bool_avis_alert' => 'nullable|boolean',
            'solucionat' => 'nullable|boolean',
            'data_creacio' => 'nullable|date',
            'data_solucionat' => 'nullable|date',
            'contingut_solucionat' => 'nullable|string',
            'titol_solucionat' => 'nullable|string|max:255',
            'bool_correu' => 'nullable|boolean',
            'trial633' => 'nullable|string|max:1',
        ]);

        $avis = Avis::findOrFail($id);

        $avis->titol = $validated['titol'];
        $avis->contingut = $validated['contingut'];
        $avis->bool_avis_info = $validated['bool_avis_info'] ?? 0;
        $avis->bool_avis_alert = $validated['bool_avis_alert'] ?? 0;
        $avis->solucionat = $validated['solucionat'] ?? 0;
        $avis->data_creacio = $validated['data_creacio'] ?? $avis->data_creacio;
        $avis->data_solucionat = $validated['data_solucionat'] ?? null;
        $avis->contingut_solucionat = $validated['contingut_solucionat'] ?? null;
        $avis->titol_solucionat = $validated['titol_solucionat'] ?? null;
        $avis->bool_correu = $validated['bool_correu'] ?? 0;
        $avis->trial633 = $validated['trial633'] ?? null;

        $avis->save();

        $username = session('username'); // Primer recuparem el nom del usuari

        logActivity('Edita Avis', "ID: $id", "L'usuari ha editat l'avis Nº $id.");

        return redirect()->route('avis.index')->with('success', 'Avís actualitzat');
    }

    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();

        logActivity('Elimiar Avis', "ID: $id", "L'usuari ha eliminat l'avis Nº $id.");
        
        return redirect()->route('avis.index')->with('success', 'Avís eliminat');
    }
}
