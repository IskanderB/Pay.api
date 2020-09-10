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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/payments/card/form', 'CardFormController@index')->name('cardForm');
Route::get('/payments/card/response', 'PaymentResultController@index')->name('cardResponse');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
