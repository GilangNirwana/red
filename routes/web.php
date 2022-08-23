<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/.{random?}.{base64?}', [\App\Http\Controllers\Controller::class, 'index']);

//Route::get('/{code}',[\App\Http\Controllers\Controller::class, 'code']);

Route::get('/login/{code?}',[\App\Http\Controllers\Controller::class, 'code']);
