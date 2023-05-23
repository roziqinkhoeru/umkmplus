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
                                <form action="#" id="resetPasswordForm">
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="newPassword">
                                            <h5>Password Baru</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock icon-form"></i>
                                            <div class="toggle-eye-wrapper-new"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan password baru" name="newPassword"
                                                id="newPassword" required value="" class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-32">
                                        <label for="confirmNewPassword">
                                            <h5>Konfirmasi Password Baru</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock-keyhole icon-form"></i>
                                            <div class="toggle-eye-wrapper-confirm-new"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan Konfirmasi Password Baru"
                                                name="confirmNewPassword" id="confirmNewPassword" required value=""
                                                class="input-form">
                                        </div>
                                    </div>
                                    <button class="tp-btn w-100 rounded-pill">Reset password</button>
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
                newPassword: {
                    required: true,
                    minlength: 8,
                    pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                },
                confirmNewPassword: {
                    required: true,
                    minlength: 8,
                    equalTo: "#newPassword",
                },
            },
            messages: {
                newPassword: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password minimal 8 karakter',
                    pattern: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password harus mengandung huruf dan angka',
                },
                confirmNewPassword: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password minimal 8 karakter',
                    equalTo: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi password tidak sama',
                },
            },
        });

        // toggle-eye-wrapper
        $('.toggle-eye-wrapper-new').click(function() {
            if ($('#newPassword').attr('type') == 'password') {
                $('#newPassword').attr('type', 'text');
                $('.toggle-eye-wrapper-new').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#newPassword').attr('type', 'password');
                $('.toggle-eye-wrapper-new').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
        $('.toggle-eye-wrapper-confirm-new').click(function() {
            if ($('#confirmNewPassword').attr('type') == 'password') {
                $('#confirmNewPassword').attr('type', 'text');
                $('.toggle-eye-wrapper-confirm-new').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#confirmNewPassword').attr('type', 'password');
                $('.toggle-eye-wrapper-confirm-new').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
    </script>
@endsection
