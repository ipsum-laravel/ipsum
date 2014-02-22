<?php

// Configuration des menus
return array(
    array(
        'rubrique' => 'actualite',
        'menu' => array(
            array(
                'nom' => 'Actualités',
                'controler' => 'Actualite\Controller_Admin_Actualite',
                'uri' => 'actualite/actualite',
                'smenus' => array(
                    array(
                        'nom' => 'Liste des actualités',
                        'uri' => 'actualite/actualite',
                        'icone' => 'table.png'
                    ),
                    array(
                        'nom' => 'Ajouter une actualité',
                        'uri' => 'actualite/actualite/create',
                        'icone' => 'add.png'
                    ),
                ),      
            ),
            array(
                'nom' => 'test',
                'controler' => 'Actualite\Controller_Admin_Test',
                'uri' => 'actualite/test',     
            ),
        ),
    ),
    array(
        'rubrique' => 'configuration',
        'menu' => array(
            array(
                 'nom' => 'Dashboard',
                'controler' => 'Admin\Controller_Admin',
                'action' => 'index',
                'uri' => 'index',
                'visibility'=> 'hidden',
            ),
            array(
                'nom' => 'Configuration',
                'controler' => 'Admin\Controller_Admin',
                'action' => 'configuration',
                'uri' => 'configuration',
            ),
            array(
                'nom' => 'Paramètres',
                'controler' => 'Admin\Controller_Admin',
                'action' => 'website',
                'uri' => 'website',
                'visibility'=> 'hidden',
            ),
            array(
                'nom' => 'Utilisateurs',
                'controler' => 'Admin\Controller_Admin_User',
                'uri' => 'admin/user',
                'visibility'=> 'hidden',
                'smenus' => array(
                    array(
                        'nom' => 'Liste des utilisateurs',
                        'uri' => 'admin/user',
                        'icone' => 'table.png'
                    ),
                    array(
                        'nom' => 'Ajouter une utilisateur',
                        'uri' => 'admin/user/create',
                        'icone' => 'add.png'
                    ),
                ),
            ),
        ),
        ),
);