@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Blog</h4>
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
                        <a href="{{ route('admin.blog') }}">
                            Data Blog
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Detail Blog
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
                                <div class="card-title">Data Blog</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('admin.blog.update', $blog->slug) }}" method="POST"
                                enctype="multipart/form-data" id="editBlog">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" value="{{ $blog->title }}"
                                            id="title" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" class="form-control" id="status" name="status">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}"
                                                    @if ($status == $blog->status) selected @endif>
                                                    {{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group form-group-default">
                                        <label for="headline" class="form-label">Headline</label>
                                        <textarea class="form-control" aria-label="With textarea" id="headline" name="headline">{{ $blog->headline }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group form-group-default">
                                        <label for="content" class="form-label">Konten</label>
                                        <textarea type="text" class="form-control" id="content" name="content">{{ $blog->content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label for="thumbnail" class="form-label">Thumbnail</label>
                                        <input type="file" id="thumbnail" onchange="previewImage(event)" name="thumbnail"
                                            accept="image/*">
                                        <img id="imagePreview" src="{{ asset("storage/".$blog->thumbnail) }}"
                                            alt="{{ $blog->slug }}-blog-thumbnail" style="height: 200px; width: 300px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" id="updateButton">Ubah</button>
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
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#editBlog').validate({
            rules: {
                title: {
                    required: true,
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
            },
            messages: {
                title: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Judul tidak boleh kosong',
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
            },
            submithandler: function(form) {
                // tombol spin
                $('#updateButton').prop('disabled', true);
                $('#updateButton').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
                form.submit();
            }
        });
    </script>
@endsection
