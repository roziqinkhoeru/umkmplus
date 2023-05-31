@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Tambah Mentor</h4>
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
                        Form Add Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Add Mentor</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data mentor
                            </div>
                        </div>
                        <form id="addMentorForm" action="#" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- fullname --}}
                                <div class="form-group form-show-validation row">
                                    <label for="fullname" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nama Lengkap
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="{{ old('fullname') }}" placeholder="Masukkan Nama Lengkap" required>
                                    </div>
                                </div>
                                {{-- username --}}
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Username
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="username-addon">@</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="username"
                                                value="{{ old('username') }}" aria-label="username"
                                                aria-describedby="username-addon" id="username" name="username" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- phone --}}
                                <div class="form-group form-show-validation row">
                                    <label for="phone" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> No Telepon
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="Enter phone" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="form-group form-show-validation row">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Alamat Email
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Enter Email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                {{-- password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/admin/mentor" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="createButton"
                                            type="submit">Tambah</button>
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
    <script>
        $("#addMentorForm").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                fullname: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap maksimal 50 karakter',
                },
                username: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username maksimal 50 karakter',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone hanya boleh berisi angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone minimal 10 digit',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone maksimal 13 digit',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak valid',
                },
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password minimal 8 karakter',
                },
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $('#createButton').html('<i class="fas fa-circle-notch text-lg spinners"></i>');
                $('#createButton').prop('disabled', true);
                $.ajax({
                    url: "{{ url('/admin/mentor/create') }}",
                    type: "POST",
                    data: {
                        name: $('#fullname').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        password: $('#password').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#createButton').html('Tambah');
                        $('#createButton').prop('disabled', false);
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'UMKMPlus Admin',
                            message: response.meta.message,
                        }, {
                            type: 'secondary',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            time: 2000,
                        });
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON.data);
                        $('#createButton').html('Tambah');
                        $('#createButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH MENTOR GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH MENTOR GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    }
                });
            }
        });
    </script>
@endsection
