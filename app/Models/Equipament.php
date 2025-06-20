<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipament extends Model
{
    protected $table = 'ciutada.equipaments';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // RETORNA TOTA L'INFORMACIO D'UN SERVEI CONCRET
    public static function getEquipament($id)
    {
        return DB::table('ciutada.equipaments')
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS EQUIPAMENTS ORDENATS (sense TRANSLATE, perquè Oracle només)
    public static function getAllEquipaments()
    {
        return DB::table('ciutada.equipaments')
            ->select('id', 'nom')
            ->orderBy('nom', 'asc')
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS EQUIPAMENTS BACKEND (mateix que anterior)
    public static function getAllEquipamentsAdmin()
    {
        return self::getAllEquipaments();
    }

    // RETORNA TOTES LES CATEGORIES D'EQUIPAMENTS
    public static function getAllCatEquipaments()
    {
        return DB::table('ciutada.categories_equipaments')
            ->distinct()
            ->get()
            ->toArray();
    }

    // RETORNA LES CATEGORIES D'EQUIPAMENTS AMB EQUIPAMENTS ASSOCIATS
    public static function getCatEquipaments()
    {
        return DB::table('ciutada.categories_equipaments as C')
            ->distinct()
            ->join('ciutada.FK_equipaments_categoria as E', 'E.FK_id_categoria_equipament', '=', 'C.id')
            ->select('C.id', 'C.nom')
            ->get()
            ->toArray();
    }

    // RETORNA TOTA L'INFORMACIO D'UNA CATEGORIA
    public static function getCategoria($id)
    {
        return DB::table('ciutada.categories_equipaments')
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTES LES CATEGORIES RELACIONADES AMB LA ID D'EQUIPAMENT
    public static function getCatIdEquipament($id)
    {
        return DB::table('ciutada.FK_equipaments_categoria')
            ->where('FK_id_equipament', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS EQUIPAMENTS D'UNA CATEGORIA DONADA
    public static function getEquipamentsIdCategoria($id)
    {
        return DB::table('ciutada.FK_equipaments_categoria')
            ->where('FK_id_categoria_equipament', $id)
            ->get()
            ->toArray();
    }
}
