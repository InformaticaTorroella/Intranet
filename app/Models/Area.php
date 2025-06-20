<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Area extends Model
{
    protected $table = 'ciutada.area';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['nom'];

    // Método para obtener todas las áreas con traducción simplificada
    public static function getAllArees()
    {
        return DB::table('ciutada.area')
            ->selectRaw("id, nom, TRANSLATE(nom, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t")
            ->orderBy('nom', 'asc')
            ->get();
    }

    // Método para obtener todas las áreas para admin, ordenado por nom_t
    public static function getAllAreesAdmin()
    {
        return DB::table('ciutada.area')
            ->selectRaw("id, nom, TRANSLATE(nom, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t")
            ->orderBy('nom_t', 'asc')
            ->get();
    }

    // Obtener una área concreta por id
    public static function getArea($idarea)
    {
        return self::where('id', $idarea)->first();
    }
}
