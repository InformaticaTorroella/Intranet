<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatNoticia extends Model
{
    protected $table = 'int_cat_noticies';

    public $timestamps = false;

    protected $primaryKey = 'id';

    // Definir el tipus de clau primària si cal (int per defecte)
    protected $keyType = 'int';

    // Mass assignable (opcional)
    protected $fillable = ['nom'];

    // Relació: una categoria té moltes notícies
    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'cat_noticia_id', 'id');
    }
}
