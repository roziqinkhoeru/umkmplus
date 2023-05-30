@extends('admin.auth.authLayout')

@section('authContent')
    <div class="container container-login container-transparent animated fadeIn">
        <h3 class="text-center">Masuk sebagai Admin</h3>
        <form class="login-form" action="#" id="loginAdminForm">
            {{-- username --}}
            <div class="form-group">
                <label for="username" class="placeholder"><b>Username</b></label>
                <input id="username" name="username" type="text" class="form-control" id="username" required>
            </div>
            {{-- password --}}
            <div class="form-group">
                <label for="password" class="placeholder"><b>Password</b></label>
                <a href="/admin/forgot-password" class="link float-right">Forget Password ?</a>
                <div class="position-relative">
                    <input id="password" name="password" id="password" type="password" class="form-control" required>
                    <div class="show-password">
                        <i class="icon-eye"></i>
                    </div>
                </div>
            </div>
            <div class="form-group form-action-d-flex mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
                    <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Masuk</button>
            </div>
        </form>
    </div>
@endsection

@section('authScript')
    <script>
        $('#loginAdminForm').validate({
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
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username tidak boleh kosong',
                },
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Kata sandi tidak boleh kosong',
                },
            },
        });
    </script>
@endsection
