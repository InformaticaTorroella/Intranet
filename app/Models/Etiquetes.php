<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Etiqueta extends Model
{
    protected $table = 'ajuntament.int_etiquetes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // RETORNA TOTA L'INFORMACIO D'UNA ETIQUETA EN CONCRET
    public static function getEtiqueta($id)
    {
        return DB::table('ajuntament.int_etiquetes')
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTA L'INFORMACIO D'UNA ETIQUETA PER NOM
    public static function getEtiquetaByNom($nom)
    {
        return DB::table('ajuntament.int_etiquetes')
            ->where('nom', $nom)
            ->get()
            ->toArray();
    }

    // RETORNA TOTES LES ETIQUETES
    public static function getEtiquetes()
    {
        return DB::table('ajuntament.int_etiquetes')
            ->get()
            ->toArray();
    }

    // RETORNA TOTES LES ETIQUETES D'UNA NOTICIA
    public static function getEtiquetesNoticia($noticiaId)
    {
        return DB::table('ajuntament.int_etiquetes as E')
            ->join('ajuntament.int_fk_noticies_etiquetes as FK', 'E.id', '=', 'FK.FK_ID_ETIQUETA')
            ->where('FK.fk_id_noticia', $noticiaId)
            ->select('E.id', 'E.nom', 'E.n_utilitzat')
            ->get()
            ->toArray();
    }

    // INSERTA UNA NOVA ETIQUETA I RETORNA L'ID
    public static function insertEtiqueta(array $data)
    {
        $id = DB::table('ajuntament.int_etiquetes')->insertGetId([
            'nom' => $data['nom_etiqueta'],
            'n_utilitzat' => $data['n_utilitzat']
        ]);
        return $id;
    }

    // INSERTA RELACIÓ ENTRE NOTICIA I ETIQUETA
    public static function insertRelNoticiaEtiqueta(array $data)
    {
        return DB::table('ajuntament.int_fk_noticies_etiquetes')->insert([
            'fk_id_noticia' => $data['id_last_noticia'],
            'fk_id_etiqueta' => $data['id_etiqueta']
        ]);
    }

    // ACTUALITZA UNA ETIQUETA PER ID
    public static function updateEtiqueta($id, array $data)
    {
        return DB::table('ajuntament.int_etiquetes')
            ->where('id', $id)
            ->update([
                'nom' => $data['nom_etiqueta'],
                'n_utilitzat' => $data['n_utilitzat']
            ]);
    }

    // ACTUALITZA EL CAMP n_utilitzat PER NOM ETIQUETA
    public static function updateUtilitzatEtiqueta(array $data)
    {
        return DB::table('ajuntament.int_etiquetes')
            ->where('nom', $data['nom'])
            ->update([
                'n_utilitzat' => $data['n_utilitzat']
            ]);
    }

    // ELIMINA UNA ETIQUETA PER ID
    public static function deleteEtiqueta($id)
    {
        return DB::table('ajuntament.int_etiquetes')
            ->where('id', $id)
            ->delete();
    }

    // ELIMINA RELACIONS D'ETIQUETES D'UNA NOTICIA
    public static function deleteRelNoticiaEtiquetes($noticiaId)
    {
        return DB::table('ajuntament.int_fk_noticies_etiquetes')
            ->where('fk_id_noticia', $noticiaId)
            ->delete();
    }
}
