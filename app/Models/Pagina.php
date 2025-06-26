<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagina extends Model
{
    protected $table = 'int_noticies'; 
    public $timestamps = false;

    public static function getSearch($s_cat, $s_text)
    {
        $s_text_upper = strtoupper($s_text);
        $accent_translation = "translate(nom, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ','aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')";
        
        if (isset($s_cat) && empty($s_text)) {
            switch ($s_cat) {
                case 'tots':
                    $result1 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, descripcio, DATE(data_creacio) as data_creacio, DATE(data_publicacio) as data_publicacio, publicat, fk_tipus_obj 
                        FROM int_noticies
                    ");
                    $result2 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, num_directe, extensio_voip, num_directe_mobil, extensio_mobil, fk_tipus_obj 
                        FROM int_telefons
                    ");
                    $result3 = DB::select("
                        SELECT id, nom_visual as nom, translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t, url, fk_tipus_obj 
                        FROM int_manuals
                    ");
                    $result4 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, resposta, publicat, fk_id_categoria_faq, fk_tipus_obj 
                        FROM int_faqs
                    ");

                    return array_merge(
                        json_decode(json_encode($result1), true),
                        json_decode(json_encode($result2), true),
                        json_decode(json_encode($result3), true),
                        json_decode(json_encode($result4), true)
                    );

                case 'faqs':
                    return DB::table('int_faqs')->get()->toArray();

                case 'manuals':
                    return DB::table('int_manuals')->get()->toArray();

                case 'noticies':
                    return DB::table('int_noticies')->get()->toArray();

                case 'telefons':
                    return DB::table('int_telefons')->get()->toArray();

                default:
                    return [];
            }
        } elseif (isset($s_cat) && isset($s_text)) {
            $like = '%' . $s_text . '%';
            switch ($s_cat) {
                case 'tots':
                    $result1 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, descripcio, DATE(data_creacio) as data_creacio, DATE(data_publicacio) as data_publicacio, publicat, fk_tipus_obj 
                        FROM int_noticies 
                        WHERE UPPER($accent_translation) LIKE UPPER(?)
                    ", [$like]);
                    $result2 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, num_directe, extensio_voip, num_directe_mobil, extensio_mobil, fk_tipus_obj 
                        FROM int_telefons 
                        WHERE UPPER($accent_translation) LIKE UPPER(?)
                    ", [$like]);
                    $result3 = DB::select("
                        SELECT id, nom_visual as nom, translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC') as nom_t, url, fk_tipus_obj 
                        FROM int_manuals 
                        WHERE UPPER(translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')) LIKE UPPER(?)
                    ", [$like]);
                    $result4 = DB::select("
                        SELECT id, nom, $accent_translation as nom_t, resposta, publicat, fk_id_categoria_faq, fk_tipus_obj 
                        FROM int_faqs 
                        WHERE UPPER($accent_translation) LIKE UPPER(?)
                    ", [$like]);

                    return array_merge(
                        json_decode(json_encode($result1), true),
                        json_decode(json_encode($result2), true),
                        json_decode(json_encode($result3), true),
                        json_decode(json_encode($result4), true)
                    );

                case 'faqs':
                    return DB::table('int_faqs')->where(DB::raw("UPPER($accent_translation)"), 'LIKE', $like)->get()->toArray();

                case 'manuals':
                    return DB::table('int_manuals')->where(DB::raw("UPPER(translate(nom_visual, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC'))"), 'LIKE', $like)->get()->toArray();

                case 'noticies':
                    return DB::table('int_noticies')->where(DB::raw("UPPER($accent_translation)"), 'LIKE', $like)->get()->toArray();

                case 'telefons':
                    return DB::table('int_telefons')->where(DB::raw("UPPER($accent_translation)"), 'LIKE', $like)->get()->toArray();

                default:
                    return [];
            }
        }

        return [];
    }
}
