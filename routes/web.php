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
     config(['mortgage.loanTerm' => 24,'mortgage.loanAmount' => 7000, 'mortgage.interestRate' => 19]);

     $report = Annuity::showRepaymentSchedule()->toArray();

     $data = [];

     foreach ($report as $index => $rep) {

        if($index === count($report) - 1 && $rep['indebtedness'] < 0) {

            $report[$index-1]['indebtedness'] = $rep['mainDept'];
            $report[$index]['indebtedness'] = 0.00;
        } elseif($index === count($report) - 1 && $rep['indebtedness'] > 0 && $rep['indebtedness'] < 1) {
            $report[$index-1]['indebtedness'] = $report[$index]['mainDept'];
            $report[$index]['indebtedness'] = 0.00;
        }
     }

     dd($report);

});

