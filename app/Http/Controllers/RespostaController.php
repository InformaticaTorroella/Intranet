<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resposta;

class RespostaController extends Controller
{
    public function store(Request $request)
    {
        Resposta::create([
            'resposta' => $request->input('resposta'),
            'faq_id' => $request->input('faq_id'),
            'usuari_id' => session('user')->id,
            'resposta_pare_id' => $request->input('resposta_pare_id'),
        ]);

        return redirect()->back();
    }
}
