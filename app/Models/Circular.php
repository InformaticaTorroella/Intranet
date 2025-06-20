<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Circular extends Model
{
    protected $table = 'int_circulars';
    public $timestamps = false;

    // GET circular by ID
    public function getCircular($id)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // GET all categories ordered by ordre
    public function getAllCatCirculars()
    {
        return DB::table('int_cat_circulars')
            ->select('id', 'nom', 'ordre')
            ->orderBy('ordre', 'asc')
            ->get()
            ->toArray();
    }

    // GET categories with at least one published circular
    public function getCatCircularExist()
    {
        return DB::table('int_cat_circulars as C')
            ->distinct()
            ->select('C.id', 'C.nom', 'C.ordre')
            ->join('int_circulars as M', function ($join) {
                $join->on('M.fk_cat_circular', '=', 'C.id')
                     ->where('M.publicat', 1);
            })
            ->orderBy('C.ordre', 'asc')
            ->get()
            ->toArray();
    }

    // Helper for accent removal in MySQL (simulate translate with nested REPLACE)
    protected function rawRemoveAccents($column)
    {
        $replaces = [
            ['á', 'a'], ['é', 'e'], ['í', 'i'], ['ó', 'o'], ['ú', 'u'],
            ['à', 'a'], ['è', 'e'], ['ì', 'i'], ['ò', 'o'], ['ù', 'u'],
            ['ã', 'a'], ['õ', 'o'], ['â', 'a'], ['ê', 'e'], ['î', 'i'],
            ['ô', 'o'], ['ö', 'o'], ['ä', 'a'], ['ë', 'e'], ['ï', 'i'],
            ['ü', 'u'], ['ç', 'c'], ['Á', 'A'], ['É', 'E'], ['Í', 'I'],
            ['Ó', 'O'], ['Ú', 'U'], ['À', 'A'], ['È', 'E'], ['Ì', 'I'],
            ['Ò', 'O'], ['Ù', 'U'], ['Ã', 'A'], ['Õ', 'O'], ['Â', 'A'],
            ['Ê', 'E'], ['Î', 'I'], ['Ô', 'O'], ['Û', 'U'], ['Ä', 'A'],
            ['Ë', 'E'], ['Ï', 'I'], ['Ö', 'O'], ['Ü', 'U'], ['Ç', 'C'],
        ];

        $expr = $column;
        foreach ($replaces as [$search, $replace]) {
            $expr = "REPLACE($expr, '$search', '$replace')";
        }

        return DB::raw($expr);
    }

    // GET all published circulars ordered by name natural (simulate REGEXP_SUBSTR for MySQL 8+)
    public function getAllCircularsPub()
    {
        $nom_t = $this->rawRemoveAccents('nom_visual');

        return DB::table($this->table)
            ->select(
                'id',
                'nom_visual',
                $nom_t . ' as nom_t',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_edicio, '%Y-%m-%d %H:%i:%s') as data_edicio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'ordre',
                'fk_cat_circular',
                'url',
                'publicat'
            )
            ->where('publicat', 1)
            ->orderByRaw("
                CAST(REGEXP_SUBSTR(nom_visual, '^[^0-9]*') AS CHAR),
                CAST(REGEXP_SUBSTR(nom_visual, '[0-9]+') AS UNSIGNED)
            ")
            ->get()
            ->toArray();
    }

    // GET all circulars (no filter)
    public function getAllCirculars()
    {
        $nom_t = $this->rawRemoveAccents('nom_visual');

        return DB::table($this->table)
            ->select(
                'id',
                'nom_visual',
                $nom_t . ' as nom_t',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_edicio, '%Y-%m-%d %H:%i:%s') as data_edicio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'ordre',
                'fk_cat_circular',
                'url',
                'publicat'
            )
            ->orderByRaw("
                CAST(REGEXP_SUBSTR(nom_visual, '^[^0-9]*') AS CHAR),
                CAST(REGEXP_SUBSTR(nom_visual, '[0-9]+') AS UNSIGNED)
            ")
            ->get()
            ->toArray();
    }

    // GET all circulars ordered by publication date DESC
    public function getAllCircularsDate()
    {
        $nom_t = $this->rawRemoveAccents('nom_visual');

        return DB::table($this->table)
            ->select(
                'id',
                'nom_visual',
                $nom_t . ' as nom_t',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_edicio, '%Y-%m-%d %H:%i:%s') as data_edicio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d') as data_publicacio"),
                'ordre',
                'fk_cat_circular',
                'url',
                'publicat'
            )
            ->orderBy('data_publicacio', 'desc')
            ->get()
            ->toArray();
    }

    // INSERT circular and return inserted ID
    public function insertCircular(array $data)
    {
        return DB::table($this->table)->insertGetId([
            'nom_visual' => $data['nom_circular'],
            'data_creacio' => $data['data_creacio'],
            'data_publicacio' => $data['data_publicacio'],
            'ordre' => $data['ordre'],
            'fk_cat_circular' => $data['fk_categoria_circular'],
            'publicat' => $data['publicat'],
            'fk_tipus_obj' => $data['fk_tipus_obj'] ?? null,
        ]);
    }

    // UPDATE circular with document data
    public function updateCircular(array $data)
    {
        return DB::table($this->table)
            ->where('id', $data['id_last_circular'])
            ->update([
                'nom_visual' => $data['nom_circular'],
                'nom_arxiu' => $data['nom_arxiu'],
                'data_edicio' => $data['data_edicio'],
                'data_publicacio' => $data['data_publicacio'],
                'extensio' => $data['extensio'],
                'ordre' => $data['ordre_circular'],
                'url' => $data['url_document'],
                'fk_cat_circular' => $data['fk_categoria_circular'],
                'publicat' => $data['publicat'],
            ]);
    }

    // UPDATE circular without document data
    public function updateCircularNoDoc(array $data)
    {
        return DB::table($this->table)
            ->where('id', $data['id_last_circular'])
            ->update([
                'nom_visual' => $data['nom_circular'],
                'data_edicio' => $data['data_edicio'],
                'fk_cat_circular' => $data['fk_categoria_circular'],
                'publicat' => $data['publicat'],
            ]);
    }

    // UPDATE ordre for a circular
    public function updateOrdreCircular($id, array $data)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->update(['ordre' => $data['circular'][0]['ORDRE']]);
    }

    // DELETE circular by id
    public function deleteCircular($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }
}
