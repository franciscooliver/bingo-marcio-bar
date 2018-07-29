<?php

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

use App\Http\Controllers\BingoController;

Route::get('/', 'BingoController@index')->name('index');
//Route::post("/verificaganhador","BingoController@verificaGanhador");
Route::post("/salvarJogo","BingoController@salvarJogo");

