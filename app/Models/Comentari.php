<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentari extends Model
{
    protected $table = 'comentaris';
    public $timestamps = false;

    // GET all published comments for a news, ordered newest first
    public function getComentarisNoticia($id)
    {
        return DB::table($this->table)
            ->select('id', 'nom_persona', 'email', 'comentari', 
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'publicat', 'id_parent', 'fk_id_noticia')
            ->where('publicat', 1)
            ->where('fk_id_noticia', $id)
            ->orderBy('data_creacio', 'desc')
            ->get()
            ->toArray();
    }

    // GET one comment by ID
    public function getComentari($id)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // GET all unpublished comments ordered by creation date
    public function getUnpublishedComentaris()
    {
        return DB::table($this->table)
            ->select('id', 'nom_persona', 'email', 'comentari', 
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'publicat', 'id_parent', 'fk_id_noticia')
            ->where('publicat', 0)
            ->orderBy('data_creacio', 'desc')
            ->get()
            ->toArray();
    }

    // GET all published comments ordered by publication date
    public function getPublishedComentaris()
    {
        return DB::table($this->table)
            ->select('id', 'nom_persona', 'email', 'comentari', 
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'publicat', 'id_parent', 'fk_id_noticia')
            ->where('publicat', 1)
            ->orderBy('data_publicacio', 'desc')
            ->get()
            ->toArray();
    }

    // GET published comments of a specific news ordered by publication date
    public function getPublishedComentarisNoticia($id)
    {
        return DB::table($this->table)
            ->select('id', 'nom_persona', 'email', 'comentari', 
                DB::raw("DATE_FORMAT(data_creacio, '%Y-%m-%d %H:%i:%s') as data_creacio"),
                DB::raw("DATE_FORMAT(data_publicacio, '%Y-%m-%d %H:%i:%s') as data_publicacio"),
                'publicat', 'id_parent', 'fk_id_noticia')
            ->where('publicat', 1)
            ->where('fk_id_noticia', $id)
            ->orderBy('data_publicacio', 'desc')
            ->get()
            ->toArray();
    }

    // INSERT comment, returns inserted ID
    public function insertComentari(array $data)
    {
        $id = DB::table($this->table)->insertGetId([
            'nom_persona' => $data['comentari_nom_persona'],
            'email' => $data['comentari_email'],
            'comentari' => $data['comentari_noticia'],
            'data_creacio' => $data['comentari_data_cre'],
            'data_publicacio' => $data['comentari_data_pub'],
            'publicat' => $data['comentari_bool_pub'],
            'id_parent' => $data['comentari_id_parent'],
            'fk_id_noticia' => $data['comentari_id_noticia'],
        ]);

        return $id;
    }

    // UPDATE validate comment (publication date and status)
    public function updateValidarComentari(array $data)
    {
        return DB::table($this->table)
            ->where('id', $data['comentari_id'])
            ->update([
                'data_publicacio' => $data['comentari_data_publicacio'],
                'publicat' => $data['comentari_bool_pub'],
            ]);
    }

    // UPDATE comment content and fields
    public function updateComentari(array $data)
    {
        return DB::table($this->table)
            ->where('id', $data['id_last_comentari'])
            ->update([
                'nom_persona' => $data['nom_persona'],
                'email' => $data['email'],
                'comentari' => $data['comentari'],
                'data_publicacio' => $data['data_publicacio'],
                'publicat' => $data['publicat'],
            ]);
    }

    // DELETE comment and its child comments
    public function deleteComentari($id)
    {
        DB::table($this->table)
            ->where('id', $id)
            ->orWhere('id_parent', $id)
            ->delete();

        // Delete orphan child comments with id_parent not existing
        DB::table($this->table)
            ->whereNotIn('id_parent', function ($query) {
                $query->select('id')->from($this->table);
            })
            ->delete();
    }
}
