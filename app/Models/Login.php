<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'usuaris';
    public $timestamps = false;
    protected $fillable = ['user', 'pass'];

    public static function login($username, $password)
    {
        if ($username && $password) {
            return DB::table('usuaris')
                ->where('user', $username)
                ->where('pass', $password)
                ->get()
                ->toArray();
        }
        return false;
    }
}
