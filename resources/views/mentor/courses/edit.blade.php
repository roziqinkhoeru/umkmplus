@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Edit Kelas</h4>
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
                        <a href="#">Form Edit Kelas</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Kelas</div>
                            <div class="card-category">
                                Form ini digunakan untuk mengubah data Kelas
                            </div>
                        </div>
                        <form id="createCourseForm" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- title --}}
                                <div class="form-group form-show-validation row">
                                    <label for="title" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Judul
                                        Kelas
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Masukkan Judul Kelas"
                                                value="{{ $course->title }}" aria-label="title"
                                                aria-describedby="title-addon" id="title" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- description --}}
                                <div class="form-group form-show-validation row">
                                    <label for="description"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Deskripsi
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <textarea type="text" class="form-control" placeholder="Masukkan Deskripsi Kelas" aria-label="description"
                                                aria-describedby="description-addon" id="description" name="description" rows="5" required>{{ $course->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- category --}}
                                <div class="form-group form-show-validation row">
                                    <label for="category_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">
                                        Kategori
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <select class="form-control" aria-label="Default select example" name="category_id"
                                            id="category_id" required>
                                            {{-- <option hidden>Pilih Spesialisasi</option> --}}
                                            @foreach ($categories as $category)
                                                <option @if ($category->id == $course->category_id) selected @endif
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- price --}}
                                <div class="form-group form-show-validation row">
                                    <label for="price" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right"> Harga
                                        (Rp)
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="price" class="form-control" id="price"
                                                placeholder="Masukkan Harga Kelas" value="{{ $course->price }}" required>
                                            <span class="input-group-text"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0">.00</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- thumbnail --}}
                                <div class="form-group form-show-validation row">
                                    <label for="thumbnail"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Thumbnail<span
                                            class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-file input-file-image">
                                            <img class="img-upload-preview" width="240"
                                                src="{{ asset('storage/' . $course->thumbnail) }}" alt="course-thumbnail"
                                                id="imagePreview">
                                            <input type="file" class="form-control form-control-file" id="thumbnail"
                                                name="thumbnail" accept="image/*" required onchange="previewImage(event)">
                                            <label for="thumbnail" class="label-input-file btn btn-black btn-round mt-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-file-image"></i>
                                                </span>
                                                Unggah Thumbnail
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- file_info --}}
                                <div class="form-group form-show-validation row">
                                    <label for="file_info" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">File
                                        Info<span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="mb-2">
                                            <div class="d-flex flex-column flex-sm-row">
                                                @if ($course->file_info)
                                                    <div class="mr-0 mr-sm-5 mb-4 mb-sm-0 mt-3 mt-sm-0">
                                                        <div class="text-sm-center">
                                                            <figure class="file-pdf-info">
                                                                <img src="{{ asset('assets/img/decoration/pdf.png') }}"
                                                                    alt="pdf-file-old">
                                                            </figure>
                                                            <a href="{{ asset('storage/' . $course->file_info) }}"
                                                                target="_blank" class="mb-0">File sebelum</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div id="filePreview"></div>
                                            </div>
                                        </div>
                                        <div class="input-file input-file-image">
                                            <input type="file" class="form-control form-control-file" id="file_info"
                                                name="file_info" accept="application/pdf" required
                                                onchange="previewFile(event)">
                                            <label for="file_info" class="label-input-file btn btn-black btn-round mt-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-file-pdf"></i>
                                                </span>
                                                Upload File Info
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- discount --}}
                                <div class="form-group form-show-validation row">
                                    <label for="discount" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right"> Diskon
                                        Kelas (%)
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group mb-3">
                                            <input type="number" name="discount" class="form-control" id="discount"
                                                min="0" max="100" placeholder="Masukkan Diskon Kelas"
                                                value="{{ $course->discount }}" required>
                                            <span class="input-group-text"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0">%</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- google_form --}}
                                <div class="form-group form-show-validation row">
                                    <label for="google_form" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Link
                                        Google Form
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan Link Google Form" value="{{ $course->google_form }}"
                                                aria-label="google_form" aria-describedby="google_form-addon"
                                                id="google_form" name="google_form" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Submit --}}
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/mentor/course" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="createButton"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }

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

        $.validator.addMethod('maxfilesize', function(value, element, param) {
            var maxSize = param;

            if (element.files.length > 0) {
                var fileSize = element.files[0].size; // Ukuran file dalam byte
                return fileSize <= maxSize;
            }

            return true;
        }, '');

        // Menambahkan aturan khusus untuk link Google Form
        $.validator.addMethod("google_form", function(value, element) {
            // Aturan: Link harus diawali dengan "https://docs.google.com/forms/"
            return this.optional(element) || /^https:\/\/docs\.google\.com\/forms\//.test(value);
        }, "Masukkan link google form yang valid.");

        $("#createCourseForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                description: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true,
                    min: 0,
                },
                thumbnail: {
                    extension: "jpg|jpeg|png",
                    maxfilesize: 2 * 1024 * 1024, // 2MB (dalam byte)
                },
                file_info: {
                    extension: "pdf",
                    maxfilesize: 5 * 1024 * 1024, // 5MB (dalam byte)
                },
                discount: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100,
                },
                google_form: {
                    required: true,
                    url: true,
                    google_form: true,
                },
            },
            messages: {
                title: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>judul maksimal 100 karakter',
                },
                description: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>deskripsi tidak boleh kosong',
                },
                category_id: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>kategori tidak boleh kosong',
                },
                price: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>harga tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>harga harus berupa angka',
                    min: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>harga minimal 0',
                },
                thumbnail: {
                    extension: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>thumbnail harus berupa file gambar (jpg, jpeg, png)',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>ukuran thumbnail maksimal 2MB',
                },
                file_info: {
                    extension: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>file harus berupa file pdf',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>ukuran file maksimal 5MB',
                },
                discount: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>diskon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>diskon harus berupa angka',
                    min: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>diskon minimal 0',
                    max: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>diskon maksimal 100',
                },
                google_form: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>link google form tidak boleh kosong',
                    url: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>link google form harus berupa url',
                    google_form: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>link google form tidak valid',
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
                    url: "{{ route('mentor.course.update', $course->slug) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#createButton').html('Edit');
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
                        $('#createButton').html('Edit');
                        $('#createButton').prop('disabled', false);
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
                    }
                });
            }
        });
    </script>
@endsection
