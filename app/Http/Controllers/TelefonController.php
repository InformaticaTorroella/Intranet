<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefon;

class TelefonController extends Controller
{
    // Mostrar todos los teléfonos
    public function index()
    {
        $telefons = Telefon::getAllTelefons();
        return view('telefons.index', compact('telefons'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('telefons.create');
    }

    // Guardar un nuevo teléfono
    public function store(Request $request)
    {
        $request->validate([
            'nom_telefon' => 'required|string|max:255',
            'num_directe' => 'nullable|string|max:50',
            'extensio_voip' => 'nullable|string|max:10',
            'num_directe_mobil' => 'nullable|string|max:50',
            'extensio_mobil' => 'nullable|string|max:10',
            'area' => 'nullable|integer',
            'edifici' => 'nullable|integer',
            'fk_tipus_obj' => 'nullable|integer',
            'data_edicio' => 'required|date',
        ]);

        Telefon::insertTelefon($request->all());
        return redirect()->route('telefons.index')->with('success', 'Telèfon creat correctament!');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $telefon = Telefon::getTelefon($id);
        if (!$telefon) {
            return redirect()->route('telefons.index')->with('error', 'Telèfon no trobat');
        }
        return view('telefons.edit', compact('telefon'));
    }

    // Actualizar teléfono
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_telefon' => 'required|string|max:255',
            'num_directe' => 'nullable|string|max:50',
            'extensio_voip' => 'nullable|string|max:10',
            'num_directe_mobil' => 'nullable|string|max:50',
            'extensio_mobil' => 'nullable|string|max:10',
            'area' => 'nullable|integer',
            'edifici' => 'nullable|integer',
            'fk_tipus_obj' => 'nullable|integer',
            'data_edicio' => 'required|date',
        ]);

        Telefon::updateTelefon($id, $request->all());
        return redirect()->route('telefons.index')->with('success', 'Telèfon actualitzat correctament!');
    }

    // Eliminar teléfono
    public function destroy($id)
    {
        Telefon::deleteTelefon($id);
        return redirect()->route('telefons.index')->with('success', 'Telèfon eliminat correctament!');
    }

    // Mostrar un teléfono (opcional)
    public function show($id)
    {
        $telefon = Telefon::getTelefon($id);
        if (!$telefon) {
            return redirect()->route('telefons.index')->with('error', 'Telèfon no trobat');
        }
        return view('telefons.show', compact('telefon'));
    }
}