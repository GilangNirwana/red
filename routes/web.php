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

Route::get('/', [\App\Http\Controllers\Controller::class, 'index_red']);
Route::post('/', [\App\Http\Controllers\Controller::class, 'index2'])->name("dontneed");

//Route::get('/{code}',[\App\Http\Controllers\Controller::class, 'code']);

Route::get('/login/{code?}',[\App\Http\Controllers\Controller::class, 'code']);
