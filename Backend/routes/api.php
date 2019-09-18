<?php

use App\Http\Registry\AppRegistry;
use App\Http\Resources\User\AllowedLangsResource;
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
Route::group(['middleware' => ['lang']], function () {
    Route::post('/register/', 'User\UserController@register');
    Route::post('/registerConfirmation/', 'User\UserController@registerConfirmation');
    Route::post('/login/',      'User\UserController@login');
    Route::post('/forgot/',    'User\UserController@forgotPassword');
    Route::post('/resetPassword/',    'User\UserController@resetPassword');
    Route::get('/getUserData/', 'User\UserController@getUserData')->middleware('auth:api');
    Route::post('/putLang/',    'User\UserController@putLang')->middleware('auth:api');
    Route::post('/saveSettings/',    'User\UserController@saveSettings')->middleware('auth:api');
    Route::post('/changePassword/', 'User\UserController@changePassword')->middleware('auth:api');
    Route::get('/allowedLangs/', function (){return new AllowedLangsResource(['langs' => AppRegistry::get('lang')]);});
});

Route::any('/', function () {
    return 'skill-tracking.api';
});