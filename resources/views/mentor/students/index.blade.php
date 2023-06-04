@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Siswa</h4>
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
                        <a href="#">
                            Data Siswa
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
                                <div class="card-title">Data Siswa Belum Dinilai</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul Kelas</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Selesai Pada</th>
                                            <th>Skor</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enrolls as $enroll)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $enroll->course->title }}</td>
                                                <td>{{ $enroll->student->name }}</td>
                                                <td>{{ $enroll->student->user->email }}</td>
                                                <td data-sort="{{ date('Y-m-d', strtotime($enroll->finished_at)) }}">
                                                    {{ date('d-m-Y', strtotime($enroll->finished_at)) }}</td>
                                                <td>{{ $enroll->score }}</td>
                                                <td>
                                                    <span
                                                        class="badge @switch($enroll->status)
                                                            @case('aktif')
                                                                badge-warning
                                                                @break
                                                            @case('selesai')
                                                                badge-diterima
                                                                @break
                                                            @default
                                                                badge-danger
                                                                @break
                                                        @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $enroll->status }}
                                                    </span>
                                                </td>
                                                <td class="space-nowrap">
                                                    <a href="{{ url('/mentor/student/' . $enroll->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
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
    @if (session('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @elseif (session('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#courseTable').DataTable();
        });
    </script>
@endsection
