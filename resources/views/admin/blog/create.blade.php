@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Tambah Blog</h4>
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
                        <a href="{{ route('admin.blog') }}">
                            Data Blog
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Tambah Blog
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                <div class="col-md-12">
                    {{-- blog data --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Tambah Data Blog</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('admin.blog.store') }}" method="POST"
                                enctype="multipart/form-data" id="addBlog">
                                @csrf
                                {{-- title --}}
                                <div class="col-md-6">
                                    <div class="form-group form-group-default mb-0">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" value="{{ old('title') }}"
                                            id="title" name="title" required>
                                    </div>
                                    <p id="titleCountWrapper" class="mb-3 mt-1 text-xs text-success"><span
                                            id="titleCount"></span> karakter
                                        tersisa</p>
                                </div>
                                {{-- status --}}
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" class="form-control" id="status" name="status" required>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- headline --}}
                                <div class="col-12">
                                    <div class="form-group form-group-default mb-0">
                                        <label for="headline" class="form-label">Headline</label>
                                        <textarea class="form-control" aria-label="With textarea" id="headline" name="headline" required rows="3"
                                            maxlength="120">{{ old('headline') }}</textarea>
                                    </div>
                                    <p class="mb-3 mt-1 text-xs text-success" id="headlineCountWrapper"><span
                                            id="headlineCount">120</span>
                                        karakter
                                        tersisa.</p>
                                </div>
                                {{-- content --}}
                                <div class="col-12">
                                    <div id="contentWrapper" class="form-group form-group-default pb-3">
                                        <label for="content" class="form-label mb-2">Konten</label>
                                        <textarea type="text" class="form-control" id="content" name="content" required>{{ old('content') }}</textarea>
                                    </div>
                                </div>
                                {{-- thumbnail --}}
                                <div class="col-md-12">
                                    <div class="form-group form-group-default pb-3 mb-4">
                                        <label for="thumbnail" class="form-label mb-2">Thumbnail</label>
                                        <div class="input-file input-file-image">
                                            <img class="img-upload-preview" width="240" src="http://placehold.it/240x240"
                                                alt="blog-thumbnail-preview" id="imagePreview">
                                            <input type="file" class="form-control form-control-file" id="thumbnail"
                                                name="thumbnail" accept="image/*" required onchange="previewImage(event)">
                                            <label for="thumbnail" class="label-input-file btn btn-black btn-round mt-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-file-image"></i>
                                                </span>
                                                Upload a Image
                                            </label>
                                            <button type="button" onclick="deleteImage()"
                                                class="btn btn-danger btn-round ml-3 btn-delete-image mt-2">
                                                <span class="btn-label"><i class="fas fa-trash-alt"></i></span>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- button --}}
                                <div class="col-12">
                                    <div class="text-right"><button type="submit" class="btn btn-primary"
                                            id="updateButton">Buat Blog</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <script>
        ClassicEditor.create(document.querySelector('#content'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'bold', 'italic',
                        '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
                    ]
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                },
                input: {
                    class: 'text-lg mb-15'
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        window.onload = function() {
            const imagePreview = document.getElementById('imagePreview');
            var storedImage = localStorage.getItem('imageBlogPreview');

            if (storedImage) {
                imagePreview.src = storedImage;
            }
        };

        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                localStorage.setItem('imageBlogPreview', e.target.result);
            };

            reader.readAsDataURL(file);
        }

        function deleteImage() {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = 'http://placehold.it/240x240'; // Replace with your default image URL
            localStorage.removeItem('imageBlogPreview');
        }

        $(document).ready(function() {
            const headlineTextarea = $("#headline");
            const headlineCountWrapper = $("#headlineCountWrapper");
            const headlineCount = $("#headlineCount");
            const titleInput = $("#title");
            const titleCountWrapper = $("#titleCountWrapper");
            const titleCount = $("#titleCount");
            const maxLengthTitle = 100; // Set the maximum character count here

            updateTitleCharacterCount();
            updateHeadlineCharacterCount();

            titleInput.on("input", updateTitleCharacterCount);
            headlineTextarea.on("input", updateHeadlineCharacterCount);

            function updateHeadlineCharacterCount() {
                const maxLength = headlineTextarea.attr("maxlength");
                const remainingCharacters = maxLength - headlineTextarea.val().length;

                headlineCount.text(remainingCharacters);
                headlineCountWrapper
                    .toggleClass("text-success", remainingCharacters > 30)
                    .toggleClass("text-warning", remainingCharacters <= 30 && remainingCharacters > 0)
                    .toggleClass("text-danger", remainingCharacters === 0);
            }

            function updateTitleCharacterCount() {
                const remainingCharacters = maxLengthTitle - titleInput.val().length;
                titleCount.text(remainingCharacters);
                titleCountWrapper
                    .toggleClass("text-success", remainingCharacters > 30)
                    .toggleClass("text-warning", remainingCharacters <= 30 && remainingCharacters > 0)
                    .toggleClass("text-danger", remainingCharacters <= 0);
            }
        });

        // Menambahkan aturan validasi kustom untuk ukuran maksimum file
        $.validator.addMethod('maxfilesize', function(value, element, param) {
            var maxSize = param;

            if (element.files.length > 0) {
                var fileSize = element.files[0].size; // Ukuran file dalam byte
                return fileSize <= maxSize;
            }

            return true;
        }, '');

        $('#addBlog').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 100,
                },
                status: {
                    required: true,
                },
                headline: {
                    required: true,
                },
                content: {
                    required: true,
                },
                thumbnail: {
                    required: true,
                    maxfilesize: 2 * 1024 * 1024, // 2MB (dalam byte)
                    extension: 'jpg|jpeg|png',
                },
            },
            messages: {
                title: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Judul tidak boleh kosong',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Judul tidak boleh lebih dari 100 karakter',
                },
                status: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Status tidak boleh kosong',
                },
                headline: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Headline tidak boleh kosong',
                },
                content: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Konten tidak boleh kosong',
                },
                thumbnail: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Thumbnail tidak boleh kosong',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Ukuran file maksimal 2MB',
                    extension: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Ekstensi file yang diperbolehkan hanya .jpg, .jpeg, dan .png',
                },
            },
        });
    </script>
@endsection
