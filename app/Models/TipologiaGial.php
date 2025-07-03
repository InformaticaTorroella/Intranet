<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipologiaGial extends Model
{
    protected $table = 'tipologies_gial';

    protected $fillable = ['codi'];

    public function quadres()
    {
        return $this->belongsToMany(
            QuadreClassificacio::class,
            'quadres_classificacions_tipologies',
            'fk_id_tipologia_gial',
            'fk_id_quadre_classificacio'
        );
    }
}
