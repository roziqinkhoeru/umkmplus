@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Ubah Password Mentor</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/admin">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/mentor">Data Mentor</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        Form Ubah Password Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Ubah Password Mentor</div>
                            <div class="card-category">
                                Form ini digunakan untuk mengubah data mentor
                            </div>
                        </div>
                        <form id="formChangePassword" action="#" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- old password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="old_password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password
                                        Lama
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="password" class="form-control" id="old_password" name="old_password"
                                            placeholder="Masukkan Password Lama" required>
                                    </div>
                                </div>
                                {{-- new password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password
                                        Baru
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Masukkan Password Baru"
                                                id="password" name="password" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- confirm new password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="password_confirmation"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Konfrmasi Password Baru
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" placeholder="Masukkan Konfrmasi Password Baru"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/mentor/profile" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updatePasswordButton" type="submit">Ubah
                                            Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#formChangePassword").validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 8,
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
            },
            messages: {
                old_password: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password lama tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password lama minimal 8 karakter',
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
            },
            submitHandler: function(form) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda akan mengubah password anda",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#updatePasswordButton').html(
                            '<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                        $('#updatePasswordButton').prop('disabled', true);
                        $.ajax({
                            url: "{{ route('mentor.change.password') }}",
                            type: "PUT",
                            data: {
                                old_password: $('#old_password').val(),
                                password: $('#password').val(),
                                password_confirmation: $('#password_confirmation').val(),
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#updatePasswordButton').html('Update password');
                                $('#updatePasswordButton').prop('disabled', false);
                                $('#old_password').val("");
                                $('#password').val("");
                                $('#password_confirmation').val("");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'UBAH PASSWORD BERHASIL!',
                                    text: response.meta.message,
                                })
                                window.location.href = response.data.redirect;
                            },
                            error: function(xhr, status, error) {
                                $('#updatePasswordButton').html('Update password');
                                $('#updatePasswordButton').prop('disabled', false);
                                if (xhr.responseJSON) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'UBAH PASSWORD GAGAL!',
                                        text: xhr.responseJSON.meta.message +
                                            " Error: " + xhr
                                            .responseJSON.data.error,
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'UBAH PASSWORD GAGAL!',
                                        text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                            error,
                                    })
                                }
                                return false;
                            }
                        });
                    } else {
                        return false;
                    }
                });
            }
        });
    </script>
@endsection
