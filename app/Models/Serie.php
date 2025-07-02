<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    protected $primaryKey = 'id_serie';

    protected $fillable = [
        'id_serie',
        'serie',
    ];

    public function quadres_classificacions()
    {
        return $this->hasMany(QuadresClassificacio::class, 'fk_id_serie', 'id_serie');
    }
}
