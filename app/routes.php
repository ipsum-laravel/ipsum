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

Route::get('/', array('as' => 'home', function()
{
	return View::make('hello');
}));


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


// routes de test 403,404,500
Route::get('/error/403', function()
{
    return View::make('error/403');
});

Route::get('/error/404', function()
{
    return View::make('error/404');
});

Route::get('/error/500', function()
{
    return View::make('error/500');
});

Route::get('/error/503', function()
{
    return View::make('error/503');
});