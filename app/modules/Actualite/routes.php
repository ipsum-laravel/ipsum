<?php

Route::get('actualite', '\Ipsum\Actualite\Controllers\frontController@index');

Route::resource('admin/actualite', '\Ipsum\Actualite\Controllers\AdminController');



