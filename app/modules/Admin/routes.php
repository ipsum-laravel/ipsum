<?php

Route::group(
    array(
        'prefix' => 'admin',
        'namespace' => '\Ipsum\Admin\Controllers'
    ),
    function() {
        /* Login */
        Route::get("login", array(
            "as" => "admin.login",
            "uses" => "LoginController@login",
        ));
        Route::post("login", array(
            "as" => "admin.login",
            "uses" => "LoginController@postLogin",
        ));
        Route::get("forgot", array(
            "as" => "admin.forgot",
            "uses" => "LoginController@forgot",
        ));
        Route::get("logout", array(
            "as" => "admin.logout",
            "uses" => "LoginController@logout",
        ));

        /* Remind */
        Route::get("remind", array(
            "as" => "admin.remind",
            "uses" => "RemindersController@getRemind",
        ));
        Route::post("remind", array(
            "as" => "admin.remind",
            "uses" => "RemindersController@postRemind",
        ));
        Route::get("reset/{token}", array(
            "as" => "admin.reset",
            "uses" => "RemindersController@getReset",
        ));
        Route::post("reset", array(
            "as" => "admin.reset",
            "uses" => "RemindersController@postReset",
        ));


        Route::get('/', array(
            'uses' => 'BaseController@getIndex',
            'as' => 'admin',
        ));

        Route::get('configuration', array(
            'uses' => 'BaseController@configuration',
            'as' => 'admin.configuration',
        ));

        // TODO : http://laravel.io/forum/02-27-2014-naming-restful-controller-methods
        Route::resource('user', 'UsersController');

        Route::get('parametre', array(
            'uses' => 'ConfigController@index',
            'as' => 'admin.parametre',
        ));
        Route::post('parametre', array(
            'uses' => 'ConfigController@update',
            'as' => 'admin.parametre',
        ));

        Route::get('log', array(
            'uses' => 'LogController@log',
            'as' => 'admin.log',
        ));
        Route::post('log', array(
            'uses' => 'LogController@postLog',
            'as' => 'admin.log',
        ));
    }
);

