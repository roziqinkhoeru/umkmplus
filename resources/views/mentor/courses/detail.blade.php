@extends('admin.layouts.app')

@section('content')
    <main>
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
                            <a href="{{ route('mentor.course') }}">
                                Data Kelas
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">
                                Detail Kelas
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
                                    <div class="card-title">Data Siswa</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="courseTable" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Progress</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course->courseEnrolls as $enroll)
                                                @php
                                                    $progress = (($enroll->upto_no_module - 1) / $course->modules->count()) * 100;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $enroll->student->name }}</td>
                                                    <td>{{ $progress }}</td>
                                                    <td>{{ $enroll->started_at }}</td>
                                                    <td>
                                                        <span
                                                            class="badge @switch($enroll->status)
                                                                @case('menunggu pembayaran')
                                                                    badge-info
                                                                    @break
                                                                @case('aktif')
                                                                    badge-info
                                                                    @break
                                                                @case('proses')
                                                                    badge-pending
                                                                    @break
                                                                @case('selesai')
                                                                    badge-diterima
                                                                    @break
                                                            @endswitch"><i
                                                                class="fas fa-circle" style="font-size: 10px"></i>
                                                            {{ $enroll->status }}
                                                        </span>
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
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#courseTable').DataTable({});
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
