<?php

use Illuminate\Http\Request;
use App\Company;
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

Route::get('/', function () {
    $company = Company::first();
    $branch  = $company->Branches;
    $currency  = $company->Currencies;
    return $currency[0]->id;
});

Route::group(['middleware' => ['auth:api', 'role:admin|super-admin|employee']], function () {

    Route::resource('company', 'CompanyController');
    Route::get('company/{company}/categories', 'CompanyController@categories');
    Route::get('company/{company}/allcategories', 'CompanyController@allCategories');
    Route::get('company/{company}/products', 'CompanyController@products');

    Route::post('company/clients', 'CompanyController@clients');

    Route::resource('journal', 'JournalController');
    Route::post('journal/{journal}/update', 'JournalController@update');

    Route::get('journal/bycompany/{company}', 'JournalController@indexCompany');
    Route::get('ledger/bycompany/{company}', 'LedgerController@indexCompany');
    Route::post('ledger/search', 'LedgerController@search');


    Route::get('journal/media/{media}', 'JournalController@openFile');
    Route::delete('journal/media/{media}', 'JournalController@deleteFile');


    Route::resource('account', 'AccountController');
    Route::post('account/search', 'AccountController@search');

    Route::resource('receipt', 'ReceiptController');
    Route::resource('client', 'ClientController');
    Route::resource('product', 'ProductController');
    Route::post('product/{product}/update', 'ProductController@update');

    Route::resource('category', 'CategoryController');
    Route::get('test/upload', 'CostControlController@test');


    ////EKafel


    Route::any('auth/login', 'AuthController@login');
    Route::any('auth/logout', 'AuthController@logout');

    //Employees
    Route::any('employee/store', 'EmployeesController@store');
    Route::any('company/{company}/employees/all', 'EmployeesController@getAll');
    Route::any('company/{company}/employees/trash', 'EmployeesController@trash');
    Route::any('employees/{employee}/increment/iqama', 'EmployeesController@incrementIqama');
    Route::any('employees/{employee}', 'EmployeesController@get');
    Route::any('employees/{employee}/update', 'EmployeesController@update');
    Route::any('employee/{employee}/softdelete', 'EmployeesController@softDelete');
    Route::any('employee/{employee}/removefromproject/{project}', 'EmployeesController@removeFromProject');
    Route::any('employee/import', 'EmployeesController@importFromCSVFile');

    // Section
    Route::resource('section', 'SectionController');
    Route::get('company/{company}/section', 'SectionController@companySection');

    //holidays type
    Route::resource('holiday-type', 'HolidayTypeController');
    Route::resource('holiday', 'HolidayController');

    //contacts
    // Route::get('contact/{company}', 'ContactController@index');
    Route::resource('contact', 'ContactController');

    //letters
    Route::get('letter/{company}', 'LetterController@index');
    Route::resource('letter', 'LetterController');

    //Company
    Route::any('company/store', 'CompanyController@store');
    Route::any('company/{company}/update', 'CompanyController@update');
    Route::any('company/all', 'CompanyController@index');
    Route::any('company/{company}/delete', 'CompanyController@delete');
    Route::any('company/{company}', 'CompanyController@get');

    //Projects
    Route::any('company/{company}/project/store', 'ProjectsController@store');
    Route::any('project/{project}/update', 'ProjectsController@update');
    Route::any('company/{company}/project/all', 'ProjectsController@all');
    Route::any('project/{project}/delete', 'ProjectsController@delete');
    Route::any('project/{project}', 'ProjectsController@get');
    Route::any('company/{company}/projects/', 'ProjectsController@getProjectsOfCompany');


});


Route::post('auth/register', 'passportController@register');
Route::post('auth/login', 'passportController@login');