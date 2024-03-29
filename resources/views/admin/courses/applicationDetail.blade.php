@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Kelas</h4>
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
                        <a href="{{ route('admin.course') }}">
                            Data Kelas
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.course.application') }}">
                            Data Pengajuan Kelas
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Detail Pengajuan Kelas
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Kelas</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Judul</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Modul</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->modules->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diskon</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->discount }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td><span
                                                    class="badge @switch($course->status)
                                                                    @case('aktif')
                                                                    badge-info
                                                                        @break
                                                                    @case('nonaktif')
                                                                            badge-diterima
                                                                            @break
                                                                    @case('pending')
                                                                        badge-pending
                                                                        @break
                                                                    @case('ditolak')
                                                                        badge-ditolak
                                                                        @break
                                                                @endswitch"><i
                                                        class="fas fa-circle" style="font-size: 10px"></i>
                                                    {{ Str::upper($course->status) }}
                                                </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Pemrosesan Kelas</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                @if ($course->status == 'ditolak')
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <i class="fas fa-exclamation-triangle mr-3 text-danger text-2xl"></i>
                                        <div>
                                            Status kelas telah ditangguhkan.
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button onclick="acceptApplication('{{ $course->slug }}')"
                                                class="btn btn-success w-100 fw-bold mr-sm-1 mb-2 mb-sm-0"
                                                id="acceptButton">Terima
                                                Kelas</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-danger w-100 fw-bold" id="rejectedButton"
                                                onclick="rejectedApplication('{{ $course->slug }}')">Tolak Kelas</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Module Course --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Module</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th class="filter-none">File Pendukung</th>
                                            <th class="filter-none">Media Module</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->modules as $module)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $module->title }}</td>
                                                <td><a href="{{ $module->file }}" target="_blank"
                                                        rel="noopener noreferrer">{{ $module->file }}</a>
                                                </td>
                                                <td>
                                                    <ol class="mb-0 pl-3">
                                                        @foreach ($module->mediaModules as $mediaModule)
                                                            <li class="mb-1">{{ $mediaModule->title }} <span
                                                                    class="badge badge-category badge-primary"><a
                                                                        href="https://www.youtube.com/watch?v={{ $mediaModule->video_url }}"
                                                                        target="_blank" rel="noopener noreferrer"
                                                                        class="text-white">video <i
                                                                            class="fas fa-external-link-alt"
                                                                            style="font-size: 9px"></i></a></span>
                                                            </li>
                                                        @endforeach
                                                    </ol>
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


        function acceptApplication(courseSlug) {
            event.preventDefault();
            $('#acceptButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
            swal.fire({
                title: 'Apakah anda yakin kelas diterima?',
                text: "Kelas akan dibuatkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#acceptButton').html('Terima');
                    swal.fire(
                        'Berhasil!',
                        'Form akun kelas akan dibuatkan.',
                        'success'
                    )
                    window.location.href = `{{ url('admin/course/application/${courseSlug}/accept') }}`;
                }
                $('#acceptButton').html('Terima');
            })
        };

        function rejectedApplication(courseSLug) {
            event.preventDefault();
            $('#rejectedButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
            swal.fire({
                title: 'Apakah anda yakin kelas ditolak?',
                text: "Kelas tidak akan dibuatkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `{{ url('/admin/course/application/${courseSLug}/reject') }}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            $('#rejectedButton').html('Ditolak');
                            swal.fire(
                                'Berhasil!',
                                'Pengajuan kelas berhasil ditolak.',
                                'success'
                            )
                            window.location.href = response.data.redirect;
                        },
                        error: function(response) {
                            $('#rejectedButton').html('Ditolak');
                            swal.fire(
                                'Gagal!',
                                'Pengajuan kelas gagal ditolak, silahkan coba lagi.',
                                response.error
                            )
                        }
                    });
                }
                $('#rejectedButton').html('Ditolak');
            })
        }
    </script>
@endsection
