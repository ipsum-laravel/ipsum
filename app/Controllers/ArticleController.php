<?php
namespace App\Controllers;

use Redirect;
use View;
use Input;
use Route;
use Config;
use App\Article\Article;

use App\Library\Markdown;
use Mews\Purifier\Purifier;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $method = explode('@', Route::currentRouteAction());
        $method = end($method);
        if ($method == 'markdownPreview') {
            $this->forgetBeforeFilter('csrf');
        }
    }

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

    /**
     * markdownPreview
     * @return Response
     * @internal param string $data
     */
    public function markdownPreview()
    {
        $converter = new Markdown(new CommonMarkConverter(), new Purifier());
        $html =  $converter->convertToHtml(Input::get('data'));
        return View::make('article.admin.preview', compact('html'));
    }
}
