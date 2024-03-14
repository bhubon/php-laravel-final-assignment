<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JobPulse | Find Your Dream Jobs</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href=" {{ asset('frontend/assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/price_rangs.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href=" {{ asset('frontend/assets/css/style.css') }}">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('frontend') }}/assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="/"><img src="{{ asset('uploads/logo.png') }}" alt="Logo"
                                        width="150px"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="{{ route('frontend.jobs') }}">Find a Jobs </a></li>
                                            <li><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                                            <li><a href="{{ route('frontend.about') }}">About</a></li>
                                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    @if (auth()->check())
                                    <a href="{{ auth()->check() && auth()->user()->role == 'admin' ? '/admin/dashboard' : (auth()->check() && auth()->user()->role == 'company' ? '/company/dashboard' : '/user/dashboard') }}" class="btn head-btn1">Dashboard</a>

                                    @else
                                        <a href="{{ route('register') }}" class="btn head-btn1">Register</a>
                                        <a href="{{ route('login') }}" class="btn head-btn2">Login</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
