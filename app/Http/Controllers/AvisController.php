<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index(Request $request)
    {
        $query = Avis::query();

        if ($request->filled('filter_tipo')) {
            if ($request->filter_tipo === 'info') {
                $query->where('bool_avis_info', 1);
            } elseif ($request->filter_tipo === 'alert') {
                $query->where('bool_avis_alert', 1);
            }
        }

        if ($request->filled('filter_solucionat')) {
            $query->where('solucionat', $request->filter_solucionat);
        }

        $avisos = $query->orderBy('data_creacio', 'desc')->get();

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
        ]);

        // Validar que solo uno de los dos bools esté activo
        if (($validated['bool_avis_info'] ?? 0) + ($validated['bool_avis_alert'] ?? 0) !== 1) {
            return back()
                ->withInput()
                ->withErrors(['bool_avis_info' => 'Has de seleccionar només una opció: informació o alerta.']);
        }

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

        $avis->save();

        logActivity('Crea Avis', "ID: {$avis->id}", "L'usuari ha creat l'avis Nº {$avis->id}.");

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
        ]);

        if (($validated['bool_avis_info'] ?? 0) + ($validated['bool_avis_alert'] ?? 0) !== 1) {
            return back()
                ->withInput()
                ->withErrors(['bool_avis_info' => 'Has de seleccionar només una opció: informació o alerta.']);
        }

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

        $avis->save();

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
