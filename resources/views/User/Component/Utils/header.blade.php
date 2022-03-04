<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>RS PKU Muhammadiyah Klaten</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('images/favicon.svg') }}" />

        <!-- Fonts css -->
        <link href="{{asset('css/fonts2.css')}}" rel="stylesheet" />
        <link href="{{asset('css/fonts3.css')}}" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
        <!-- LineIcons css -->
        <link rel="stylesheet" href="{{asset('css/LineIcons.2.0.css')}}" />
        <!-- Animate css -->
        <link rel="stylesheet" href="{{asset('css/animate.css')}}" />
        <!-- Tiny-slider css -->
        <link rel="stylesheet" href="{{asset('css/tiny-slider.css')}}" />
        <link rel="stylesheet" href="{{asset('css/glightbox.css')}}" />
        <!-- Main css -->
        <link rel="stylesheet" href="{{asset('css/main.css')}}" />
        <!-- Detail css -->
        <link rel="stylesheet" href="{{asset('css/detail.css')}}" />
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    </head>
    <body>
        <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <header class="header navbar-area style2">
            <div class="top-bar">
                <div class="container">
                    <div class="inner-topbar">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="top-contact">
                                    <ul>
                                        @foreach($global as $desc)
                                          @if($desc -> name === 'email')
                                            <li><i class="lni lni-envelope"></i><a href="mailto:{{$desc -> description}}">{{$desc -> description}}</a></li>
                                          @elseif($desc -> name === 'telp')
                                            <li><i class="lni lni-phone"></i> <a class="color" href="tel:{{$desc -> description}}">{{$desc -> description}}</a> </li>
                                          @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="right-content">
                                    <div class="login-button">
                                        <ul>
                                            <li>
                                                <a href="/login"><i class="lni lni-enter"></i> Login</a>
                                            </li>
                                            <li>
                                                <a href="/signup"><i class="lni lni-user"></i> Register</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="top-social">
                                        <ul>
                                            @foreach($social_global as $desc)
                                              <li><a href="{{$desc -> description}}"><i class="lni lni-{{$desc -> name}}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="nav-inner">

                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="/">
                                    <img src="/images/logo/logo.svg" alt="Logo">
                                </a>
                                <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul id="nav" class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/pelayanan-kami">Services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/dokter-kami">Doctors</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/blog-kami">Our Blog</a>
                                            <!-- <a class="page-scroll dd-menu collapsed" href="javascript:void(0)"
                                                data-bs-toggle="collapse" data-bs-target="#submenu-1-5"
                                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                                aria-label="Toggle navigation">Our Blog</a> -->
                                        </li>
                                        <li class="nav-item">
                                            <a href="/kontak" aria-label="Toggle navigation">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="button add-list-button">
                                    <a href="/buat-janji-temu" class="btn">Book Appointment</a>
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </header>


        <a href="#" class="scroll-top">
            <i class="lni lni-chevron-up"></i>
        </a>
