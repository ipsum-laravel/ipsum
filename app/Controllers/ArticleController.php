<?php
namespace App\Controllers;

use View;
use App\Article\Article;


class ArticleController extends BaseController
{

    public function page($page)
    {
        $article = Article::where('slug', $page)->firstOrFail();

        return View::make('article.page', compact('article'));
    }

    public function actualites()
    {
        $actualites = Article::actualites()->with('illustration')->orderBy('created_at', 'desc')->paginate(15);

        return View::make('article.actualites', compact('actualites'));
    }

    public function actualite($slug)
    {
        $actualite = Article::actualites()->where('slug', $slug)->firstOrfail();

        return View::make('article.actualite', compact('actualite'));
    }

}
