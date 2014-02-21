<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Design & Integration xhtml/css B1nj.fr -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administration <?php //TODO : echo \Config::get('website.nom_site');?> :: <?= $title ?></title>
    <meta name="robots" content="noindex, nofollow" />
    <link href="<?php echo asset('assets/admin/css/admin_accueil.css'); ?>" rel="stylesheet">
</head>

<body>   
    <div id="conteneur">
    <div id="conteneur_haut"></div>
        <h1>
            <img src="<?php echo asset('assets/admin/img/logo_login.jpg'); ?>" alt="Administration" />
            <span>ADMINISTRATION</span>
        </h1>
        
        <?php echo $content; ?>

        <div id="conteneur_bas"></div>
    </div>
</body>
</html>