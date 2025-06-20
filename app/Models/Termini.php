<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Termini extends Model
{
    protected $table = 'int_terminis';
    public $timestamps = false;

    protected $fillable = [
        'descripcio',
        'data_avis',
        'data_creacio',
        'codi_expedient',
        'bool_finalitzat',
        'usuari_creacio',
        'usuari_finalitzat',
        'fk_id_area',
    ];

    // RETORNA TOTS ELS TERMINIS PENDENTS DE FINALITZAR
    public static function getAllTerminisPendents()
    {
        return self::select('id', 'codi_expedient', 'descripcio', 'data_avis', 'bool_finalitzat', 'fk_id_area', 'usuari_creacio')
            ->where('bool_finalitzat', 0)
            ->orderBy('data_avis', 'asc')
            ->get();
    }

    // RETORNA TOTS ELS TERMINIS FINALITZATS
    public static function getAllTerminisFinalitzats()
    {
        return self::select('id', 'codi_expedient', 'descripcio', 'data_avis', 'bool_finalitzat', 'fk_id_area', 'usuari_creacio')
            ->where('bool_finalitzat', 1)
            ->orderBy('data_avis', 'desc')
            ->get();
    }

    // RETORNA UN TERMINI PER ID
    public static function getTermini($id)
    {
        return self::find($id);
    }

    // INSERTA UN NOU TERMINI
    public static function insertTermini(array $data)
    {
        $termini = new self();
        $termini->descripcio = $data['descripcio'];
        $termini->data_avis = Carbon::createFromFormat('d-m-Y H:i:s', $data['data_avis']);
        $termini->data_creacio = Carbon::parse($data['data_creacio']);
        $termini->codi_expedient = $data['codi_expedient'];
        $termini->bool_finalitzat = $data['bool_finalitzat'];
        $termini->usuari_creacio = $data['usuari_creacio'];
        $termini->save();

        return $termini->id;
    }

    // VALIDAR TERMINI (marcar como finalitzat)
    public static function validarTermini(array $data)
    {
        $termini = self::find($data['idtermini']);
        if (!$termini) {
            return false;
        }
        $termini->bool_finalitzat = 1;
        $termini->usuari_finalitzat = $data['usuari_finalitzat'];
        return $termini->save();
    }

    // ELIMINA UN TERMINI PER ID
    public static function deleteTermini($id)
    {
        return self::destroy($id);
    }
}
