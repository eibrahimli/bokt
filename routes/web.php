<?php

use Illuminate\Support\Facades\Route;

Route::get('/letters/{customer}.pdf', 'DownloadController@letterPDF')
    ->middleware('auth');
