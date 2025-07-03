<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\SeccioController;
use App\Http\Controllers\SubseccioController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\TipologiaGialController;
use App\Http\Controllers\QuadreClassificacioController;
use App\Http\Controllers\QuadreClassificacioTipologiaController;


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

// 🐉 Quadres 
Route::get('/quadres', [QuadreClassificacioController::class, 'index'])->name('quadres.index');


Route::get('/quadres/create', function (Request $request) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(QuadreClassificacioController::class)->create($request);
})->name('quadres.create');


Route::post('/quadres', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioController::class)->store(request());
})->name('quadres.store');

Route::get('/quadres/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(QuadreClassificacioController::class)->edit($id);
})->name('quadres.edit');

Route::put('/quadres/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioController::class)->update(request(), $id);
})->name('quadres.update');

Route::delete('/quadres/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioController::class)->destroy($id);
})->name('quadres.destroy');


// 🦁 Seccions 
Route::get('/seccions', [SeccioController::class, 'index'])->name('seccions.index');

Route::get('/seccions/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SeccioController::class)->create();
})->name('seccions.create');

Route::post('/seccions', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SeccioController::class)->store(request());
})->name('seccions.store');

Route::get('/seccions/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SeccioController::class)->edit($id);
})->name('seccions.edit');

Route::put('/seccions/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SeccioController::class)->update(request(), $id);
})->name('seccions.update');

Route::delete('/seccions/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SeccioController::class)->destroy($id);
})->name('seccions.destroy');


// 🐍 Subseccions 
Route::get('/subseccions', [SubseccioController::class, 'index'])->name('subseccions.index');

Route::get('/subseccions/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SubseccioController::class)->create();
})->name('subseccions.create');

Route::post('/subseccions', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SubseccioController::class)->store(request());
})->name('subseccions.store');

Route::get('/subseccions/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SubseccioController::class)->edit($id);
})->name('subseccions.edit');

Route::put('/subseccions/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SubseccioController::class)->update(request(), $id);
})->name('subseccions.update');

Route::delete('/subseccions/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SubseccioController::class)->destroy($id);
})->name('subseccions.destroy');


// 🦅 Series 
Route::get('/series', [SerieController::class, 'index'])->name('series.index');

Route::get('/series/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SerieController::class)->create();
})->name('series.create');

Route::post('/series', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SerieController::class)->store(request());
})->name('series.store');

Route::get('/series/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(SerieController::class)->edit($id);
})->name('series.edit');

Route::put('/series/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SerieController::class)->update(request(), $id);
})->name('series.update');

Route::delete('/series/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(SerieController::class)->destroy($id);
})->name('series.destroy');


// 🐛 Tipologies GIAL 
Route::get('/tipologies-gial', [TipologiaGialController::class, 'index'])->name('tipologies-gial.index');

Route::get('/tipologies-gial/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(TipologiaGialController::class)->create();
})->name('tipologies-gial.create');

Route::post('/tipologies-gial', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(TipologiaGialController::class)->store(request());
})->name('tipologies-gial.store');

Route::get('/tipologies-gial/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(TipologiaGialController::class)->edit($id);
})->name('tipologies-gial.edit');

Route::put('/tipologies-gial/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(TipologiaGialController::class)->update(request(), $id);
})->name('tipologies-gial.update');

Route::delete('/tipologies-gial/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(TipologiaGialController::class)->destroy($id);
})->name('tipologies-gial.destroy');


// 🎞️ Quadres Classificacions Tipologies

Route::get('/quadres-classificacions-tipologies', [QuadreClassificacioTipologiaController::class, 'index'])
    ->name('quadres-classificacions-tipologies.index');

Route::get('/quadres-classificacions-tipologies/create', function () {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(QuadreClassificacioTipologiaController::class)->create();
})->name('quadres-classificacions-tipologies.create');

Route::post('/quadres-classificacions-tipologies', function () {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioTipologiaController::class)->store(request());
})->name('quadres-classificacions-tipologies.store');

Route::get('/quadres-classificacions-tipologies/{id}/edit', function ($id) {
    if (!session()->has('username')) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login');
    }
    return app(QuadreClassificacioTipologiaController::class)->edit($id);
})->name('quadres-classificacions-tipologies.edit');

Route::put('/quadres-classificacions-tipologies/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioTipologiaController::class)->update(request(), $id);
})->name('quadres-classificacions-tipologies.update');

Route::delete('/quadres-classificacions-tipologies/{id}', function ($id) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return app(QuadreClassificacioTipologiaController::class)->destroy($id);
})->name('quadres-classificacions-tipologies.destroy');


Route::get('/api/subseccions/{seccioId}', function($seccioId) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return \App\Models\Subseccio::where('fk_id_seccio', $seccioId)->get();
});

Route::get('/api/series/{subseccioId}', function($subseccioId) {
    if (!session()->has('username')) {
        return redirect()->route('login');
    }
    return \App\Models\Serie::where('fk_id_subseccio', $subseccioId)->get();
});
