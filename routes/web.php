<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('/letters/{customer}.pdf', [\App\Http\Controllers\DownloadController::class,'letterPDF'])
    ->middleware('auth');
Route::get('/lang/{lang}',[LanguageController::class, 'switchLang'])
    ->name('lang.switch')
    ->middleware('auth');


