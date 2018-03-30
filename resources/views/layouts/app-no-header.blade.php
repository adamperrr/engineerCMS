<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <meta name="keywords" content="{{ $websiteSettings['keywords']['value'] }}">
    <meta name="description" content="{{ $websiteSettings['description']['value'] }}">

    <title>@yield('title') - {{ $websiteSettings['title']['value'] }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('guest-template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('guest-template/css/scrolling-nav.css') }}" rel="stylesheet">

    <!-- Styles  -->
    <link href="{{ asset('css/guest/no-header.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ $websiteSettings['topBarTitle']['value'] }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            @include('components.menus.app-menu')
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class='container main-container'>
    @yield('content')
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">{{ $websiteSettings['footer']['value'] }}</p>
        <hr>
        <p class="m-0 text-center text-white">
            <a class="small" href="{{ route('pages-guest.list-pages') }}">Lista dostępnych stron</a>
            -
            <a class="small" href="{{ route('login') }}">Logowanie</a>
        </p>
    </div>
    <!-- /.container -->
</footer>

<!-- Scripts -->
<script src="{{ asset('guest-template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('guest-template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
