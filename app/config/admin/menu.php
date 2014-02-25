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
            'action' => 'ActualiteController@index',
            'menus' => array(
                'actualite' => array(
                    'menu' => 'actualite',
                    'nom' => 'Actualités',
                    'action' => 'ActualiteController@index',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des actualités',
                            'action' => 'ActualiteController@index',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une actualité',
                            'action' => 'ActualiteController@create',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
                'test' => array(
                    'menu' => 'test',
                    'nom' => 'test',
                    'action' => 'ActualiteController@index',
                ),
            ),            
        ),
        'configuration' => array(
            'rubrique' => 'configuration',
            'nom' => 'Configuration',
            'abreviation' => 'Config.',
            'icone' => 'parametre.png',
            'zone' => '',
            'action' => 'AdminController@configuration',
            'menus' => array(
                'dashboard' => array(
                    'menu' => 'dashboard',
                    'nom' => 'Dashboard',
                    'action' => 'AdminController@getIndex',
                    'visibility'=> 'hidden',
                ),
                'configuration' => array(
                    'menu' => 'configuration',
                    'nom' => 'Configuration',
                    'action' => 'AdminController@configuration',
                ),
                'parametre' => array(
                    'menu' => 'parametre',
                    'nom' => 'Paramètres',
                    'action' => 'AdminController@getIndex',
                    'visibility'=> 'hidden',
                ),
                'utilisateur' => array(
                    'menu' => 'utilisateur',
                    'nom' => 'Utilisateurs',
                    'action' => 'UsersController@index',
                    'visibility'=> 'hidden',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des utilisateurs',
                            'action' => 'UsersController@index',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une utilisateur',
                            'action' => 'UsersController@index',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
            ),            
        ),
    ),
);
