<?php

Route::any('{all}', 'IndexController@index')->where('all', '.*');