<?php

Route::group(
    array(
        'namespace' => 'Ipsum\Website\Controllers'
    ),
    function() {
        Route::get('/', array(
            'as'     => 'home',
            'uses' => 'HomeController@index'
        ));

        Route::get('contact', array(
            'as'     => 'contact.index',
            'uses' => 'ContactController@index'
        ));
        Route::post('contact', array(
            'as'     => 'contact.send',
            'uses' => 'ContactController@send'
        ));
        Route::get('contact/success', array(
            'as'     => 'contact.success',
            'uses' => 'ContactController@success'
        ));
    }
);
