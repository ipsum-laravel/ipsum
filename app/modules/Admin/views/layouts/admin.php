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

    <?= empty($head) ? '' : $head ?>
</head>
<body>
<div id="conteneur">
<div id="conteneur_haut"></div>
    <div id="header">
        <h1><a href="<?= url('/') ?>" title="Retour à la page d'accueil" ><?= e(Config::get('website.nom_site')) ?></a></h1>
        <p class="infos_connect">
            <strong><?= e(Auth::user()->prenom) ?> <?= e(Auth::user()->nom) ?></strong><br />
            <?= e(Auth::user()->role()) ?><br />
            <?= link_to_action('\Ipsum\Admin\Controllers\LoginController@logout', 'Déconnexion') ?>
        </p>
        <div id="rubrique">
            <?= HTML::rubrique($rubrique) ?>
        </div>
    </div><!-- Fin header //-->
    <div id="menu">
        <?= HTML::menu($rubrique, $menu) ?>
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
            <a href="#rubrique" >Haut de page</a> - Administration du site <?= e(Config::get('website.nom_site')) ?>
        </p>
    </div>
    <div id="conteneur_bas"></div>
</div><!-- Fin conteneur //-->
</body>
</html>