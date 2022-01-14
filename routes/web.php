<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Mortgage\Facades\Annuity;

Route::get('/letters/{customer}.pdf', [\App\Http\Controllers\DownloadController::class,'letterPDF'])
    ->middleware('auth');
Route::get('/lang/{lang}',[LanguageController::class, 'switchLang'])
    ->name('lang.switch')
    ->middleware('auth');

Route::get('test', function () {

     $report = (new \App\Helpers\CreditHelper(12,1000,24))->getFormatedData();

     dd(array_sum(array_column($report, 'totalDept')));

});

