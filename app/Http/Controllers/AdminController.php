<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Circular;
use App\Models\op_Ad;
use App\Models\op_Usuari;
use Carbon\Carbon;


// no es fa servir del tot la funcio home esta com fensa al web pero aquest controllador no es fa servir
class AdminController extends Controller
{
    public function home()
    {
        // Últim registre AD amb responsable carregat
        $ultimaAd = op_Ad::with('responsable')->latest('data')->first();

        $noticias = Noticia::orderBy('data_publicacio', 'desc')->take(4)->get();
        $circulars = Circular::orderBy('data_creacio', 'desc')->take(4)->get();

        return view('home', compact('noticias', 'circulars', 'ultimaAd'));
    }



}

