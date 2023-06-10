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
                        <a href="/admin/mentor">Data Mentor</a>
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
                                    <a href="{{ route('admin.mentor.application') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Pendaftar Mentor
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mentorTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th class="fiter-none">Email</th>
                                            <th class="filter-none">Kelas</th>
                                            <th class="text-center">Status</th>
                                            <th class="filter-none text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentors as $mentor)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $mentor->name }}</td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>
                                                    <ol class="mb-0 pl-3">
                                                        @foreach ($mentor->mentorCourses as $mentorCourse)
                                                            <li class="mb-1">{{ $mentorCourse->title }} <span
                                                                    class="badge badge-info badge-category">{{ $mentorCourse->category->name }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge @if ($mentor->dataMentor->status == 1) badge-active
                                                    @else
                                                        badge-nonactive @endif"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $mentor->dataMentor->status == 1 ? 'Aktif' : 'Nonaktif' }}</span>
                                                </td>
                                                <td class="space-nowrap">
                                                    <a href="{{ url('/admin/mentor/' . $mentor->slug) }}"
                                                        class="btn btn-primary btn-sm mr-1">Detail</a>
                                                    @if ($mentor->dataMentor->status == 1)
                                                        <button onclick="nonaktifkanMentor('{{ $mentor->slug }}')"
                                                            class="btn btn-danger btn-sm mr-1">Nonaktifkan</button>
                                                    @else
                                                        <button onclick="aktifkanMentor('{{ $mentor->slug }}')"
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
            $('#mentorTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });

        function nonaktifkanMentor(mentor) {
            swal({
                title: 'Apakah anda yakin?',
                text: "Mentor akan dinonaktifkan!",
                icon: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Nonaktifkan mentor!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            status: 0,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/mentor/${mentor}') }}`,
                        success: function(response) {
                            location.reload();
                            swal({
                                title: 'Berhasil!',
                                text: 'Mentor telah dinonaktifkan.',
                                icon: 'success',
                            })

                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                swal({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            else
                                swal({
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
            swal({
                title: 'Apakah anda yakin?',
                text: "Mentor akan diaktifkan!",
                icon: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Aktifkan mentor!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            status: 1,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/admin/mentor/${mentor}') }}`,
                        success: function(response) {
                            location.reload();
                            swal({
                                title: 'Berhasil!',
                                text: 'Mentor telah diaktifkan.',
                                icon: 'success',
                            })
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                swal({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: xhr.responseJSON.meta.message,
                                })
                            else
                                swal({
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
