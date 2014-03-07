<?php

Route::get('contact', array('uses' => 'Ipsum\Website\Controllers\ContactController@getIndex'));
Route::post('contact', array('uses' => 'Ipsum\Website\Controllers\ContactController@postIndex'));
Route::get('contact/success', array('uses' => 'Ipsum\Website\Controllers\ContactController@getSuccess'));

