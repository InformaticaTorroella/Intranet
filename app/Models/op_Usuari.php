<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class op_Usuari extends Model
{
    use HasFactory;

    protected $table = 'op_usuaris';

    protected $fillable = ['nom'];

    public $timestamps = false;
}
