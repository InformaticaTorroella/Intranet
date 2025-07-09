<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Circular;
use App\Models\Faq;
use Carbon\Carbon;


// no es fa servir del tot la funcio home esta com fensa al web pero aquest controllador no es fa servir
class AdminController extends Controller
{
    public function home()
    {
        $ultimaFaq = Faq::orderBy('created_at', 'desc')->first();

        if ($ultimaFaq) {
            try {
                $ultimaFaq->created_at = Carbon::parse($ultimaFaq->created_at);
            } catch (\Exception $e) {
                $ultimaFaq->created_at = now();
            }
        }

        $noticias = Noticia::orderBy('data_publicacio', 'desc')->take(4)->get();
        $circulars = Circular::orderBy('data_creacio', 'desc')->take(4)->get();

        return view('home', compact('noticias', 'circulars', 'ultimaFaq'));
    }



}

