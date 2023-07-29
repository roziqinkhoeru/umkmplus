@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Tambah Mentor</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mentor') }}">Data Mentor</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        Form Tambah Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Tambah Mentor</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data mentor
                            </div>
                        </div>
                        <form id="addMentorForm" action="#" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- fullname --}}
                                <div class="form-group form-show-validation row">
                                    <label for="fullname" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Nama
                                        Lengkap
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="{{ $mentorRegistration->fullname }}" placeholder="Masukkan Nama Lengkap"
                                            required>
                                    </div>
                                </div>
                                {{-- username --}}
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Username
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="username-addon">@</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Masukkan Username"
                                                value="{{ old('username') }}" aria-label="username"
                                                aria-describedby="username-addon" id="username" name="username" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- phone --}}
                                <div class="form-group form-show-validation row">
                                    <label for="phone" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right"> No
                                        Telepon
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="Masukkan No Telepon" value="{{ $mentorRegistration->phone }}"
                                            required>
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="form-group form-show-validation row">
                                    <label for="address" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right"> Alamat
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Masukkan Alamat" value="{{ $mentorRegistration->address }}"
                                            required>
                                    </div>
                                </div>
                                {{-- job --}}
                                <div class="form-group form-show-validation row">
                                    <label for="job" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">
                                        Pekerjaan
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="job" class="form-control" id="job"
                                            placeholder="Masukkan Pekerjaan" value="{{ $mentorRegistration->job }}"
                                            required>
                                    </div>
                                </div>
                                {{-- specialist --}}
                                <div class="form-group form-show-validation row">
                                    <label for="specialist" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">
                                        Spesialisasi
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <select class="form-control" aria-label="Default select example" name="specialist"
                                            id="specialist" required>
                                            {{-- <option hidden>Pilih Spesialisasi</option> --}}
                                            @foreach ($categories as $category)
                                                <option @if ($category->name == $mentorRegistration->specialist) selected @endif
                                                    value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="form-group form-show-validation row">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Alamat
                                        Email
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Masukkan Email" value="{{ $mentorRegistration->email }}"
                                            required>
                                    </div>
                                </div>
                                {{-- password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="password"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Password
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan Password" required>
                                    </div>
                                </div>
                                {{-- file cv --}}
                                <div class="form-group form-show-validation row">
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input hidden type="text" class="form-control" id="file_cv" name="file_cv"
                                            value="{{ $mentorRegistration->file_cv }}" placeholder="Masukkan File CV"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('mentor.student') }}"
                                            class="btn btn-default btn-outline-dark">Batal</a>
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
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");
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
                address: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                job: {
                    required: true,
                },
                specialist: {
                    required: true,
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
                    nowhitespace: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Username tidak boleh ada spasi',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak valid',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone hanya boleh berisi angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone minimal 10 digit',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor handphone maksimal 16 digit',
                },
                address: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Alamat tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Alamat minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Alamat maksimal 100 karakter',
                },
                job: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Pekerjaan tidak boleh kosong',
                },
                specialist: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Spesialis tidak boleh kosong',
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
            submitHandler: function(form, event) {
                event.preventDefault();
                $('#createButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#createButton').prop('disabled', true);
                $.ajax({
                    url: "{{ route('admin.mentor.registration.store', $mentorRegistration->id) }}",
                    type: "POST",
                    data: {
                        name: $('#fullname').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val(),
                        job: $('#job').val(),
                        specialist: $('#specialist').val(),
                        password: $('#password').val(),
                        file_cv: $('#file_cv').val(),
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
