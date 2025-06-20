<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manual extends Model
{
    protected $table = 'int_manuals';
    public $timestamps = false;
    protected $fillable = [
        'nom_visual', 'data_creacio', 'ordre', 'fk_id_cat_manual',
        'publicat', 'fk_tipus_obj', 'nom_arxiu', 'data_edicio',
        'extensio', 'url'
    ];

    public static function getManual($id)
    {
        return self::where('id', $id)->get()->toArray();
    }

    public static function getAllCategories()
    {
        return DB::table('int_cat_manuals')
            ->select('id', 'nom', 'ordre')
            ->distinct()
            ->orderBy('ordre', 'asc')
            ->get()
            ->toArray();
    }

    public static function getCategoriesWithManuals()
    {
        return DB::table('int_cat_manuals as C')
            ->distinct()
            ->join('int_manuals as M', 'M.fk_id_cat_manual', '=', 'C.id')
            ->where('M.publicat', 1)
            ->select('C.id', 'C.nom', 'C.ordre')
            ->orderBy('C.ordre', 'asc')
            ->get()
            ->toArray();
    }

    public static function getAllPublishedManuals()
    {
        return DB::table('int_manuals')
            ->selectRaw("id, nom_visual, 
                translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t,
                DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio,
                DATE_FORMAT(data_edicio, '%Y-%m-%d %H:%i:%s') as data_edicio,
                ordre, fk_id_cat_manual, url, publicat")
            ->where('publicat', 1)
            ->orderByRaw("regexp_substr(nom_visual, '^\\D*') nulls first")
            ->orderByRaw("CAST(regexp_substr(nom_visual, '\\d+') AS UNSIGNED)")
            ->get()
            ->toArray();
    }

    public static function getAllManuals()
    {
        return DB::table('int_manuals')
            ->selectRaw("id, nom_visual, 
                translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t,
                DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio,
                DATE_FORMAT(data_edicio, '%Y-%m-%d %H:%i:%s') as data_edicio,
                ordre, fk_id_cat_manual, url, publicat")
            ->orderByRaw("regexp_substr(nom_visual, '^\\D*') nulls first")
            ->orderByRaw("CAST(regexp_substr(nom_visual, '\\d+') AS UNSIGNED)")
            ->get()
            ->toArray();
    }

    public static function insertManual(array $data)
    {
        $id = DB::table('int_manuals')->insertGetId([
            'nom_visual' => $data['nom_manual'],
            'data_creacio' => $data['data_creacio'],
            'ordre' => $data['ordre'],
            'fk_id_cat_manual' => $data['fk_categoria_manual'],
            'publicat' => $data['publicat'],
            'fk_tipus_obj' => $data['fk_tipus_obj'],
        ]);
        return $id;
    }

    public static function updateManual(array $data)
    {
        return DB::table('int_manuals')
            ->where('id', $data['id_last_manual'])
            ->update([
                'nom_visual' => $data['nom_manual'],
                'nom_arxiu' => $data['nom_arxiu'],
                'data_edicio' => $data['data_edicio'],
                'extensio' => $data['extensio'],
                'ordre' => $data['ordre_manual'],
                'url' => $data['url_document'],
                'fk_id_cat_manual' => $data['fk_categoria_manual'],
                'publicat' => $data['publicat'],
            ]);
    }

    public static function updateManualNoDoc(array $data)
    {
        return DB::table('int_manuals')
            ->where('id', $data['id_last_manual'])
            ->update([
                'nom_visual' => $data['nom_manual'],
                'data_edicio' => $data['data_edicio'],
                'fk_id_cat_manual' => $data['fk_categoria_manual'],
                'publicat' => $data['publicat'],
            ]);
    }

    public static function updateOrderManual($id, $ordre)
    {
        return DB::table('int_manuals')
            ->where('id', $id)
            ->update(['ordre' => $ordre]);
    }

    public static function deleteManual($id)
    {
        return DB::table('int_manuals')
            ->where('id', $id)
            ->delete();
    }
}
