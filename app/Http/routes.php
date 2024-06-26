<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Home Route
Route::get('/home','HomeController@index');

//Auth Routes

Route::get('/', 'Auth\AuthController@getLogin');
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
//Route::get('/auth/register','Auth\AuthController@getRegister');
//Route::post('/auth/register','Auth\AuthController@postRegister');

//client Routes
Route::get('/client/ajax_search','ClientsController@ajaxSearch');
Route::get('/client/{id}/delete','ClientsController@destroy');
Route::post('/client/search','ClientsController@search');
Route::get('/client/search','ClientsController@search');
Route::resource('/client','ClientsController');


////representative Routes
//Route::get('/representative/{id}/delete','RepresentativesController@destroy');
//Route::post('/representative/search','RepresentativesController@search');
//Route::get('/representative/search','RepresentativesController@index');
//Route::resource('/representative','RepresentativesController');

//item Routes
Route::get('/item/{id}/delete','ItemController@destroy');
Route::post('/item/search','ItemController@search');
Route::get('/item/search','ItemController@search');
Route::get('/item/ajax_search','ItemController@ajaxSearch');
Route::get('/item/search_by_id','ItemController@search_by_id');
Route::resource('/item','ItemController');
//model type Routes
Route::get('/model-type/{id}/delete','ModelTypeController@destroy');
Route::post('/model-type/search','ModelTypeController@search');
Route::get('/model-type/search','ModelTypeController@search');
Route::get('/model-type/ajax_search','ModelTypeController@ajaxSearch');
Route::get('/model-type/search_by_id','ModelTypeController@search_by_id');
Route::resource('/model-type','ModelTypeController');
//invoice Routes
Route::get('/invoice/{id}/delete','InvoiceController@destroy');
Route::post('/invoice/search','InvoiceController@search');
Route::get('/invoice/search','InvoiceController@search');
Route::post('/invoice/report','InvoiceController@getTotalFromDateToDate');
Route::get('/invoice/report','InvoiceController@getTotalFromDateToDateForm');
Route::resource('/invoice','InvoiceController');

//Employee Routes
Route::get('/employee/{id}/delete','EmployeeController@destroy');
Route::get('/employee/search','EmployeeController@search');
Route::get('/employee/report','EmployeeController@getReport');
Route::post('/employee/report','EmployeeController@getReport');
Route::post('/employee/search','EmployeeController@search');
Route::resource('/employee','EmployeeController');