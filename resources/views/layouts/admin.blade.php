<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

    <title>@yield('title') - EngineerCMS </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ $websiteSettings['topBarTitle']['value'] }} / EngineerCMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @auth
                            @include('components.menus.authorized-menu')
                        @else
                            @include('components.menus.login-menu')
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class='container'>
        @auth
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand">Panel administracyjny</a>
                    </div>
                    <ul class="nav navbar-nav">
                        @if(Auth::user()->hasRole('superadmin') or Auth::user()->hasRole('admin'))
                        <li><a href="{{ route('pages-admin.index') }}">Strony</a></li>
                        <li><a href="{{ route('upload-admin.index') }}">Przechowywane pliki</a></li>
                        <li><a href="{{ route('menu-admin.index') }}">Menu</a></li>
                        <li><a>|</a></li>
                        @endif

                        <li><a href="{{ route('user-settings-admin.index') }}">Ustawienia użytkownika</a></li>

                        @if(Auth::user()->hasRole('superadmin'))
                        <li><a>|</a></li>
                        <li><a href="{{ route('settings-admin.index') }}">Ustawienia strony</a></li>
                        <li><a href="{{ route('users-admin.index') }}">Użytkownicy</a></li>
                        @endif


                    </ul>
                </div>
            </nav>
        @if(Auth::user()->hasRole('superadmin') and $websiteSettings['registrationOpen']['value'] == 1)
            <div class="alert alert-danger">
                <strong>Uwaga!</strong> Możliwość rejestracji jest włączona.
                Nowo zarejestrowani użytkownicy będą mieli rolę gościa.
            </div>
        @endif
        @endauth

        @yield('content')

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
