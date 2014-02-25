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


Route::get("admin/login" , array("as" => "admin.login" , "uses" => "AdminController@login"));
Route::post("admin/login" , "AdminController@postLogin");
Route::get("admin/forgot" , array("as" => "admin.forgot" , "uses" => "AdminController@forgot"));
Route::get("admin/logout" , array("as" => "admin.logout" , "uses" => "AdminController@logout"));


Route::group(array('before' => 'auth', 'prefix' => 'admin'), function()
{
    Route::get('/', array('uses' => 'AdminController@getIndex', 'as' => 'admin'));
    
    Route::get('configuration', array('uses' => 'AdminController@configuration', 'as' => 'admin.configuration'));

    Route::resource('actualite', 'ActualiteController');
    Route::resource('user', 'UsersController');
});


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