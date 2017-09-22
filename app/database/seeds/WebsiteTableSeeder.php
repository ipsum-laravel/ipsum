<?php

class WebsiteTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->getConfig() as $config) {
            Config::set('website.'.$config['key'], $config['value']);
        }

    }

    private function getConfig()
    {
        return array(
            array(
                'key' => 'nom_site',
                'value' => 'Ipsum 3',
            ),
            array(
                'key' => 'nom',
                'value' => 'Nom de société',
            ),
            array(
                'key' => 'adresse',
                'value' => 'Adresse',
            ),
            array(
                'key' => 'cp',
                'value' => '97200',
            ),
            array(
                'key' => 'ville',
                'value' => 'Fort-de-France',
            ),
            array(
                'key' => 'telephone',
                'value' => '00 00 00 00 00 00',
            ),
            array(
                'key' => 'gsm',
                'value' => '00 00 00 00 00 00',
            ),
            array(
                'key' => 'fax',
                'value' => '00 00 00 00 00 00',
            ),
            array(
                'key' => 'email',
                'value' => 'email@example.com',
            ),
            array(
                'key' => 'mail_to',
                'value' => 'email@example.com',
            ),
            array(
                'key' => 'mail_objet',
                'value' => 'Contact site Internet',
            ),
            array(
                'key' => 'reply',
                'value' => '',
            ),
            array(
                'key' => 'reply',
                'value' => '',
            ),
        );
    }
}
