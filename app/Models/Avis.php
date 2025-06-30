<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Avis extends Model
{
    protected $table = 'int_avisos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'titol', 'contingut', 'bool_avis_info', 'bool_avis_alert',
        'solucionat', 'data_creacio', 'bool_correu',
        'titol_solucionat', 'contingut_solucionat', 'data_solucionat'
    ];

    protected $casts = [
        'bool_avis_info' => 'boolean',
        'bool_avis_alert' => 'boolean',
        'solucionat' => 'boolean',
        'bool_correu' => 'boolean',
        'data_creacio' => 'datetime',
        'data_solucionat' => 'datetime',
    ];

    // Retorna tots els avisos
    public static function getAllAvisos()
    {
        return self::orderBy('id', 'desc')->get();
    }

    // Retorna la informacio de un avis concret de un avis concreto
    public static function getAvis($id)
    {
        return self::find($id);
    }

    // Inserta un nou avis
    public static function insertAvis(array $data)
    {
        $data['data_creacio'] = Carbon::parse($data['data_creacio']);

        return self::create([
            'titol' => $data['titol_avis'],
            'contingut' => $data['contingut_avis'],
            'bool_avis_info' => $data['bool_avis_info'],
            'bool_avis_alert' => $data['bool_avis_alert'],
            'solucionat' => $data['solucionat'] ?? 0,
            'data_creacio' => $data['data_creacio'],
            'bool_correu' => $data['bool_correu'] ?? 0,
            'titol_solucionat' => $data['titol_solucionat'] ?? null,
            'contingut_solucionat' => $data['contingut_solucionat'] ?? null,
            'data_solucionat' => isset($data['data_solucionat']) ? Carbon::parse($data['data_solucionat']) : null,
        ]);
    }

    // Actualitza un avis
    public static function updateAvis(int $id, array $data)
    {
        $avis = self::findOrFail($id);
        $avis->update([
            'titol' => $data['titol_avis'],
            'contingut' => $data['contingut_avis'],
            'bool_avis_info' => $data['bool_avis_info'],
            'bool_avis_alert' => $data['bool_avis_alert'],
            'bool_correu' => $data['bool_correu'],
        ]);
        return $avis;
    }

    // Marcar avis com solucionats
    public static function validarAvis(int $id, array $data)
    {
        $avis = self::findOrFail($id);
        $avis->update([
            'solucionat' => $data['solucionat'],
            'data_solucionat' => Carbon::parse($data['data_solucionat']),
            'contingut_solucionat' => $data['contingut_solucionat'],
            'titol_solucionat' => $data['titol_solucionat'],
        ]);
        return $avis;
    }

    // Eliminar un avis
    public static function deleteAvis(int $id)
    {
        return self::destroy($id);
    }
}
