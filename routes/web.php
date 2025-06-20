<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoticiaController;

Route::get('/', function () {
    return redirect()->route('admin.home');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/home', function () {
    $noticias = \App\Models\Noticia::orderBy('data_creacio', 'desc')->take(10)->get();
    return view('admin.home', compact('noticias'));
})->name('admin.home');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('noticias', [NoticiaController::class, 'index'])->name('noticias.index');

Route::get('noticias/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);  // Guardas la URL actual
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@create');
})->name('noticias.create');


Route::post('noticias', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@store');
})->name('noticias.store');

Route::get('noticias/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@edit', ['id' => $id]);
})->name('noticias.edit');

Route::put('noticias/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@update', ['id' => $id]);
})->name('noticias.update');

Route::delete('noticias/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@destroy', ['id' => $id]);
})->name('noticias.destroy');

Route::get('noticias/{id}', [NoticiaController::class, 'show'])->name('noticias.show');

