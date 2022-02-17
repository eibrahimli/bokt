<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/data', function (Request $request) {

    return response()->json(\App\Models\Registry::allDebetCredit($request));
});

Route::get('/codes', function (Request $request) {

    return response()->json(\App\Models\DcAccount::pluck("name","code"));
});

Route::get('/branches', function (Request $request) {

    return response()->json(\App\Models\Branch::pluck("name","id"));
});

Route::get('/suppliers', function (Request $request) {

    return response()->json(\App\Models\Supplier::pluck("name","id"));
});

Route::get('/accounts', function (Request $request) {

    return response()->json(\App\Models\Account::pluck("name","id"));
});
