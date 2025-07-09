<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatDocument extends Model
{
    protected $table = 'int_cat_documents';

    protected $fillable = [
        'nom',
    ];

    public $timestamps = false;

    // Relació amb int_documents
    public function documents()
    {
        return $this->hasMany(IntDocument::class, 'fk_id_cat_document');
    }
}
