<?php

return array(
    array(
        'nom' => 'PARAMETRES SYSTEME',
        'smenus' => array(
            array(
                'nom' => 'Gestion des administrateurs',
                'action' => '\Ipsum\Admin\Controllers\UsersController@index',
            ),
            array(
                'nom' => 'Gestion des paramètres',
                'action' => '\Ipsum\Admin\Controllers\ConfigController@index',
                'zone' => 'admin',
            ),
            array(
                'nom' => 'Gestion des erreurs',
                'action' => '\Ipsum\Admin\Controllers\LogController@log',
                'zone' => 'superAdmin',
            ),
        ),
    ),
    array(
        'nom' => 'GESTION DU SITE',
        'zone' => '',
        'smenus' => array(
            array(
                'nom' => 'Gestion des catégories',
                'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
                'zone' => 'categorie',
            ),
        ),
    ),
);