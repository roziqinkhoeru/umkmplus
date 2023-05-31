@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Mentor</h4>
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
                        Data Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Mentor</div>
                                <div class="card-tools">
                                    <a href="{{ route('admin.mentor.create') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Mentor
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mentorTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentors as $mentor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mentor->name }}</td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>
                                                    <ol class="mb-0 pl-3">
                                                        @foreach ($mentor->mentorCourses as $mentorCourse)
                                                            <li class="mb-1">{{ $mentorCourse->title }}
                                                                ({{ $mentorCourse->category->name }})
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>
                                                    {{ $mentor->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                                </td>
                                                <td class="space-nowrap">
                                                    <a href="{{ url('/admin/mentor/' . $mentor->slug) }}"
                                                        class="btn btn-primary btn-sm">Detail</a>
                                                    @if ($mentor->status == 1)
                                                        <button
                                                            onclick="nonaktifkanMentor('{{ $mentor->slug }}')"
                                                            class="btn btn-danger btn-sm">Nonaktifkan</button>
                                                    @else
                                                        <button
                                                            onclick="aktifkanMentor('{{ $mentor->slug }}')"
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
            $('#mentorTable').DataTable({});
        });

        function nonaktifkanMentor(mentor) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Mentor akan dinonaktifkan dan tidak dapat mengakses sistem lagi!",
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
                            status: 0,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/mentor/${mentor}') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Mentor telah dinonaktifkan.',
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

        function aktifkanMentor(mentor) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Mentor akan diaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'aktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            status: 1,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/mentor/${mentor}') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Mentor telah diaktifkan.',
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
