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

/**
 * @todo convert this to create/store actions
 */
Route::post('/web-application', 'WebApplicationController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
