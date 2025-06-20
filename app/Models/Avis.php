<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    // Retorna todos los avisos
    public static function getAllAvisos()
    {
        return DB::table('int_avisos')
            ->selectRaw("id, 
                titol AS nom,
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                titol, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'),
                'à', 'a'), 'è', 'e'), 'ì', 'i'), 'ò', 'o'), 'ù', 'u') AS nom_t,
                contingut,
                titol_solucionat,
                contingut_solucionat,
                bool_avis_info,
                bool_avis_alert,
                solucionat,
                DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') AS data_creacio,
                DATE_FORMAT(data_solucionat, '%Y-%m-%d %H:%i:%s') AS data_solucionat"
            )
            ->orderBy('id', 'desc')
            ->get();
    }

    // Retorna info de un avis concreto
    public static function getAvis($id)
    {
        return self::where('id', $id)->get();
    }

    // Inserta un nuevo avis
    public static function insertAvis(array $data)
    {
        $data['data_creacio'] = Carbon::parse($data['data_creacio'])->format('Y-m-d H:i:s');

        return DB::table('ajuntament.int_avisos')->insertGetId([
            'titol' => $data['titol_avis'],
            'contingut' => $data['contingut_avis'],
            'bool_avis_info' => $data['bool_avis_info'],
            'bool_avis_alert' => $data['bool_avis_alert'],
            'solucionat' => $data['solucionat'],
            'data_creacio' => $data['data_creacio'],
            'bool_correu' => $data['bool_correu']
        ]);
    }

    // Actualiza un avis
    public static function updateAvis(int $id, array $data)
    {
        return DB::table('ajuntament.int_avisos')
            ->where('id', $id)
            ->update([
                'titol' => $data['titol_avis'],
                'contingut' => $data['contingut_avis'],
                'bool_avis_info' => $data['bool_avis_info'],
                'bool_avis_alert' => $data['bool_avis_alert'],
                'bool_correu' => $data['bool_correu']
            ]);
    }

    // Marcar avis como solucionado
    public static function validarAvis(int $id, array $data)
    {
        $data['data_solucionat'] = Carbon::parse($data['data_solucionat'])->format('Y-m-d H:i:s');

        return DB::table('ajuntament.int_avisos')
            ->where('id', $id)
            ->update([
                'solucionat' => $data['solucionat'],
                'data_solucionat' => $data['data_solucionat'],
                'contingut_solucionat' => $data['contingut_solucionat'],
                'titol_solucionat' => $data['titol_solucionat']
            ]);
    }

    // Eliminar un avis
    public static function deleteAvis(int $id)
    {
        return DB::table('int_avisos')->where('id', $id)->delete();
    }
}
