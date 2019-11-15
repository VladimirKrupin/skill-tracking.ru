<?php

use App\Http\Registry\AppRegistry;
use App\Http\Resources\Skills\SkillsResource;
use App\Http\Resources\User\AllowedLangsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    //user
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
    Route::post('/avatarUploader/', 'User\UserController@avatarUploader')->middleware('auth:api');
    //skills
    Route::get('/getSkills/', function (){return new SkillsResource(Auth::user());})->middleware('auth:api');
    Route::get('/getSkillsData/', function (){return new SkillsResource(Auth::user());})->middleware('auth:api');
    Route::post('/saveSkill/',  'Skills\SkillsController@saveSkill')->middleware('auth:api');
    Route::post('/checkTitle/',  'Skills\SkillsController@checkTitle')->middleware('auth:api');
    Route::post('/getPointsValuesByDate/',  'Skills\SkillsController@getPointsValuesByDate')->middleware('auth:api');
    Route::post('/sendSkillPointsValues/',  'Skills\SkillsController@sendSkillPointsValues')->middleware('auth:api');
});

Route::any('/', function () {
    return 'skill-tracking.api';
});