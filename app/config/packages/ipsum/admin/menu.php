<?php

// Configuration des rubriques
return array(
    'groupe1' => array(
        'article' => array(
            'rubrique' => 'article',
            'nom' => 'Articles',
            'abreviation' => 'Art.',
            'icone' => 'page.png',
            'zone' => 'article',
            'url' => route('admin.article.index', ['type' => 'actualite']),
            'menus' => array(
                'actualite' => array(
                    'menu' => 'actualite',
                    'nom' => 'Actualités',
                    'url' => route('admin.article.index', ['type' => 'actualite']),
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des actualités',
                            'url' => route('admin.article.index', ['type' => 'actualite']),
                            'icone' => 'table.png'
                        ),
                        array(
                            'nom' => 'Ajouter une actualité',
                            'url' => route('admin.article.create', ['type' => 'actualite']),
                            'icone' => 'add.png'
                        ),
                    ),
                ),
                'page' => array(
                    'menu' => 'page',
                    'nom' => 'Pages',
                    'url' => route('admin.article.index', ['type' => 'page']),
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des pages',
                            'url' => route('admin.article.index', ['type' => 'page']),
                            'icone' => 'table.png'
                        ),
                    ),
                ),
                'article' => array(
                    'menu' => 'article',
                    'nom' => 'Articles',
                    'route' => 'admin.article.index',
                    'visibility' => 'hidden',
                    'smenus' => array(
                        array(
                            'nom' => 'Liste des articles',
                            'route' => 'admin.article.index',
                            'icone' => 'table.png'
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
