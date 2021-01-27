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

  Route::get('/users', 'App\Http\Controllers\UserController@index')->middleware('api.admin')->name('users.index');
  Route::get('/users/find', 'App\Http\Controllers\UserController@find')->middleware('api.admin')->name('users.find');
});
