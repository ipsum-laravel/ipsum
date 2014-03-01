<?php

Route::group(array('prefix' => 'admin'), function()
{
    Route::get("login", array(
        "as" => "admin.login", 
        "uses" => "\Ipsum\Admin\Controllers\LoginController@login",
    ));
    Route::post("login", array(
        "as" => "admin.login", 
        "uses" => "\Ipsum\Admin\Controllers\LoginController@postLogin",
    ));
    Route::get("forgot", array(
        "as" => "admin.forgot", 
        "uses" => "\Ipsum\Admin\Controllers\LoginController@forgot",
    ));
    Route::get("logout", array(
        "as" => "admin.logout", 
        "uses" => "\Ipsum\Admin\Controllers\LoginController@logout",
    ));

    Route::get('/', array(
        'uses' => '\Ipsum\Admin\Controllers\BaseController@getIndex', 
        'as' => 'admin',
    ));

    Route::get('configuration', array(
        'uses' => '\Ipsum\Admin\Controllers\BaseController@configuration', 
        'as' => 'admin.configuration',
    ));

    Route::resource('user', '\Ipsum\Admin\Controllers\UsersController');
    
});




