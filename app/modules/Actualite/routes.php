<?php

Route::get('actualite', array(
    'as' => 'actualite',
    'uses' => '\Ipsum\Actualite\Controllers\frontController@index'
));

Route::group(
    array(
        'prefix' => 'administration',
        'namespace' => '\Ipsum\Actualite\Controllers'
    ),
    function() {
        /* Patterns */
        Route::pattern('id', '\d+');

        /* Actualite */
        Route::get('actualite', array(
            'as'     => 'admin.actualite.index',
            'uses'   => 'AdminController@index'
        ));
        Route::get('actualite/create', array(
            'as'     => 'admin.actualite.create',
            'uses'   => 'AdminController@create'
        ));
        Route::post('actualite', array(
            'as'     => 'admin.actualite.store',
            'uses'   => 'AdminController@store'
        ));
        Route::get('actualite/{id}/edit', array(
            'as'     => 'admin.actualite.edit',
            'uses'   => 'AdminController@edit'
        ));
        Route::put('actualite/{id}', array(
            'as'     => 'admin.actualite.update',
            'uses'   => 'AdminController@update'
        ));
        Route::put('actualite/{id}/upload', array(
            'as'     => 'admin.actualite.upload',
            'uses'   => 'AdminController@upload'
        ));
        Route::delete('actualite/{id}/image', array(
            'as'     => 'admin.actualite.deleteImage',
            'uses'   => 'AdminController@deleteImage'
        ));
        Route::delete('actualite/{id}/destroy', array(
            'as'     => 'admin.actualite.destroy',
            'uses'   => 'AdminController@destroy'
        ));
    }
);

