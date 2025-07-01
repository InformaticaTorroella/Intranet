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
        'cat_noticia_id', 'url', 'extensio', 'data_inicial', 'data_final'
    ];

    public static function getNoticiaUpdatePublicar($id)
    {
        return DB::table('int_noticies')
            ->select(DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"), 'publicat')
            ->where('id', $id)
            ->get();
    }

    public static function getNoticia($id)
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d') as data_publicacio"),
                'publicat', 'cat_noticia_id', 'url', 'extensio',
                DB::raw("DATE_FORMAT(data_inicial, '%Y-%m-%d') as data_inicial"),
                DB::raw("DATE_FORMAT(data_final, '%Y-%m-%d') as data_final")
            )
            ->where('id', $id)
            ->get();
    }

    public static function getNomCatNoticia($id)
    {
        return DB::table('int_cat_noticies')->where('id', $id)->get();
    }

    public static function getNoticies()
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio',
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d') as data_creacio"),
                'data_publicacio', 'publicat', 'cat_noticia_id'
            )
            ->get();
    }

    public static function getNoticiesIntranet()
    {
        return DB::table('int_noticies')
            ->select(
                'id', 'nom', 'descripcio', 'data_creacio',
                DB::raw("DATE_FORMAT(data_publicacio, '%W- %d %M %Y %H:%i') as data_publicacio"),
                'publicat', 'cat_noticia_id', 'data_publicacio as data_pub_new'
            )
            ->where('publicat', 1)
            ->orderBy('data_creacio', 'desc')
            ->get();
    }

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

    public static function getNoticiesReleasedNum()
    {
        return DB::table('int_noticies')->where('publicat', 1)->count();
    }

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

    public static function insertNoticia(array $data)
    {
        return DB::table('int_noticies')->insertGetId([
            'nom' => $data['nom_noticia'],
            'descripcio' => $data['descripcio_noticia'],
            'data_creacio' => $data['data_cre'],
            'data_publicacio' => $data['data_pub'],
            'publicat' => $data['bool_pub'],
            'cat_noticia_id' => $data['cat_noticia_id'] ?? null,
            'url' => $data['url_document'],
            'data_inicial' => $data['data_inicial'],
            'data_final' => $data['data_final'],
        ]);
    }

    public static function insertRelacioNoticiaCategoria(array $data)
    {
        return DB::table('int_fk_noticies_categoria')->insert([
            'FK_id_noticia' => $data['id_last_noticia'],
            'FK_id_categoria_noticia' => $data['tema_noticia']
        ]);
    }

    public static function updateNoticia(array $data)
    {
        return DB::table('int_noticies')
            ->where('id', $data['id'])
            ->update([
                'nom' => $data['nom_noticia'],
                'descripcio' => $data['descripcio_noticia'],
                'data_publicacio' => $data['data_pub'],
                'publicat' => $data['bool_pub'],
                'cat_noticia_id' => $data['cat_noticia_id'],
                'url' => $data['url_document'],
                'data_inicial' => $data['data_inicial'],
                'data_final' => $data['data_final'],
            ]);
    }

    public function categoria()
    {
        return $this->belongsTo(CatNoticia::class, 'cat_noticia_id', 'id');
    }
}
