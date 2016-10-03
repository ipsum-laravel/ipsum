<?php
namespace App\Controllers;

class BaseController extends \Controller {

    public function __construct()
    {
        $this->beforeFilter('csrfFront', array('on' => array('post')));
    }
}