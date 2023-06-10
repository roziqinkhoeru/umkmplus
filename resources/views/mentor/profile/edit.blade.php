@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Ubah Mentor</h4>
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
                        Form Ubah Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Ubah Mentor</div>
                            <div class="card-category">
                                Form ini digunakan untuk mengubah data mentor
                            </div>
                        </div>
                        <form id="editMentorForm" action="#" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- name --}}
                                <div class="form-group form-show-validation row">
                                    <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nama Lengkap
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $mentor->name }}" placeholder="Masukkan Nama Lengkap" required>
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
                                            <input type="text" class="form-control" placeholder="Masukkan Username"
                                                value="{{ $mentor->user->username }}" aria-label="username"
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
                                            placeholder="Masukkan No Telepon" value="{{ $mentor->phone }}" required>
                                    </div>
                                </div>
                                {{-- dob --}}
                                <div class="form-group form-show-validation row">
                                    <label for="dob" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Tanggal
                                        Lahir
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="dob" class="form-control" id="dob"
                                            placeholder="Tanggal Lahir" value="{{ date('d/m/Y', strtotime($mentor->dob)) }}"
                                            required>
                                    </div>
                                </div>
                                {{-- gender --}}
                                <div class="form-group form-show-validation row">
                                    <label for="gender" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> No Telepon
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <select class="form-control w-100 h-52" aria-label="Default select example"
                                            name="gender" id="gender" required>
                                            <option value="laki-laki" @if ($mentor->gender == 'laki-laki') selected @endif>
                                                laki-laki</option>
                                            <option value="perempuan" @if ($mentor->gender == 'perempuan') selected @endif>
                                                perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="form-group form-show-validation row">
                                    <label for="address" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Alamat
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Masukkan Alamat" value="{{ $mentor->address }}" required>
                                    </div>
                                </div>
                                {{-- job --}}
                                <div class="form-group form-show-validation row">
                                    <label for="job" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Pekerjaan
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" name="job" class="form-control" id="job"
                                            placeholder="Masukkan Pekerjaan" value="{{ $mentor->job }}" required>
                                    </div>
                                </div>
                                {{-- about --}}
                                <div class="form-group form-show-validation row">
                                    <label for="about" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Tentang
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <textarea name="about" class="form-control" id="about" rows="5" maxlength="400"
                                            placeholder="Masukkan Deskripsi Diri" required>{{ $mentor->dataMentor->about }}</textarea>
                                    </div>
                                </div>
                                {{-- specialist --}}
                                <div class="form-group form-show-validation row">
                                    <label for="specialist" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Spesialisasi
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <select class="form-control" aria-label="Default select example"
                                            name="specialist" id="specialist" required>
                                            {{-- <option hidden>Pilih Spesialisasi</option> --}}
                                            @foreach ($categories as $category)
                                                <option @if ($category->name == $mentor->specialist) selected @endif
                                                    value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="form-group form-show-validation row">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Alamat
                                        Email
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Masukkan Email" value="{{ $mentor->user->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/mentor/profile" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updateButton"
                                            type="submit">Ubah</button>
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
        $(document).ready(function() {
            $('#dob').datetimepicker({
                format: 'DD/MM/YYYY',
            }).on('changeDate', function(e) {
                // Mengganti value input dob dengan tanggal yang dipilih
                $('#dob').val(e.format('dd/mm/yyyy'));
            });
        });
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");
        $("#editMentorForm").validate({
            rules: {
                name: {
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
                dob: {
                    required: true,
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
                about: {
                    required: true,
                    minlength: 3,
                    maxlength: 400,
                },
            },
            messages: {
                name: {
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
                dob: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tanggal lahir tidak boleh kosong',
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
                gender: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jenis kelamin tidak boleh kosong',
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
                about: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tentang mentor tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tentang mentor minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tentang mentor maksimal 400 karakter',
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
                swal({
                    title: 'Apakah anda yakin?',
                    text: "Anda akan mengubah data profil!",
                    icon: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Ya, Ubah data!',
                            className: 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-danger'
                        }
                    }
                }).then((result) => {
                    if (result) {
                        $('#updateButton').html(
                            '<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                        $('#updateButton').prop('disabled', true);
                        $.ajax({
                            url: "{{ route('mentor.update.profile') }}",
                            type: "PUT",
                            data: {
                                name: $('#name').val(),
                                username: $('#username').val(),
                                dob: $('#dob').val(),
                                email: $('#email').val(),
                                phone: $('#phone').val(),
                                gender: $('#gender').val(),
                                address: $('#address').val(),
                                job: $('#job').val(),
                                about: $('#about').val(),
                                specialist: $('#specialist').val(),
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#updateButton').html('Ubah');
                                $('#updateButton').prop('disabled', false);
                                $.notify({
                                    icon: 'flaticon-alarm-1',
                                    title: 'UMKMPlus Admin',
                                    message: response.meta.message,
                                }, {
                                    type: 'secondary',
                                    placement: {
                                        from: "top",
                                        align: "right"
                                    },
                                    time: 2000,
                                });
                                window.location.href = response.data.redirect
                            },
                            error: function(xhr, status, error) {
                                $('#updateButton').html('Ubah');
                                $('#updateButton').prop('disabled', false);
                                if (xhr.responseJSON)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'UBAH MENTOR GAGAL!',
                                        text: xhr.responseJSON.meta.message +
                                            " Error: " + xhr
                                            .responseJSON.data.error,
                                    })
                                else
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'UBAH MENTOR GAGAL!',
                                        text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                            error,
                                    })
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
