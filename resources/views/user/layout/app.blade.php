<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon.png') }}">

    {{-- bootstrap file --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link href="style.css" rel="stylesheet" />
    {{-- bootstrap icon --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    {{-- styles --}}
    <link rel="stylesheet" href="{{ asset('assets/template/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/backtotop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    {{-- title --}}
    <title>{{ $title }}</title>
</head>

<body>
    {{-- pre loader area start --}}
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <svg id="loader">
                    <path id="corners" d="m 0 12.5 l 0 -12.5 l 50 0 l 0 50 l -50 0 l 0 -37.5" />
                </svg>
                <img src="{{ asset('assets/img/brand/umkmplus-loader-logo.svg') }}" alt="umkmplus-logo">
            </div>
        </div>
    </div>
    {{-- pre loader area end --}}

    {{-- back to top start --}}
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    {{-- back to top end --}}

    @include('user.components.navbar')
    @yield('content')
    @include('user.components.footer')

    {{-- scripts --}}
    <script src="{{ asset('assets/template/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/template/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/template/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/template/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/template/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/template/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/template/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/template/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/template/js/backtotop.js') }}"></script>
    <script src="{{ asset('assets/template/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/template/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/template/js/wow.js') }}"></script>
    <script src="{{ asset('assets/template/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/template/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/template/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/template/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- script custom --}}
    @yield('script')
</body>

</html>
