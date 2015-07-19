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
Route::get('/auth/login', function () {
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
    //Group controller
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
        'uses' => 'GroupController@showGroup'
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
        'uses' => 'VehicleController@addGroup'
    ));
    Route::get('/vehicle/remove-group/{id}', array(
        'as' => 'remove-group',
        'uses' => 'VehicleController@removeGroup'
    ));
    //Invoices Controller
    Route::get('/invoice', array(
        'as' => 'invoice',
        'uses' => 'InvoiceController@index'
    ));
    Route::get('/invoice/add-group-invoice', array(
        'as' => 'add-group-invoice',
        'uses' => 'InvoiceController@createGroupInvoice'
    ));
    Route::post('/post/add-group-invoice', array(
        'as' => 'add-group-invoice',
        'uses' => 'InvoiceController@storeGroupInvoice'
    ));
    Route::get('/invoice/add-vehicle-invoice', array(
        'as' => 'add-vehicle-invoice',
        'uses' => 'InvoiceController@createVehicleInvoice'
    ));
    Route::post('/post/add-vehicle-invoice', array(
        'as' => 'add-vehicle-invoice',
        'uses' => 'InvoiceController@storeVehicleInvoice'
    ));
    Route::get('/invoice/get-group-invoice/{id}', array(
        'as' => 'get-invoice',
        'uses' => 'InvoiceController@getInvoice'
    ));
    Route::get('/invoice/get-individual-invoice/{id}', array(
        'as' => 'get-invoice',
        'uses' => 'InvoiceController@getInvoice'
    ));
    Route::get('/invoice/get-individual-invoice/{id}', array(
        'as' => 'get-invoice',
        'uses' => 'InvoiceController@getInvoice'
    ));
    Route::get('/invoice/view-cert/{id}', array(
        'as' => 'view-cert',
        'uses' => 'InvoiceController@viewCert'
    ));
    Route::get('/invoice/print-cert/{id}', array(
        'as' => 'print-cert',
        'uses' => 'InvoiceController@printCert'
    ));
    Route::get('/invoice/view-cert/{id}', array(
        'as' => 'view-cert',
        'uses' => 'InvoiceController@viewCert'
    ));
    Route::get('/invoice/view-invoices', array(
        'as' => 'view-invoices',
        'uses' => 'InvoiceController@show'
    ));
    Route::get('invoice/delete-invoice/{id}', array(
        'as' => 'delete-invoice',
        'uses' => 'InvoiceController@delete'
    ));
    Route::get('/invoice/group-autocomplete', array(
        'as' => 'group-autocomplete',
        'uses' => 'InvoiceController@getGroupDetails'
    ));
    Route::get('/invoice/vehicle-autocomplete', array(
        'as' => 'vehicle-autocomplete',
        'uses' => 'InvoiceController@getVehicleDetails'
    ));
    //Invoice approval routes
    Route::get('/invoice/approve/{id}', array(
        'as' => 'approval',
        'uses' => 'InvoiceController@approve'
    ));
    Route::post('/post/finance-approve', array(
        'as' => 'finance-approval',
        'uses' => 'InvoiceController@financeApproval'
    ));
    Route::post('/post/manager-approve', array(
        'as' => 'managerial-approval',
        'uses' => 'InvoiceController@managerApproval'
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
    Route::get('/admin/manage-user/{id}', array(
        'as' => '/manage-user',
        'uses' => 'AdminController@viewPrivileges'
    ));
    Route::get('/admin/view-deleted-users', array(
        'as' => '/view-deleted-users',
        'uses' => 'AdminController@viewDeletedUsers'
    ));
    Route::get('/admin/view-users', array(
        'as' => '/view-users',
        'uses' => 'AdminController@show'
    ));
    Route::get('/admin/edit-user/{id}', array(
        'as' => '/edit-user',
        'uses' => 'AdminController@edit'
    ));
    Route::post('/post/add-user', array(
        'as' => 'add-user',
        'uses' => 'AdminController@store'
    ));
    Route::post('/post/edit-user', array(
        'as' => 'edit-user',
        'uses' => 'AdminController@update'
    ));
    Route::get('/admin/restore-user/{id}', array(
        'as' => '/restore-user',
        'uses' => 'AdminController@restoreDeletedUser'
    ));
});
