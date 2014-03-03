<?php
namespace Ipsum\Admin\Controllers;

use Ipsum\Library\Liste;
use View;
use Input;
use Redirect;
use Session;
use Str;
use Config;
use Validator;
use Hash;
use Ipsum\Admin\Models\User;

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
        $validation = User::validate($inputs);

        if ($validation->passes()) {
            $data = new User;
            $data->nom = Input::get('nom');
            $data->prenom = Input::get('prenom');
            $data->email = Input::get('email');
            $data->password = Hash::make(Input::get('password'));;
            $data->role = Input::get('role');
            if ($data->save()) {
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
        $data = User::findOrFail($id);
        $rules = User::$rules;

        $inputs = Input::all();
        // Modification des régles
        if (!Input::has('password')) {
            unset($rules['password']);
        }
        foreach ($rules['email'] as $key => $rule) {
            if (starts_with($rule, 'unique')) {
                $rules['email'][$key] = $rule.','.$data->id;
            }
        }
        $validation = Validator::make($inputs, $rules);

        if ($validation->passes()) {
            $data->nom = Input::get('nom');
            $data->prenom = Input::get('prenom');
            $data->email = Input::get('email');
            if (Input::has('email')) {
                $data->password = Hash::make(Input::get('password'));
            }
            $data->role = Input::get('role');
            if ($data->save()) {
                Session::flash('success', "L'enregistrement a bien été créé");
                return Redirect::route("admin.user.index");
            } else {
                Session::flash('error', "Impossible de créer l'enregistrement");
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
        $data = User::findOrFail($id);
        if ($data->delete()) {
            Session::flash('warning', "L'enregistrement a bien été supprimé");
        } else {
            Session::flash('error', "Impossible de supprimer l'enregistrement");
        }
        return Redirect::back();
    }

}