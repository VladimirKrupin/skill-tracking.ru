<?php

Route::any('{all}', 'IndexController@index')->where('all', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
