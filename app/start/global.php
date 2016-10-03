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
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


Validator::extend('notSpammeur', function($attribute, $value, $parameters)
{
    $adresse = 'http://www.stopforumspam.com/api?';
    $query = array(
        'confidence' => 'true',
        'f' => 'xmldom',
    );

    $query['email'] = urlencode($value);

    if (!empty($parameters[3])) {
        $query['ip'] = urlencode($parameters[3]);
    } else {
        $query['ip'] = Request::getClientIp();
    }

    foreach($query as $key => $value) {
        $adresse .= $key.'='.$value.'&';
    }

    $xml_string = file_get_contents($adresse);
    if ($xml_string) {
        $xml = new SimpleXMLElement($xml_string);
        if ($xml->success == 1) {
            foreach ($xml->children() as $value) {
                if ($value->appears == "1" and  $value->confidence >= 0) {
                    // spammeur detecté
                    return false;
                }
            }
        }
    }
    return true;

});
