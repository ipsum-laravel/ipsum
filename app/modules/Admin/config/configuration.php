<?php
// TODO : gèrer les accès aux zones
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
                'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
            ),
            array(
                'nom' => 'Gestion des erreurs',
                'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
            ),
        ),
    ),
    array(
        'nom' => 'GESTION DU SITE',
        'smenus' => array(
            array(
                'nom' => 'Gestion des catégories',
                'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
            ),
        ),
    ),
);