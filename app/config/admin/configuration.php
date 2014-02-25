<?php
// TODO : gèrer les accès aux zones
return array(
    array(
        'nom' => 'PARAMETRES SYSTEME',
        'smenus' => array(
            array(
                'nom' => 'Gestion des administrateurs',
                'action' => 'UsersController@index',
            ),
            array(
                'nom' => 'Gestion des paramètres',
                'action' => 'AdminController@getIndex',
            ),
            array(
                'nom' => 'Gestion des erreurs',
                'action' => 'AdminController@getIndex',
            ),
        ),
    ),
    array(
        'nom' => 'GESTION DU SITE',
        'smenus' => array(
            array(
                'nom' => 'Gestion des catégories',
                'action' => 'AdminController@getIndex',
            ),
        ),
    ),
);