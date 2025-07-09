<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Circular;

// no es fa servir del tot la funcio home esta com fensa al web pero aquest controllador no es fa servir
class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware anonim per protegir totes les accions
        $this->middleware(function ($request, $next) {
            if (!session()->has('username')) {
                return redirect('/login');
            }
            return $next($request);
        });
    }

    public function home()
    {
        $noticias = Noticia::getNoticiesIntranet()->take(2);
        $circulars = Circular::orderBy('data_creacio', 'desc')->take(2)->get();
        
        return view('home', compact('noticias', 'circulars'));
    }

}

