<?php
namespace Ipsum\Admin\Controllers;

use Ipsum\Library\Liste;
use View;
use Input;
use Redirect;
use Session;
use Config;

class ConfigController extends BaseController {

    public $title = 'Gestion des paramètres';
    public $rubrique = 'configuration';
    public $menu = 'parametre';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->layout->content = View::make('IpsumAdmin::config');
    }


    /**
     * Update all the the website configuration
     *
     * @return Response
     */
    public function update()
    {
        foreach (Config::get('website') as $key => $value) {
            if (Input::get($key) != $value) {
                Config::set('website.'.$key, Input::get($key));
            }
        }
        Session::flash('success', "Les paramètres ont bien été modifiés");
        return Redirect::back();
    }

}