<?php
namespace App\Controllers\Admin;

use App\Article\Categorie;
use App\Article\Media;
use Ipsum\Admin\Library\JsTools;
use View;
use Input;
use Redirect;
use Session;
use Str;
use Liste;

use Croppa;
use App\Article\Article;

class ArticleController extends \Ipsum\Admin\Controllers\BaseController
{
    public $title = 'Gestion des articles';
    public $rubrique = 'article';
    public $menu = 'article';
    public static $zone = 'article';

    protected function setupLayout()
    {
        // Modification du menu en fonction de la catégorie de l'article
        if (Input::has('type')) {
            $this->menu = Input::get('type');
        }

        parent::setupLayout();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $datas = array();

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

        $this->layout->content = View::make('article.admin.index', compact('datas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categorie::get()->lists('nom', 'id');

        $this->layout->head = JsTools::markItUp(route('article.markdownPreview'));
        $this->layout->content = View::make('article.admin.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
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
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $categories = Categorie::get()->lists('nom', 'id');

        $this->layout->head = JsTools::markItUp(route('article.markdownPreview'));
        $this->layout->content = View::make('article.admin.form', compact("article", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
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

    public function illustrer($id)
    {
        $media = Media::findOrFail(Input::get('media_id'));
        $article = Article::findOrFail($id);

        $article->illustration()->associate($media)->save();

        Session::flash('success', "L'image d'illustration a été enregistrée.");

        return Redirect::back();
    }
}
