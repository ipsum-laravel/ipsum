<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/knacss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield('head')
    <title>@yield('title') - {{{ Config::get('IpsumCore::website.nom_site') }}}</title>
</head>
<body>
    <div class="conteneur center">
        <header role="banner" class="header line pam mbs">
            <div class="header-logo"><a href="{{ route('home') }}" title="Retour à la page d'accueil" ><img src="{{ asset('assets/img/logo-pixell.gif') }}" width="200" alt="logo"></a></div>
            <p class="header-slogan">Le meilleur site du web</p>
        </header>

        <nav role="navigation" class="menu mbs">
            <ul class="line">
                <li class="inbl {{ Request::is('/') ? 'lien_actif' : '' }}" ><a href="{{ route('home') }}">Accueil</a></li>
                <li class="inbl {{ Request::is('menu3*') ? 'lien_actif' : '' }}" ><a href="#">menu3</a></li>
                <li class="inbl {{ Request::is('menu4*') ? 'lien_actif' : '' }}" ><a href="#">menu4</a></li>
                <li class="inbl {{ Request::is('contact*') ? 'lien_actif' : '' }}" ><a href="{{ route('contact.index') }}">Contact</a></li>
            </ul>
        </nav>

        <aside class="menu mod right w30 mls pam">
            <p>
                Lorem ipsum dolor sit amet, <strong>consectetur adipisicing</strong> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </aside>

        <div role="main" class="texte mod mls pam">
            @yield('content')
        </div>

        <footer role="contentinfo" class="footer line pam txtcenter">
            <p><a href="{{ url('mentions-legales') }}" >Mentions légales</a> - <a href="http://www.pixellweb.com" title="Réalisé, hébergé et référencé par Pixell"><img src="{{ asset('assets/img/logo-pixell.gif') }}" alt="logo Pixell"></a></p>
        </footer>
    </div>
    @yield('script')
</body>
</html>