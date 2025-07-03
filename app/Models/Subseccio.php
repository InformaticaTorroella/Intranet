<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subseccio extends Model
{
    protected $table = 'subseccions';

    protected $primaryKey = 'id_subseccio';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = ['id_subseccio', 'subseccio', 'fk_id_seccio'];

    public function seccio()
    {
        return $this->belongsTo(Seccio::class, 'fk_id_seccio', 'id_seccio');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'fk_id_subseccio', 'id_subseccio');
    }

    public function quadres()
    {
        return $this->hasMany(QuadreClassificacio::class, 'fk_id_subseccio', 'id_subseccio');
    }
}
