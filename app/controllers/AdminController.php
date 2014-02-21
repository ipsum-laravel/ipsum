<?php

class AdminController extends BaseController {

    public $layout = 'layouts.admin';

    public function __construct()
    {

    }

    public function getIndex()
    {
        $this->layout->menus = array();
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

    private function _menu()
    {
        // Chargement des paramètres du menu
        \Config::load('admin::rubrique', 'rubrique');
        $menus = \Config::get('module.menu');
        if (\Config::get('module.rubrique') == 'configuration' and \Request::active()->module != 'admin') {
            $module_admin = \Config::load('admin::module', 'module_admin');
            $menus = array_merge($module_admin['menu'], $menus); // permet d'avoir le menu configuration en premier
        }

        // Gestion des groupes et rubriques
        $rubriques = \Config::get('rubrique');
        foreach ($rubriques as $key1 => $groupe) {
            foreach ($groupe as $key => $rubrique) {
                $rubriques[$key1][$key]['selected'] = \Config::get('module.rubrique') == $rubrique['rubrique'] ? 'selected' : '';
            }
        }
        $this->template->rubriques = $rubriques;

        // Gestion du menu et sous menus
        foreach ($menus as $key1 => $menu) {
            if (
                !(isset($menu['visibility']) and $menu['visibility'] == 'hidden')
                or (
                    \Request::active()->controller == $menu['controler']
                    and (!isset($menu['action']) or \Request::active()->action == $menu['action']))
                ) {
                $menu2 = $menu;
                $menu2['selected'] = (\Request::active()->controller == $menu['controler'] and (!isset($menu['action']) or \Request::active()->action == $menu['action'])) ? 'selected' : '';
                $menu2['uri'] = 'admin/'.$menu['uri'];
                if (isset($menu['smenus'])) {
                    foreach ($menu['smenus'] as $key => $smenu) {
                        $menu2['smenus'][$key]['uri'] = 'admin/'.$smenu['uri'];
                    }
                }
                $menus2[] = $menu2;
            }
        }
        $this->template->menus = $menus2;
    }
}