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

/**
 * Affiche le menu
 *
 */
HTML::macro("menu", function($views = 'partials.menu') {

    $menus = Config::get('admin/module');
    var_dump($menus); die();

    $controleur = strstr(Route::currentRouteAction(), '@', true);

    foreach ($menus as $key1 => $menu) {
        if (
            !(isset($menu['visibility']) and $menu['visibility'] == 'hidden')
            or (
                $controleur == $menu['controleur']
                and (!isset($menu['action']) or Route::currentRouteAction() == $menu['action']))
            ) {
            $menu2 = $menu;
            $menu2['selected'] = ($controleur == $menu['controleur'] and (!isset($menu['action']) or Route::currentRouteAction() == $menu['action'])) ? 'selected' : '';
            $menu2['uri'] = 'admin/'.$menu['uri'];
            if (isset($menu['smenus'])) {
                foreach ($menu['smenus'] as $key => $smenu) {
                    $menu2['smenus'][$key]['uri'] = 'admin/'.$smenu['uri'];
                }
            }
            $menus2[] = $menu2;
        }
    }

    return View::make($views, array('menus' => $menus2));
});