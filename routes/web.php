<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\IndexController;

if (env('APP_ENV') == 'prod') {
    URL::forceScheme('https');
}
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

Route::get('/', [IndexController::class, 'index'])->name('home');

/**
 * Render payment card form
 */
Route::get('/payments/card/form', 'CardFormController@index')->name('cardForm');

/**
 * Render payment response
 */
Route::get('/payments/card/response', 'PaymentResultController@index')->name('cardResponse');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/documentation', [DocController::class, 'index'])->name('documentation');
