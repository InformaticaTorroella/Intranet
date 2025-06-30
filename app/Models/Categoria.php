<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'int_cat_circulars'; 
    public $timestamps = false;

    protected $fillable = ['id', 'nom', 'ordre'];

    public function getCategoriesOrdreCircular()
    {
        return $this->orderBy('ordre', 'asc')->get(['id', 'nom', 'ordre']);
    }
}
