<?php

Route::post('article/markdownPreview', array(
    'as'     => 'admin.article.markdownPreview',
    'uses'   => 'App\Controllers\Admin\ArticleController@markdownPreview'
));

Route::group(
    array(
        'prefix' => 'administration',
        'namespace' => 'App\Controllers\Admin',
    ),
    function() {
        Route::group(
            array(
                'prefix' => 'article',
            ),
            function () {
                /* Article */
                Route::get('', array(
                    'as'     => 'admin.article.index',
                    'uses'   => 'ArticleController@index'
                ));
                Route::get('create', array(
                    'as'     => 'admin.article.create',
                    'uses'   => 'ArticleController@create'
                ));
                Route::post('', array(
                    'as'     => 'admin.article.store',
                    'uses'   => 'ArticleController@store'
                ));
                Route::get('{id}/edit', array(
                    'as'     => 'admin.article.edit',
                    'uses'   => 'ArticleController@edit'
                ));
                Route::put('{id}', array(
                    'as'     => 'admin.article.update',
                    'uses'   => 'ArticleController@update'
                ));
                Route::delete('{id}/destroy', array(
                    'as'     => 'admin.article.destroy',
                    'uses'   => 'ArticleController@destroy'
                ));
            }
        );
        Route::group(
            array(
                'prefix' => 'media',
            ),
            function () {
                /* Media */
                Route::get('', array(
                    'as'     => 'admin.media.index',
                    'uses'   => 'MediaController@index'
                ));
                Route::put('upload', array(
                    'as'     => 'admin.media.upload',
                    'uses'   => 'MediaController@upload'
                ));
                Route::get('{id}/edit', array(
                    'as'     => 'admin.media.edit',
                    'uses'   => 'MediaController@edit'
                ));
                Route::put('{id}', array(
                    'as'     => 'admin.media.update',
                    'uses'   => 'MediaController@update'
                ));
                Route::delete('{id}/destroy', array(
                    'as'     => 'admin.media.destroy',
                    'uses'   => 'MediaController@destroy'
                ));
                Route::put('{id}/illustrer', array(
                    'as'     => 'admin.media.illustrer',
                    'uses'   => 'MediaController@illustrer'
                ));
            }
        );
    }
);
