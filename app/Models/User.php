<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name'];

    public $timestamps = false; // Si no tienes columnas created_at/updated_at
}
