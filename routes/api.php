<?php

use Illuminate\Http\Request;

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

Route::resource('company', 'CompanyController');

Route::resource('journal', 'JournalController');

Route::get('journal/bycompany/{company}', 'JournalController@indexCompany');

Route::resource('account', 'AccountController');
Route::post('account/search', 'AccountController@search');
