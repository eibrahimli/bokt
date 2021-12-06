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
//     config(['mortgage.loanTerm' => 12,'mortgage.loanAmount' => 1000, 'mortgage.interestRate' => 24.00]);

     dd(Annuity::showRepaymentSchedule());
});

