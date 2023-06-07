@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Blog</h4>
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
                        <a href="/admin/blog">Data Blog</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Blog</div>
                                <div class="card-tools">
                                    <a href="/admin/blog/create" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Buat Blog
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="blogTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Status</th>
                                            <th class="filter-none text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->user->customer->name }}</td>
                                                <td>{{ CustomDate::tglIndo($blog->created_at) }}</td>
                                                <td class="text-capitalize text-center">
                                                    <span
                                                        class="badge @switch($blog->status)
                                                            @case('tampilkan')
                                                                badge-diterima
                                                                @break
                                                            @case('sembunyikan')
                                                                badge-ditolak
                                                                @break
                                                        @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $blog->status }}
                                                    </span>
                                                </td>
                                                <td class="space-nowrap text-center">
                                                    <a href="{{ route('admin.blog.show', $blog->slug) }}"
                                                        class="btn btn-primary btn-sm mr-1">Detail</a>
                                                    <button onclick="deleteBlog('{{ $blog->slug }}')"
                                                        class="btn btn-danger btn-sm mr-1">Hapus</button>
                                                        @if ($blog->status == "tampilkan")
                                                            <button onclick="nonactivateBlog('{{ $blog->slug }}')"
                                                                class="btn btn-warning btn-sm mr-1">Nonaktifkan</button>
                                                        @else
                                                            <button onclick="activateBlog('{{ $blog->slug }}')"
                                                                class="btn btn-success btn-sm">Aktifkan</button>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        $(document).ready(function() {
            $('#blogTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });


        function deleteBlog(blog) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "BLog akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/blog/${blog}') }}`,
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'BLog telah dihapus.',
                                icon: 'success',
                            })
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                        error,
                                })
                        }
                    });

                }
            })
        }


        function nonactivateBlog(blog) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Blog akan dinonaktifkan dan tidak dapat mengakses sistem lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Nonaktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            status: "sembunyikan",
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/blog/${blog}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Blog telah dinonaktifkan.',
                                icon: 'success',
                            })

                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                        error,
                                })
                        }
                    });

                }
            })
        }

        function activateBlog(blog) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Blog akan diaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Aktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            status: "tampilkan",
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/blog/${blog}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Blog telah diaktifkan.',
                                icon: 'success',
                            })
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                        error,
                                })
                        }
                    });

                }
            })
        }
    </script>
@endsection
