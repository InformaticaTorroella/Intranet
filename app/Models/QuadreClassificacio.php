<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuadreClassificacio extends Model
{
    protected $table = 'quadres_classificacions';
    public $timestamps = false;


    protected $fillable = [
        'fk_id_seccio',
        'fk_id_subseccio',
        'fk_id_serie'
    ];

    public function seccio()
    {
        return $this->belongsTo(Seccio::class, 'fk_id_seccio', 'id_seccio');
    }

    public function subseccio()
    {
        return $this->belongsTo(Subseccio::class, 'fk_id_subseccio', 'id_subseccio');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'fk_id_serie', 'id_serie');
    }

    public function tipologies()
    {
        return $this->belongsToMany(
            TipologiaGial::class,
            'quadres_classificacions_tipologies',
            'fk_id_quadre_classificacio',
            'fk_id_tipologia_gial'
        );
    }
}
