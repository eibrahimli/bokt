<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('/letters/{customer}.pdf', 'DownloadController@letterPDF')
    ->middleware('auth');
Route::get('/lang/{lang}',[LanguageController::class, 'switchLang'])
    ->name('lang.switch')
    ->middleware('auth');

