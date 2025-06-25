<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Telefon extends Model
{
    protected $table = 'int_telefons';
    public $timestamps = false; // As data_edicio is manually managed

    protected $fillable = [
        'nom',
        'num_directe',
        'extensio_voip',
        'fk_id_area',
        'fk_id_equipament',
        'num_directe_mobil',
        'extensio_mobil',
        'fk_tipus_obj',
        'data_edicio',
    ];

    // GET ALL TELEFONS
    public static function getAllTelefons()
    {
        // Laravel doesn't have TRANSLATE, simulate by removing accents in PHP after query or use raw SQL without TRANSLATE
        // Here, just return ordered by nom
        return self::orderBy('nom', 'asc')->get();
    }

    // GET ONE TELEFON BY ID
    public static function getTelefon($id)
    {
        return self::find($id);
    }

    // INSERT NEW TELEFON
    public static function insertTelefon(array $data)
    {
        $telefon = new self();
        $telefon->nom = $data['nom_telefon'];
        $telefon->num_directe = $data['num_directe'];
        $telefon->extensio_voip = $data['extensio_voip'];
        $telefon->fk_id_area = $data['area'];
        $telefon->fk_id_equipament = $data['edifici'];
        $telefon->num_directe_mobil = $data['num_directe_mobil'];
        $telefon->extensio_mobil = $data['extensio_mobil'];
        $telefon->fk_tipus_obj = $data['fk_tipus_obj'];
        $telefon->data_edicio = Carbon::parse($data['data_edicio']);
        $telefon->save();

        return $telefon->id;
    }

    // UPDATE TELEFON BY ID
    public static function updateTelefon($id, array $data)
    {
        $telefon = self::find($id);
        if (!$telefon) {
            return false;
        }
        $telefon->nom = $data['nom_telefon'];
        $telefon->num_directe = $data['num_directe'];
        $telefon->extensio_voip = $data['extensio_voip'];
        $telefon->fk_id_area = $data['area'];
        $telefon->fk_id_equipament = $data['edifici'];
        $telefon->num_directe_mobil = $data['num_directe_mobil'];
        $telefon->extensio_mobil = $data['extensio_mobil'];
        $telefon->fk_tipus_obj = $data['fk_tipus_obj'];
        $telefon->data_edicio = Carbon::parse($data['data_edicio']);
        return $telefon->save();
    }

    // DELETE TELEFON BY ID
    public static function deleteTelefon($id)
    {
        return self::destroy($id);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'fk_id_area');
    }

    public function equipament()
    {
        return $this->belongsTo(\App\Models\Equipament::class, 'fk_id_equipament', 'id_equimanent');
    }

}
