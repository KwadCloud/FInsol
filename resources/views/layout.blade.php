<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Our mission is to provide exceptional tax consultation services to individuals and businesses, ensuring their financial success and peace of mind. We strive to be a trusted partner, delivering expert guidance, innovative solutions, and personalized attention to every client.">
    @yield('seo')
    <meta name="keywords" content="Finsol, SSK, Sampurna Suvidha Kendra">
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KL5VM9HK');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S3LT0G4S1L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-S3LT0G4S1L');
    </script>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" id="user-style-default">
    <script>
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        userLinkRTL.setAttribute('disabled', true);
    </script>
    <style>
        .card-span .card-span-img {
            border-radius: 1rem;
        }
    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KL5VM9HK" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-standard navbar-expand-lg fixed-top navbar-dark"
            data-navbar-darken-on-scroll="data-navbar-darken-on-scroll">
            <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img class="logoimgwidth"
                        src="{{ asset('assets/img/logos/finsollogo.svg') }}" alt="logo"></a><button
                    class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">

                    <ul class="navbar-nav ms-auto">
                        @if (request()->is('tos'))
                            <li class="nav-item dropdown"><a class="nav-link logincolor" href="#about" role="button"
                                    aria-haspopup="true" aria-expanded="false">About</a>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link logincolor" href="#services" role="button"
                                    aria-haspopup="true" aria-expanded="false">Services</a>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link logincolor" href="#contact" role="button"
                                    aria-haspopup="true" aria-expanded="false">Contact</a>
                            </li>
                        @endif
                        @auth
                            <li class="nav-item dropdown"><a class="nav-link logincolor" href="{{ route('home') }}"
                                    role="button" aria-haspopup="true" aria-expanded="false">Dashboard</a>
                            @else
                            <li class="nav-item dropdown"><a class="nav-link logincolor" href="{{ route('login_page') }}"
                                    role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Footer -->
        <section class="bg-dark pt-8 pb-4" data-bs-theme="light" id="contact">
            <div class="container">
                <div class="position-absolute btn-back-to-top bg-dark"><a class="text-600" href="#banner"
                        data-bs-offset-top="0"><span class="fas fa-chevron-up"
                            data-fa-transform="rotate-45"></span></a>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-uppercase text-white opacity-85 mb-3">Our Mission</h5>
                        <p class="text-600">Our mission is to provide exceptional tax consultation services to
                            individuals and
                            businesses, ensuring their financial success and peace of mind. We strive to be a trusted
                            partner,
                            delivering expert guidance, innovative solutions, and personalized attention to every
                            client. </p>
                    </div>
                    <div class="col-md-8">
                        <div class="row mt-5 mt-lg-0">
                            <div class="col-md-3">
                                <h5 class="text-uppercase text-white opacity-85 mb-3">Read About</h5>
                                <ul class="list-unstyled">

                                    <li class="mb-1"><a class="link-600" href="{{ route('tos') }}">Terms of
                                            Services</a></li>
                                    <li class="mb-1"><a class="link-600" href="{{ url('/#faqs') }}">FAQs</a></li>
                                    <li class="mb-1"><a class="link-600" href="{{ route('refund') }}">Refund
                                            Policy</a></li>
                                    <li class="mb-1"><a class="link-600" href="{{ route('privacy') }}">Privacy
                                            Policy</a></li>

                                </ul>
                            </div>
                            <div class="col-md-9">
                                <h5 class="text-uppercase text-white opacity-85 mb-3">Contact</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-white opacity-85 mb-3">Headquater</h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1">
                                                <a class="link-600" href="mailto:contact@sampurnasuvidhakendra.com">
                                                    contact@sampurnasuvidhakendra.com
                                                </a>
                                            </li>
                                            <li class="mb-1"><a class="link-600" href="#!">+91 - 6203324932</a></li>
                                            <li class="mb-1"><a class="link-600" href="#!">+91 - 8709476161</a></li>
                                            <li class="mb-1"><a class="link-600" href="#!">101, Raj Krishna Apartment,
                                                    East Boring canal road, Near Raja Pul( near PNB ), Patna 800001</a></li>
        
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-white opacity-85 mb-3">Corporate</h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1">
                                                <a class="link-600" href="#!">
                                                    Crystel Apartment, 3rd Floor, C/19/3,
                                                    Nawada Extension, Utam Nagar, New Delhi 110059
                                                </a>
                                            </li>        
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>

        <section class="py-0 bg-dark" data-bs-theme="light">
            <div>
                <hr class="my-0 text-600 opacity-25" />
                <div class="container py-3">
                    <div class="row justify-content-between fs--1">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">Designed and Developed by <a
                                    class="text-white opacity-85" href="#">Kwad</a><span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2024 &copy; <a
                                    class="text-white opacity-85" href="#">Finsol</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">v1.0.0</p>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!--End Footer-->

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>

</html>
