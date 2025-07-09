<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuadreClassificacioTipologia extends Model
{
    public $timestamps = false;

    protected $table = 'quadres_classificacions_tipologies';

    protected $fillable = [
        'fk_id_quadre_classificacio',
        'fk_id_tipologia_gial'
    ];

    // Relations

    public function quadre()
    {
        return $this->belongsTo(QuadreClassificacio::class, 'fk_id_quadre_classificacio');
    }

    public function tipologia()
    {
        return $this->belongsTo(TipologiaGial::class, 'fk_id_tipologia_gial');
    }

}
