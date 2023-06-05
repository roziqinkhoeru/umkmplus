@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Kelas</h4>
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
                            Data Kelas
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
                                <div class="card-title">Data Kelas</div>
                                <div class="card-tools">
                                    <a href="{{ url('/admin/course/application') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Data Pengajuan Kelas
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th>Mentor</th>
                                            <th class="text-center">Kategori</th>
                                            <th>Harga</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center filter-none">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $course->title }}</td>
                                                <td>{{ $course->mentor->name }}</td>
                                                <td class="text-center">{{ $course->category->name }}</td>
                                                <td class="space-nowrap">
                                                    {{ 'Rp ' . number_format($course->price, 0, ',', '.') }}</td>
                                                <td class="text-capitalize text-center">
                                                    <span
                                                        class="badge @switch($course->status)
                                                            @case('aktif')
                                                                badge-diterima
                                                                @break
                                                            @case('nonaktif')
                                                                badge-ditolak
                                                                @break
                                                        @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $course->status }}
                                                    </span>
                                                </td>
                                                <td class="space-nowrap">
                                                    <a href="{{ url('/admin/course/' . $course->slug) }}"
                                                        class="btn btn-primary btn-sm mr-1">Detail</a>
                                                    @if ($course->status == 'aktif')
                                                        <button onclick="nonaktifkanCourse('{{ $course->slug }}')"
                                                            class="btn btn-danger btn-sm">Nonaktifkan</button>
                                                    @else
                                                        <button onclick="aktifkanCourse('{{ $course->slug }}')"
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
            $('#courseTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });

        function nonaktifkanCourse(course) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Kelas akan dinonaktifkan!",
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
                            status: "nonaktif",
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/course/${course}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Kelas telah dinonaktifkan.',
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

        function aktifkanCourse(course) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Kelas akan diaktifkan!",
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
                            status: "aktif",
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/course/${course}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Kelas telah diaktifkan.',
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
