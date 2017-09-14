<?php

// Configuration des rubriques
return array(
    'groupe1' => array(
        'article' => array(
            'rubrique' => 'article',
            'nom' => 'Articles',
            'abreviation' => 'Art.',
            'icone' => 'calendrier.png',
            'zone' => 'article',
            'route' => 'admin.article.index',
            'menus' => array(
                'article' => array(
                    'menu' => 'article',
                    'nom' => 'Articles',
                    'route' => 'admin.article.index',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des articles',
                            'route' => 'admin.article.index',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter un article',
                            'route' => 'admin.article.create',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
            ),
        ),
        'configuration' => array(
            'rubrique' => 'configuration',
            'nom' => 'Configuration',
            'abreviation' => 'Config.',
            'icone' => 'parametre.png',
            'zone' => '',
            'route' => 'admin.configuration',
            'menus' => array(
                'dashboard' => array(
                    'menu' => 'dashboard',
                    'nom' => 'Dashboard',
                    'route' => 'admin',
                    'visibility'=> 'hidden',
                ),
                'configuration' => array(
                    'menu' => 'configuration',
                    'nom' => 'Configuration',
                    'route' => 'admin.configuration',
                ),
                'parametre' => array(
                    'menu' => 'parametre',
                    'nom' => 'Paramètres',
                    'route' => 'admin.parametre',
                    'visibility'=> 'hidden',
                ),
                'log' => array(
                    'menu' => 'log',
                    'nom' => 'Fichier de log',
                    'route' => 'admin.log',
                    'visibility'=> 'hidden',
                ),
                'utilisateur' => array(
                    'menu' => 'utilisateur',
                    'nom' => 'Utilisateurs',
                    'route' => 'admin.user',
                    'visibility'=> 'hidden',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des utilisateurs',
                            'route' => 'admin.user',
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une utilisateur',
                            'route' => 'admin.user.create',
                            'icone' => 'add.png'
                        ),
                    ),
                ),
            ),
        ),
    ),
);
