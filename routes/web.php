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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('order')->group(function () {
    Route::get('/', 'OrderController@index')->name('order-list');
    Route::get('/{id}/show', 'OrderController@show')->name('order-show');
    Route::get('/form', 'OrderController@form')->name('form-order');
    Route::post('/form', 'OrderController@store')->name('form-order-store');
});
