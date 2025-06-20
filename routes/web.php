<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin/home', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }

    $noticias = \App\Models\Noticia::orderBy('data_creacio', 'desc')->take(10)->get();
    return view('admin.home', compact('noticias'));
})->name('admin.home');



