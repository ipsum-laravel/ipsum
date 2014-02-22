<?php

// Configuration des rubriques
return array(
    array(
        array(
            'rubrique' => 'actualite',
            'nom' => 'Actualités',
            'abreviation' => 'Actu.',
            'icone' => 'calendrier.png',
            'droit' => 'actualite',
            'action' => 'ActualiteController@index',
        ),
        array(
            'rubrique' => 'configuration',
            'nom' => 'Configuration',
            'abreviation' => 'Config.',
            'icone' => 'parametre.png',
            'droit' => '',
            'action' => 'AdminController@configuration',
        ),
    ),
);
