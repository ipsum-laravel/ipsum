<?php
namespace Ipsum\Website\Controllers;

use Ipsum\Actualite\Models\Actualite;
use Carbon\Carbon;
use File;
use View;
use Str;

class HomeController extends \BaseController {

	public function index()
	{
    	return View::make('IpsumWebsite::home');
	}

}