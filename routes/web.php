<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\TelefonController;
use App\Http\Controllers\LogController;


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


// Noticia routes

Route::get('noticias', [NoticiaController::class, 'index'])->name('noticias.index');

Route::get('noticias/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
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


// Document routes

Route::get('documents', function () {
    return app()->call('App\Http\Controllers\DocumentController@index');
})->name('documents.index');

Route::get('documents/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@create');
})->name('documents.create');

Route::post('documents', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@store');
})->name('documents.store');

Route::get('documents/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@edit', ['id' => $id]);
})->name('documents.edit');

Route::put('documents/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@update', ['id' => $id]);
})->name('documents.update');

Route::delete('documents/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@destroy', ['id' => $id]);
})->name('documents.destroy');


// Avis routes
Route::get('avis', function () {
    return app()->call('App\Http\Controllers\AvisController@index');
})->name('avis.index');

Route::get('avis/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@create');
})->name('avis.create');

Route::post('avis', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@store');
})->name('avis.store');

Route::get('avis/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@edit', ['id' => $id]);
})->name('avis.edit');

Route::put('avis/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@update', ['id' => $id]);
})->name('avis.update');

Route::delete('avis/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@destroy', ['id' => $id]);
})->name('avis.destroy');

Route::get('avis/{id}', [AvisController::class, 'show'])->name('avis.show');


// TELEFONS
Route::get('telefons', function () {
    return app()->call('App\Http\Controllers\TelefonController@index');
})->name('telefons.index');

Route::get('telefons/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@create');
})->name('telefons.create');

Route::post('telefons', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@store');
})->name('telefons.store');

Route::get('telefons/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@edit', ['id' => $id]);
})->name('telefons.edit');

Route::put('telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@update', ['id' => $id]);
})->name('telefons.update');

Route::delete('telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@destroy', ['id' => $id]);
})->name('telefons.destroy');

Route::get('telefons/{id}', [TelefonController::class, 'show'])->name('telefons.show');


// Ruta per als logs
Route::get('/logs', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\LogController@index');
})->name('logs.index');
