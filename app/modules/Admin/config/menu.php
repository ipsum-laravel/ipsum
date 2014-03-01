<?php

// Configuration des rubriques
return array(
    array(
        'actualite' => array(
            'rubrique' => 'actualite',
            'nom' => 'Actualités',
            'abreviation' => 'Actu.',
            'icone' => 'calendrier.png',
            'zone' => 'actualite',
            'action' => '\Ipsum\Actualite\Controllers\AdminController@index',
            'menus' => array(
                'actualite' => array(
                    'menu' => 'actualite',
                    'nom' => 'Actualités',
                    'action' => '\Ipsum\Actualite\Controllers\AdminController@index',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des actualités',
                            'action' => '\Ipsum\Actualite\Controllers\AdminController@index',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une actualité',
                            'action' => '\Ipsum\Actualite\Controllers\AdminController@create',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
                'test' => array(
                    'menu' => 'test',
                    'nom' => 'test',
                    'action' => '\Ipsum\Actualite\Controllers\AdminController@index',
                ),
            ),
        ),
        'configuration' => array(
            'rubrique' => 'configuration',
            'nom' => 'Configuration',
            'abreviation' => 'Config.',
            'icone' => 'parametre.png',
            'zone' => '',
            'action' => '\Ipsum\Admin\Controllers\BaseController@configuration',
            'menus' => array(
                'dashboard' => array(
                    'menu' => 'dashboard',
                    'nom' => 'Dashboard',
                    'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
                    'visibility'=> 'hidden',
                ),
                'configuration' => array(
                    'menu' => 'configuration',
                    'nom' => 'Configuration',
                    'action' => '\Ipsum\Admin\Controllers\BaseController@configuration',
                ),
                'parametre' => array(
                    'menu' => 'parametre',
                    'nom' => 'Paramètres',
                    'action' => '\Ipsum\Admin\Controllers\BaseController@getIndex',
                    'visibility'=> 'hidden',
                ),
                'utilisateur' => array(
                    'menu' => 'utilisateur',
                    'nom' => 'Utilisateurs',
                    'action' => '\Ipsum\Admin\Controllers\UsersController@index',
                    'visibility'=> 'hidden',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des utilisateurs',
                            'action' => '\Ipsum\Admin\Controllers\UsersController@index',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une utilisateur',
                            'action' => '\Ipsum\Admin\Controllers\UsersController@create',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
            ),
        ),
    ),
);
