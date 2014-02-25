<?php

class AdminController extends BaseController {

    public $layout = 'layouts.admin';
    public $menu = null;
    public static $zone;
    
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        parent::setupLayout();
        $this->layout->menu = $this->menu;
    }    

    public function getIndex()
    {
        $this->layout->rubrique = null;
        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('admin.dashboard');
    }

    public function login()
    {
        if (Auth::check()) {
            return Redirect::route("admin");
        }

        $this->layout = View::make('layouts.admin_login');

        $this->layout->title = 'Connexion';
        $this->layout->content = View::make('admin/connexion');
    }

    public function postLogin()
    {
        $this->layout = View::make('layouts.admin_login');

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
        $this->layout = View::make('layouts.admin_login');

        Auth::logout();
        return Redirect::route("admin.login")->with("alert_error" , "Vous êtes bien déconnecté");
    }

    public function forgot()
    {
        $this->layout = View::make('layouts.admin_login');

        // TODO
        $this->layout->title = 'Mot de passe oublié';
        $this->layout->content = View::make('admin/connexion');
    }

    public function configuration()
    {
        $configuration = Config::get('admin/configuration');
        
        $this->layout->rubrique = 'configuration';
        $this->layout->menu = 'configuration';
        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('admin.configuration', array('menu_configuration' => $configuration));
    }
}