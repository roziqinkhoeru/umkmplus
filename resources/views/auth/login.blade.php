@extends('auth.layout')

@section('authContent')
    {{-- main content --}}
    <main>
        <!-- sign up area start -->
        <section class="signup__area p-relative z-index-1 pb-145" style="padding-top: {{ $ptSection }}">
            <div class="sign__shape">
                <img class="man-1" src="{{ asset('assets/img/decoration/man-1.png') }}" alt="decoration-man-1">
                <img class="man-2" src="{{ asset('assets/img/decoration/man-2.png') }}" alt="decoration-man-2">
                <img class="circle" src="{{ asset('assets/img/decoration/circle.png') }}" alt="decoration-circle">
                <img class="zigzag" src="{{ asset('assets/img/decoration/zigzag.png') }}" alt="decoration-zigzag">
                <img class="dot" src="{{ asset('assets/img/decoration/dot.png') }}" alt="decoration-dot">
                <img class="bg" src="{{ asset('assets/img/decoration/sign-up.png') }}" alt="decoration-sign-up">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center" style="margin-bottom: 44px">
                            <a href="{{ route('dashboard') }}"><img
                                    src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}" alt="umkmplus-logo"
                                    style="margin-bottom: 30px; width: 200px; margin-top: 30px"></a>
                            <h2 class="section__title mb-2">Masuk ke Akun Anda</h2>
                            <p>Belajar dengan seru di UMKMPlus bersama para praktisi kami</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            <div class="sign__header mb-25">
                                <div class="sign__in text-center">
                                    <a href="{{ route('google.redirect') }}" class="sign__social g-plus text-start mb-15"><i
                                            class="fab fa-google-plus-g"></i>Login with
                                        Google</a>
                                    <p>OR</p>
                                </div>
                            </div>
                            <div class="sign__form">
                                <form action="{{ url('login') }}" method="POST" id="loginForm">
                                    @csrf
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="username">
                                            <h5>Username</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-user icon-form"></i>
                                            <input type="text" placeholder="Masukan username" name="username"
                                                id="username" required value="" class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-15">
                                        <label for="password">
                                            <h5>Kata Sandi</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock icon-form"></i>
                                            <div class="toggle-eye-wrapper"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan kata sandi" value=""
                                                name="password" id="password" class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__action d-sm-flex justify-content-between mb-30">
                                        <div class="sign__agree d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" id="m-agree" />
                                            <label class="m-check-label" for="m-agree">Ingat saya
                                            </label>
                                        </div>
                                        <div class="sign__forgot">
                                            <a href="{{ route('forgotPassword') }}">Lupa kata sandi?</a>
                                        </div>
                                    </div>
                                    <button id="loginButton" class="tp-btn w-100 rounded-pill">Masuk</button>
                                    <div class="sign__new text-center mt-20">
                                        <p>Belum Punya Akun? <a href="{{ route('register') }}">Daftar disini!</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->
    </main>
@endsection

@section('script')
    <script>
        // validate form
        $("#loginForm").validate({
            rules: {
                username: {
                    required: true,
                },
                password: {
                    required: true,
                }
            },
            messages: {
                username: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username tidak boleh kosong',
                },
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi tidak boleh kosong',
                }
            },
            submitHandler: function(form) {
                $('#loginButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#loginButton').prop('disabled', true);
                $.ajax({
                    url: "{{ url('login') }}",
                    type: "POST",
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#loginButton').html('Masuk');
                        $('#loginButton').prop('disabled', false);
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        $('#loginButton').html('Masuk');
                        $('#loginButton').prop('disabled', false);
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message == "CSRF token mismatch.") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'LOGIN GAGAL!',
                                    text: "Mohon maaf username/password Anda tidak sesuai",
                                })
                                location.reload()
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'LOGIN GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'LOGIN GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        }
                        return false;
                    }
                });
            }
        });

        // toggle-eye-wrapper
        $('.toggle-eye-wrapper').click(function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('.toggle-eye-wrapper').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#password').attr('type', 'password');
                $('.toggle-eye-wrapper').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
    </script>
@endsection
