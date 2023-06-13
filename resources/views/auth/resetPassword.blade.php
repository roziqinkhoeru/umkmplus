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
                            <a href="/"><img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}"
                                    alt="umkmplus-logo" style="margin-bottom: 30px; width: 200px; margin-top: 30px"></a>
                            <h2 class="section__title">Reset Password</h2>
                            <p>Masukkan kata sandi baru Anda</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            <div class="sign__form">
                                <form action="{{ url('reset-password') }}" method="POST" id="resetPasswordForm">
                                    @csrf
                                    <input hidden type="text" name="token" id="token" value="{{ $token }}">
                                    <input hidden type="email" name="email" id="email" value="{{ $email }}">
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="password">
                                            <h5>Password Baru</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock icon-form"></i>
                                            <div class="toggle-eye-wrapper-new"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan password baru" name="password"
                                                id="password" required value="" class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-32">
                                        <label for="password_confirmation">
                                            <h5>Konfirmasi Password Baru</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock-keyhole icon-form"></i>
                                            <div class="toggle-eye-wrapper-confirm-new"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan Konfirmasi Password Baru"
                                                name="password_confirmation" id="password_confirmation" required
                                                value="" class="input-form">
                                        </div>
                                    </div>
                                    <button type="submit" class="tp-btn w-100 rounded-pill" id="resetPasswordButton">Reset
                                        password</button>
                                    <div class="sign__new text-center mt-20">
                                        <p>Mengalami kesulitan? Hubungi<a href="#"> kami</a></p>
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
        $("#resetPasswordForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                },
            },
            messages: {
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password minimal 8 karakter',
                    pattern: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password harus mengandung huruf dan angka',
                },
                password_confirmation: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password minimal 8 karakter',
                    equalTo: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password tidak sama',
                },
            },
            submitHandler: function(form) {
                $('#resetPasswordButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#resetPasswordButton').prop('disabled', true);
                $.ajax({
                    url: "{{ route('resetPassword') }}",
                    type: "POST",
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                        token: $('#token').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#resetPasswordButton').html('Reset password');
                        $('#resetPasswordButton').prop('disabled', false);
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        $('#resetPasswordButton').html('Reset password');
                        $('#resetPasswordButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'RESET PASSWORD GAGAL!',
                                text: xhr.responseJSON.meta.message,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'RESET PASSWORD GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    }
                });
            }
        });

        // toggle-eye-wrapper
        $('.toggle-eye-wrapper-new').click(function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('.toggle-eye-wrapper-new').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#password').attr('type', 'password');
                $('.toggle-eye-wrapper-new').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
        $('.toggle-eye-wrapper-confirm-new').click(function() {
            if ($('#password_confirmation').attr('type') == 'password') {
                $('#password_confirmation').attr('type', 'text');
                $('.toggle-eye-wrapper-confirm-new').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#password_confirmation').attr('type', 'password');
                $('.toggle-eye-wrapper-confirm-new').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
    </script>
@endsection
