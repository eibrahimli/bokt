<?php

use App\Helpers\PenaltyHelper;
use App\Models\Loan;
use App\Models\LoanPenalty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Mortgage\Facades\Annuity;
use App\Helpers\LoanHelper;

Route::get('/letters/{customer}.pdf', [\App\Http\Controllers\DownloadController::class, 'letterPDF'])
    ->middleware('auth');
Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])
    ->name('lang.switch')
    ->middleware('auth');

Route::get('redirecto/{url}', function ($url) {
    dd($url);
    return redirect()->to($url);
});

Route::get('/test', function() {
    dd(LoanHelper::findFifd());
});

