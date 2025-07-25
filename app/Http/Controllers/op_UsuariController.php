<?php

namespace App\Http\Controllers;

use App\Models\op_usuari;
use Illuminate\Http\Request;

class op_UsuariController extends Controller
{
    public function index()
    {
        $usuaris = op_usuari::paginate(15);
        return view('op_usuaris.index', compact('usuaris'));
    }

    public function create()
    {
        return view('op_usuaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        op_usuari::create($request->all());

        return redirect()->route('op_usuaris.index')->with('success', 'Usuari creat correctament');
    }

    public function edit(op_usuari $op_usuari)
    {
        return view('op_usuaris.edit', compact('op_usuari'));
    }

    public function update(Request $request, op_usuari $op_usuari)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $op_usuari->update($request->all());

        return redirect()->route('op_usuaris.index')->with('success', 'Usuari actualitzat correctament');
    }

    public function destroy(op_usuari $op_usuari)
    {
        $op_usuari->delete();
        return redirect()->route('op_usuaris.index')->with('success', 'Usuari eliminat');
    }
}
