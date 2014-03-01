<?php
namespace Ipsum\Admin\Controllers;

use \View;
use \Input;
use \Redirect;
use \Auth;
use \Ipsum\Admin\Models\User;

class LoginController extends \BaseController {

    public $layout = 'IpsumAdmin::layouts.login';
    public $menu = null;    
    

    public function login()
    {
        if (Auth::check()) {
            return Redirect::route("admin");
        }

        $this->layout->title = 'Connexion';
        $this->layout->content = View::make('IpsumAdmin::login.connexion');
    }

    public function postLogin()
    {

        $creds = array(
            'identifiant' => Input::get('identifiant') ,
            'password' => Input::get('password')
        );

        $validation = User::validate($creds, Input::has('cookie'));

        if ($validation->passes()) {
            return (Auth::attempt($creds , true)) ? Redirect::route("admin")
                    : Redirect::back()->with("alert_error" , "Erreur de connexion");
        }
        return Redirect::back()->with("alert_error" , "Merci de renseigner l'identifiant et le mot de passe");
    }

    public function logout()
    {

        Auth::logout();
        return Redirect::route("admin.login")->with("alert_error" , "Vous êtes bien déconnecté");
    }

    public function forgot()
    {

        // TODO
        $this->layout->title = 'Mot de passe oublié';
        $this->layout->content = View::make('IpsumAdmin::login.connexion');
    }

}