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


// Authentication routes...
Route::get('login', 'LogRegController@AuthenticationIndex');
Route::post('login', 'LogRegController@LoginPost')->name('authenticate');
Route::get('logout', 'LogRegController@logout');


// Registration routes...

Route::get('register', 'LogRegController@AuthenticationIndex');
Route::post('register', 'LogRegController@RegisterPost')->name('register');

// Password Reset...
Route::get('pwd-reset', 'LogRegController@PassResetIndex');
Route::post('pwd-reset', 'LogRegController@NewPassRequest');
Route::put('pwd-reset', 'LogRegController@PassResetUpdate');

// Application Landing route...
Route::get('/', 'LogRegController@rootshow');

// Admin Routes...
Route::get('admin', 'AdminController@home');
Route::get('users-collection', 'AdminController@UsersIndex');
Route::delete('/permissions/role/delete/{roleId}', 'AdminController@deleteRole');
// Permissions
Route::get('/permissions', 'PermissionController@PermissionIndex');
Route::post('/permissions', 'PermissionController@PermissionCreate');
Route::post('/permissions/addrole', 'PermissionController@RoleCreate');
Route::post('/permissions/{roleid}/{permission}/remove', 'PermissionController@PermissionRoleRemove');
Route::delete('/permissions/{PermissionId}/destroy', 'PermissionController@deletePermission');
Route::put('permissions/role/edit/{roleId}', 'PermissionController@RolePermissionsUpdate');


// Not Admin Routes...
Route::get('home', 'PagesController@homeIndex')->name('home');
Route::get('dashboard', 'PagesController@dashboardIndex')->name('dashboard');
Route::get('altiumCmp', 'PagesController@altiumCmpIndex')->name('altium');
Route::get('myprofile', 'PagesController@myprofileIndex')->name('myprofile');
Route::post('/myprofile/update', 'PagesController@profileUpdate')->name('profile.update');

//users control
Route::resource('/user', 'UserController');
Route::get('/user/{user}/activate', 'UserController@activate');

//Error pages...
Route::get('403', function(){
	return view('errors.403');
});

Route::get('503', function(){
	return view('errors.503');
});

//Altium Routes

Route::get('Altium/{type}', 'AltiumController@ShowCategory');
Route::post('Altium/{type}/ShowAll', 'AltiumController@ShowAll');

Route::post('Altium/{type}/{table}/create', 'AltiumController@CreateNew');
Route::post('Altium/{type}/store', 'AltiumController@store');

Route::post('Altium/{type}/search', 'AltiumController@Search');

Route::get('Altium/{type}/{table}/{id}/edit', 'AltiumController@edit');
Route::post('Altium/{type}/{table}/{id}/update', 'AltiumController@update');
Route::post('Altium/delete', 'AltiumController@destroy');
Route::get('Altium/{type}/{table}/{id}/view', 'AltiumController@PartIndex');
Route::post('Altium/{type}/getRefs', 'AltiumController@populateRefs');
Route::get('Altium/{type}/getsvn', 'AltiumController@getSVNinfos');
Route::get('altcom', 'AltiumController@Test');



//Projects

Route::group(['prefix' => 'yproject'], function(){
	Route::get('/show/{group}','ProjectsController@ProjectsIndex');
	Route::get('/{id}/view', 'ProjectsController@ViewProject');
	Route::get('/myprojects', 'ProjectsController@MyProjects');
	Route::get('/{id}/edit', 'ProjectsController@EditProject');
	Route::get('/{id}/view','ProjectsController@ViewProject');
	Route::post('/save', 'ProjectsController@Store');
	Route::post('/newrev', 'ProjectsController@NewRevision');
	Route::delete('/{id}/delete', 'ProjectsController@DeleteProject');
	Route::get('/manufacturers', 'ProjectsController@manuf');
	Route::get('/orders', 'ProjectsController@orders');
	Route::post('/new_manuf', 'ProjectsController@manufStore');
	Route::post('/processorder', 'ProjectsController@processorder');
	Route::post('/cancelorder', 'ProjectsController@cancelorder');

});

//orders

Route::group(['prefix' => 'yproject/order'], function(){
	Route::post('/{id}/quotation', 'OrdersController@quotation');
	Route::post('/{id}/offer', 'OrdersController@offer');
	Route::post('/{id}/approve', 'OrdersController@approve');
	Route::post('/{id}/order', 'OrdersController@order');
	Route::post('/{id}/delivery', 'OrdersController@delivery');
	Route::post('/{id}/cancel', 'OrdersController@cancel');

});


//Settings

Route::get('Settings/Altium/SVN', 'PagesController@SVNSettingsIndex');
Route::post('Settings/Altium/SVN/update', 'PagesController@SVNSettingsUpdate');