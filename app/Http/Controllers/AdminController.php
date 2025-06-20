<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware para proteger todas las acciones
        $this->middleware(function ($request, $next) {
            if (!session()->has('username')) {
                return redirect('/login');
            }
            return $next($request);
        });
    }

    public function home()
    {
        $noticias = Noticia::getNoticiesIntranet()->take(10);
        
        return view('admin.home', compact('noticias'));
    }
}

