@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Ubah Hasil Kelas Siswa</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/mentor/dashboard">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/mentor/student">Data Hasil Kelas Siswa</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Ubah Hasil Kelas Siswa</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Ubah Hasil Kelas Siswa</div>
                            <div class="card-category">
                                Form ini digunakan untuk mengubah hasil kelas siswa
                            </div>
                        </div>
                        <form id="formEditScore" action="{{ url('/mentor/un-student/' . $courseEnroll->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                {{-- Check Score In Google Form --}}
                                <div class="form-group form-show-validation row">
                                    <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Cek Nilai
                                        Ujian
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <a href="{{ $courseEnroll->course->google_form }}?usp=sharing"
                                            class="btn btn-warning btn-outline-dark">Cek </a>
                                    </div>
                                </div>
                                {{-- Name --}}
                                <div class="form-group form-show-validation row">
                                    <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Nama
                                        Lengkap
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="name" name="name"
                                            value="{{ $courseEnroll->student->name }}" required>
                                    </div>
                                </div>
                                {{-- Course --}}
                                <div class="form-group form-show-validation row">
                                    <label for="courseTitle" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Judul
                                        Kelas
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="courseTitle"
                                            name="courseTitle" value="{{ $courseEnroll->course->title }}" required>
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="form-group form-show-validation row">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Alamat
                                        Email
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="email" name="email" class="form-control" id="email"
                                            placeholder="Masukkan Email" value="{{ $courseEnroll->student->user->email }}"
                                            required>
                                    </div>
                                </div>
                                {{-- Skor --}}
                                <div class="form-group form-show-validation row">
                                    <label for="score" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Skor
                                        Kelas
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="score" name="score"
                                            value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/admin/mentor" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updateButton" type="submit">Ubah</button>
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
        $("#formEditScore").validate({
            rules: {
                score: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100,
                },
            },
            messages: {
                score: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Skor tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Skor hanya boleh berisi angka',
                    min: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Skor minimal 0',
                    max: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Skor maksimal 100',
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
                $('#updateButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#updateButton').prop('disabled', true);
                $.ajax({
                    type: "PUT",
                    url: `{{ url('/mentor/un-student/' . $courseEnroll->id) }}`,
                    data: {
                        score: $('#score').val(),
                        _token: "{{ csrf_token() }}",
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
                                from: "bottom",
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
                                title: 'UBAH HASIL KELAS SISWA GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'UBAH HASIL KELAS SISWA GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    },
                });
            }
        });
    </script>
@endsection
