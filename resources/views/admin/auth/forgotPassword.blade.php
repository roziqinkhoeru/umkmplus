@extends('admin.auth.authLayout')

@section('authContent')
    <div class="container container-login container-transparent animated fadeIn">
        <div id="forgotPasswordContent">
            <h3 class="text-center">Lupa kata sandi Anda?</h3>
            <form class="login-form" action="#" id="forgotPasswordAdminForm">
                {{-- email --}}
                <div class="form-group">
                    <label for="email" class="placeholder"><b>Email</b></label>
                    <input id="email" name="email" type="email" class="form-control" id="email" required>
                </div>
                {{-- button --}}
                <div class="form-group d-flex mb-3 w-100">
                    <button type="submit" class="btn btn-secondary col-12 mt-3 mt-sm-0 fw-bold w-100"
                        id="forgotPasswordButton">Kirim
                        Tautan</button>
                </div>
                <div class="login-account">
                    <span class="msg">Ingat kata sandi?</span>
                    <a href="/admin/login" class="link"> Masuk</a>
                </div>
            </form>
        </div>
        <div id="forgotPasswordSuccess"></div>
    </div>
@endsection

@section('authScript')
    <script>
        let isResendLinkResetPassword = false;

        function submitForgotPasswordAjax(isResend) {
            $.ajax({
                url: "{{ route('admin.forgotPassword') }}",
                type: "POST",
                data: {
                    email: $('#email').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#forgotPasswordButton').html('Tautan terkirim');
                    $('#forgotPasswordButton').prop('disabled', true);
                    Swal.fire({
                        icon: 'success',
                        title: 'KIRIM TAUTAN BERHASIL!',
                        text: '{{ session('success') }}',
                    });
                    if (isResend) {
                        $('#resend_link').html(
                            'Masih belum menerima email?<br/>Periksa spam Anda atau <a href="{{ route('admin.password.forgot') }}">coba alamat email lain</a>.'
                        );
                    } else {
                        $('#forgotPasswordSuccess').html(
                            `<div class="card card-auth mb-3">
                                    <div class="card-body card-body-auth" id="forgotPasswordContent">
                                        <p class="text-center fw-bold mb-3 text-xl">Tautan telah dikirim</p>
                                        <p class="text-center mb-3">
                                            Tautan untuk reset password dikirim ke
                                            <span style="font-weight: 600">${$('#email').val()}
                                            </span>.
                                            Silahkan cek email Anda.
                                        </p>
                                        <p class="mt-4 text-center" id="resend_link">
                                            Tidak menerima tautan?
                                            <span id="resend_link_btn"></span>
                                        </p>
                                    </div>
                                </div>`
                        );

                        startCountdown();
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
            event.preventDefault();
            $('#buttonResendLink').html(
                '<i class="fas fa-circle-notch text-lg spinners-2"></i>'
            );
            isResendLinkResetPassword = true;
            submitForgotPasswordAjax(isResendLinkResetPassword);

        }
        $('#forgotPasswordAdminForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                }
            },
            messages: {
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak valid',
                },
            },
            submitHandler: function(form) {
                $('#forgotPasswordButton').html(
                    '<i class="fas fa-circle-notch text-lg spinners-2"></i>'
                );
                $('#forgotPasswordButton').prop('disabled', true);
                submitForgotPasswordAjax(isResendLinkResetPassword);
            }
        });

        const startCountdown = () => {
            var countdown = 60;

            // Display countdown
            var resendLinkBtn = $('#resend_link_btn');
            resendLinkBtn.html(`${countdown} s`);

            // Decrease countdown every second
            var timer = setInterval(function() {
                countdown--;
                resendLinkBtn.html(`${countdown} s`);

                if (countdown <= 0) {
                    clearInterval(timer);
                    // Show the content
                    resendLinkBtn.html(
                        `<button onclick="submitForgotPassword()" class="btn-anchor" id="buttonResendLink">Kirim ulang</button>`
                    )
                }
            }, 1000);
        }
    </script>
@endsection
