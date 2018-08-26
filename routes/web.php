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

Route::get('/provider', 'ProviderController@index');
Route::get('/provider/create', 'ProviderController@create');
Route::get('/provider/{type}', 'ProviderController@store');

Route::get('/lab/create/{type}', 'LabController@create');
Route::post('/lab', 'LabController@store');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
