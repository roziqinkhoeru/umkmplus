<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('assets/template/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/admin/css/atlantis.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/template/admin/css/demo.css') }}"> --}}
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            {{-- Logo Header --}}
            @include('admin.components.headerLogo')
            {{-- End Logo Header --}}

            {{-- Navbar Header --}}
            <nav class="navbar navbar-header navbar-expand-lg"
                data-background-color="@php
if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1) {
            echo 'blue2';
        } elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2) {
            echo 'purple2';
        } @endphp">
                @include('admin.components.navbar')
            </nav>
            {{-- End Navbar --}}
        </div>

        {{-- Sidebar --}}
        <div class="sidebar sidebar-style-2"
            data-color="@php
if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1) {
                    echo 'blue';
                } elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2) {
                    echo 'purple';
                } @endphp">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                @include('admin.components.sidebar')
            </div>
        </div>
        {{-- End Sidebar --}}

        {{-- main content --}}
        <div class="main-panel">
            @yield('content')
            @include('admin.components.footer')
        </div>
        {{-- end main content --}}
    </div>

    {{-- Core JS Files --}}
    <script src="{{ asset('assets/template/admin/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/core/bootstrap.min.js') }}"></script>

    {{-- jQuery UI --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}">
    </script>

    {{-- jQuery Scrollbar --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    {{-- Moment JS --}}
    <script src="{{ asset('assets/template/admin/js/plugin/moment/moment.min.js') }}"></script>

    {{-- Chart JS --}}
    <script src="{{ asset('assets/template/admin/js/plugin/chart.js/chart.min.js') }}"></script>

    {{-- jQuery Sparkline --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    {{-- Chart Circle --}}
    <script src="{{ asset('assets/template/admin/js/plugin/chart-circle/circles.min.js') }}"></script>

    {{-- Datatables --}}
    <script src="{{ asset('assets/template/admin/js/plugin/datatables/datatables.min.js') }}"></script>

    {{-- Bootstrap Notify --}}
    <script src="{{ asset('assets/template/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    {{-- Bootstrap Toggle --}}
    <script src="{{ asset('assets/template/admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    {{-- jQuery Vector Maps --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    {{-- Google Maps Plugin --}}
    <script src="{{ asset('assets/template/admin/js/plugin/gmaps/gmaps.js') }}"></script>

    {{-- Dropzone --}}
    <script src="{{ asset('assets/template/admin/js/plugin/dropzone/dropzone.min.js') }}"></script>

    {{-- Fullcalendar --}}
    <script src="{{ asset('assets/template/admin/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

    {{-- DateTimePicker --}}
    <script src="{{ asset('assets/template/admin/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    {{-- Bootstrap Tagsinput --}}
    <script src="{{ asset('assets/template/admin/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    {{-- Bootstrap Wizard --}}
    <script src="{{ asset('assets/template/admin/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

    {{-- jQuery Validation --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    {{-- Summernote --}}
    <script src="{{ asset('assets/template/admin/js/plugin/summernote/summernote-bs4.min.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('assets/template/admin/js/plugin/select2/select2.full.min.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="{{ asset('assets/template/admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    {{-- Owl Carousel --}}
    <script src="{{ asset('assets/template/admin/js/plugin/owl-carousel/owl.carousel.min.js') }}"></script>

    {{-- Magnific Popup --}}
    <script src="{{ asset('assets/template/admin/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js') }}">
    </script>

    {{-- Atlantis JS --}}
    <script src="{{ asset('assets/template/admin/js/atlantis.min.js') }}"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    {{-- <script src="{{ asset('assets/template/admin/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/template/admin/js/demo.js') }}"></script> --}}
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include CKEditor scripts and styles -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

    @yield('script')
</body>

</html>
