<?php

namespace App\Http\Controllers;

use App\Models\op_Tercer;
use Illuminate\Http\Request;

class op_TercerController extends Controller
{
    public function index()
    {
        $tercers = op_Tercer::paginate(15);
        return view('op_tercers.index', compact('tercers'));
    }

    public function create()
    {
        return view('op_tercers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TER_DOC' => 'required|string|max:20|unique:op_tercers_aytos,TER_DOC',
            'TER_NOM' => 'required|string|max:255',
            'TER_DOM' => 'nullable|string|max:255',
            'TER_POB' => 'nullable|string|max:100',
            'TER_CPO' => 'nullable|integer',
            'TER_PRO' => 'nullable|string|max:100',
            'TER_TLF' => 'nullable|string|max:50',
            'TER_FAX' => 'nullable|string|max:50',
            'TER_DCE' => 'nullable|string|max:255',
        ]);

        op_Tercer::create($request->all());

        return redirect()->route('op_tercers.index')->with('success', 'Tercer creat correctament');
    }

    public function edit(op_Tercer $op_tercer)
    {
        return view('op_tercers.edit', compact('op_tercer'));
    }

    public function update(Request $request, op_Tercer $op_tercer)
    {
        $request->validate([
            'TER_DOC' => 'required|string|max:20|unique:op_tercers_aytos,TER_DOC,' . $op_tercer->ter_doc . ',TER_DOC',
            'TER_NOM' => 'required|string|max:255',
            'TER_DOM' => 'nullable|string|max:255',
            'TER_POB' => 'nullable|string|max:100',
            'TER_CPO' => 'nullable|string|max:5',
            'TER_PRO' => 'nullable|string|max:100',
            'TER_TLF' => 'nullable|string|max:50',
            'TER_FAX' => 'nullable|string|max:50',
            'TER_DCE' => 'nullable|string|max:255',
        ]);

        $op_tercer->update($request->all());

        return redirect()->route('op_tercers.index')->with('success', 'Tercer actualitzat correctament');
    }

    public function destroy(op_Tercer $op_tercer)
    {
        $op_tercer->delete();
        return redirect()->route('op_tercers.index')->with('success', 'Tercer eliminat');
    }
}
