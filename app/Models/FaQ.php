<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    protected $fillable = ['pregunta', 'usuari_id'];

    public function usuari()
    {
        return $this->belongsTo(User::class, 'usuari_id');
    }

    public function respostes()
    {
        return $this->hasMany(Resposta::class)->whereNull('resposta_pare_id');
    }
    
    public static function ultima()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

}
