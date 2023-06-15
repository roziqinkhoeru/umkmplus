@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Siswa</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('mentor.student') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Data Seluruh Siswa
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
                                <div class="card-title">Data Seluruh Siswa</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul Kelas</th>
                                            <th>Nama</th>
                                            <th class="filter-none">Email</th>
                                            <th>Selesai Pada</th>
                                            <th class="text-center">Skor</th>
                                            <th class="text-center filter-none">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enrolls as $enroll)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $enroll->course->title }}</td>
                                                <td>{{ $enroll->student->name }}</td>
                                                <td>{{ $enroll->student->user->email }}</td>
                                                <td data-sort="{{ date('Y-m-d', strtotime($enroll->finished_at)) }}">
                                                    {{ date('d-m-Y', strtotime($enroll->finished_at)) }}</td>
                                                <td class="text-center">
                                                    @if ($enroll->score)
                                                        {{ $enroll->score }}
                                                    @else
                                                        <span class="badge badge-danger">Belum Dinilai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center text-capitalize">
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
            $('#courseTable').DataTable({
                "columnDefs": [{
                    "targets": 'filter-none',
                    "orderable": false,
                }]
            });
        });
    </script>
@endsection
