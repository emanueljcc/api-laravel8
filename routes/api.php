<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
  'namespace' => 'App\Http\Controllers',
  'middleware' => ['cors', 'json.response']
], function () {
  // public routes
  Route::post('/login', 'Auth\AuthController@login')->name('login.api');
  Route::post('/register', 'Auth\AuthController@register')->name('register.api');
});

// protected routes
Route::middleware('auth:api')->group(function () {
  Route::post('/logout', 'App\Http\Controllers\Auth\AuthController@logout')->name('logout.api');

  Route::prefix('users')->group(function () {
    Route::get('/', 'App\Http\Controllers\UserController@index')->middleware('api.admin')->name('users.index');
    Route::get('/find', 'App\Http\Controllers\UserController@find')->middleware('api.admin')->name('users.find');
  });

  Route::prefix('hotels')->group(function () {
    Route::get('/', 'App\Http\Controllers\HotelController@index')->middleware('api.admin')->name('hotels.index');
    Route::get('/{id}', 'App\Http\Controllers\HotelController@find')->middleware('api.admin')->name('hotels.find');
    Route::post('/', 'App\Http\Controllers\HotelController@store')->middleware('api.admin')->name('hotels.store');
    Route::delete('/{id}', 'App\Http\Controllers\HotelController@remove')->middleware('api.admin')->name('hotels.remove');
  });

  Route::prefix('rooms')->group(function () {
    Route::get('/', 'App\Http\Controllers\RoomController@index')->middleware('api.admin')->name('rooms.index');
    Route::get('/{id}', 'App\Http\Controllers\RoomController@find')->middleware('api.admin')->name('rooms.find');
    Route::post('/', 'App\Http\Controllers\RoomController@store')->middleware('api.admin')->name('rooms.store');
    Route::delete('/{id}', 'App\Http\Controllers\RoomController@remove')->middleware('api.admin')->name('rooms.remove');
  });

  Route::prefix('user-room')->group(function () {
    Route::post('/', 'App\Http\Controllers\UserRoomController@store')->name('userRoom.store');
  });
});
