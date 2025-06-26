<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faq extends Model
{
    protected $table = 'ajuntament.int_faqs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // RETORNA TOTA L'INFORMACIO D'UN FAQ
    public static function getFaq($id)
    {
        return DB::table('ajuntament.int_faqs')
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    // RETORNA TOTES LES CATEGORIES DE FAQS ORDENADES PER NOM
    public static function getCatFaqs()
    {
        return DB::table('ajuntament.int_cat_faqs')
            ->distinct()
            ->orderBy('nom')
            ->get()
            ->toArray();
    }

    // RETORNA LES CATEGORIES DE FAQS QUE TENEN FAQS PUBLICATS
    public static function getCatFaqsExist()
    {
        return DB::table('ajuntament.int_cat_faqs as C')
            ->distinct()
            ->join('ajuntament.int_faqs as F', 'F.FK_id_categoria_faq', '=', 'C.id')
            ->where('F.publicat', 1)
            ->orderBy('C.nom')
            ->select('C.id', 'C.nom')
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS FAQS PUBLICATS ORDENATS PER NOM
    public static function getAllFaqs()
    {
        return DB::table('ajuntament.int_faqs')
            ->where('publicat', 1)
            ->orderBy('nom')
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS FAQS (SENSE FILTRAR PER PUBLICAT)
    public static function getFaqs()
    {
        return DB::table('ajuntament.int_faqs')
            ->distinct()
            ->orderBy('nom')
            ->get()
            ->toArray();
    }

    // RETORNA TOTS ELS FAQS BACKEND ORDENATS SENSE TRANSLATE (Oracle-specific removed)
    public static function getAllFaqsAdmin()
    {
        return DB::table('ajuntament.int_faqs')
            ->select('id', 'nom', 'fk_id_categoria_faq')
            ->orderBy('nom')
            ->get()
            ->toArray();
    }

    // CERCA FAQS PER TEXT EN NOM (sense TRANSLATE--oracle )
    public static function getCercaFaqs($s_text)
    {
        return DB::table('ajuntament.int_faqs')
            ->where('publicat', 1)
            ->where('nom', 'like', '%' . $s_text . '%')
            ->orderBy('nom')
            ->get()
            ->toArray();
    }

    // RETORNA CATEGORIES DE FAQS AMB FAQS PUBLICATS I NOM QUE CONTÉ $s_text
    public static function getCatFaqsExistVar($s_text)
    {
        return DB::table('ajuntament.int_cat_faqs as C')
            ->distinct()
            ->join('ajuntament.int_faqs as F', 'F.FK_id_categoria_faq', '=', 'C.id')
            ->where('F.publicat', 1)
            ->where('F.nom', 'like', '%' . $s_text . '%')
            ->orderBy('C.nom')
            ->select('C.id', 'C.nom')
            ->get()
            ->toArray();
    }

    // INSERTAR FAQ amb CLOB: usa DB::transaction per garantir integritat
    public static function insertFaq(array $data)
    {
        // Connectar via OCI per CLOB
        $tnsname = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = SVORACLE)(PORT = 1521))
                    (CONNECT_DATA = (SERVER = DEDICATED) (SID = ORCL)))';
        $conn = oci_connect('ciutada', 'piticli', $tnsname, 'AL32UTF8');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $sql = "INSERT INTO ajuntament.int_faqs (nom, resposta, publicat, FK_id_categoria_faq, fk_tipus_obj)
                VALUES (:nom, EMPTY_CLOB(), :publicat, :FK_id_categoria_faq, :fk_tipus_obj) RETURNING resposta INTO :resposta";

        $stid = oci_parse($conn, $sql);
        $clob = oci_new_descriptor($conn, OCI_D_LOB);

        oci_bind_by_name($stid, ":nom", $data['nom_faq']);
        oci_bind_by_name($stid, ":resposta", $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stid, ":publicat", $data['pub_faq']);
        oci_bind_by_name($stid, ":FK_id_categoria_faq", $data['categoria_faq']);
        oci_bind_by_name($stid, ":fk_tipus_obj", $data['fk_tipus_obj']);

        oci_execute($stid, OCI_NO_AUTO_COMMIT);
        $clob->save($data['descripcio_faq']);
        oci_commit($conn);
        $clob->free();
        oci_free_statement($stid);
        oci_close($conn);

        // Recuperar últim id inserit
        $id = DB::table('ajuntament.int_faqs')
            ->max('id');

        return $id;
    }

    // ACTUALITZA FAQ amb CLOB
    public static function updateFaq($id, array $data)
    {
        $tnsname = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = SVORACLE)(PORT = 1521))
                    (CONNECT_DATA = (SERVER = DEDICATED) (SID = ORCL)))';
        $conn = oci_connect('ciutada', 'piticli', $tnsname, 'AL32UTF8');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $sql = "UPDATE ajuntament.int_faqs SET nom = :nom, resposta = EMPTY_CLOB(), publicat = :publicat, FK_id_categoria_faq = :FK_id_categoria_faq, fk_tipus_obj = :fk_tipus_obj WHERE id = :id RETURNING resposta INTO :resposta";

        $stid = oci_parse($conn, $sql);
        $clob = oci_new_descriptor($conn, OCI_D_LOB);

        oci_bind_by_name($stid, ":nom", $data['nom_faq']);
        oci_bind_by_name($stid, ":resposta", $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stid, ":publicat", $data['pub_faq']);
        oci_bind_by_name($stid, ":FK_id_categoria_faq", $data['categoria_faq']);
        oci_bind_by_name($stid, ":fk_tipus_obj", $data['fk_tipus_obj']);
        oci_bind_by_name($stid, ":id", $id);

        oci_execute($stid, OCI_NO_AUTO_COMMIT);
        $clob->save($data['descripcio_faq']);
        oci_commit($conn);
        $clob->free();
        oci_free_statement($stid);
        oci_close($conn);
    }

    // ELIMINA FAQ PER ID
    public static function deleteFaq($id)
    {
        return DB::table('ajuntament.int_faqs')
            ->where('id', $id)
            ->delete();
    }
}
