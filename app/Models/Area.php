<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $table = 'int_area';
    protected $primaryKey = 'IdArea';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = ['Area', 'id_equimanent'];

    public function equipament()
    {
        return $this->belongsTo(Equipament::class, 'id_equimanent', 'id_equimanent');
    }


    // Funci oper treure els accents
    public static function removeAccents($str)
    {
        return strtr(
            $str,
            'áéíóúàèìòùãõâêîôöäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ',
            'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOUAEIOUC'
        );
    }

    public static function getAllArees()
    {
        $areas = DB::table('intranet.int_area')
            ->select('IdArea', 'Area')
            ->orderBy('Area', 'asc')
            ->get();

        return $areas->map(function ($area) {
            $area->Area_t = self::removeAccents($area->Area);
            return $area;
        });
    }

    public static function getAllAreesAdmin()
    {
        $areas = DB::table('intranet.int_area')
            ->select('IdArea', 'Area')
            ->get();

        return $areas->map(function ($area) {
            $area->Area_t = self::removeAccents($area->Area);
            return $area;
        })->sortBy('Area_t')->values();
    }

    public static function getArea($idarea)
    {
        return self::where('IdArea', $idarea)->first();
    }

    public function telefons()
    {
        return $this->hasMany(\App\Models\Telefon::class, 'fk_id_area');
    }
}
