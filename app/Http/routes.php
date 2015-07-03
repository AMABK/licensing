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
    Route::get('/group', array(
        'as' => 'group',
        'uses' => 'GroupController@index'
    ));
    Route::get('/group', array(
        'as' => 'group',
        'uses' => 'GroupController@index'
    ));
    Route::get('/group/add-group', array(
        'as' => 'add-group',
        'uses' => 'GroupController@create'
    ));
    Route::post('/post/add-group', array(
        'as' => 'add-group',
        'uses' => 'GroupController@store'
    ));
    Route::get('/group/view-groups', array(
        'as' => 'view-group',
        'uses' => 'GroupController@show'
    ));
    Route::get('/group/view-group/{id}', array(
        'as' => 'view-group',
        'uses' => 'GroupController@showSacco'
    ));
    Route::get('/group/edit-group/{id}', array(
        'as' => 'edit-group',
        'uses' => 'GroupController@edit'
    ));
    Route::post('/post/edit-group', array(
        'as' => 'edit-group',
        'uses' => 'GroupController@update'
    ));
    Route::get('/group/add-vehicle/{id}', array(
        'as' => 'add-vehicle',
        'uses' => 'GroupController@addVehicle'
    ));
    Route::get('/group/autocomplete', array(
        'as' => '/groups-autocomplete',
        'uses' => 'GroupController@getGroups'
    ));
    Route::get('/group/add-new-vehicle/{id}', array(
        'as' => 'add-new-vehicle',
        'uses' => 'GroupController@addNewVehicle'
    ));
    //Company controller
    Route::get('/company', array(
        'as' => 'company',
        'uses' => 'GroupController@index'
    ));
    Route::get('/company/add-company', array(
        'as' => 'add-company',
        'uses' => 'GroupController@create'
    ));
    Route::post('/post/add-company', array(
        'as' => 'add-company',
        'uses' => 'GroupController@store'
    ));
    Route::get('/company/view-companies', array(
        'as' => 'view-companies',
        'uses' => 'GroupController@show'
    ));
    Route::get('/company/view-company/{id}', array(
        'as' => 'view-company',
        'uses' => 'GroupController@showCompany'
    ));
    Route::get('/company/edit-company/{id}', array(
        'as' => 'edit-company',
        'uses' => 'GroupController@edit'
    ));
    Route::post('/post/edit-company', array(
        'as' => 'edit-company',
        'uses' => 'GroupController@update'
    ));
    Route::get('/company/add-vehicle/{id}', array(
        'as' => 'add-vehicle',
        'uses' => 'GroupController@addVehicle'
    ));
    Route::get('/company/autocomplete', array(
        'as' => '/company-autocomplete',
        'uses' => 'GroupController@getSaccos'
    ));
    Route::get('/company/add-new-vehicle/{id}', array(
        'as' => 'add-new-vehicle',
        'uses' => 'GroupController@addNewVehicle'
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
    Route::get('/vehicle/add-group/{id}', array(
        'as' => 'add-group',
        'uses' => 'VehicleController@addSacco'
    ));
    Route::get('/vehicle/remove-group/{id}', array(
        'as' => 'remove-group',
        'uses' => 'VehicleController@removeSacco'
    ));
    //Invoices Controller
    Route::get('/invoice', array(
        'as' => 'invoice',
        'uses' => 'InvoiceController@index'
    ));
    Route::get('/invoice/add-group-invoice', array(
        'as' => 'add-group-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/edit-group-invoice', array(
        'as' => 'edit-group-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/add-vehicle-invoice', array(
        'as' => 'add-group-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/edit-vehicle-invoice', array(
        'as' => 'edit-group-invoice',
        'uses' => 'InvoiceController@create'
    ));
    Route::get('/invoice/view-invoices', array(
        'as' => 'view-invoices',
        'uses' => 'InvoiceController@show'
    ));
    Route::get('/invoice/sacco-autocomplete', array(
        'as' => 'sacco-autocomplete',
        'uses' => 'InvoiceController@getGroupDetails'
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
