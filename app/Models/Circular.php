<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $table = 'int_circulars';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nom_visual',
        'nom_arxiu',
        'data_creacio',
        'data_edicio',
        'url',
        'descripcion',
        'fk_cat_circular',
    ];

    public function categoria()
    {
        return $this->belongsTo(CatCircular::class, 'fk_cat_circular');
    }

    public function files()
    {
        return $this->hasMany(CircularFile::class, 'circular_id');
    }
}
