<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccio extends Model
{
    protected $table = 'seccions';
    protected $primaryKey = 'id_seccio';

    protected $fillable = [
        'id_seccio',
        'seccio',
    ];

    public function quadres_classificacions()
    {
        return $this->hasMany(QuadresClassificacio::class, 'fk_id_seccio', 'id_seccio');
    }
}
