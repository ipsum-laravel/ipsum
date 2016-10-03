<?php
namespace App\Controllers;

use View;
use App;

class PageController extends BaseController
{

    public function getIndex($page)
    {
        $page = str_replace('/', '.', $page);
        $page = 'page.' . $page;

        try {
            return View::make($page);
        } catch (\InvalidArgumentException $e) {
            App::abort(404);
        }
    }
}