<?php
Route::get('/start/', 'TestController@web');

Route::get('/home/', function (){
    return 'Main Page';
});

Auth::routes();

Route::any('/', function () {
    return 'skill-tracking.api';
});