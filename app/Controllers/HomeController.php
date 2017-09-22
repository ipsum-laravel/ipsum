<?php
namespace App\Controllers;

use App\Article\Article;
use View;

class HomeController extends BaseController
{

    public function index()
    {
        $article = Article::where('slug', '')->firstOrFail();

        return View::make('home', compact('article'));
    }

}