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

Route::get('/', function()
{
	return View::make('hello');
});


Route::get("admin/users/login" , array("as" => "users.login" , "uses" => "UsersController@login"));
Route::post("admin/users/login" , "UsersController@postLogin");

Route::group(array('before' => 'auth', 'prefix' => 'admin'), function()
{
    Route::get('/', array('uses' => 'AdminController@getIndex', 'as' => 'admin'));
});
