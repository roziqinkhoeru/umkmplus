@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Terima Pengajuan Kelas</h4>
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
                        <a href="{{ route('admin.course') }}">
                            Data Kelas
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        ...
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Form Pengajuan Kelas
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Penerimaan Kelas</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data kelas
                            </div>
                        </div>
                        <form id="formCourse" action="{{ url('/admin/course/application/' . $course->slug . '/accept') }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Judul
                                        Kelas
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="name" name="name"
                                            value="{{ $course->title }}" required>
                                    </div>
                                </div>
                                {{-- Description --}}
                                <div class="form-group form-show-validation row">
                                    <label for="description"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Deskripsi
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="description"
                                            name="description" value="{{ $course->description }}" required>
                                    </div>
                                </div>
                                {{-- Title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="category" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Kategori
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="category" name="category"
                                            value="{{ $course->category->name }}" required>
                                    </div>
                                </div>
                                {{-- Title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="module" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Jumlah
                                        Modul
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" id="module" name="module"
                                            value="{{ $course->modules->count() }}" required>
                                    </div>
                                </div>
                                {{-- Confirmation --}}
                                <div class="form-group form-show-validation row">
                                    <label for="confirmation" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Kelas
                                        Sudah Sesuai
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8 d-flex">
                                        <input type="checkbox" class="form-control" id="confirmation" name="confirmation"
                                            required title="Checklist untuk menlanjutkan" style="width: 24px">
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('admin.course.application') }}"
                                            class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updateButton"
                                            type="submit">Terima</button>
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
        $("#formCourse").validate({
            rules: {
                confirmation: {
                    required: true,
                },
            },
            messages: {
                confirmation: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi kelas sudah sesuai',
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
                    url: `{{ url('/admin/course/application/' . $course->slug . '/accept') }}`,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#updateButton').html('Terima');
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
                        $('#updateButton').html('Terima');
                        $('#updateButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH KELAS GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH KELAS GAGAL!',
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
