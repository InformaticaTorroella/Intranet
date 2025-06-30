<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Albara extends Model
{
    protected $table = 'int_albara';
    protected $primaryKey = 'id';
    public $timestamps = false; // Laravel per defecte busca created_at, updated_at

    protected $fillable = [
        'area',
        'usuari_creacio',
        'data_creacio',
        'validat',
        'usuari_validador',
        'data_validacio',
        'usuari_modificacio',
        'data_modificacio',
        'observacions',
        'modificat'
    ];

    // Si la columna data_creacio y data_validació son timestamp, Laravel las puede mutar a Carbon:
    protected $dates = [
        'data_creacio',
        'data_validacio',
        'data_modificacio',
    ];

    // Métodes equivalents a les funcions de la aplicacio anteriro

    public static function getAlbara($idalbara)
    {
        return self::find($idalbara);
    }

    public static function getAllAlbaransNoValidats()
    {
        return self::where('validat', 0)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

    public static function getAllAlbaransValidats()
    {
        return self::where('validat', 1)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

    public static function getAreaAlbaransNoValidats($areaId)
    {
        return self::where('validat', 0)
            ->where('area', $areaId)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

    public static function getAreaAlbaransValidats($areaId)
    {
        return self::where('validat', 1)
            ->where('area', $areaId)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

    public static function insertAlbara($data)
    {
        // Es pot fer directe ment amb create si $fillable está ben definit
        return self::create($data);
    }

    public function updateAlbara($data)
    {
        return $this->update($data);
    }

    public function validarAlbara($usuariValidador, $dataValidacio)
    {
        $this->usuari_validador = $usuariValidador;
        $this->data_validacio = $dataValidacio;
        $this->validat = 1;
        return $this->save();
    }

}
