<?php
namespace App\Controllers;

use View;

class HomeController extends BaseController
{

    public function index()
    {
        return View::make('home');
    }

}