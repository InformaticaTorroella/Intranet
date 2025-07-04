<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    
    protected $primaryKey = 'id_serie';
    public $incrementing = true;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = ['id_serie', 'serie', 'fk_id_subseccio'];

    public function subseccio()
    {
        return $this->belongsTo(Subseccio::class, 'fk_id_subseccio', 'id_subseccio');
    }

    public function quadres()
    {
        return $this->hasMany(QuadreClassificacio::class, 'fk_id_serie', 'id_serie');
    }
}
