<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefon;
use App\Models\Area;
use App\Models\Equipament;

class TelefonController extends Controller
{
    // Mostrar todos los teléfonos


    // En tu controlador, método que carga la vista
    public function index(Request $request)
    {
        $equipament_id = $request->input('id_equipament');
        $area_id = $request->input('area_id');

        // Cargar equipaments ordenados
        $equipaments = Equipament::orderBy('Equipament')->get();

        // Si hay equipament seleccionado, filtrar áreas con teléfonos solo de ese equipament
        if ($equipament_id) {
            // Si hay equipament, sólo áreas con teléfonos en ese equipament
            $arees = Area::whereHas('telefons', function ($query) use ($equipament_id) {
                $query->where('fk_id_equipament', $equipament_id);
            })->orderBy('Area')->get();
        } else {
            // Si no hay equipament, todas las áreas
            $arees = Area::orderBy('Area')->get();
        }


        // Consulta base para teléfonos
        $query = Telefon::query();

        if ($area_id) {
            $query->where('fk_id_area', $area_id);
        } elseif ($equipament_id) {
            $query->where('fk_id_equipament', $equipament_id);
        }

        $telefons = $query->orderBy('nom')->get();

        return view('telefons.index', compact('telefons', 'equipaments', 'arees'));
    }




    // Mostrar formulario de creación
    public function create()
    {
        $arees = Area::orderBy('Area')->get();
        $equipaments = Equipament::orderBy('Equipament')->get();
        return view('telefons.create', compact('arees', 'equipaments'));
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

        $arees = Area::orderBy('Area')->get();
        $equipaments = Equipament::orderBy('Equipament')->get();

        return view('telefons.edit', compact('telefon', 'arees', 'equipaments'));
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