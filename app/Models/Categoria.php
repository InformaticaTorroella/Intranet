<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $table_faq = 'int_cat_faqs';
    protected $table_manual = 'int_cat_manuals';
    protected $table_circular = 'int_cat_circulars';
    protected $table_noticia = 'int_cat_noticies';
    protected $table_fk_noticies_categoria = 'int_fk_noticies_categoria';

    // GET ALL FAQ CATEGORIES ORDERED BY NOM (WITH TRANSLATE FUNCTION SIMULATION)
    public function getCategoriesOrdreFaq()
    {
        return DB::table($this->table_faq)
            ->select('id', 'nom', DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u') as nom_t"))
            ->orderBy('nom', 'asc')
            ->get()
            ->toArray();
    }

    // GET ALL MANUAL CATEGORIES ORDERED BY NOM
    public function getCategoriesOrdreManual()
    {
        return DB::table($this->table_manual)
            ->select('id', 'nom', DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u') as nom_t"), 'ordre')
            ->orderBy('nom', 'asc')
            ->get()
            ->toArray();
    }

    // GET ALL CIRCULAR CATEGORIES ORDERED BY NOM
    public function getCategoriesOrdreCircular()
    {
        return DB::table($this->table_circular)
            ->select('id', 'nom', DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u') as nom_t"), 'ordre')
            ->orderBy(DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u')"), 'asc')
            ->get()
            ->toArray();
    }

    // GET CIRCULAR CATEGORIES WITH AT LEAST ONE PUBLISHED CIRCULAR
    public function getCategoriesOrdreCircularRelation()
    {
        return DB::table($this->table_circular . ' as C')
            ->distinct()
            ->select('C.id', 'C.nom', 'C.ordre')
            ->join('int_circulars as M', function ($join) {
                $join->on('M.fk_cat_circular', '=', 'C.id')
                     ->where('M.publicat', '=', 1);
            })
            ->orderBy(DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                C.nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u')"), 'asc')
            ->get()
            ->toArray();
    }

    // GET MANUAL CATEGORIES WITH AT LEAST ONE PUBLISHED MANUAL
    public function getCategoriesOrdreManualRelation()
    {
        return DB::table($this->table_manual . ' as C')
            ->distinct()
            ->select('C.id', 'C.nom', 'C.ordre')
            ->join('int_manuals as M', function ($join) {
                $join->on('M.fk_id_cat_manual', '=', 'C.id')
                     ->where('M.publicat', '=', 1);
            })
            ->orderBy(DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                C.nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u')"), 'asc')
            ->get()
            ->toArray();
    }

    // GET ALL NEWS CATEGORIES ORDERED BY NOM
    public function getCategoriesNoticia()
    {
        return DB::table($this->table_noticia)
            ->select('id', 'nom', DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                nom, 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u'), 'à','a'), 'è','e'), 'ì','i'), 'ò','o'), 'ù','u') as nom_t"))
            ->orderBy('nom', 'asc')
            ->get()
            ->toArray();
    }

    // GET SINGLE FAQ CATEGORY BY ID
    public function getCategoriaFaq($idcategoria)
    {
        return DB::table($this->table_faq)->where('id', $idcategoria)->get()->toArray();
    }

    // GET SINGLE MANUAL CATEGORY BY ID
    public function getCategoriaManual($idcategoria)
    {
        return DB::table($this->table_manual)->where('id', $idcategoria)->get()->toArray();
    }

    // GET SINGLE NOTICIA CATEGORY BY ID
    public function getCategoriaNoticia($idcategoria)
    {
        return DB::table($this->table_noticia)->where('id', $idcategoria)->get()->toArray();
    }

    // GET SINGLE CIRCULAR CATEGORY BY ID
    public function getCategoriaCircular($idcategoria)
    {
        return DB::table($this->table_circular)->where('id', $idcategoria)->get()->toArray();
    }

    // GET CATEGORY FOR A NOTICIA BY ID NOTICIA
    public function getCategoriaForNoticia($idnoticia)
    {
        return DB::table($this->table_fk_noticies_categoria)->where('fk_id_noticia', $idnoticia)->distinct()->get()->toArray();
    }

    // INSERT FAQ CATEGORY
    public function insertCategoriaFaq(array $data)
    {
        return DB::table($this->table_faq)->insertGetId([
            'nom' => $data['nom_cat'],
        ]);
    }

    // INSERT CIRCULAR CATEGORY
    public function insertCategoriaCircular(array $data)
    {
        return DB::table($this->table_circular)->insertGetId([
            'nom' => $data['nom_cat'],
        ]);
    }

    // INSERT MANUAL CATEGORY
    public function insertCategoriaManual(array $data)
    {
        return DB::table($this->table_manual)->insertGetId([
            'nom' => $data['nom_cat'],
        ]);
    }

    // INSERT NOTICIA CATEGORY
    public function insertCategoriaNoticia(array $data)
    {
        return DB::table($this->table_noticia)->insertGetId([
            'nom' => $data['nom_cat'],
        ]);
    }

    // UPDATE ORDRE FAQ CATEGORY
    public function updateOrdreCategoriaFaq($idcategoria, array $array)
    {
        return DB::table('categories_faq')->where('id', $idcategoria)->update(['ordre' => $array['num_ordre']]);
    }

    // UPDATE ORDRE MANUAL CATEGORY
    public function updateOrdreCategoriaManual($idcategoria, array $array)
    {
        return DB::table($this->table_manual)
            ->where('id', $idcategoria)
            ->update(['ordre' => $array['categoria'][0]['ORDRE']]);
    }

    // UPDATE ORDRE NOTICIA CATEGORY
    public function updateOrdreCategoriaNoticia($idcategoria, array $array)
    {
        return DB::table($this->table_noticia)->where('id', $idcategoria)->update(['ordre' => $array['num_ordre']]);
    }

    // UPDATE FAQ CATEGORY
    public function updateCategoriaFaq($idcategoria, array $array)
    {
        return DB::table($this->table_faq)->where('id', $idcategoria)->update(['nom' => $array['nom_cat']]);
    }

    // UPDATE MANUAL CATEGORY
    public function updateCategoriaManual($idcategoria, array $array)
    {
        return DB::table($this->table_manual)
            ->where('id', $idcategoria)
            ->update(['nom' => $array['nom_cat'], 'ordre' => $array['num_ordre']]);
    }

    // UPDATE NOTICIA CATEGORY
    public function updateCategoriaNoticia($idcategoria, array $array)
    {
        return DB::table($this->table_noticia)
            ->where('id', $idcategoria)
            ->update(['nom' => $array['nom_cat'], 'ordre' => $array['num_ordre']]);
    }

    // UPDATE CIRCULAR CATEGORY
    public function updateCategoriaCircular($idcategoria, array $array)
    {
        return DB::table($this->table_circular)
            ->where('id', $idcategoria)
            ->update(['nom' => $array['nom_cat'], 'ordre' => $array['num_ordre']]);
    }

    // DELETE MANUAL CATEGORY
    public function deleteCategoriaManual($id)
    {
        return DB::table($this->table_manual)->where('id', $id)->delete();
    }

    // DELETE FAQ CATEGORY
    public function deleteCategoriaFaq($id)
    {
        return DB::table($this->table_faq)->where('id', $id)->delete();
    }

    // DELETE CIRCULAR CATEGORY
    public function deleteCategoriaCircular($id)
    {
        return DB::table($this->table_circular)->where('id', $id)->delete();
    }

    // DELETE NOTICIA CATEGORY
    public function deleteCategoriaNoticia($id)
    {
        return DB::table($this->table_noticia)->where('id', $id)->delete();
    }

    // DELETE NOTICIA CATEGORY RELATION
    public function deleteRelCategoriaNoticia($id)
    {
        return DB::table($this->table_fk_noticies_categoria)->where('fk_id_noticia', $id)->delete();
    }
}
