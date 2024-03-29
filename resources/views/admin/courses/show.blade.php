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
                        <a href="#">
                            Detail Kelas
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                {{-- course data --}}
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Kelas</div>
                            </div>
                        </div>
                        <div class="card-body pt-3">
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
                                            <td>Mentor</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $course->mentor->name }}</td>
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
                {{-- course statistic --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Statistik Kelas</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="statisticCourseChart" style="width: 50%; height: 50%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Student Course --}}
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
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th class="text-center">Progress</th>
                                            <th>Tanggal Mulai</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->courseEnrolls as $enroll)
                                            @php
                                                $progress = (($enroll->upto_no_module - 1) / $course->modules->count()) * 100;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $enroll->student->name }}</td>
                                                <td class="text-center">{{ $progress }}</td>
                                                <td>{{ $enroll->started_at }}</td>
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

        var statisticCourseChart = document.getElementById('statisticCourseChart').getContext('2d');
        var mystatisticCourseChart = new Chart(statisticCourseChart, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{ $course->courseEnrolls->where('status', 'aktif')->count() }},
                        {{ $course->courseEnrolls->where('status', 'selesai')->count() }},
                        {{ $course->courseEnrolls->where('status', 'proses')->count() }},
                        {{ $course->courseEnrolls->where('status', 'menunggu pembayaran')->count() }}
                    ],
                    backgroundColor: ['#1572e8', '#0fae34', '#e0a800', '#fdaf4b']
                }],
                labels: [
                    'Aktif',
                    'Selesai',
                    'Proses',
                    'Menunggu Pembayaran'
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });
    </script>
@endsection
