@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Kelas</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('mentor.dashboard') }}">
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
                                            <td>Jumlah Module</td>
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
                                        <tr>
                                            <td>Aksi</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>
                                                <a href="{{ route('mentor.module', $course->slug) }}" class="btn btn-primary">Modul</a>
                                                <a href="{{ route('mentor.course.edit', $course->slug) }}" class="btn btn-warning">Edit</a>
                                                <a href="{{ route('mentor.course.destroy', $course->slug) }}" class="btn btn-danger">Hapus</a>
                                            </td>
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
                                            <th>Progress</th>
                                            <th>Tanggal Mulai</th>
                                            <th class="text-center filter-none">Status</th>
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
                                                <td>{{ $progress }}</td>
                                                <td>{{ $enroll->started_at }}</td>
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

            {{-- Testimonial Course --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Testimoni</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="testimonialTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Siswa</th>
                                            <th>Testimoni</th>
                                            <th>Rating</th>
                                            <th class="text-center filter-none">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

            getTestimoniCourse();
        });

        let statisticCourseChart = document.getElementById('statisticCourseChart').getContext('2d');
        let mystatisticCourseChart = new Chart(statisticCourseChart, {
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

        function getTestimoniCourse() {
            $.ajax({
                url: "{{ route('mentor.course.testimonial', $course->slug) }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    if (response.data.testimonials.length > 0) {
                        $.each(response.data.testimonials, function(index, testimonial) {
                            var rowData = [
                                index + 1,
                                testimonial.course_enroll.student.name,
                                testimonial.testimonial,
                                testimonial.rating,
                                testimonial.status,
                            ];
                            $('#testimonialTable').DataTable().row.add(rowData).draw(false);
                        });
                    } else {
                        console.log("Data Kosong");
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
