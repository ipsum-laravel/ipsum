<?php

use \App\library\Liste;

class ActualiteController extends AdminController {

    public $title = 'Gestion des actualités';
    public $rubrique = 'actualite';
    public static $zone = 'actualite';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $data = array();

        $liste = new Liste();
        $recherche = array(
            'input'     => 'mot',
            'colonnes'      => array (
                'actualite.nom',
                'actualite.description'
            )
        );
        $liste->setRecherche($recherche);
        $tri = array(
            'ordre'     => 'DESC',
            'colonne'  => 'date_actu'
        );
        $liste->setTri($tri);
        $requete = array(
            'colonnes'  => 'actualite.id,
                            actualite.nom,
                            actualite.description,
                            DATE_FORMAT(actualite.date_actu, "%d/%m/%Y") AS date_actu_format',
            'from'      => 'actualite'
        );
        $ressource = $liste->select($requete);

        $data['datas'] = array();
        foreach($ressource as $item) {
            $item->description = Str::words(strip_tags($item->description), 30, '...');
            $data['datas'][] = $item;
        }

        $data['liste'] = $liste;

        $this->layout->content = View::make('actualite.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->layout->head = \JsTools::jwysiwyg().\JsTools::datePicker();
        $this->layout->content = View::make('actualite.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $inputs = Input::all();
        $inputs['date_actu'] = formateDateStocke(Input::get('date_actu'));
        $validation = Actualite::validate($inputs);

        if ($validation->passes()) {
            $data = new Actualite;
            $data->nom = Input::get('nom');
            $data->date_actu = $inputs['date_actu'];
            $data->description = Input::get('description');
            if ($post->save()) {
                Session::flash('success', "L'enregistrement a bien été créé");
                return Redirect::route("admin.actualite.index");
            } else {
                Session::flash('error', "Impossible de créer l'enregistrement");
            }
        }
        return Redirect::back()->withInput()->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data['actualite'] = Actualite::findOrFail($id);

        $this->layout->title = $data['actualite']->nom;
        $this->layout->content = View::make('actualite.show', $data);
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

        $this->layout->head = JsTools::jwysiwyg().JsTools::datePicker();
        $this->layout->content = View::make('actualite.form', compact("data"));
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
        $inputs['date_actu'] = formateDateStocke(Input::get('date_actu'));
        $validation = Actualite::validate($inputs);

        if ($validation->passes()) {
            $data->nom = Input::get('nom');
            $data->date_actu = $inputs['date_actu'];
            $data->description = Input::get('description');

            if ($data->save()) {
                Session::flash('success', "L'enregistrement a bien été modifié");
                return Redirect::route("admin.actualite.index");
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
	    $data = Actualite::findOrFail($id);
		if ($data->delete()) {
            Session::flash('warning', "L'enregistrement a bien été supprimé");
		} else {
		    Session::flash('error', "Impossible de supprimer l'enregistrement");
		}
		return Redirect::back();
	}

}