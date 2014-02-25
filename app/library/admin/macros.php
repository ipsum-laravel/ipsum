<?php

/**
 * Affiche le menu des rubriques
 *
 */
HTML::macro("rubrique", function($rubrique_active, $views = 'partials.rubrique') {

    $rubriques = Config::get('admin/menu');

    foreach ($rubriques as $key1 => $groupe) {
        foreach ($groupe as $key => $rubrique) {
            $rubriques[$key1][$key]['selected'] = $rubrique_active == $rubrique['rubrique'] ? 'selected' : '';
        }
    }
    // Use render http://www.laravel-tricks.com/tricks/avoid-string-viewmake
    return View::make($views, array('rubriques' => $rubriques));
});

/**
 * Affiche le menu
 *
 */
HTML::macro("menu", function($rubrique_active, $menu_actif, $views = 'partials.menu') {
    
    $rubriques = Config::get('admin/menu');
    
    $datas = array();
    foreach ($rubriques as $key => $groupe) {
        if(isset($groupe[$rubrique_active])) {
            foreach ($groupe[$rubrique_active]['menus'] as $key => $menu) {
                if ( ! (isset($menu['visibility']) and $menu['visibility'] == 'hidden') or $menu_actif == $key) {
                    $menu['selected'] = $menu_actif == $key ? 'selected' : '';                    
                    $datas[] = $menu;
                }
            }
            break;
        }
    }
    // Use render http://www.laravel-tricks.com/tricks/avoid-string-viewmake
    return View::make($views, array('menus' => $datas))->render();
});