<?php

Route::group(array('prefix' => 'admin'), function()
{
    /* Login */
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
    
    /* Remind */
    Route::get("remind", array(
        "as" => "admin.remind", 
        "uses" => "\Ipsum\Admin\Controllers\RemindersController@getRemind",
    ));    
    Route::post("remind", array(
        "as" => "admin.remind", 
        "uses" => "\Ipsum\Admin\Controllers\RemindersController@postRemind",
    ));
    Route::get("reset/{token}", array(
        "as" => "admin.reset", 
        "uses" => "\Ipsum\Admin\Controllers\RemindersController@getReset",
    ));
    Route::post("reset", array(
        "as" => "admin.reset", 
        "uses" => "\Ipsum\Admin\Controllers\RemindersController@postReset",
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




