<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\TelefonController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\NoticiaCategoriaController;
use App\Http\Controllers\DocumentCategoriaController;
use App\Http\Controllers\CircularCategoriaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EdificiController;


// Rutas de autenticació
Route::get('/', fn() => redirect()->route('home'));

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Home
Route::get('/home', function () {
    $noticias = \App\Models\Noticia::orderBy('data_creacio', 'desc')->take(10)->get();
    return view('home', compact('noticias'));
})->name('home');


// 📢 Noticies
Route::get('noticias', [NoticiaController::class, 'index'])->name('noticias.index');

Route::get('noticias/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@create');
})->name('noticias.create');

Route::post('noticias', fn() => session()->has('username') ? app()->call('App\Http\Controllers\NoticiaController@store') : redirect()->route('login'))->name('noticias.store');

Route::get('noticias/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\NoticiaController@edit', ['id' => $id]);
})->name('noticias.edit');

Route::put('noticias/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\NoticiaController@update', ['id' => $id]) : redirect()->route('login'))->name('noticias.update');

Route::delete('noticias/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\NoticiaController@destroy', ['id' => $id]) : redirect()->route('login'))->name('noticias.destroy');

Route::get('noticias/{id}', [NoticiaController::class, 'show'])->name('noticias.show');

// 📁 Documents
Route::get('documents', fn() => app()->call('App\Http\Controllers\DocumentController@index'))->name('documents.index');

Route::get('/documents/view/{id}/{action?}', [DocumentController::class, 'view'])->name('documents.view');

Route::get('documents/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@create');
})->name('documents.create');

Route::post('documents', fn() => session()->has('username') ? app()->call('App\Http\Controllers\DocumentController@store') : redirect()->route('login'))->name('documents.store');

Route::get('documents/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\DocumentController@edit', ['id' => $id]);
})->name('documents.edit');

Route::put('documents/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\DocumentController@update', ['id' => $id]) : redirect()->route('login'))->name('documents.update');

Route::delete('documents/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\DocumentController@destroy', ['id' => $id]) : redirect()->route('login'))->name('documents.destroy');

// 📌 Avisos
Route::get('avis', fn() => app()->call('App\Http\Controllers\AvisController@index'))->name('avis.index');

Route::get('avis/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@create');
})->name('avis.create');

Route::post('avis', fn() => session()->has('username') ? app()->call('App\Http\Controllers\AvisController@store') : redirect()->route('login'))->name('avis.store');

Route::get('avis/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\AvisController@edit', ['id' => $id]);
})->name('avis.edit');

Route::put('avis/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\AvisController@update', ['id' => $id]) : redirect()->route('login'))->name('avis.update');

Route::delete('avis/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\AvisController@destroy', ['id' => $id]) : redirect()->route('login'))->name('avis.destroy');

Route::get('avis/{id}', [AvisController::class, 'show'])->name('avis.show');

// ☎️ Telefons
Route::get('telefons', fn() => app()->call('App\Http\Controllers\TelefonController@index'))->name('telefons.index');

Route::get('telefons/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@create');
})->name('telefons.create');

Route::post('telefons', fn() => session()->has('username') ? app()->call('App\Http\Controllers\TelefonController@store') : redirect()->route('login'))->name('telefons.store');

Route::get('telefons/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\TelefonController@edit', ['id' => $id]);
})->name('telefons.edit');

Route::put('telefons/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\TelefonController@update', ['id' => $id]) : redirect()->route('login'))->name('telefons.update');

Route::delete('telefons/{id}', fn($id) => session()->has('username') ? app()->call('App\Http\Controllers\TelefonController@destroy', ['id' => $id]) : redirect()->route('login'))->name('telefons.destroy');

Route::get('telefons/{id}', [TelefonController::class, 'show'])->name('telefons.show');

// 📋 Logs
Route::get('/logs', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call('App\Http\Controllers\LogController@index');
})->name('logs.index');

// 📄 Circulars
Route::get('circulars', function() {
    return app()->call([new CircularController(), 'index']);
})->name('circulars.index');

Route::get('circulars/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call([new CircularController(), 'create']);
})->name('circulars.create');

Route::post('circulars', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call([new CircularController(), 'store']);
})->name('circulars.store');

Route::get('circulars/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app()->call([new CircularController(), 'edit'], ['id' => $id]);
})->name('circulars.edit');

Route::put('circulars/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call([new CircularController(), 'update'], ['id' => $id]);
})->name('circulars.update');

Route::delete('circulars/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app()->call([new CircularController(), 'destroy'], ['id' => $id]);
})->name('circulars.destroy');

Route::get('circulars/{id}', function ($id) {
    return app()->call([new CircularController(), 'show'], ['id' => $id]);
})->name('circulars.show');

Route::get('circulars/view/{id}/{action?}', function ($id, $action = 'download') {
    return app()->call([new CircularController(), 'view'], ['id' => $id, 'action' => $action]);
})->name('circulars.view');

// 🧮 Categoria Noticies

Route::get('/categoria-noticias', [NoticiaCategoriaController::class, 'index'])->name('categoria-noticias.index');

Route::get('/categoria-noticias/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(NoticiaCategoriaController::class)->create();
})->name('categoria-noticias.create');

Route::post('/categories-noticias', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(NoticiaCategoriaController::class)->store(request());
})->name('categoria-noticias.store');

Route::get('/categories-noticias/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(NoticiaCategoriaController::class)->edit($id);
})->name('categoria-noticias.edit');

Route::put('/categories-noticias/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(NoticiaCategoriaController::class)->update(request(), $id);
})->name('categoria-noticias.update');

Route::delete('/categories-noticias/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(NoticiaCategoriaController::class)->destroy($id);
})->name('categoria-noticias.destroy');


// 📄 Categoria Documents

Route::get('/categoria-documents', [DocumentCategoriaController::class, 'index'])->name('categoria-documents.index');

Route::get('/categoria-documents/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(DocumentCategoriaController::class)->create();
})->name('categoria-documents.create');

Route::post('/categoria-documents', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(DocumentCategoriaController::class)->store(request());
})->name('categoria-documents.store');

Route::get('/categoria-documents/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(DocumentCategoriaController::class)->edit($id);
})->name('categoria-documents.edit');

Route::put('/categoria-documents/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(DocumentCategoriaController::class)->update(request(), $id);
})->name('categoria-documents.update');

Route::delete('/categoria-documents/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(DocumentCategoriaController::class)->destroy($id);
})->name('categoria-documents.destroy');

// 🍩 Categories Circulars
Route::get('/categoria-circulars', [CircularCategoriaController::class, 'index'])->name('categoria-circulars.index');

Route::get('/categoria-circulars/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(CircularCategoriaController::class)->create();
})->name('categoria-circulars.create');

Route::post('/categoria-circulars', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(CircularCategoriaController::class)->store(request());
})->name('categoria-circulars.store');

Route::get('/categoria-circulars/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(CircularCategoriaController::class)->edit($id);
})->name('categoria-circulars.edit');

Route::put('/categoria-circulars/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(CircularCategoriaController::class)->update(request(), $id);
})->name('categoria-circulars.update');

Route::delete('/categoria-circulars/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(CircularCategoriaController::class)->destroy($id);
})->name('categoria-circulars.destroy');

// ♦️ Areas
Route::get('/area-telefons', [AreaController::class, 'index'])->name('area-telefons.index');

Route::get('/area-telefons/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(AreaController::class)->create();
})->name('area-telefons.create');

Route::post('/area-telefons', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(AreaController::class)->store(request());
})->name('area-telefons.store');

Route::get('/area-telefons/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(AreaController::class)->edit($id);
})->name('area-telefons.edit');

Route::put('/area-telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(AreaController::class)->update(request(), $id);
})->name('area-telefons.update');

Route::delete('/area-telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(AreaController::class)->destroy($id);
})->name('area-telefons.destroy');

// 🏘️ Edifici
Route::get('/edifici-telefons', [EdificiController::class, 'index'])->name('edifici-telefons.index');

Route::get('/edifici-telefons/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(EdificiController::class)->create();
})->name('edifici-telefons.create');

Route::post('/edifici-telefons', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(EdificiController::class)->store(request());
})->name('edifici-telefons.store');

Route::get('/edifici-telefons/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(EdificiController::class)->edit($id);
})->name('edifici-telefons.edit');

Route::put('/edifici-telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(EdificiController::class)->update(request(), $id);
})->name('edifici-telefons.update');

Route::delete('/edifici-telefons/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(EdificiController::class)->destroy($id);
})->name('edifici-telefons.destroy');