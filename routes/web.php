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

Auth::routes();

Route::get('/register', function ()  { return redirect('/home');});
Route::post('/register', function () { return redirect('/home');});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'  => 'admin:admin'],function(){

    //Companies
    Route::get('companies' , 'CompanyController@index');
    Route::get('company/{id}' , 'CompanyController@show');

    Route::get('createcompany' , 'CompanyController@create');
    Route::post('createcompany' , 'CompanyController@store');

    Route::get('company/update/{id}' , 'CompanyController@edit');
    Route::post('company/update/{id}' , 'CompanyController@update');

    Route::get('/company/{id}/destroy', 'CompanyController@destroy');

//Employee
    Route::get('employees' , 'EmployeeController@index');

    Route::get('addemployee' , 'EmployeeController@create');
    Route::post('addemployee' , 'EmployeeController@store');

    Route::get('employee/update/{id}' , 'EmployeeController@edit');
    Route::post('employee/update/{id}' , 'EmployeeController@update');

    Route::get('/employee/{id}/destroy', 'EmployeeController@destroy');

});

