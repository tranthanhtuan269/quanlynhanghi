<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'RoomController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@countServiceSellInDay')->name('test');
Route::resource('hotel', 'HotelController');
Route::post('addorder', 'RoomController@addOrder');
Route::post('editorder', 'RoomController@editOrder');
Route::post('payorder', 'RoomController@payOrder');
Route::get('getroominfo', 'RoomController@getroominfo');
Route::resource('room', 'RoomController');
Route::get('getroomtypeinfo', 'RoomTypeController@getRoomTypeInfo');
Route::resource('roomtype', 'RoomTypeController');
Route::get('getserviceinfo', 'ServiceController@getServiceInfo');
Route::resource('service', 'ServiceController');
Route::resource('order', 'OrderController');
Route::get('/home', 'HomeController@index')->name('home');

   	
Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
	Route::get('admin', 'Admin\AdminController@index');
	Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
	Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
	Route::resource('admin/roles', 'Admin\RolesController');
	Route::resource('admin/permissions', 'Admin\PermissionsController');
	Route::resource('admin/users', 'Admin\UsersController');
	Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
	Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});