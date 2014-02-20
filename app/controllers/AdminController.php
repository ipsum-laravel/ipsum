<?php

class AdminController extends BaseController {

    public function __construct()
    {
        //$this->beforeFilter('auth');
    }

    public function getIndex()
    {
        $data = array();

        if (Auth::check()) {
            echo 'identifié';
        }
        return View::make('admin.index', $data);
    }
}