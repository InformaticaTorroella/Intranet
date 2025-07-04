<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefon;
use App\Models\Area;
use App\Models\Equipament;

class TelefonController extends Controller
{
    // Mostrar tots els telefons
    public function index(Request $request)
    {
        $equipament_id = $request->input('id_equipament');
        $area_id = $request->input('area_id');    
        $nom = $request->input('nom'); 
        $orderBy = $request->input('order_by', 'nom'); 
        $order = $request->input('order', 'asc');

        $equipaments = Equipament::orderBy('Equipament')->get();

        if ($equipament_id) {
            $arees = Area::whereHas('telefons', function ($query) use ($equipament_id) {
                $query->where('fk_id_equipament', $equipament_id);
            })->orderBy('Area')->get();
        } else {
            $arees = Area::orderBy('Area')->get();
        }

        $query = Telefon::query();

        if ($area_id) {
            $query->where('fk_id_area', $area_id);
        } elseif ($equipament_id) {
            $query->where('fk_id_equipament', $equipament_id);
        }

        if ($nom) {
            $query->where('nom', 'LIKE', $nom . '%');
        }

        $telefons = $query->orderByRaw('LOWER(' . $orderBy . ') ' . $order)->paginate(15);

        return view('telefons.index', compact('telefons', 'equipaments', 'arees', 'order', 'orderBy'));
    }



    // Mostrar formulari de creacio
    public function create()
    {
        $arees = Area::orderBy('Area')->get();
        $equipaments = Equipament::orderBy('Equipament')->get();
        return view('telefons.create', compact('arees', 'equipaments'));
    }

    // Guardar un nou telefon
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
            'data_edicio' => 'nullable|date',
        ]);

        $data = $request->all();
        if (empty($data['data_edicio'])) {
            $data['data_edicio'] = date('Y-m-d');
        }

        $telefon = Telefon::create($data);  

        $id = $telefon->id;

        logActivity('Crea Telefon', "ID: $id", "L'usuari ha creat el telefon Nº $id.");

        return redirect()->route('telefons.index')->with('success', 'Telèfon creat correctament!');
    }


    // Mostrar formulari de edició
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

    // Actualizar telefon
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
            'data_edicio' => 'nullable|date',
        ]);

        $data = $request->all();
        if (empty($data['data_edicio'])) {
            $data['data_edicio'] = date('Y-m-d');
        }

        Telefon::updateTelefon($id, $data);

        logActivity('Edita Telefon', "ID: $id", "L'usuari ha editat el telefon Nº $id.");

        return redirect()->route('telefons.index')->with('success', 'Telèfon actualitzat correctament!');
    }

    // Eliminar telefon
    public function destroy($id)
    {
        Telefon::deleteTelefon($id);

        logActivity('Eliminar Telefon', "ID: $id", "L'usuari ha eliminat el telefon Nº $id.");

        return redirect()->route('telefons.index')->with('success', 'Telèfon eliminat correctament!');
    }

    // Mostrar un telefon (opcional)
    public function show($id)
    {
        $telefon = Telefon::getTelefon($id);
        if (!$telefon) {
            return redirect()->route('telefons.index')->with('error', 'Telèfon no trobat');
        }
        return view('telefons.show', compact('telefon'));
    }
}