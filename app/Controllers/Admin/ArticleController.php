<?php
namespace App\Controllers\Admin;

use Ipsum\Admin\Controllers\BaseController;
use App\Article\Article;
use App\Article\Categorie;
use Ipsum\Admin\Library\JsTools;
use View;
use Input;
use Redirect;
use Session;
use Liste;
use Croppa;
use Route;


class ArticleController extends BaseController
{
    public $title = 'Gestion des articles';
    public $rubrique = 'article';
    public $menu = 'article';
    public static $zone = 'article';


    public function __construct()
    {
        parent::__construct();

        if (Route::is('admin.article.markdownPreview')) {
            $this->forgetBeforeFilter('csrf');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $requete = Article::with('illustration', 'categorie', 'categorie');

        Liste::setRequete($requete);
        $filtres = array(
            array(
                'nom' => 'mot',
                'operateur' => 'like',
                'colonnes' => array(
                    'article.titre',
                    'article.extrait',
                    'article.texte',
                ),
            ),
            array(
                'nom' => 'categorie',
                'colonnes' => 'article.categorie_id',
            ),
            array(
                'nom' => 'type',
                'colonnes' => 'article.type',
            ),
        );
        Liste::setFiltres($filtres);
        $tris = array(
            array(
                'nom' => 'creation',
                'ordre' => 'desc',
                'colonne' => 'created_at',
                'actif' => true,
            ),
            array(
                'nom' => 'titre',
            ),
            array(
                'nom' => 'extrait',
            ),
            array(
                'nom' => 'type',
            ),
            array(
                'nom' => 'categorie',
                'colonne' => 'categorie_id',
            ),
        );

        Liste::setTris($tris);

        $datas = Liste::rechercherLignes();

        $categories = Categorie::get()->lists('nom', 'id');

        $this->layout->menu = Input::has('type') ? Input::get('type') : $this->menu; // Modification du menu en fonction de type de l'article
        $this->layout->content = View::make('article.admin.index', compact('datas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Categorie::get()->lists('nom', 'id');

        $this->layout->menu = Input::has('type') ? Input::get('type') : $this->menu; // Modification du menu en fonction de type de l'article
        $this->layout->head = JsTools::markItUp(route('admin.article.markdownPreview'));
        $this->layout->content = View::make('article.admin.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validation = Article::validate(Input::all());

        if ($validation->passes()) {
            $data = new Article(Input::all());
            if ($data->save()) {
                Session::flash('success', "L'enregistrement a bien été créé");
                return Redirect::route("admin.article.edit", $data->id);
            } else {
                Session::flash('error', "Impossible de créer l'enregistrement");
            }
        }
        return Redirect::back()->withInput()->withErrors($validation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $categories = Categorie::get()->lists('nom', 'id');

        $this->layout->menu = $article->type; // Modification du menu en fonction de type de l'article
        $this->layout->head = JsTools::markItUp(route('admin.article.markdownPreview'));
        $this->layout->content = View::make('article.admin.form', compact("article", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $data = Article::findOrFail($id);

        $validation = Article::validate(Input::all());

        if ($validation->passes()) {
            if ($data->fill(Input::all())->save()) {
                Session::flash('success', "L'enregistrement a bien été modifié");
                return Redirect::route("admin.article.edit", $id);
            } else {
                Session::flash('error', "Impossible de modifier l'enregistrement");
            }
        }
        return Redirect::back()->withInput()->withErrors($validation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = Article::findOrFail($id);

        if ($data->delete()) {
            Session::flash('warning', "L'enregistrement a bien été supprimé");
        } else {
            Session::flash('error', "Impossible de supprimer l'enregistrement");
        }
        return Redirect::back();
    }


    /**
     * @return \Illuminate\View\View
     */
    public function markdownPreview()
    {
        $article = new Article();
        $article->texte_md = Input::get('data');
        $html = $article->texte;
        return View::make('article.admin.preview', compact('html'));
    }
}
