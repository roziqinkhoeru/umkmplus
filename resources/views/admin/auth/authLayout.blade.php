<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/template/admin/img/icon.ico') }}" type="image/x-icon" />

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

    @yield('authScript')
</body>

</html>
