<?php


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::post('report', '\Eibrahimli\MonthlyCreditPaymentReport\Http\Controllers\CreditPaymentController@calculate');