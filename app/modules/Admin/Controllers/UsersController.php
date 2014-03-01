<?php
namespace Ipsum\Admin\Controllers;

use \Ipsum\Library\Liste;
use \View;
use \Input;
use \Redirect;
use \Session;
use \Str;
use \Config;
use \Ipsum\Admin\Models\User;

class UsersController extends BaseController {
    
    public $title = 'Gestion des utilisateurs';
    public $rubrique = 'configuration';
    public $menu = 'utilisateur';
    //public static $zone = 'utilisateur';    

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
                'utilisateur.nom',
                'utilisateur.prenom',
                'utilisateur.email'
            )
        );
        $liste->setRecherche($recherche);
        $tri = array(
            'ordre'     => 'ASC',
            'colonne'  => 'id'
        );
        $liste->setTri($tri);
        $requete = array(
            'colonnes'  => 'utilisateur.id,
                            utilisateur.nom,
                            utilisateur.prenom,
                            utilisateur.email',
            'from'      => 'utilisateur'
        );
        $ressource = $liste->select($requete);

        $data['datas'] = array();
        foreach($ressource as $item) {
            $data['datas'][] = $item;
        }

        $data['liste'] = $liste;

        $this->layout->content = View::make('IpsumAdmin::user.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $role = Config::get('auth.roles');
        $this->layout->content = View::make('IpsumAdmin::user.form', compact("data", "role"));
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
                return Redirect::route("admin.user.index");
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
        $data = User::findOrFail($id);
        $role = Config::get('auth.roles');

        $this->layout->content = View::make('IpsumAdmin::user.form', compact("data", "role"));
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
                return Redirect::route("admin.user.index");
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