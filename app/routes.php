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


Route::get("admin/login" , array("as" => "admin.login" , "uses" => "AdminController@login"));
Route::post("admin/login" , "AdminController@postLogin");
Route::get("admin/forgot" , array("as" => "admin.forgot" , "uses" => "AdminController@forgot"));
Route::get("admin/logout" , array("as" => "admin.logout" , "uses" => "AdminController@logout"));


Route::group(array('before' => 'auth', 'prefix' => 'admin'), function()
{
    Route::get('/', array('uses' => 'AdminController@getIndex', 'as' => 'admin'));
    
    Route::get('configuration', array('uses' => 'AdminController@configuration'));

    Route::resource('actualite', 'ActualiteController');
});
