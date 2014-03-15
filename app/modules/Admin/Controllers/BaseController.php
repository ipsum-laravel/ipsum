<?php
namespace Ipsum\Admin\Controllers;

use View;
use Input;
use Redirect;
use Config;
use Ipsum\Admin\Models\User;

class BaseController extends \BaseController {

    public $layout = 'IpsumAdmin::layouts.admin';
    public $menu = null;
    public static $zone;

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on' => array('post')));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        parent::setupLayout();

        if (isset($this->title)) {
            $this->layout->title = $this->title;
        }
        if (isset($this->rubrique)) {
            $this->layout->rubrique = $this->rubrique;
        }
        $this->layout->menu = $this->menu;
    }

    public function getIndex()
    {
        $this->layout->rubrique = null;
        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('IpsumAdmin::dashboard');
    }

    public function configuration()
    {
        $configuration = Config::get('IpsumAdmin::configuration');

        $this->layout->rubrique = 'configuration';
        $this->layout->menu = 'configuration';
        $this->layout->title = 'Configuration';
        $this->layout->content = View::make('IpsumAdmin::configuration', array('menu_configuration' => $configuration));
    }

}