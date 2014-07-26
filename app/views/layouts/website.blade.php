<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="iso-8859-15">
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/knacss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    @yield('head')
    <title>
        @yield('title')
        - {{{ Config::get('IpsumCore::website.nom_site') }}}
    </title>
</head>
<body>
    <div class="conteneur center">
        <header role="banner" class="header line pam mbs">
            <div class="header-logo"><a href="index.php" title="Retour à la page d'accueil" ><img src="{{ asset('assets/img/logo-pixell.gif') }}" width="200" alt="logo"></a></div>
            <p class="header-slogan">Le meilleur site du web</p>
        </header><!-- Fin header //-->

        <nav role="navigation" class="menu mbs">
            <ul class="line">
                <li class="inbl {{ Request::is('/') ? 'lien_actif' : '' }}" ><a href="{{ route('home') }}">Accueil</a></li>
                <li class="inbl {{ Request::is('actualite*') ? 'lien_actif' : '' }}" ><a href="{{ route('actualite') }}">Actualités</a></li>
                <li class="inbl {{ Request::is('produit*') ? 'lien_actif' : '' }}" ><a href="#">Produits</a></li>
                <li class="inbl {{ Request::is('panier*') ? 'lien_actif' : '' }}" ><a href="#">Panier</a></li>
                <li class="inbl {{ Request::is('compte*') ? 'lien_actif' : '' }}" ><a href="#">Mon compte</a></li>
                <li class="inbl {{ Request::is('menu3*') ? 'lien_actif' : '' }}" ><a href="#">menu3</a></li>
                <li class="inbl {{ Request::is('menu4*') ? 'lien_actif' : '' }}" ><a href="#">menu4</a></li>
                <li class="inbl {{ Request::is('contact*') ? 'lien_actif' : '' }}" ><a href="{{ route('contact.index') }}">Contact</a></li>
            </ul>
        </nav>

        <aside class="menu mod right w30 mls pam">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
             </p>
        </aside>

        <div role="main" class="texte mod mls pam">
            <!--[if lte IE 7]><div class="messages warning""><p>Nous avons détecté que vous utilisez IE7 (ou une version antérieure).<br/>Ce site ne s'affichera pas correctement car cette version est dépassée. Pour une meilleure utilisation du site, nous vous recommandons fortement d'utiliser un des navigateurs suivants  :<br /><a href="http://www.microsoft.com/windows/products/winfamily/ie/default.mspx">Internet Explorer</a> <a href="http://www.apple.com/safari/">Safari</a> <a href="http://www.google.com/chrome/">Google Chrome</a> <a href="http://www.mozilla.com/firefox/">Firefox</a> <a href="http://www.opera.com/download/">Opera</a></p></div> <![endif]-->
            @yield('content')
        </div>

        <footer role="contentinfo" class="footer line pam txtcenter">
            <p><a href="{{ url('mentions-legales') }}" >Mentions légales</a> - Réalisé, hébergé et référencé par <a href="http://www.pixellweb.com"><img src="{{ asset('assets/img/logo-pixell.gif') }}" alt="logo pixell"></a></p>
        </footer>
    </div><!-- Fin conteneur //-->
    @yield('script')
</body>
</html>