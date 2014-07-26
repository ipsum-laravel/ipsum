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

// Routes for the pages : Catch all the route
// Must be the last rule
Route::get('{all}', 'Ipsum\Website\Controllers\PageController@getIndex')->where('all', '.*');

