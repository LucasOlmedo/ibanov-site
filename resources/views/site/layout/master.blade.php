<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0;">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicons -->
    <link href="{{ secure_asset('img/favicon.png') }}" rel="icon">
    <link href="{{ secure_asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{('css/font.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ secure_asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ secure_asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('lib/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">

    <!-- Custom CSS Files -->
    @stack('page-css')
</head>
<body>

@include('site.layout.partials.header')

@include('site.layout.partials.intro')

<main id="main">
    @yield('content')
</main>

@include('site.layout.partials.footer')

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- Essential JS -->
<script src="{{ secure_asset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ secure_asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- JavaScript Libraries -->
<script src="{{ secure_asset('lib/jquery/jquery-migrate.min.js') }}"></script>
<script src="{{ secure_asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ secure_asset('lib/superfish/hoverIntent.js') }}"></script>
<script src="{{ secure_asset('lib/superfish/superfish.min.js') }}"></script>
<script src="{{ secure_asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ secure_asset('lib/venobox/venobox.min.js') }}"></script>
<script src="{{ secure_asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Contact Form JavaScript File -->
<script src="{{ secure_asset('js/contactform.js') }}"></script>

<!-- Template Main Javascript File -->
<script src="{{ secure_asset('js/main.js') }}"></script>

<!-- Custom JS Files -->
@stack('page-js')
</body>
</html>
