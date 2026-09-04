<?php

use App\Http\Controllers\ProfilePasswordController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login')->with('info', 'Você saiu da sua conta.');
})->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/site', [SiteController::class, 'index'])->name('site.index');
    Route::get('/site/conteudos', [SiteController::class, 'contentIndex'])->name('site.content.index');
    Route::get('/site/noticias', [SiteController::class, 'newsIndex'])->name('site.news.index');
    Route::get('/site/noticias/{news}', [SiteController::class, 'newsShow'])->name('site.news.show');
    Route::get('/site/eventos', [SiteController::class, 'eventsIndex'])->name('site.events.index');
    Route::get('/site/eventos/{event}', [SiteController::class, 'eventsShow'])->name('site.events.show');

    Route::get('/site/perfil/senha', [ProfilePasswordController::class, 'index'])->name('site.profile.password');
    Route::put('/site/perfil/senha', [ProfilePasswordController::class, 'update'])->name('site.profile.password.update');
});

