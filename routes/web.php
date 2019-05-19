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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
Route::get('/createCustomer', 'PaymentsController@createCustomer');
Route::get('/saveCard', 'PaymentsController@saveCard');
Route::get('/getSavedCard', 'PaymentsController@getSavedCard');
Route::get('/getPaymentToken', 'PaymentsController@getPaymentToken');
Route::get('/deleteCard', 'PaymentsController@deleteCard');
