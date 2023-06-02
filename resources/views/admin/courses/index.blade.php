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
                                    <a href="{{ url('/admin/course/application') }}" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Kelas
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Mentor</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->title }}</td>
                                                <td>{{ $course->mentor->name }}</td>
                                                <td>{{ $course->category->name }}</td>
                                                <td>{{ $course->price }}</td>
                                                <td>
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
                                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                                    <button onclick=""
                                                        class="btn btn-danger btn-sm">Nonaktifkan</button>
                                                    <button onclick="" class="btn btn-warning btn-sm">Aktifkan</button>
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
            $('#courseTable').DataTable({});
        });
    </script>
@endsection
