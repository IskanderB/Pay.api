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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/**
 * Add payment session
 */
Route::post('/v1/register', 'PaymentController@register')->name('register');
/**
 * Add payment
 */
Route::post('/v1/payments/operation', 'PaymentController@create')->name('operation');
/**
 * Get payments
 */
Route::get('/v1/payments', 'PaymentController@getAll')->name('payments');
