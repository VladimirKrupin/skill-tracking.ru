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

Route::get('/test/', 'TestController@index');

Route::post('/register/', 'User\UserController@register')->middleware('lang');
Route::post('/login/',      'User\UserController@login')->middleware('lang');
Route::get('/getUserData/', 'User\UserController@getUserData')->middleware('auth:api');
Route::post('/putLang/',    'User\UserController@putLang')->middleware('auth:api');

Route::any('/', function () {
    return 'skill-tracking.api';
});