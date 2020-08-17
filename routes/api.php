<?php

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

Route::post('/users', 'UserController@create');

Route::get('/users/{id}/transactions', 'TransactionController@index');

Route::get('/transactions', 'TransactionController@index');

Route::post('/transactions', 'TransactionController@create');