<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield('head')
    <title>@yield('title') - {{{ Config::get('IpsumCore::website.nom_site') }}}</title>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{{ Config::get('app.analytics_id') }}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{{ Config::get('app.analytics_id') }}}');
    </script>
</head>
<body>
    <div class="conteneur center">
        <header role="banner" class="header line pam mbs">
            <div class="header-logo"><a href="{{ route('home') }}" title="Retour à la page d'accueil" ><img src="{{ asset('packages/ipsum/admin/img/logo-pixell.gif') }}" width="200" alt="logo"></a></div>
            <p class="header-slogan">Le meilleur site du web</p>
        </header>

        <nav role="navigation" class="menu mbs">
            <ul class="line">
                <li class="inbl {{ Request::is('/') ? 'lien_actif' : '' }}" ><a href="{{ route('home') }}">Accueil</a></li>
                <li class="inbl {{ Request::is('page1') ? 'lien_actif' : '' }}" ><a href="{{ url('page1') }}">Page 1</a></li>
                <li class="inbl {{ Request::is('page2') ? 'lien_actif' : '' }}" ><a href="{{ url('page2') }}">Page 2</a></li>
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
