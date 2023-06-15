@extends('auth.layout')

@section('authContent')
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
                            <h2 class="section__title mb-2">Daftarkan Akun Anda</h2>
                            <p>Belajar dengan seru di UMKMPlus bersama para praktisi kami</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            <div class="sign__header mb-25">
                                <div class="sign__in text-center">
                                    <a href="javascript:void(0);" class="sign__social g-plus text-start mb-15"
                                        style="cursor: not-allowed"><i class="fab fa-google-plus-g"></i>Register with
                                        Google</a>
                                    <p>OR</p>
                                </div>
                            </div>
                            <div class="sign__form">
                                <form action="{{ url('register') }}" method="POST" id="registerForm">
                                    @csrf
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="name">
                                            <h5>Nama Lengkap</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-user icon-form"></i>
                                            <input type="text" placeholder="Masukan nama lengkap" name="name"
                                                id="name" value="{{ old('name') }}" required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="username">
                                            <h5>Username</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-user icon-form"></i>
                                            <input type="text" placeholder="Masukan username" name="username"
                                                id="username" value="{{ old('username') }}" required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="email">
                                            <h5>Email</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-envelope icon-form"></i>
                                            <input type="email" placeholder="Masukan email" name="email" id="email"
                                                value="{{ old('email') }}" required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="phone">
                                            <h5>No Handphone</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-phone icon-form"></i>
                                            <input type="text" placeholder="Masukan nomor handphone" name="phone"
                                                id="phone" value="{{ old('phone') }}" required class="input-form">
                                        </div>
                                    </div>
                                    {{-- gender --}}
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="gender">
                                            <h5>Jenis Kelamin</h5>
                                        </label>
                                        <div class="sign__input">
                                            <select class="select-form w-100 h-52" aria-label="Default select example"
                                                name="gender" id="gender" required>
                                                <option hidden selected>Pilih Jenis Kelamin</option>
                                                <option selected value="laki-laki">laki-laki</option>
                                                <option value="perempuan">perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="password">
                                            <h5>Kata Sandi</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock icon-form"></i>
                                            <div class="toggle-eye-wrapper"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan kata sandi" name="password"
                                                id="password" value="" required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-15">
                                        <label for="password_confirmation">
                                            <h5>Ulangi Kata Sandi</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-lock-keyhole icon-form"></i>
                                            <div class="toggle-eye-wrapper-confirm"><i
                                                    class="fa-regular fa-eye toggle-eye icon-toggle-password"></i></div>
                                            <input type="password" placeholder="Masukan ulang kata sandi"
                                                name="password_confirmation" id="password_confirmation" value=""
                                                required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__action d-flex justify-content-between mb-30">
                                        <div class="sign__agree d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" id="terms" name="terms"
                                                required>
                                            <label class="m-check-label" for="terms">Saya menyetujui <a
                                                    href="/terms">Syarat dan Ketentuan</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" id="registerButton"
                                        class="tp-btn w-100 rounded-pill">Daftar</button>
                                    <div class="sign__new text-center mt-20">
                                        <p>Sudah punya akun? <a href="/login"> Login</a></p>
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
        // add method validation only letters
        $.validator.addMethod('alphabetOnly', function(value, element) {
            return this.optional(element) || value == value.match(/^[A-Za-z\s']+$/);
        });
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");
        // validate form
        $("#registerForm").validate({
            rules: {
                name: {
                    required: true,
                    alphabetOnly: true,
                },
                username: {
                    required: true,
                    nowhitespace: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 16,
                },
                gender: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password",
                },
                terms: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username tidak boleh kosong',
                    alphabetOnly: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username hanya boleh berisi huruf',
                },
                username: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username tidak boleh kosong',
                    nowhitespace: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username tidak boleh ada spasi',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak valid',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone hanya boleh berisi angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone minimal 10 digit',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone maksimal 16 digit',
                },
                gender: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Jenis kelamin tidak boleh kosong',
                },
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi minimal 8 karakter',
                    pattern: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi harus mengandung huruf dan angka',
                },
                password_confirmation: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi kata sandi tidak boleh kosong',
                    equalTo: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi kata sandi tidak sama',
                },
                terms: {
                    required: '<i class="fas fa-exclamation-circle text-sm icon-error" style="transform: translateY(-2px) !important;"></i>',
                },
            },
            submitHandler: function(form) {
                $('#registerButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#registerButton').prop('disabled', true);
                $.ajax({
                    url: "{{ url('register') }}",
                    type: "POST",
                    data: {
                        name: $('#name').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        gender: $('#gender').val(),
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#registerButton').html('Daftar');
                        $('#registerButton').prop('disabled', false);
                        Swal.fire({
                            icon: 'success',
                            title: 'PENDAFTARAN BERHASIL!',
                            text: response.meta.message,
                        })
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        $('#registerButton').html('Daftar');
                        $('#registerButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'PENDAFTARAN GAGAL!',
                                text: xhr.responseJSON.meta.message + ' Error: ' +
                                    xhr.responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'PENDAFTARAN GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
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
        $('.toggle-eye-wrapper-confirm').click(function() {
            if ($('#password_confirmation').attr('type') == 'password') {
                $('#password_confirmation').attr('type', 'text');
                $('.toggle-eye-wrapper-confirm').html(
                    '<i class="fa-regular fa-eye-slash toggle-eye icon-toggle-password"></i>');
            } else {
                $('#password_confirmation').attr('type', 'password');
                $('.toggle-eye-wrapper-confirm').html(
                    '<i class="fa-regular fa-eye toggle-eye icon-toggle-password"></i>');
            }
        });
    </script>
@endsection
