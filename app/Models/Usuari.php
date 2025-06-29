<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuari extends Model
{
    protected $table = 'int_usuaris';
    public $timestamps = false;

    protected $fillable = [
        'USUARI', 'fk_id_area', 
        'bool_categories_veure', 'bool_categories_crear', 'bool_categories_editar', 'bool_categories_eliminar',
        'bool_telefons_veure', 'bool_telefons_crear', 'bool_telefons_editar', 'bool_telefons_eliminar',
        'bool_faq_veure', 'bool_faq_crear', 'bool_faq_editar', 'bool_faq_eliminar',
        'bool_manuals_veure', 'bool_manuals_crear', 'bool_manuals_editar', 'bool_manuals_eliminar',
        'bool_noticies_veure', 'bool_noticies_crear', 'bool_noticies_editar', 'bool_noticies_eliminar',
        'bool_avisos_veure', 'bool_avisos_crear', 'bool_avisos_editar', 'bool_avisos_eliminar',
        'bool_usuaris_veure', 'bool_usuaris_crear', 'bool_usuaris_editar', 'bool_usuaris_eliminar',
        'bool_albarans_editar', 'bool_albarans_eliminar',
        'bool_circulars_veure', 'bool_circulars_crear', 'bool_circulars_editar', 'bool_circulars_eliminar',
        'bool_impressores_veure', 'bool_impressores_crear', 'bool_impressores_editar', 'bool_impressores_eliminar',
        'bool_event_crear', 'bool_event_editar', 'bool_event_eliminar',
        'bool_calendaris_veure', 'bool_calendaris_crear', 'bool_calendaris_editar', 'bool_calendaris_eliminar',
    ];

    public static function getAllUsuaris()
    {
        return self::all();
    }

    public static function getUsuari($id)
    {
        return self::where('id', $id)->get();
    }

    public static function insertUsuari(array $data)
    {
        $usuari = self::create([
            'USUARI' => $data["nom_usuari"],
            'fk_id_area' => $data["area"],

            'bool_categories_veure' => $data["ck_veure_categories"],
            'bool_categories_crear' => $data["ck_crear_categories"],
            'bool_categories_editar' => $data["ck_editar_categories"],
            'bool_categories_eliminar' => $data["ck_eliminar_categories"],

            'bool_telefons_veure' => $data["ck_veure_telefons"],
            'bool_telefons_crear' => $data["ck_crear_telefons"],
            'bool_telefons_editar' => $data["ck_editar_telefons"],
            'bool_telefons_eliminar' => $data["ck_eliminar_telefons"],

            'bool_faq_veure' => $data["ck_veure_faq"],
            'bool_faq_crear' => $data["ck_crear_faq"],
            'bool_faq_editar' => $data["ck_editar_faq"],
            'bool_faq_eliminar' => $data["ck_eliminar_faq"],

            'bool_manuals_veure' => $data["ck_veure_manuals"],
            'bool_manuals_crear' => $data["ck_crear_manuals"],
            'bool_manuals_editar' => $data["ck_editar_manuals"],
            'bool_manuals_eliminar' => $data["ck_eliminar_manuals"],

            'bool_noticies_veure' => $data["ck_veure_noticies"],
            'bool_noticies_crear' => $data["ck_crear_noticies"],
            'bool_noticies_editar' => $data["ck_editar_noticies"],
            'bool_noticies_eliminar' => $data["ck_eliminar_noticies"],

            'bool_avisos_veure' => $data["ck_veure_avisos"],
            'bool_avisos_crear' => $data["ck_crear_avisos"],
            'bool_avisos_editar' => $data["ck_editar_avisos"],
            'bool_avisos_eliminar' => $data["ck_eliminar_avisos"],

            'bool_usuaris_veure' => $data["ck_veure_usuaris"],
            'bool_usuaris_crear' => $data["ck_crear_usuaris"],
            'bool_usuaris_editar' => $data["ck_editar_usuaris"],
            'bool_usuaris_eliminar' => $data["ck_eliminar_usuaris"],

            'bool_albarans_editar' => $data["ck_editar_albarans"],
            'bool_albarans_eliminar' => $data["ck_eliminar_albarans"],

            'bool_circulars_veure' => $data["ck_veure_circulars"],
            'bool_circulars_crear' => $data["ck_crear_circulars"],
            'bool_circulars_editar' => $data["ck_editar_circulars"],
            'bool_circulars_eliminar' => $data["ck_eliminar_circulars"],

            'bool_impressores_veure' => $data["ck_veure_impressores"],
            'bool_impressores_crear' => $data["ck_crear_impressores"],
            'bool_impressores_editar' => $data["ck_editar_impressores"],
            'bool_impressores_eliminar' => $data["ck_eliminar_impressores"],

            'bool_event_crear' => $data["ck_crear_events"] ?? false,
            'bool_event_editar' => $data["ck_editar_events"] ?? false,
            'bool_event_eliminar' => $data["ck_eliminar_events"] ?? false,

            'bool_calendaris_veure' => $data["ck_veure_calendaris"] ?? false,
            'bool_calendaris_crear' => $data["ck_crear_calendaris"] ?? false,
            'bool_calendaris_editar' => $data["ck_editar_calendaris"] ?? false,
            'bool_calendaris_eliminar' => $data["ck_eliminar_calendaris"] ?? false,
        ]);

        return $usuari->id;
    }

    public static function insertAcces(array $data)
    {
        return DB::table('int_acces_log')->insert([
            'nom_usuari' => $data['username'],
            'fk_area' => $data['area'],
            'data' => $data['data'], 
        ]);
    }

    public static function updateUsuari(int $id, array $data)
    {
        $usuari = self::find($id);
        if (!$usuari) return false;

        $usuari->USUARI = $data["nom_usuari"];
        $usuari->fk_id_area = $data["area"];

        $usuari->bool_categories_veure = $data["ck_veure_categories"];
        $usuari->bool_categories_crear = $data["ck_crear_categories"];
        $usuari->bool_categories_editar = $data["ck_editar_categories"];
        $usuari->bool_categories_eliminar = $data["ck_eliminar_categories"];

        $usuari->bool_circulars_veure = $data["ck_veure_circulars"];
        $usuari->bool_circulars_crear = $data["ck_crear_circulars"];
        $usuari->bool_circulars_editar = $data["ck_editar_circulars"];
        $usuari->bool_circulars_eliminar = $data["ck_eliminar_circulars"];

        $usuari->bool_telefons_veure = $data["ck_veure_telefons"];
        $usuari->bool_telefons_crear = $data["ck_crear_telefons"];
        $usuari->bool_telefons_editar = $data["ck_editar_telefons"];
        $usuari->bool_telefons_eliminar = $data["ck_eliminar_telefons"];

        $usuari->bool_faq_veure = $data["ck_veure_faq"];
        $usuari->bool_faq_crear = $data["ck_crear_faq"];
        $usuari->bool_faq_editar = $data["ck_editar_faq"];
        $usuari->bool_faq_eliminar = $data["ck_eliminar_faq"];

        $usuari->bool_manuals_veure = $data["ck_veure_manuals"];
        $usuari->bool_manuals_crear = $data["ck_crear_manuals"];
        $usuari->bool_manuals_editar = $data["ck_editar_manuals"];
        $usuari->bool_manuals_eliminar = $data["ck_eliminar_manuals"];

        $usuari->bool_noticies_veure = $data["ck_veure_noticies"];
        $usuari->bool_noticies_crear = $data["ck_crear_noticies"];
        $usuari->bool_noticies_editar = $data["ck_editar_noticies"];
        $usuari->bool_noticies_eliminar = $data["ck_eliminar_noticies"];

        $usuari->bool_avisos_veure = $data["ck_veure_avisos"];
        $usuari->bool_avisos_crear = $data["ck_crear_avisos"];
        $usuari->bool_avisos_editar = $data["ck_editar_avisos"];
        $usuari->bool_avisos_eliminar = $data["ck_eliminar_avisos"];

        $usuari->bool_usuaris_veure = $data["ck_veure_usuaris"];
        $usuari->bool_usuaris_crear = $data["ck_crear_usuaris"];
        $usuari->bool_usuaris_editar = $data["ck_editar_usuaris"];
        $usuari->bool_usuaris_eliminar = $data["ck_eliminar_usuaris"];

        $usuari->bool_albarans_editar = $data["ck_editar_albarans"];
        $usuari->bool_albarans_eliminar = $data["ck_eliminar_albarans"];

        $usuari->bool_event_crear = $data["ck_crear_events"] ?? false;
        $usuari->bool_event_editar = $data["ck_editar_events"] ?? false;
        $usuari->bool_event_eliminar = $data["ck_eliminar_events"] ?? false;

        $usuari->bool_calendaris_veure = $data["ck_veure_calendaris"] ?? false;
        $usuari->bool_calendaris_crear = $data["ck_crear_calendaris"] ?? false;
        $usuari->bool_calendaris_editar = $data["ck_editar_calendaris"] ?? false;
        $usuari->bool_calendaris_eliminar = $data["ck_eliminar_calendaris"] ?? false;

        $usuari->bool_impressores_veure = $data["ck_veure_impressores"];
        $usuari->bool_impressores_crear = $data["ck_crear_impressores"];
        $usuari->bool_impressores_editar = $data["ck_editar_impressores"];
        $usuari->bool_impressores_eliminar = $data["ck_eliminar_impressores"];

        return $usuari->save();
    }

    public static function deleteUsuari($id)
    {
        return self::destroy($id);
    }
}
