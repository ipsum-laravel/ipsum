<?php
namespace Ipsum\Website\Validations;

class ContactValidator extends \Ipsum\Core\Library\Validator {

    public function getRules() {
        return array(
            'nom' => array('required', 'min:5'),
            'email' => array('required', 'email'),
            'telephone' => array('min:10'),
            'texte' => array('required', 'min:30'),
        );
    }
}
