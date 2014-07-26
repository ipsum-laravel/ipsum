<?php
namespace Ipsum\Website\Validations;

class ContactValidator extends \App\Services\Validator {
    // TODO faire App\Services\Validator

    public function getRules() {
        return array(
            'name' => array('required', 'min:5'),
            'email' => array('required', 'email'),
            'subject' => array('min:5'),
            'mailContent' => array('required', 'min:30'),
        );
    }
}
