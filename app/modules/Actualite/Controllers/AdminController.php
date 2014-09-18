<?php
namespace Ipsum\Actualite\Controllers;

use Ipsum\Admin\Library\JsTools;
use View;
use Input;
use Redirect;
use Session;
use Str;
use Validator;
use File;
use Liste;
use Ipsum\Actualite\Models\Actualite;

class AdminController extends \Ipsum\Admin\Controllers\BaseController {

    public $title = 'Gestion des actualités';
    public $rubrique = 'actualite';
    public $menu = 'actualite';
    public static $zone = 'actualite';
    public $mediaFolder = 'assets/media/actu/';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $datas = array();

        $requete = Actualite::select(
            'actualite.id',
            'actualite.nom',
            'actualite.description',
            'actualite.date_actu'
        );
        $liste = Liste::setRequete($requete);
        $filtres = array(
            array(
                'nom' => 'id',
                'colonnes' => 'id',
            ),
            array(
                'nom' => 'mot',
                'operateur' => 'like',
                'colonnes' => array (
                    'actualite.nom',
                    'actualite.description'
                ),
            ),
        );
        Liste::setFiltres($filtres);
        $tris = array(
            array(
                'nom' => 'date',
                'ordre' => 'desc',
                'colonne' => 'date_actu',
                'actif' => true,
            ),
            array(
                'nom' => 'titre',
                'colonne' => 'nom',
            ),
            array(
                'nom' => 'description',
            ),
        );
        Liste::setTris($tris);

        foreach(Liste::rechercherLignes() as $item) {
            $item->image = File::find($this->mediaFolder.$item->id.'.*', null, true);
            $item->description = Str::words(strip_tags($item->description), 30, '...');
            $datas[] = $item;
        }

        $this->layout->content = View::make('IpsumActualite::admin.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->layout->head = JsTools::jwysiwyg().JsTools::datePicker();
        $this->layout->content = View::make('IpsumActualite::admin.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $inputs = Input::all();
        $inputs['date_actu'] = formateDateStocke(Input::get('date_actu'), 'Y-m-d');
        $validation = Actualite::validate($inputs);

        if ($validation->passes()) {
            $data = new Actualite;
            $data->nom = Input::get('nom');
            $data->date_actu = $inputs['date_actu'];
            $data->description = Input::get('description');
            if ($data->save()) {
                Session::flash('success', "L'enregistrement a bien été créé");
                return Redirect::route("admin.actualite.edit", $data->id);
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
        $data = Actualite::findOrFail($id);

        $data->image = File::find($this->mediaFolder.$id.'.*', null, true);

        $this->layout->head = JsTools::jwysiwyg().JsTools::datePicker();
        $this->layout->content = View::make('IpsumActualite::admin.form', compact("data", "image"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $data = Actualite::findOrFail($id);

        $inputs = Input::all();
        $inputs['date_actu'] = formateDateStocke(Input::get('date_actu'), 'Y-m-d');
        $validation = Actualite::validate($inputs);

        if ($validation->passes()) {
            $data->nom = Input::get('nom');
            $data->date_actu = $inputs['date_actu'];
            $data->description = Input::get('description');

            if ($data->save()) {
                Session::flash('success', "L'enregistrement a bien été modifié");
                return Redirect::route("admin.actualite.edit", $id);
            } else {
                Session::flash('error', "Impossible de modifier l'enregistrement");
            }
        }
        return Redirect::back()->withInput()->withErrors($validation);
	}

    /**
     * Upload image
     *
     * @param  int  $id
     * @return Response
     */
    public function upload($id)
    {
        $data = Actualite::findOrFail($id);

        // TODO problème avec champ vide
        // puis message lorsque dépasse upload_max_filesize
        $rules = array('image'  => 'image|max:2000');
        $datas = array('image' => Input::file('image'));
        $validation = Validator::make($datas, $rules);
        if ($validation->passes()) {

            try {
                $file = Input::file('image');

                // Delete all images
                File::deleteAll($this->mediaFolder.$id.'{.,-}*');

                $filename = $id.'.'.File::extension($file->getClientOriginalName());
                Input::file('image')->move($this->mediaFolder, $filename);
                Session::flash('success', "L'image a bien été téléchargée");

            } catch (\RuntimeException $e) {
                Session::flash('error', "Votre fichier image est trop lourd.");
            } catch (\Exception $e) {
                Session::flash('error', "Impossible d'enregistrer l'image");
            }
        }
        return Redirect::route("admin.actualite.edit", $id)->withErrors($validation);
    }

    /**
     * Delete image
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteImage($id)
    {
        $data = Actualite::findOrFail($id);

        // Delete all images
        File::deleteAll($this->mediaFolder.$id.'{.,-}*');
        Session::flash('warning', "L'image a bien été supprimée");
        return Redirect::route("admin.actualite.edit", $id);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $data = Actualite::findOrFail($id);

	    File::deleteAll($this->mediaFolder.$id.'{.,-}*');

		if ($data->delete()) {
            Session::flash('warning', "L'enregistrement a bien été supprimé");
		} else {
		    Session::flash('error', "Impossible de supprimer l'enregistrement");
		}
		return Redirect::back();
	}

}