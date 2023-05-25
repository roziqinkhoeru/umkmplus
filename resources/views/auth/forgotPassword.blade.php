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
                            <h2 class="section__title mb-2">Lupa kata sandi Anda?</h2>
                            <p>Masukkan email terdaftar Anda untuk menerima tautan
                                reset kata sandi.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg" id="forgotPasswordContent">
                            <div class="sign__form">
                                <form action="{{ url('forgot-password') }}" method="POST" id="forgotPasswordForm">
                                    @csrf
                                    <div class="sign__input-wrapper mb-32">
                                        <label for="email">
                                            <h5>Email</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fa-light fa-envelope icon-form"></i>
                                            <input type="email" placeholder="Masukan email" name="email" id="email"
                                                required value="" class="input-form">
                                        </div>
                                    </div>
                                    <button class="tp-btn w-100 rounded-pill" type="submit" id="forgotPasswordButton">Kirim
                                        tautan</button>
                                </form>
                            </div>
                            <div class="sign__new text-center mt-20">
                                <p>Ingat kata sandi? <a href="/login"> Masuk</a></p>
                            </div>
                        </div>
                        <div id="forgotPasswordSuccess"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->
    </main>
@endsection

@section('script')
    @if (session()->has('error'))
        <script>
            console.log({{ session('error') }});
        </script>
    @endif
    @error('email')
        <script>
            console.log({{ $message }});
        </script>
    @enderror
    <script>
        let isResendLinkResetPassword = false;

        function submitForgotPasswordAjax(isResend) {
            $.ajax({
                url: "{{ route('forgotPassword') }}",
                type: "POST",
                data: {
                    email: $('#email').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#forgotPasswordButton').html('Tautan terkirim');
                    $('#forgotPasswordButton').prop('disabled', true);
                    toastr.success('{{ session('success') }}', 'KIRIM TAUTAN BERHASIL!');
                    if (isResend) {
                        $('#resend_link').html(
                            'Masih belum menerima email?<br/>Periksa spam Anda atau <a href="{{ route('forgotPassword') }}">coba alamat email lain</a>.'
                        );
                    } else {
                        $('#forgotPasswordSuccess').html(
                            `<div class="card card-auth mb-3"><div class="card-body card-body-auth" id="forgotPasswordContent"><h5 class ="text-center font-bold mb-3">Tautan telah dikirim</h5><p class="text-center mb-3">Tautan untuk reset password dikirim ke <span style="font-weight: 600">${$('#email').val()}</span>. Silahkan cek email Anda. </p><div style="margin-top: 28px"> <a href="{{ route('login') }}" class="btn btn-login">Masuk</a></div><p class="mt-4 text-center" id="resend_link">Tidak menerima tautan? <button onclick="submitForgotPassword()" class="btn-anchor">Kirim ulang</bu>.</p></div>`
                        );
                        $('#forgotPasswordContent').hide();
                    }
                },
                error: function(xhr, status, error) {
                    $('#forgotPasswordButton').html('Kirim tautan');
                    $('#forgotPasswordButton').prop('disabled', false);
                    if (xhr.responseJSON)
                    Swal.fire({
                                icon: 'error',
                                title: 'KIRIM TAUTAN GAGAL!',
                                text: xhr.responseJSON.meta.message,
                            })
                    else
                    Swal.fire({
                                icon: 'error',
                                title: 'KIRIM TAUTAN GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " + error,
                            })
                    return false;
                }
            });
        }

        function submitForgotPassword() {
            isResendLinkResetPassword = true;
            $('#forgotPasswordForm').submit();
        }

        // validate form
        $("#forgotPasswordForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak valid',
                }
            },
            submitHandler: function(form) {
                $('#forgotPasswordButton').html(
                    '<i class="fas fa-circle-notch text-base spinners"></i> Menunggu...'
                );
                $('#forgotPasswordButton').prop('disabled', true);
                submitForgotPasswordAjax(isResendLinkResetPassword);
            }
        });
    </script>
@endsection
