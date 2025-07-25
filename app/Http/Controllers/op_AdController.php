<?php

namespace App\Http\Controllers;

use App\Models\op_Ad;
use App\Models\op_Usuari;
use App\Models\op_Partida;
use App\Models\op_Tercer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class op_AdController extends Controller
{
    public function index()
    {
        $username = session('name');
        $userGroups = session('user_groups', []);

        $hasGroupAccess = in_array('Intranet_Operacions', $userGroups) || in_array('Intranet_Administracio', $userGroups);

        if ($hasGroupAccess) {
            $ads = op_Ad::with(['responsable', 'partidaRel', 'tercer'])->paginate(10);
            return view('op_ads.index', compact('ads'))->with('noUser', false);
        }

        if (!$username) {
            $ads = new LengthAwarePaginator([], 0, 10);
            return view('op_ads.index', compact('ads'))->with('noUser', true);
        }

        $usuari = op_Usuari::where('nom', $username)->first();

        if (!$usuari) {
            $ads = new LengthAwarePaginator([], 0, 10);
            return view('op_ads.index', compact('ads'))->with('noUser', true);
        }

        $ads = op_Ad::with(['responsable', 'partidaRel', 'tercer'])
            ->where('responsable_id', $usuari->id)
            ->paginate(10);

        return view('op_ads.index', compact('ads'))->with('noUser', false);
    }

    public function create()
    {
        $usuaris = op_Usuari::all();
        $partides = op_Partida::all();
        $tercers = op_Tercer::orderBy('TER_NOM', 'asc')->get();
        return view('op_ads.create', compact('usuaris', 'partides', 'tercers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'responsable_id' => 'required|exists:op_usuaris,id',
            'partida' => 'required|exists:op_partides,partida',
            'import_reserva' => 'required|numeric',
            'exp_sedipualba' => 'nullable|string',
            'concepte_despesa' => 'nullable|string',
            'cif' => 'nullable|exists:op_tercers_aytos,TER_ITE',
            'rc' => 'nullable|string',
        ]);

        op_Ad::create($validated);

        return redirect()->route('op_ads.index')->with('success', 'Registre creat correctament.');
    }

    public function edit(op_Ad $op_ad)
    {
        return view('op_ads.edit', [
            'ad' => $op_ad, // <- esta es la variable que usas en la vista
            'usuaris' => op_Usuari::all(),
            'partides' => op_Partida::all(),
            'tercers' => op_Tercer::all(),
        ]);
    }


    public function update(Request $request, $id)
    {
        $ad = op_Ad::findOrFail($id);

        $validated = $request->validate([
            'data' => 'required|date',
            'responsable_id' => 'required|exists:op_usuaris,id',
            'partida' => 'required|exists:op_partides,partida',
            'import_reserva' => 'required|numeric',
            'exp_sedipualba' => 'nullable|string',
            'concepte_despesa' => 'nullable|string',
            'cif' => 'nullable|exists:op_tercers_aytos,TER_ITE',
            'rc' => 'nullable|string',
        ]);


        $ad->fill($validated);
        $ad->save();

        return redirect()->route('op_ads.index')->with('success', 'Registre actualitzat correctament.');
    }

    public function destroy($id)
    {
        $ad = op_Ad::findOrFail($id);
        $ad->delete();
        return redirect()->route('op_ads.index')->with('success', 'Registre eliminat.');
    }


}

