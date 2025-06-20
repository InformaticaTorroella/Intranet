<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Impressora extends Model
{
    protected $table = 'int_impressores';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipus', 'model', 'url', 'fk_id_equipament', 'escaner', 'departament', 'fk_tipus_obj', 'data_edicio'
    ];

    // Get all impressoras
    public static function getAllImpressores()
    {
        return DB::table('int_impressores')
            ->selectRaw("id, data_edicio, tipus,
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                tipus, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'), 'à', 'a'), 'è', 'e'), 'ì', 'i'), 'ò', 'o'), 'ù', 'u'),
                'ã', 'a'), 'õ', 'o'), 'â', 'a'), 'ê', 'e'), 'î', 'i'), 'ô', 'o'), 'ö', 'o'), 'ä', 'a'), 'ë', 'e'), 'ï', 'i'), 'ü', 'u'),
                'ç', 'c') as tipus_t,
                model, url, departament,
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                departament, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'), 'à', 'a'), 'è', 'e'), 'ì', 'i'), 'ò', 'o'), 'ù', 'u'),
                'ã', 'a'), 'õ', 'o'), 'â', 'a'), 'ê', 'e'), 'î', 'i'), 'ô', 'o'), 'ö', 'o'), 'ä', 'a'), 'ë', 'e'), 'ï', 'i'), 'ü', 'u'),
                'ç', 'c') as departament_t,
                fk_tipus_obj, fk_id_equipament, escaner")
            ->orderBy('fk_id_equipament', 'asc')
            ->get()
            ->toArray();
    }

    // Get all tipus
    public static function getAllTipus()
    {
        return DB::table('INT_TIPUS_IMPRESSORES')
            ->selectRaw("id, nom,
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'), 'à', 'a'), 'è', 'e'), 'ì', 'i'), 'ò', 'o'), 'ù', 'u'),
                'ã', 'a'), 'õ', 'o'), 'â', 'a'), 'ê', 'e'), 'î', 'i'), 'ô', 'o'), 'ü', 'u'), 'ç', 'c') as nom_t")
            ->get()
            ->toArray();
    }

    // Get all models
    public static function getAllModels()
    {
        return DB::table('INT_MODEL_IMPRESSORES')->get()->toArray();
    }

    // Get impressora by ID
    public static function getImpressora($id)
    {
        return DB::table('INT_IMPRESSORES')->where('id', $id)->get()->toArray();
    }

    // Insert impressora and return inserted id
    public static function insertImpressora(array $data)
    {
        $data['data_edicio'] = date('Y-m-d H:i:s', strtotime($data['data_edicio']));

        $id = DB::table('int_impressores')->insertGetId([
            'tipus' => $data['tipus'],
            'model' => $data['model'],
            'url' => $data['nom_arxiu'],
            'fk_id_equipament' => $data['edifici'],
            'escaner' => $data['escaner'],
            'departament' => $data['departament'],
            'fk_tipus_obj' => $data['fk_tipus_obj'],
            'data_edicio' => $data['data_edicio'],
        ]);

        return $id;
    }

    // Update impressora by ID
    public static function updateImpressora($id, array $data)
    {
        $data['data_edicio'] = date('Y-m-d H:i:s', strtotime($data['data_edicio']));

        return DB::table('int_impressores')
            ->where('id', $id)
            ->update([
                'tipus' => $data['tipus'],
                'model' => $data['model'],
                'url' => $data['nom_arxiu'],
                'fk_id_equipament' => $data['edifici'],
                'escaner' => $data['nom_escaner'],
                'departament' => $data['departament'],
                'fk_tipus_obj' => $data['fk_tipus_obj'],
                'data_edicio' => $data['data_edicio'],
            ]);
    }

    // Delete impressora by ID
    public static function deleteImpressora($id)
    {
        return DB::table('int_impressores')->where('id', $id)->delete();
    }
}
