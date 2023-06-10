<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="description"
        content="Website UMKMPlus. Pelajari keterampilan bisnis berharga dengan kursus komprehensif kami. Tingkatkan karier Anda dan tingkatkan pengetahuan bisnis Anda, hanya di UMKMPlus">
    <meta name="keywords"
        content="business courses, business academy, career development, business skills, kursus bisnis, akademi bisnis, pengembangan karier, keterampilan bisnis, umkmplus, umkm">
    <meta name="author" content="UMKMPlus">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="UMKMPlus - Learn Valuable Business Skills">
    <meta property="og:description"
        content="Tingkatkan karier Anda dan tingkatkan pengetahuan bisnis Anda dengan kursus komprehensif kami.">
    <meta property="og:image" content="{{ asset('assets/icon/apple-touch-icon.png') }}">
    <meta property="og:url" content="https://www.umkmplus.site">

    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    {{-- apple touch icon --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/icon/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/icon/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/icon/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/icon/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/icon/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/icon/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/icon/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon/apple-touch-icon-180x180.png') }}">

    {{-- android touch icon --}}
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon/android_192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon/android_32.png') }}">
    <link rel="icon" type="image/png" sizes="100x100" href="{{ asset('assets/icon/android_100.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icon/android_16.png') }}">

    {{-- manifest --}}
    {{-- <link rel="manifest" href="{{ asset('assets/img/brand/manifest.json') }}"> --}}

    {{-- microsoft touch icon --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/icon/apple-touch-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- Fonts and icons --}}
    <script src="{{ asset('assets/template/admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('assets/template/admin/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/template/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/admin/css/atlantis.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
</head>

<body class="login">
    <main class="wrapper wrapper-login wrapper-login-full p-0">
        {{-- left container --}}
        <section
            class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
            <div class="d-flex justify-content-center mb-4">
                <figure class="auth-image-wrapper">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}" alt="umkmplus-letter-logo">
                    </a>
                </figure>
            </div>
            <h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1>
            <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
        </section>

        {{-- auth container --}}
        <section class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
            @yield('authContent')
        </section>
    </main>
    <script src="{{ asset('assets/template/admin/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/atlantis.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('authScript')
</body>

</html>
