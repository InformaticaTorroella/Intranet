<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Calendari extends Model
{
    protected $table = 'int_calendari';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'assumpte', 'ubicacio', 'data_inici', 'data_final',
        'interessat', 'color', 'allday', 'horari', 'mes_informacio', 'fk_cat_calendari'
    ];

    public static function getEvent($id)
    {
        return DB::table('ajuntament.int_calendari')
            ->select(
                'id', 'assumpte', 'ubicacio',
                DB::raw("to_char(data_inici, 'YYYY-MM-DD HH24:MI:SS') AS data_inicial"),
                DB::raw("to_char(data_final, 'YYYY-MM-DD HH24:MI:SS') AS data_final"),
                'interessat', 'color', 'allday', 'horari', 'mes_informacio', 'fk_cat_calendari'
            )
            ->where('id', $id)
            ->get();
    }

    public static function getEvents()
    {
        return DB::table('ajuntament.int_calendari')
            ->select(
                'id', 'assumpte', 'ubicacio',
                DB::raw("to_char(data_inici, 'YYYY-MM-DD HH24:MI:SS') AS data_inicial"),
                DB::raw("to_char(data_final, 'YYYY-MM-DD HH24:MI:SS') AS data_final"),
                'interessat', 'color', 'allday', 'horari', 'mes_informacio', 'fk_cat_calendari'
            )
            ->get();
    }

    public static function getCategories()
    {
        return DB::table('ajuntament.int_cat_calendaris')->get();
    }

    public static function insertEvent(array $data)
    {
        return DB::table('int_calendari')->insert([
            'assumpte' => $data['assumpte'],
            'ubicacio' => $data['ubicacio'],
            'data_inici' => DB::raw("TO_DATE('{$data['data_inici']}', 'yyyy/mm/dd hh24:mi:ss')"),
            'data_final' => DB::raw("TO_DATE('{$data['data_final']}', 'yyyy/mm/dd hh24:mi:ss')"),
            'interessat' => $data['interessat'],
            'color' => $data['color'],
            'allday' => $data['allday'],
            'horari' => $data['horari'],
            'mes_informacio' => $data['mes_informacio'],
        ]);
    }

    public static function updateEventDates(array $data)
    {
        return DB::table('ajuntament.int_calendari')
            ->where('id', $data['id'])
            ->update([
                'data_inici' => DB::raw("TO_DATE('{$data['fecini']}', 'YYYY-MM-DD HH24:MI:SS')"),
                'data_final' => DB::raw("TO_DATE('{$data['fecfin']}', 'YYYY-MM-DD HH24:MI:SS')"),
            ]);
    }

    public static function updateEvent(array $data)
    {
        return DB::table('ajuntament.int_calendari')
            ->where('id', $data['id'])
            ->update([
                'assumpte' => $data['assumpte'],
                'ubicacio' => $data['ubicacio'],
                'data_inici' => DB::raw("TO_DATE('{$data['dataInici']}', 'YYYY-MM-DD HH24:MI:SS')"),
                'data_final' => DB::raw("TO_DATE('{$data['dataFinal']}', 'YYYY-MM-DD HH24:MI:SS')"),
                'interessat' => $data['interessat'],
                'color' => $data['color'],
                'allday' => $data['allDayEvent'],
                'horari' => $data['horari'],
                'mes_informacio' => $data['mes_informacio'],
                'fk_cat_calendari' => $data['fk_cat_calendari'],
            ]);
    }

    public static function deleteEvent($id)
    {
        return DB::table('ajuntament.int_calendari')->where('id', $id)->delete();
    }
}
