@extends('admin.auth.authLayout')

@section('authContent')
    <div class="container container-login container-transparent animated fadeIn">
        <div id="forgotPasswordContent">
            <h3 class="text-center">Reset Password</h3>
            <form class="login-form" action="{{ url('reset-password') }}" method="POST" id="resetPasswordAdmin">
                @csrf
                <input hidden type="text" name="token" id="token" value="{{ $token }}">
                <input hidden type="email" name="email" id="email" value="{{ $email }}">
                {{-- new password --}}
                <div class="form-group">
                    <label for="password" class="placeholder"><b>Password</b></label>
                    <div class="position-relative">
                        <input id="password" name="password" type="password" class="form-control" required>
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                {{-- confirm new password --}}
                <div class="form-group">
                    <label for="password_confirmation" class="placeholder"><b>Konfirmasi Password</b></label>
                    <div class="position-relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                {{-- button --}}
                <div class="form-group d-flex mb-3 w-100">
                    <button type="submit" class="btn btn-secondary col-12 mt-3 mt-sm-0 fw-bold w-100"
                        id="resetPasswordButton">Reset Password</button>
                </div>
            </form>
        </div>
        <div id="forgotPasswordSuccess"></div>
    </div>
@endsection

@section('authScript')
    <script>
        // validate form
        $("#resetPasswordAdmin").validate({
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
