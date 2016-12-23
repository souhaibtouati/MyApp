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
Route::delete('Altium/{type}/{table}/{id}/delete', 'AltiumController@destroy');
Route::get('Altium/{type}/{table}/{id}/view', 'AltiumController@PartIndex');
Route::post('Altium/{type}/getRefs', 'AltiumController@populateRefs');

Route::get('altcom', 'AltiumController@Test');



//Projects

Route::group(['prefix' => 'yproject'], function(){
	Route::get('/{group}','ProjectsController@ProjectsIndex');

});


//Settings

Route::get('Settings/Altium/SVN', 'UserController@SVNSettingsIndex');
Route::post('Settings/Altium/SVN/update', 'UserController@SVNSettingsUpdate');