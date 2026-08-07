<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/site', [SiteController::class, 'index'])->name('site.index');
    Route::get('/site/conteudos', [SiteController::class, 'contentIndex'])->name('site.content.index');
    Route::get('/site/noticias', [SiteController::class, 'newsIndex'])->name('site.news.index');
    Route::get('/site/noticias/{news}', [SiteController::class, 'newsShow'])->name('site.news.show');
    Route::get('/site/eventos', [SiteController::class, 'eventsIndex'])->name('site.events.index');
    Route::get('/site/eventos/{event}', [SiteController::class, 'eventsShow'])->name('site.events.show');
});
