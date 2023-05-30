@extends('admin.auth.authLayout')

@section('authContent')
    <div class="container container-login container-transparent animated fadeIn">
        <h3 class="text-center">Lupa kata sandi Anda?</h3>
        <form class="login-form" action="#" id="forgotPasswordAdminForm">
            {{-- email --}}
            <div class="form-group">
                <label for="email" class="placeholder"><b>Email</b></label>
                <input id="email" name="email" type="email" class="form-control" id="email" required>
            </div>
            {{-- button --}}
            <div class="form-group d-flex mb-3 w-100">
                <button type="submit" class="btn btn-secondary col-12 mt-3 mt-sm-0 fw-bold w-100">Kirim
                    Tautan</button>
            </div>
            <div class="login-account">
                <span class="msg">Ingat kata sandi?</span>
                <a href="/admin/login" class="link"> Masuk</a>
            </div>
        </form>
    </div>
@endsection

@section('authScript')
    <script>
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
        });
    </script>
@endsection
