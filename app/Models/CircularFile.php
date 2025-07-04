<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CircularFile extends Model
{
    protected $table = 'int_circular_files';
    public $timestamps = false;


    protected $fillable = ['circular_id', 'nom_arxiu', 'url'];

    public function circular()
    {
        return $this->belongsTo(Circular::class, 'circular_id');
    }
}
