@extends('admin.auth.authLayout')

@section('authContent')
    <div class="container container-login container-transparent animated fadeIn">
        <div id="forgotPasswordContent">
            <h3 class="text-center">Reset Password</h3>
            <form class="login-form" action="#" id="resetPasswordAdmin">
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
                    <label for="confirmPassword" class="placeholder"><b>Konfirmasi Password</b></label>
                    <div class="position-relative">
                        <input id="confirmPassword" name="confirmPassword" type="password" class="form-control" required>
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
        $('#resetPasswordAdmin').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                },
                confirmPassword: {
                    required: true,
                    equalTo: '#password',
                }
            },
            messages: {
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password minimal 8 karakter',
                },
                confirmPassword: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Konfirmasi password tidak boleh kosong',
                    equalTo: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Konfirmasi password tidak sama',
                },
            },
            submitHandler: function(form) {
                $('#resetPasswordButton').html(
                    '<i class="fas fa-circle-notch text-lg spinners-2"></i>'
                );
                $('#resetPasswordButton').prop('disabled', true);
                console.log('reset password');
            }
        });
    </script>
@endsection
