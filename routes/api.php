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
Route::post('journal/{journal}/update', 'JournalController@update');

Route::get('journal/bycompany/{company}', 'JournalController@indexCompany');
Route::get('ledger/bycompany/{company}', 'LedgerController@indexCompany');
Route::post('ledger/search', 'LedgerController@search');


Route::get('journal/media/{media}', 'JournalController@openFile');
Route::delete('journal/media/{media}', 'JournalController@deleteFile');


Route::resource('account', 'AccountController');
Route::post('account/search', 'AccountController@search');

Route::post('test/upload', 'CostControlController@test');


