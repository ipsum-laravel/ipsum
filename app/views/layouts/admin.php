<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <title>Administration :: <?= $title ?></title>
    <meta name="robots" content="noindex, nofollow" />
    <link href="<?= asset('assets/admin/css/admin.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?= asset('assets/admin/css/admin_print.css') ?>" type="text/css" rel="stylesheet" media="print" />
    
    <!--    Librairie javascript //-->
    <script type="text/javascript" src="<?= asset('assets/admin/js/jquery-1.5.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('assets/admin/js/admin.js') ?>"></script>

    <?php if (!empty($head)) echo $head; ?>
</head>
<body>
<div id="conteneur">
<div id="conteneur_haut"></div>
    <div id="header">
        <h1><a href="<?php echo asset('/') ?>" title="Retour à la page d'accueil" ><?= e(Config::get('settings.nom_site')) ?></a></h1>
        <p class="infos_connect"><strong><?= e(Auth::user()->prenom) ?> <?= e(Auth::user()->nom) ?></strong><br /><?= link_to_action('AdminController@logout', 'Déconnexion') ?></p>
        <?= HTML::rubrique($rubrique) ?>
         
    </div><!-- Fin header //-->

    <div id="menu">
        <?php /*foreach ($menus as $menu) : ?>
        <div class="menu <?php echo $menu['selected'] ?>">
            <div class="onglet"><a href="<?php echo Uri::create($menu['uri']) ?>"><?php echo $menu['nom'] ?></a></div>
            <?php if(!empty($menu['smenus'])) : ?>
            <ul>
                <?php foreach ($menu['smenus'] as $smenu) : ?>
                <li><?php echo Asset::img($smenu['icone'], array('alt' => $smenu['nom'])) ?><a href="<?php echo Uri::create($smenu['uri']) ?>" ><?php echo $smenu['nom'] ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif ?>
        </div>
        <?php endforeach;*/ ?>
    </div>
    <div id="texte">
        <!--[if lte IE 7]><div class="attention"><p>Nous avons détecté que vous utilisez IE7 (ou une version antérieure).<br/>Ce site ne s'affichera pas correctement car cette version est dépassée. Pour une meilleure utilisation du site, nous vous recommandons fortement d'utiliser un des navigateurs suivants  :<br /><a href="http://www.microsoft.com/windows/products/winfamily/ie/default.mspx">Internet Explorer</a> <a href="http://www.apple.com/safari/">Safari</a> <a href="http://www.google.com/chrome/">Google Chrome</a> <a href="http://www.mozilla.com/firefox/">Firefox</a> <a href="http://www.opera.com/download/">Opera</a></p></div> <![endif]-->
        <?= HTML::notifications($errors) ?>
        <?= $content; ?>

    </div><!-- Fin texte //-->
    <div id="footer">
       <p id="pixell">
          Ipsum
       </p>
        <p>
            <a href="#rubrique" >Haut de page</a> - Administration du site <?= e(Config::get('settings.nom_site')) ?>
        </p>
    </div>
    <div id="conteneur_bas"></div>
</div><!-- Fin conteneur //-->
</body>
</html>
