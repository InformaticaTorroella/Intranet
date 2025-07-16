<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = 'respostes';
    protected $fillable = ['resposta', 'faq_id', 'usuari_id', 'resposta_pare_id'];

    public function usuari()
    {
        return $this->belongsTo(User::class, 'usuari_id');
    }

    public function fills()
    {
        return $this->hasMany(Resposta::class, 'resposta_pare_id');
    }
}
