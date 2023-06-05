@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Testimonial</h4>
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
                        <a href="#">
                            Data Testimonial
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Testimonial</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="studentTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th class="filter-none">Judul Kelas</th>
                                            <th class="filter-none">Testimonial</th>
                                            <th class="filter-none">Rating</th>
                                            <th class="text-center filter-none">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $testimonial)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $testimonial->courseEnroll ? $testimonial->courseEnroll->student->name : '' }}
                                                </td>
                                                <td>{{ $testimonial->courseEnroll ? $testimonial->courseEnroll->course->title : '' }}
                                                </td>
                                                <td>{{ $testimonial->testimonial }}</td>
                                                <td>{{ $testimonial->rating }}</td>
                                                <td class="space-nowrap text-center">
                                                    <a href="{{ url('admin/testimonial/' . $testimonial->id) }}"
                                                        class="btn btn-primary btn-sm">Detail</a>
                                                        @if ($testimonial->status == "tampilkan")
                                                            <button onclick="hideTestimonial('{{ $testimonial->id }}')"
                                                                class="btn btn-danger btn-sm mr-1">Nonaktifkan</button>
                                                        @else
                                                            <button onclick="showTestimonial('{{ $testimonial->id }}')"
                                                                class="btn btn-warning btn-sm">Aktifkan</button>
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
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });


        function showTestimonial(testimonial) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Testimonial akan ditampilkan!",
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
                        url: `{{ url('/admin/testimonial/${testimonial}') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Testimonial telah ditampilkan.',
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

        function hideTestimonial(testimonial) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Testimonial akan di sembunyikan!",
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
                            status: "sembunyikan",
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/testimonial/${testimonial}') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Testimonial telah di sembunyikan.',
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
