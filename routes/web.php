<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');


Auth::routes();
Route::resource('dashboard', 'DashController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show', 'pickup']]);
Route::get('dashboard/pickup/{hash}', ['uses' => 'DashController@pickup', 'as' => 'dashboard.pickup']);
//Route::get('dashboard', 'DashController@pickup');


Auth::routes();