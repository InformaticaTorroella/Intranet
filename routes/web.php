<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RespostaController;
use App\Http\Controllers\ExportController;

use App\Http\Middleware\CheckSessionUsername;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', fn() => redirect()->route('home'));

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [AdminController::class, 'home'])->name('home');

Route::get('noticias', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('noticias/{id}', [NoticiaController::class, 'show'])->name('noticias.show');

Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/view/{id}/{action?}', [DocumentController::class, 'view'])->name('documents.view');

Route::get('avis', [AvisController::class, 'index'])->name('avis.index');
Route::get('avis/{id}', [AvisController::class, 'show'])->name('avis.show');

Route::get('telefons', [TelefonController::class, 'index'])->name('telefons.index');

Route::get('circulars', [CircularController::class, 'index'])->name('circulars.index');
Route::get('circulars/view/{id}/{action?}', [CircularController::class, 'view'])->name('circulars.view');

Route::get('/categoria-noticias', [NoticiaCategoriaController::class, 'index'])->name('categoria-noticias.index');

Route::get('/categoria-documents', [DocumentCategoriaController::class, 'index'])->name('categoria-documents.index');

Route::get('/categoria-circulars', [CircularCategoriaController::class, 'index'])->name('categoria-circulars.index');

Route::get('/area-telefons', [AreaController::class, 'index'])->name('area-telefons.index');

Route::get('/area-telefons/create', [AreaController::class, 'create'])->name('area-telefons.create');

Route::get('/edifici-telefons', [EdificiController::class, 'index'])->name('edifici-telefons.index');


Route::get('/quadres', [QuadreClassificacioController::class, 'index'])->name('quadres.index');

Route::get('/seccions', [SeccioController::class, 'index'])->name('seccions.index');

Route::get('/subseccions', [SubseccioController::class, 'index'])->name('subseccions.index');

Route::get('/series', [SerieController::class, 'index'])->name('series.index');

Route::get('/tipologies-gial', [TipologiaGialController::class, 'index'])->name('tipologies-gial.index');

Route::get('/quadres-classificacions-tipologies', [QuadreClassificacioTipologiaController::class, 'index'])->name('quadres-classificacions-tipologies.index');

Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('faqs/{id}', [FaqController::class, 'show'])->name('faqs.show');


// Rutas protegidas con middleware check.session
Route::middleware('check.session')->group(function () {

    // Noticias
    Route::get('noticias/create', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('noticias', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('noticias/{id}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('noticias/{id}', [NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('noticias/{id}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');

    // Documents

    Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Avis
    Route::get('avis/create', [AvisController::class, 'create'])->name('avis.create');
    Route::post('avis', [AvisController::class, 'store'])->name('avis.store');
    Route::get('avis/{id}/edit', [AvisController::class, 'edit'])->name('avis.edit');
    Route::put('avis/{id}', [AvisController::class, 'update'])->name('avis.update');
    Route::delete('avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');

    // Telefons
    Route::get('telefons/create', [TelefonController::class, 'create'])->name('telefons.create');
    Route::post('telefons', [TelefonController::class, 'store'])->name('telefons.store');
    Route::get('telefons/{id}/edit', [TelefonController::class, 'edit'])->name('telefons.edit');
    Route::put('telefons/{id}', [TelefonController::class, 'update'])->name('telefons.update');
    Route::delete('telefons/{id}', [TelefonController::class, 'destroy'])->name('telefons.destroy');

    // Logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

    // Circulars
    Route::get('circulars/create', [CircularController::class, 'create'])->name('circulars.create');
    Route::post('circulars', [CircularController::class, 'store'])->name('circulars.store');
    Route::get('circulars/{id}/edit', [CircularController::class, 'edit'])->name('circulars.edit');
    Route::put('circulars/{id}', [CircularController::class, 'update'])->name('circulars.update');
    Route::delete('circulars/{id}', [CircularController::class, 'destroy'])->name('circulars.destroy');

    // 🧮 Categoria Noticies
    Route::get('/categoria-noticias/create', [NoticiaCategoriaController::class, 'create'])->name('categoria-noticias.create');
    Route::post('/categories-noticias', [NoticiaCategoriaController::class, 'store'])->name('categoria-noticias.store');
    Route::get('/categories-noticias/{id}/edit', [NoticiaCategoriaController::class, 'edit'])->name('categoria-noticias.edit');
    Route::put('/categories-noticias/{id}', [NoticiaCategoriaController::class, 'update'])->name('categoria-noticias.update');
    Route::delete('/categories-noticias/{id}', [NoticiaCategoriaController::class, 'destroy'])->name('categoria-noticias.destroy');

    // 📄 Categoria Documents
    Route::get('/categoria-documents/create', [DocumentCategoriaController::class, 'create'])->name('categoria-documents.create');
    Route::post('/categoria-documents', [DocumentCategoriaController::class, 'store'])->name('categoria-documents.store');
    Route::get('/categoria-documents/{id}/edit', [DocumentCategoriaController::class, 'edit'])->name('categoria-documents.edit');
    Route::put('/categoria-documents/{id}', [DocumentCategoriaController::class, 'update'])->name('categoria-documents.update');
    Route::delete('/categoria-documents/{id}', [DocumentCategoriaController::class, 'destroy'])->name('categoria-documents.destroy');

    // 🍩 Categories Circulars
    Route::get('/categoria-circulars/create', [CircularCategoriaController::class, 'create'])->name('categoria-circulars.create');
    Route::post('/categoria-circulars', [CircularCategoriaController::class, 'store'])->name('categoria-circulars.store');
    Route::get('/categoria-circulars/{id}/edit', [CircularCategoriaController::class, 'edit'])->name('categoria-circulars.edit');
    Route::put('/categoria-circulars/{id}', [CircularCategoriaController::class, 'update'])->name('categoria-circulars.update');
    Route::delete('/categoria-circulars/{id}', [CircularCategoriaController::class, 'destroy'])->name('categoria-circulars.destroy');

    // ♦️ Areas
    Route::get('/area-telefons/create', [AreaController::class, 'create'])->name('area-telefons.create');
    Route::post('/area-telefons', [AreaController::class, 'store'])->name('area-telefons.store');
    Route::get('/area-telefons/{id}/edit', [AreaController::class, 'edit'])->name('area-telefons.edit');
    Route::put('/area-telefons/{id}', [AreaController::class, 'update'])->name('area-telefons.update');
    Route::delete('/area-telefons/{id}', [AreaController::class, 'destroy'])->name('area-telefons.destroy');

    // 🏘️ Edifici
    Route::get('/edifici-telefons/create', [EdificiController::class, 'create'])->name('edifici-telefons.create');
    Route::post('/edifici-telefons', [EdificiController::class, 'store'])->name('edifici-telefons.store');
    Route::get('/edifici-telefons/{id}/edit', [EdificiController::class, 'edit'])->name('edifici-telefons.edit');
    Route::put('/edifici-telefons/{id}', [EdificiController::class, 'update'])->name('edifici-telefons.update');
    Route::delete('/edifici-telefons/{id}', [EdificiController::class, 'destroy'])->name('edifici-telefons.destroy');

    // 🐉 Quadres
    Route::get('/quadres/create', [QuadreClassificacioController::class, 'create'])->name('quadres.create');
    Route::post('/quadres', [QuadreClassificacioController::class, 'store'])->name('quadres.store');
    Route::get('/quadres/{id}/edit', [QuadreClassificacioController::class, 'edit'])->name('quadres.edit');
    Route::put('/quadres/{id}', [QuadreClassificacioController::class, 'update'])->name('quadres.update');
    Route::delete('/quadres/{id}', [QuadreClassificacioController::class, 'destroy'])->name('quadres.destroy');
    Route::get('/export-csv', [ExportController::class, 'exportCsv']);

    // 🦁 Seccions
    Route::get('/seccions/create', [SeccioController::class, 'create'])->name('seccions.create');
    Route::post('/seccions', [SeccioController::class, 'store'])->name('seccions.store');
    Route::get('/seccions/{id}/edit', [SeccioController::class, 'edit'])->name('seccions.edit');
    Route::put('/seccions/{id}', [SeccioController::class, 'update'])->name('seccions.update');
    Route::delete('/seccions/{id}', [SeccioController::class, 'destroy'])->name('seccions.destroy');

    // 🐍 Subseccions
    Route::get('/subseccions/create', [SubseccioController::class, 'create'])->name('subseccions.create');
    Route::post('/subseccions', [SubseccioController::class, 'store'])->name('subseccions.store');
    Route::get('/subseccions/{id}/edit', [SubseccioController::class, 'edit'])->name('subseccions.edit');
    Route::put('/subseccions/{id}', [SubseccioController::class, 'update'])->name('subseccions.update');
    Route::delete('/subseccions/{id}', [SubseccioController::class, 'destroy'])->name('subseccions.destroy');

    // 🦅 Series
    Route::get('/series/create', [SerieController::class, 'create'])->name('series.create');
    Route::post('/series', [SerieController::class, 'store'])->name('series.store');
    Route::get('/series/{id}/edit', [SerieController::class, 'edit'])->name('series.edit');
    Route::put('/series/{id}', [SerieController::class, 'update'])->name('series.update');
    Route::delete('/series/{id}', [SerieController::class, 'destroy'])->name('series.destroy');

    // 🐛 Tipologies GIAL
    Route::get('/tipologies-gial/create', [TipologiaGialController::class, 'create'])->name('tipologies-gial.create');
    Route::post('/tipologies-gial', [TipologiaGialController::class, 'store'])->name('tipologies-gial.store');
    Route::get('/tipologies-gial/{id}/edit', [TipologiaGialController::class, 'edit'])->name('tipologies-gial.edit');
    Route::put('/tipologies-gial/{id}', [TipologiaGialController::class, 'update'])->name('tipologies-gial.update');
    Route::delete('/tipologies-gial/{id}', [TipologiaGialController::class, 'destroy'])->name('tipologies-gial.destroy');

    // 🎞️ Quadres Classificacions Tipologies
    Route::get('/quadres-classificacions-tipologies/create', [QuadreClassificacioTipologiaController::class, 'create'])->name('quadres-classificacions-tipologies.create');
    Route::post('/quadres-classificacions-tipologies', [QuadreClassificacioTipologiaController::class, 'store'])->name('quadres-classificacions-tipologies.store');
    Route::get('/quadres-classificacions-tipologies/{id}/edit', [QuadreClassificacioTipologiaController::class, 'edit'])->name('quadres-classificacions-tipologies.edit');
    Route::put('/quadres-classificacions-tipologies/{id}', [QuadreClassificacioTipologiaController::class, 'update'])->name('quadres-classificacions-tipologies.update');
    Route::delete('/quadres-classificacions-tipologies/{id}', [QuadreClassificacioTipologiaController::class, 'destroy'])->name('quadres-classificacions-tipologies.destroy');

    // API routes
    Route::get('/api/subseccions/{seccioId}', [QuadreClassificacioController::class, 'getSubseccions']);
    Route::get('/api/series/{subseccioId}', [QuadreClassificacioController::class, 'getSeries']);
    Route::get('/api/serie-info/{serieId}', [QuadreClassificacioController::class, 'getSerieInfo']);

    // 🔐 FAQs
    Route::get('faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('faqs', [FaqController::class, 'store'])->name('faqs.store');

    Route::post('/respostes', [RespostaController::class, 'store'])->name('respostes.store');
});



