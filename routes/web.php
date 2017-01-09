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
use \Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/sendmail', function () {
    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('email.welcome', $data, function ($message) {

        $message->from('cesar@tineo.mobi', 'Learning Laravel');

        $message->to('itsudatte01@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";
});

//Auth::routes();

Route::get('/home', 'HomeController@index');

//Auth::routes();


Route::resource('dashboard', 'DashController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);


Route::get('dashboard/pickup/{hash}', ['uses' => 'DashController@pickup', 'as' => 'dashboard.pickup']);
//Route::get('dashboard', 'DashController@pickup');


Route::resource('users', 'UsersController', ['only' => [
    'index', 'show'
]]);


Route::get('visitas/me', ['uses' => 'VisitasController@me', 'as' => 'visitas.me']);
Route::resource('visitas', 'VisitasController', ['only' => [
    'index', 'show', 'me'
]]);


/*Route::resource('users', 'UsersController', ['except' => [
    'create', 'store', 'update', 'destroy', 'edit'
]]);*/


Auth::routes();