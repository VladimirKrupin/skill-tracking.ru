<?php
Route::get('/start/', 'TestController@web');

Auth::routes();

Route::any('/', function () {
    return 'skill-tracking.api';
});