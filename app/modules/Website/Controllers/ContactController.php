<?php
namespace Ipsum\Website\Controllers;

use View;
use Ipsum\Website\Validations;

class ContactController extends \BaseController {

    public $title = 'Contact';
    public $rubrique = 'contact';

    public function getIndex()
    {
        $this->layout->description = '';
        $this->layout->head = '';
        $this->layout->javascript = '';
        $this->layout->content = View::make('IpsumWebsite::contact.index');
    }

    public function postIndex()
    {
        $validator = new ContactValidator(Input::all());

        if ($validator->passes()) {
            Mail::send('IpsumWebsite::contact.email_content', Input::all(), function($m) {
                $m->to(Config::get('website.mail_to'), Config::get('website.nom_site'))->subject(Config::get('website.mail_objet').' '.Config::get('website.nom_site'));
            });

            return Redirect::route('contact/success');
        }

        return Redirect::back()->withInput()->withErrors($validator->getErrors());
    }

    public function getSuccess()
    {
        $this->layout->content = View::make('IpsumWebsite::contact.success');
    }
}