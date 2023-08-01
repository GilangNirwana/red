<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('dash',[\App\Http\Controllers\Controller::class,'dash']);
Route::post('knockup',[\App\Http\Controllers\Controller::class,'knockup']);
Route::post('shutdown',[\App\Http\Controllers\Controller::class,'shutdown']);
Route::post('dmg',[\App\Http\Controllers\Controller::class,'dmg']);
