<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subseccio extends Model
{
    protected $table = 'subseccions';
    protected $primaryKey = 'id_subseccio';

    protected $fillable = [
        'id_subseccio',
        'subseccio',
    ];

    public function quadres_classificacions()
    {
        return $this->hasMany(QuadresClassificacio::class, 'fk_id_subseccio', 'id_subseccio');
    }
}
