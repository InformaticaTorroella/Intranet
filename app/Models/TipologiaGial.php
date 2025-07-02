<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipologiesGial extends Model
{
    protected $table = 'tipologies_gial';
    protected $primaryKey = 'id';

    protected $fillable = [
        'codi',
    ];

    public function quadres_classificacions()
    {
        return $this->belongsToMany(QuadresClassificacio::class, 'quadres_gial', 'fk_tipus', 'fk_quadre');
    }
}
