@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Tambah Media</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/mentor">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/mentor/course">Data Kelas</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/mentor/course/{{ $module->course->slug }}/module">Data Module</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Tambah Media</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Tambah Media</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data tambah media
                            </div>
                        </div>
                        <form id="createMediaForm" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                {{-- title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="title" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Judul
                                        Media
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Masukkan Judul Media"
                                                value="{{ old('title') }}" aria-label="title"
                                                aria-describedby="title-addon" id="title" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- video_url --}}
                                <div class="form-group form-show-validation row">
                                    <label for="video_url" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Kode
                                        Video
                                        (Youtube)
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Masukkan Kode Video"
                                                value="{{ old('video_url') }}" aria-label="video_url"
                                                aria-describedby="video_url-addon" id="video_url" name="video_url" required>
                                                <span class="input-group-text"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0">&ab_channel</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- duration --}}
                                <div class="form-group form-show-validation row">
                                    <label for="duration" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Durasi
                                        Video
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="Masukkan Durasi Video"
                                                min="1" value="{{ old('duration') }}" aria-label="duration"
                                                aria-describedby="duration-addon" id="duration" name="duration" required>
                                            <span class="input-group-text"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0">menit</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Submit --}}
                                <div class="card-action">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="/mentor/course" class="btn btn-default btn-outline-dark">Batal</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#createMediaForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                video_url: {
                    required: true,
                },
                duration: {
                    required: true,
                    number: true,
                    minlength: 1,
                },
            },
            messages: {
                title: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul maksimal 100 karakter',
                },
                video_url: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Kode video tidak boleh kosong',
                },
                duration: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Durasi video tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Durasi video harus berupa angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Durasi video minimal 1 menit',
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var formData = new FormData(form);
                $('#createButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#createButton').prop('disabled', true);
                $.ajax({
                    url: "{{ route('mentor.media.module.store', $module->slug) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#createButton').html('Tambah');
                        $('#createButton').prop('disabled', false);
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'UMKMPlus mentor',
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
                        $('#createButton').html('Tambah');
                        $('#createButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH MEDIA GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH MEDIA GAGAL!',
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
