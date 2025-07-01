<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    protected $table = 'int_documents'; 
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'nom_visual',
        'nom_arxiu',
        'data_entrada',
        'extensio',
        'ordre',
        'url',
        'fk_id_cat_document'
    ];

    // GET documents ordered by tramit id and tipus
    public static function getOrdre($idtramit, $tipus)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get last document by object id and type
    public static function getOrdreUltim($id, $tipus)
    {
        return DB::table('int_documents')
            ->orderByDesc('id')
            ->limit(1)
            ->get();
    }

    // Get all documents ordered by nom_visual
    public static function getDocuments()
    {
        return DB::table('int_documents')
            ->orderBy('nom_visual', 'asc')
            ->get();
    }

    // Get all documents admin with translation simplified
    public static function getDocumentsAdmin()
    {
        return DB::table('int_documents')
            ->select('id', 'nom_visual', 'url')
            ->orderBy('nom_visual', 'asc')
            ->get();
    }

    // Get documents by tramit id
    public static function getDocumentsTramit($id)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by expedient id and tipus tramit
    public static function getDocumentsExpedient($id, $tipus_tramit)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by normativa id
    public static function getDocumentsNormativa($id)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by proces id
    public static function getDocumentsProces($id)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by servei id
    public static function getDocumentsServei($id)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by concessionaria id
    public static function getDocumentsConcessionaria($id)
    {
        return DB::table('int_documents')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get documents by noticia id
    public static function getDocumentsNoticia($id)
    {
        return DB::table('int_documents')
            ->select('id', 'nom_visual', 'url', 'extensio', 'ordre', 'data_entrada')
            ->orderBy('ordre', 'asc')
            ->get();
    }

    // Get single document by id
    public static function getDocument($id)
    {
        return DB::table('int_documents')->where('id', $id)->first();
    }

    // Get all documents
    public static function getAllDocuments()
    {
        return DB::table('int_documents')->get();
    }

    // Insert document, returns inserted id
    public static function insertDocument(array $arr)
    {
        $id = DB::table('int_documents')->insertGetId([
            'nom_visual'      => $arr['nom_document'],
            'nom_arxiu'       => $arr['nom_arxiu'],
            'data_entrada'    => $arr['data_entrada'], // format Y-m-d H:i:s
            'extensio'        => $arr['extensio'],
            'ordre'           => $arr['ordre'],
            'url'             => $arr['url_document'],
            'categoria_id'    => $arr['categoria_id'],

        ]);
        return $id;
    }

    // Update document by id
    public static function updateDocument($id, array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $id)
            ->update([
                'nom_visual'      => $arr['nom_document'],
                'nom_arxiu'       => $arr['nom_arxiu'],
                'data_entrada'    => $arr['data_entrada'], // format Y-m-d H:i:s
                'extensio'        => $arr['extensio'],
                'ordre'           => $arr['ordre'],
                'url'             => $arr['url_document'],
                'categoria_id'    => $arr['categoria_id'],

            ]);
    }

    // Update path document
    public static function updatePathDocument($id, array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $arr['id_document'])
            ->update(['nom_arxiu' => $arr['nom_arxiu']]);
    }

    // Update document name and ordre
    public static function updateDocumentNom($id, array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $id)
            ->update([
                'nom_visual' => $arr['nom_document'],
                'ordre'      => $arr['ordre'],
            ]);
    }

    // Update document URL
    public static function updateDocumentUrl($id, array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $arr['id_document'])
            ->update(['url' => $arr['url_document']]);
    }

    // Update file to URL
    public static function updateFileToUrl($id, array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $arr['id_document'])
            ->update([
                'nom_visual' => $arr['nom_document'],
                'nom_arxiu'  => '',
                'extensio'   => $arr['extensio'],
                'url'        => $arr['url_document'],
            ]);
    }

    // Update ordre
    public static function updateOrdre($iddocument, array $array)
    {
        return DB::table('int_documents')
            ->where('id', $iddocument)
            ->update(['ordre' => $array['document'][0]['ORDRE']]);
    }

    // Delete document simple by id
    public static function deleteDocumentSimple($id)
    {
        return DB::table('int_documents')->where('id', $id)->delete();
    }

    // Delete document by id, normativa and tipus_tramit
    public static function deleteDocument(array $arr)
    {
        return DB::table('int_documents')
            ->where('id', $arr['id_document'])
            ->where('FK_id_tramit', $arr['id_normativa'])
            ->where('FK_id_tipus_tramit', $arr['id_tipus_tramit'])
            ->delete();
    }
}
