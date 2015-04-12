<?php
namespace Ipsum\Website\Controllers;

use View;
use Input;
use Config;
use Redirect;
use Mail;
use Session;
use Ipsum\Website\Validations\ContactValidator;

class ContactController extends \BaseController
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => array('post')));
    }

    public function index()
    {
        return View::make('IpsumWebsite::contact.index');
    }

    public function send()
    {
        $validator = new ContactValidator(Input::all());
        $validation = $validator->validate();

        if ($validation->passes()) {
            Mail::send('IpsumWebsite::contact.mail', Input::all(), function ($m) {
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
        return View::make('IpsumWebsite::contact.index');
    }
}