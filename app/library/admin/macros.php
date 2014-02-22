<?php

/**
 * Affiche le menu des rubriques
 *
 */
HTML::macro("rubrique", function($views = 'partials.rubrique') {

    $rubriques = Config::get('admin/rubrique');
    
    foreach ($rubriques as $key1 => $groupe) {
        foreach ($groupe as $key => $rubrique) {
            // TODO : ne pas faire quelques chose d'automatique pour le selected
            $rubriques[$key1][$key]['selected'] = Route::currentRouteAction() == $rubrique['action'] ? 'selected' : '';
        }
    }
    
    return View::make($views, array('rubriques' => $rubriques));
});