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
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/functions', 'HomeController@functions');
Route::resource('hotel', 'HotelController');
Route::post('addorder', 'RoomController@addOrder');
Route::post('editorder', 'RoomController@editOrder');
Route::post('payorder', 'RoomController@payOrder');
Route::get('getroominfo', 'RoomController@getroominfo');
Route::get('getroomtypeinfo', 'RoomTypeController@getRoomTypeInfo');
Route::get('getserviceinfo', 'ServiceController@getServiceInfo');
Route::get('getdetailbydate', 'OrderController@getDetailByDate');

Route::get('/user/{id}/postImages', function () {
    return view('user.images');
});

Route::get('/user/{id}', function () {
    return view('user.edit');
});

Route::get('/user/{id}/settings', function () {
    return view('user.settings');
});

Route::post('/user/{id}', 'HomeController@updateInfo');
Route::post('/user/{id}/settings', 'HomeController@updateSetting');
Route::post('/user/postImages/{id}', 'HomeController@postImages');

Route::get('/getDistrict/{id}', 'HomeController@getDistrict');
Route::get('/getTown/{id}', 'HomeController@getTown');
Route::post('ajaxpro', 'HomeController@ajaxpro');

Route::resource('room', 'RoomController');
Route::resource('roomtype', 'RoomTypeController');
Route::resource('service', 'ServiceController');
Route::resource('order', 'OrderController');

Route::get('/home', 'HomeController@index')->name('home');

   	
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
	Route::get('admin', 'Admin\AdminController@index');
	Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
	Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
	Route::resource('admin/roles', 'Admin\RolesController');
	Route::resource('admin/permissions', 'Admin\PermissionsController');
	Route::resource('admin/users', 'Admin\UsersController');
	Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
	Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});