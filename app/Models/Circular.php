<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $table = 'int_circulars';

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
    ];

    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(CatCircular::class, 'fk_cat_circular');
    }
}
