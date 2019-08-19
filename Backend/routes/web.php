<?php
Route::get('/start/', 'TestController@web');
Route::get('/createUser/', 'User\UserController@create');

Route::any('/', function () {
    return 'skill-tracking.api';
});