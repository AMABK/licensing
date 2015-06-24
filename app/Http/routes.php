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
Route::get('/home', array(
    'as' => 'home',
    'uses' => 'HomeController@index'
));
// Authentication routes...
Route::get('/auth/login', array(
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
));
Route::post('/auth/login', array(
    'as' => 'login',
    'uses' => 'Auth\AuthController@postLogin'
));
Route::get('/auth/logout', array(
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout'
));
// Registration routes...
Route::get('/auth/register', array(
    'as' => 'register',
    'uses' => 'Auth\AuthController@getRegister'
));
Route::post('/auth/register', array(
    'as' => 'register',
    'uses' => 'Auth\AuthController@postLogout'
));