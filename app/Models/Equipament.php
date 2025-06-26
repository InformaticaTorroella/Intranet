<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipament extends Model
{
    protected $table = 'int_equipaments';
    protected $primaryKey = 'id_equimanent'; 
    public $timestamps = false;
    public $incrementing = false; 

    protected $fillable = ['Equipament'];

    // RETORNA TOTA L'INFORMACIO D'UN SERVEI CONCRET
    public static function getEquipament($id)
    {
        return DB::table('intranet.int_equipaments')
            ->where('id_equimanent', $id)
            ->first();  
    }

    // RETORNA TOTS ELS int_equipaments AMB PROPIETATS NORMALITZADES (id, nom)
    public static function getAllEquipaments()
    {
        return DB::table('intranet.int_equipaments')
            ->select('id_equimanent as id', 'Equipament as nom')
            ->orderBy('nom', 'asc')
            ->get();
    }

    // RETORNA TOTS ELS int_equipaments BACKEND (mateix que anterior)
    public static function getAllEquipamentsAdmin()
    {
        return self::getAllEquipaments();
    }

    // RETORNA TOTES LES CATEGORIES D'int_equipaments
    public static function getAllCatEquipaments()
    {
        return DB::table('intranet.categories_equipaments')
            ->distinct()
            ->get()
            ->toArray();
    }

    // RETORNA LES CATEGORIES D'int_equipaments AMB int_equipaments ASSOCIATS
    public static function getCatEquipaments()
    {
        return DB::table('intranet.categories_equipaments as C')
            ->distinct()
            ->join('intranet.FK_equipaments_categoria as E', 'E.FK_id_categoria_equipament', '=', 'C.id')
            ->select('C.id', 'C.nom')
            ->get()
            ->toArray();
    }

    // RETORNA TOTA L'INFORMACIO D'UNA CATEGORIA
    public static function getCategoria($id)
    {
        return DB::table('intranet.categories_equipaments')
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTES LES CATEGORIES RELACIONADES AMB LA ID D'EQUIPAMENT
    public static function getCatIdEquipament($id)
    {
        return DB::table('intranet.FK_equipaments_categoria')
            ->where('FK_id_equipament', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS int_equipaments D'UNA CATEGORIA DONADA
    public static function getEquipamentsIdCategoria($id)
    {
        return DB::table('intranet.FK_equipaments_categoria')
            ->where('FK_id_categoria_equipament', $id)
            ->get()
            ->toArray();
    }

    public function telefons()
    {
        return $this->hasMany(\App\Models\Telefon::class, 'fk_id_equipament', 'id_equimanent');
    }
}
