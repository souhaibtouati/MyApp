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
Route::get('/pwd-reset/{id}/{code}', 'LogRegController@PassResetIndex');
Route::post('/pwd-reset', 'LogRegController@NewPassRequest');
Route::post('/pwd-reset/update/{id}/{code}', 'LogRegController@PassResetUpdate');

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

Route::get('/mailtest', function(){
	
	return View::make('emails.reminder', ['id'=>'1','code'=>'fg4s53g41sf31g53q51']);
});
Route::get('/offertest', function(){
	$test = '{ 
	"project":"B2751P02", 
	"qty":75, 
	"delivery":7,
	"attachment" :"B2751P02-PCB_Price Offer_DATA-24-3-2017.zip",
	"width":123,
	"height":145,
	"thickness":1.55,
	"layers":4,
	"out_copper":35,
	"in_copper":35,
	"top_silk":"yellow",
	"bottom_silk":"no",
	"solder_mask":"green",
	"pcb_core":"ISL2450",
	"surface":"Chem. Au",
	"min_track":0.3,
	"min_clearance":0.3,
	"impedance":"0",
	"smallest_hole":0.4,
	"biggest_hole":5.0,
	"diff_hole_count":15,
	"blind_via":0,
	"burried_via":0,
	"board_outline":"Milled",
	"laser_drill":"0",
	"elec_test":"0", 
	"visual_inspect":"0",
	"aspect_ratio":2.52,
	"pcb_type":"rigid"
	

}';
$json = json_decode($test);
$data = ['type'=>'Quotation', 'user'=>'souhaib.touati@yamaichi.de', 'manufacturer'=>'Test Manufacturer'];	
	return View::make('Test.offerMail', ['json'=>$json, 'data'=>$data]);
});