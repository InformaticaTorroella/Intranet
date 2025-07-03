<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccio extends Model
{
    protected $table = 'seccions';
    
    protected $primaryKey = 'id_seccio';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_seccio', 'seccio'];

    public function subseccions()
    {
        return $this->hasMany(Subseccio::class, 'fk_id_seccio', 'id_seccio');
    }

    public function quadres()
    {
        return $this->hasMany(QuadreClassificacio::class, 'fk_id_seccio', 'id_seccio');
    }
}
