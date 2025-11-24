<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoTranslateController;

// Automatic translation API route
Route::post('/auto-translate', [AutoTranslateController::class, 'translate'])
    ->name('auto.translate');

// Pages
Route::get('/', fn () => view('home'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');
