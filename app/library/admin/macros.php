<?php

/**
 * Affiche le menu des rubriques
 *
 */
HTML::macro("rubrique", function($rubrique_active, $views = 'partials.rubrique') {

    $rubriques = Config::get('admin/rubrique');
    
    foreach ($rubriques as $key1 => $groupe) {
        foreach ($groupe as $key => $rubrique) {
            $rubriques[$key1][$key]['selected'] = $rubrique_active == $rubrique['rubrique'] ? 'selected' : '';
        }
    }
    
    return View::make($views, array('rubriques' => $rubriques));
});