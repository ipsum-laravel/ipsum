<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(
    array(
        'namespace' => 'App\Controllers'
    ),
    function() {
        Route::get('/', array(
            'as'     => 'home',
            'uses' => 'HomeController@index'
        ));

        Route::get('actualites', array(
            'as'     => 'article.actualites',
            'uses' => 'ArticleController@actualites'
        ));
        Route::get('actualite/{slug}', array(
            'as'     => 'article.actualite',
            'uses' => 'ArticleController@actualite'
        ));

        Route::get('contact', array(
            'as'     => 'contact.index',
            'uses' => 'ContactController@index'
        ));
        Route::post('contact', array(
            'as'     => 'contact.send',
            'uses' => 'ContactController@send'
        ));
    }
);


include('routes_admin.php');

// Routes for the pages : Catch all the route
// Must be the last rule
Route::get('{all}', 'App\Controllers\ArticleController@page')->where('all', '.*');

