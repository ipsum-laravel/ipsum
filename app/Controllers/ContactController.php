<?php
namespace App\Controllers;

use View;
use Input;
use Config;
use Redirect;
use Mail;
use Session;
use Validator;

class ContactController extends BaseController
{

    public function index()
    {
        return View::make('contact.index');
    }

    public function send()
    {
        $rules =  array(
            'nom' => array('required', 'min:4'),
            'email' => array('required', 'email', 'notSpammeur'),
            'telephone' => array('min:10'),
            'texte' => array('required', 'min:10'),
        );
        $validation = Validator::make(Input::all() , $rules);

        if ($validation->passes()) {
            Mail::send('contact.mail', Input::all(), function ($m) {
                $m->from(Input::get('email'), Input::get('nom'));
                $m->to(Config::get('IpsumCore::website.mail_to'), Config::get('IpsumCore::website.nom_site'))->subject(Config::get('IpsumCore::website.mail_objet') . ' ' . Config::get('IpsumCore::website.nom_site'));
            });
            Session::flash('success', "Votre demande de contact a bien été envoyée");
            return Redirect::route('contact.success');
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function success()
    {
        return View::make('contact.index');
    }
}