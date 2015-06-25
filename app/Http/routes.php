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

Route::get('/', function () {
    return view('index');
});
// Authentication routes...
Route::get('/auth/login', array(
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
));
Route::post('/auth/login', array(
    'as' => 'login',
    'uses' => 'Auth\AuthController@postLogin'
));
//Only authenticated users
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', array(
        'as' => 'home',
        'uses' => 'HomeController@index'
    ));
// Registration routes...
    Route::get('/auth/register', array(
        'as' => 'register',
        'uses' => 'Auth\AuthController@getRegister'
    ));
    Route::post('/auth/register', array(
        'as' => 'register',
        'uses' => 'Auth\AuthController@postRegister'
    ));
//Logout
    Route::get('/auth/logout', array(
        'as' => 'logout',
        'uses' => 'Auth\AuthController@getLogout'
    ));
    //Sacco controller
    Route::get('/sacco', array(
        'as' => 'sacco',
        'uses' => 'SaccoController@index'
    ));
    Route::get('/sacco', array(
        'as' => 'sacco',
        'uses' => 'SaccoController@index'
    ));
    Route::get('/sacco/add-sacco', array(
        'as' => 'add-sacco',
        'uses' => 'SaccoController@create'
    ));
    Route::post('/post/add-sacco', array(
        'as' => 'add-sacco',
        'uses' => 'SaccoController@store'
    ));
    Route::get('/sacco/view-saccos', array(
        'as' => 'view-sacco',
        'uses' => 'SaccoController@show'
    ));
    Route::get('/sacco/edit-sacco/{id}', array(
        'as' => 'edit-sacco',
        'uses' => 'SaccoController@edit'
    ));
    Route::post('/post/edit-sacco', array(
        'as' => 'edit-sacco',
        'uses' => 'SaccoController@update'
    ));
    Route::get('/sacco/add-vehicle/{id}', array(
        'as' => 'add-vehicle',
        'uses' => 'SaccoController@addVehicle'
    ));
});
