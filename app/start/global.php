<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    Log::error($exception);

    if (!Config::get('app.debug')) {
        switch ($code) {
            case 403:
                return Response::make(View::make('error/403'), 403);

            case 500:
                return Response::make(View::make('error/500'), 500);

            default:
                return Response::make(View::make('error/404'), 404);
        }
    }
});

use Illuminate\Database\Eloquent\ModelNotFoundException;
App::error(function(ModelNotFoundException $e)
{
    return Response::make(View::make('error/404'), 404);
});


/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make(View::make('error/503'), 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';




require app_path().'/library/macros.php';

// TODO : uniquement si en admin
require app_path().'/library/admin/macros.php';
require app_path().'/library/admin/jsTools.php';


/**
* Formate une date pour un affichage
* @param string $date (format sql DATE ou DATETIME)
* @param string $format de sortie (DATE, DATETIME, IDENTIQUE)
* @return string
*/
function formateDate($date, $format='IDENTIQUE')
{
    if ($date == '0000-00-00 00:00:00' or $date == '0000-00-00') return false;
    $timestamp = strtotime($date);
    if (!$timestamp or $timestamp  == -1)
        return false;
    if ((strlen($date) == 10 and $format == 'IDENTIQUE') or $format == 'DATE')
        $date =  date('d/m/Y', $timestamp);
    elseif  ((strlen($date) == 19 and $format == 'IDENTIQUE') or $format == 'DATETIME')
        $date = date('d/m/Y H:i:s', $timestamp);
    else return false;
    return $date;
}

/**
* Formate une date pour un stockage
* Renvoi YYYY-mm-jj HH:ii:ss a partir de jj/mm/aaaa HH:MM:SS ou  jj/mm/aaaa
* @param string $date
* @return string  (format sql DATE ou DATETIME)
*/
function formateDateStocke($date)
{
    $date = trim($date);
    if (strlen($date) != 19 and strlen($date) != 10  and strlen($date) != 8){
     return false;
    }
    // On extrait
    $jour = substr($date, 0, 2);
    $mois = substr($date, 3, 2);
    if (strlen($date) == 8) {
        $annee = '20'.substr($date, 6, 2);
    } else {
        $annee = substr($date,6,4);
    }
    $date = substr_replace($date, $annee.'-'.$mois.'-'.$jour, 0);
    return $date;
}

