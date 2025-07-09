<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatCircular extends Model
{
    protected $table = 'int_cat_circulars';

    protected $fillable = ['nom'];

    public $timestamps = false;

    public function circulars()
    {
        return $this->hasMany(Circular::class, 'fk_cat_circular');
    }
}
