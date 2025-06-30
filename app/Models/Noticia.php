<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Noticia extends Model
{
    protected $table = 'int_noticies';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom', 'descripcio', 'data_creacio', 'data_publicacio', 'publicat', 
        'fk_tipus_obj', 'url', 'extensio', 'data_inicial', 'data_final'
    ];

    // Obtenir caps per editar sense modificar la data de publicació
    public static function getNoticiaUpdatePublicar($id)
    {
        return DB::table('int_noticies')
            ->select(DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"), 'publicat')
            ->where('id', $id)
            ->get();
    }

    // Obtenir noticies completes
    public static function getNoticia($id)
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d') as data_publicacio"),
                'publicat', 'fk_tipus_obj', 'url', 'extensio',
                DB::raw("DATE_FORMAT(data_inicial, '%Y-%m-%d') as data_inicial"),
                DB::raw("DATE_FORMAT(data_final, '%Y-%m-%d') as data_final")
            )
            ->where('id', $id)
            ->get();
    }

    // Obtenir nom de categornia de la noticia
    public static function getNomCatNoticia($id)
    {
        return DB::table('int_cat_noticies')->where('id', $id)->get();
    }

    // Obtenir totes les noticies
    public static function getNoticies()
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d') as data_creacio"),
                'data_publicacio', 'publicat', 'fk_tipus_obj'
            )
            ->get();
    }

    // Obtenir noticias publicadas per l'intranet
    public static function getNoticiesIntranet()
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio', 'data_creacio',
                DB::raw("DATE_FORMAT(data_publicacio, '%W- %d %M %Y %H:%i') as data_publicacio"),
                'publicat', 'fk_tipus_obj', 'data_publicacio as data_pub_new'
            )
            ->where('publicat', 1)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

    // Obtenir etiquetes de una noticia
    public static function getTagsNoticia($id)
    {
        return DB::table('int_etiquetes as e')
            ->join('int_fk_noticies_etiquetes as fk', 'e.id', '=', 'fk.fk_id_etiqueta')
            ->where('fk.fk_id_noticia', $id)
            ->select('e.id', 'e.nom', 'e.n_utilitzat')
            ->distinct()
            ->orderByDesc('e.n_utilitzat')
            ->get();
    }

    // Contar noticias publicadas
    public static function getNoticiesReleasedNum()
    {
        return DB::table('int_noticies')->where('publicat', 1)->count();
    }

    // Obtenir noticias publicadas paginadas
    public static function getNoticiesReleased($pag_num)
    {
        $perPage = 9;
        $offset = ($pag_num - 1) * $perPage;

        return DB::table('int_noticies')
            ->where('publicat', 1)
            ->whereDate('data_inicial', '<=', now())
            ->whereDate('data_final', '>=', now())
            ->orderBy('data_publicacio', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();
    }

    // Insertar noticia
    public static function insertNoticia(array $data)
    {
        return DB::table('int_noticies')->insertGetId([
            'nom' => $data['nom_noticia'],
            'descripcio' => $data['descripcio_noticia'],
            'data_creacio' => $data['data_cre'],
            'data_publicacio' => $data['data_pub'],
            'publicat' => $data['bool_pub'],
            'fk_tipus_obj' => $data['tipus_obj'],
            'url' => $data['url_document'],
            'data_inicial' => $data['data_inicial'],
            'data_final' => $data['data_final'],
        ]);
    }

    // Insertar relació noticia - categoria
    public static function insertRelacioNoticiaCategoria(array $data)
    {
        return DB::table('int_fk_noticies_categoria')->insert([
            'FK_id_noticia' => $data['id_last_noticia'],
            'FK_id_categoria_noticia' => $data['tema_noticia']
        ]);
    }

    // Actualizar noticia
    public static function updateNoticia(array $data)
    {
        return DB::table('int_noticies')
            ->where('id', $data['id'])
            ->update([
                'nom' => $data['nom_noticia'],
                'descripcio' => $data['descripcio_noticia'],
                'data_publicacio' => $data['data_pub'],
                'publicat' => $data['bool_pub'],
                'url' => $data['url_document'],
                'data_inicial' => $data['data_inicial'],
                'data_final' => $data['data_final'],
            ]);
    }
}
