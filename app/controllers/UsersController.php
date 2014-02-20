<?php

class UsersController extends BaseController {

    public function __construct() {
        $this->beforeFilter("csrf" , array("on" => "post"));
    }

    public function login() {
        return View::make('admin/connexion')->with("title" , "Login");
    }

    public function postLogin() {
        $creds = array('identifiant' => Input::get('identifiant') ,
                  'password' => Input::get('password'));
        $validation = User::validate($creds);

        if ( $validation->passes() ) {
            return (Auth::attempt($creds , true)) ? Redirect::route("admin")
                    : Redirect::back()->with("alert_error" , "Erreur de connexion");
        }
        return Redirect::back()->with("alert_error" , "Username or Password can't be empty")->with("title" , "Connexion");
    }

    public function logout() {
        Auth::logout();
        return Redirect::route("home.index");
    }
}