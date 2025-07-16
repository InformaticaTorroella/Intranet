<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSessionUsername
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('username')) {
            // Guarda la url que intentaba acceder para redirigir después si quieres
            $request->session()->put('url.intended', $request->url());
            return redirect()->route('login');
        }

        return $next($request);
    }
}
