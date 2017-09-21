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