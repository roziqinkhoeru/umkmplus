@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Detail Kelas Siswa</h4>
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
                        <a href="{{ url('admin/student') }}">
                            Data Siswa
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Data Kelas Siswa
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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="studentTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th>Mentor</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="space-nowrap">Harga</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($student->studentCourseEnrolls as $enroll)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $enroll->course->title }}</td>
                                                <td>{{ $enroll->course->mentor->name }}</td>
                                                <td class="text-center space-nowrap">{{ $enroll->course->category->name }}
                                                </td>
                                                <td class="space-nowrap">
                                                    {{ 'Rp ' . number_format($enroll->course->price, 0, ',', '.') }}</td>
                                                <td class="text-center space-nowrap text-capitalize">
                                                    <span
                                                        class="badge @switch($enroll->status)
                                                                    @case('menunggu pembayaran')
                                                                        badge-waiting
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({});
        });
    </script>
@endsection
