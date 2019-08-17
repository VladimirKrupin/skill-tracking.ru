<?php
Route::get('/start/', 'TestController@web');
Route::get('/createUser/', 'User\UserController@create');