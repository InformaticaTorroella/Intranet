<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class op_Partida extends Model
{
    use HasFactory;

    protected $table = 'op_partides';

    protected $primaryKey = 'partida';
    public $incrementing = false; // perquè partida és varchar
    protected $keyType = 'string';

    protected $fillable = ['partida', 'descripcio', 'responsable_id'];

    public $timestamps = false;

    public function responsable()
    {
        return $this->belongsTo(op_Usuari::class, 'responsable_id');
    }
}
