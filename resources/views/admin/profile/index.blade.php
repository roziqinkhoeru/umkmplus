@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <h4 class="page-title">Admin Profile</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        {{-- tab --}}
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" href="{{ route('admin.profile') }}" role="tab"
                                            aria-selected="true">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.edit.password') }}" role="tab"
                                            aria-selected="false">Ubah
                                            Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- form profile --}}
                        <div class="card-body">
                            <form action="#" id="profileAdminForm">
                                <div class="row mt-3">
                                    {{-- name --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nama" value="{{ $admin->customer->name }}">
                                        </div>
                                    </div>
                                    {{-- username --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="username">username</label>
                                            <input type="username" class="form-control" name="username" id="username"
                                                placeholder="username" value="{{ $admin->username }}" disabled>
                                        </div>
                                    </div>
                                    {{-- email --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="email" value="{{ $admin->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    {{-- birth date --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="dob">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="dob" name="dob"
                                                value="{{ date('d/m/Y', strtotime($admin->customer->dob)) }}"
                                                placeholder="Birth Date">
                                        </div>
                                    </div>
                                    {{-- gender --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="Laki-laki"
                                                    {{ $admin->customer->gender == 'laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="perempuan"
                                                    {{ $admin->customer->gender == 'perempuan' ? 'selected' : '' }}>
                                                    perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- phone --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="phone">No Telepon</label>
                                            <input type="text" class="form-control" id="phone"
                                                value="{{ $admin->customer->phone }}" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    {{-- address --}}
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control"
                                                value="{{ $admin->customer->address }}" id="address" name="address"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 mb-3">
                                    <button class="btn btn-success" type="submit" id="updateButton">Perbarui
                                        Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-header"
                            style="background-image: url({{ asset('assets/template/admin/img/blogpost.jpg') }})">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="admin-profile"
                                        class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{ $admin->customer->name }}</div>
                                <div class="job">admin</div>
                                <div class="desc">Mengelola Data UMKMPlus</div>
                            </div>
                        </div>
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

        $('#profileAdminForm').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                username: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 16,
                },
                address: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama tidak boleh kosong',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                },
                username: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username tidak boleh kosong',
                },
                dob: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tanggal lahir tidak boleh kosong',
                },
                gender: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jenis kelamin tidak boleh kosong',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon harus berupa angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon minimal 10 digit',
                },
                address: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Alamat tidak boleh kosong',
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda akan mengubah data profil!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#updateButton').html(
                            '<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                        $('#updateButton').prop('disabled', true);
                        $.ajax({
                            url: "{{ route('admin.update.profile') }}",
                            type: "PUT",
                            data: {
                                name: $('#name').val(),
                                username: $('#username').val(),
                                dob: $('#dob').val(),
                                email: $('#email').val(),
                                phone: $('#phone').val(),
                                gender: $('#gender').val(),
                                address: $('#address').val(),
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
