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
Route::post('/testProtectedCollection/', 'TestController@index')->middleware('auth:api');
Route::post('/testProtected/', 'TestController@index')->middleware('auth:api');
Route::post('/createUser/', 'User\UserController@create');

Route::get('/test/', 'TestController@index');
Route::post('/login/', 'User\UserController@login');

Route::any('/', function () {
    return 'skill-tracking.api';
});