@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Tambah Modul</h4>
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
                        <a href="/mentor/course/{{ $course->slug }}/module">Data Modul</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Tambah Modul</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Tambah Modul</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data modul
                            </div>
                        </div>
                        <form id="createCourseForm" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                {{-- title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="title" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Judul
                                        Modul
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Masukkan Judul Modul"
                                                value="{{ old('title') }}" aria-label="title"
                                                aria-describedby="title-addon" id="title" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- file --}}
                                <div class="form-group form-show-validation row">
                                    <label for="file" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">File
                                        Info<span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="mb-2">
                                            <div class="d-flex flex-column flex-sm-row">
                                                <div id="filePreview"></div>
                                            </div>
                                        </div>
                                        <div class="input-file input-file-image">
                                            <input type="file" class="form-control form-control-file" id="file"
                                                name="file" accept="application/pdf" required
                                                onchange="previewFile(event)">
                                            <label for="file" class="label-input-file btn btn-black btn-round mt-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-file-pdf"></i>
                                                </span>
                                                Unggah File Info
                                            </label>
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
        function previewFile(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const filePreview = document.getElementById("filePreview");

            if (file) {
                filePreview.innerHTML = `
                                        <div class="text-sm-center">
                                            <figure class="file-pdf-info">
                                            <img src="{{ asset('assets/img/decoration/pdf.png') }}" alt="pdf-file-new">
                                            </figure>
                                            <p class="mb-0 line-clamp-max-w-320">${file.name}</p>
                                        </div>
                `;
            }
        }

        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");

        $.validator.addMethod('maxfilesize', function(value, element, param) {
            var maxSize = param;

            if (element.files.length > 0) {
                var fileSize = element.files[0].size; // Ukuran file dalam byte
                return fileSize <= maxSize;
            }

            return true;
        }, '');

        $("#createCourseForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                file: {
                    required: true,
                    extension: "pdf",
                    maxfilesize: 3 * 1024 * 1024, // 5MB (dalam byte)
                },
            },
            messages: {
                title: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul maksimal 100 karakter',
                },
                file: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>file tidak boleh kosong',
                    extension: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>file harus berupa file pdf',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>ukuran file maksimal 5MB',
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
                var formData = new FormData(form);
                $('#createButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#createButton').prop('disabled', true);
                $.ajax({
                    url: "{{ route('mentor.module.store', $course->slug) }}",
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
                                title: 'TAMBAH MODULE GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'TAMBAH MODULE GAGAL!',
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
