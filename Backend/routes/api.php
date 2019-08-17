<?php

use Illuminate\Http\Request;

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

//USER CONTROLLER REQUESTS
Route::get('/testProtected/', 'TestController@index')->middleware('auth:api');
Route::get('/test/', 'TestController@index');
Route::get('/login/', 'User\UserController@login');