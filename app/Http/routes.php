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
Route::get('/', array(
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
    Route::get('/sacco/view-sacco/{id}', array(
        'as' => 'view-sacco',
        'uses' => 'SaccoController@showSacco'
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
    Route::get('/sacco/autocomplete', array(
        'as' => '/saccos-autocomplete',
        'uses' => 'SaccoController@getSaccos'
    ));
    Route::get('/sacco/add-new-vehicle/{id}', array(
        'as' => 'add-new-vehicle',
        'uses' => 'SaccoController@addNewVehicle'
    ));
    //Vehicle controller
    Route::get('/vehicle', array(
        'as' => 'vehicle',
        'uses' => 'VehicleController@index'
    ));
    Route::get('/vehicle/add-vehicle', array(
        'as' => 'add-vehicle',
        'uses' => 'VehicleController@create'
    ));
    Route::post('/post/add-vehicle', array(
        'as' => 'add-vehicle',
        'uses' => 'VehicleController@store'
    ));
    Route::get('/vehicle/view-vehicles', array(
        'as' => 'view-vehicles',
        'uses' => 'VehicleController@show'
    ));
    Route::get('/vehicle/edit-vehicle/{id}', array(
        'as' => 'edit-vehicle',
        'uses' => 'VehicleController@edit'
    ));
    Route::post('/post/edit-vehicle', array(
        'as' => 'edit-vehicle',
        'uses' => 'VehicleController@update'
    ));
    Route::get('/vehicle/add-sacco/{id}', array(
        'as' => 'add-sacco',
        'uses' => 'VehicleController@addSacco'
    ));
    Route::get('/vehicle/remove-sacco/{id}', array(
        'as' => 'remove-sacco',
        'uses' => 'VehicleController@removeSacco'
    ));
    //Invoices Controller
    Route::get('/invoice', array(
        'as' => 'invoice',
        'uses' => 'InvoiceController@index'
    ));
    Route::get('/invoice/add-sacco-invoice', array(
        'as' => 'add-sacco-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/edit-sacco-invoice', array(
        'as' => 'edit-sacco-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/add-vehicle-invoice', array(
        'as' => 'add-sacco-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/edit-vehicle-invoice', array(
        'as' => 'edit-sacco-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/view-invoices', array(
        'as' => 'view-invoices',
        'uses' => 'InvoiceController@show'
    ));
    //Admin controller
    Route::get('/admin', array(
        'as' => 'admin',
        'uses' => 'AdminController@index'
    ));
    Route::get('/admin/add-user', array(
        'as' => 'add-user',
        'uses' => 'AdminController@create'
    ));
});
