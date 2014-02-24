<?php

// Configuration des menus
return array(
    'actualite' => array(
        'rubrique' => 'actualite',
        'menu' => array(
            array(
                'nom' => 'Actualités',
                'controleur' => 'actualiteController',
                'action' => 'actualiteController@index',
                'smenus' => array(
                    array(
                        'nom' => 'Liste des actualités',
                        'action' => 'actualiteController@index',
                        'icone' => 'table.png'
                    ),
                    array(
                        'nom' => 'Ajouter une actualité',
                        'action' => 'actualiteController@create',
                        'icone' => 'add.png'
                    ),
                ),
            ),
            array(
                'nom' => 'test',
                'controleur' => 'testController',
                'action' => 'testController@index',
            ),
        ),
    ),
    'configuration' => array(
        'rubrique' => 'configuration',
        'menu' => array(
            array(
                 'nom' => 'Dashboard',
                'controleur' => 'adminController',
                'action' => 'adminController@index',
                'visibility'=> 'hidden',
            ),
            array(
                'nom' => 'Configuration',
                'controleur' => 'adminController',
                'action' => 'adminController@configuration',
            ),
            array(
                'nom' => 'Paramètres',
                'controleur' => 'parametreController',
                'action' => 'parametreController@index',
                'visibility'=> 'hidden',
            ),
            array(
                'nom' => 'Utilisateurs',
                'controleur' => 'userController',
                'action' => 'userController@index',
                'visibility'=> 'hidden',
                'smenus' => array(
                    array(
                        'nom' => 'Liste des utilisateurs',
                        'action' => 'userController@index',
                        'icone' => 'table.png'
                    ),
                    array(
                        'nom' => 'Ajouter une utilisateur',
                        'action' => 'userController@create',
                        'icone' => 'add.png'
                    ),
                ),
            ),
        ),
        ),
);