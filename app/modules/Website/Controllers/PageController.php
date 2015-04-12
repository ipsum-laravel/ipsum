<?php
namespace Ipsum\Website\Controllers;

use View;
use App;

class PageController extends \BaseController
{

    public $modulePages = array(
        'mentions-legales',
    );

    public function getIndex($page)
    {
        $page = str_replace('/', '.', $page);
        if (in_array($page, $this->modulePages)) {
            $page = 'IpsumWebsite::' . $page;
        }

        try {
            return View::make($page);
        } catch (\InvalidArgumentException $e) {
            App::abort(404);
        }
    }
}