<?php
namespace Ipsum\Website\Controllers;

use View;

class HomeController extends \BaseController
{

    public function index()
    {
        return View::make('IpsumWebsite::home');
    }

}