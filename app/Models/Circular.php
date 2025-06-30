<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $table = 'int_circulars';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'nom_visual',
        'nom_arxiu',
        'data_creacio',
        'data_edicio',
        'data_publicacio',
        'extensio',
        'ordre',
        'url',
        'publicat',
        'fk_cat_circular',
        'fk_tipus_obj',
        'trial689',
    ];
}
