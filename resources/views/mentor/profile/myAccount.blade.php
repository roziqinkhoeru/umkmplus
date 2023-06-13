@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Profil Mentor</h4>
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
                        <a href="#">
                            Profil Mentor
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                {{-- mentor data --}}
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Mentor</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>No Telepon</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ CustomDate::tglIndo($mentor->dob) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->job }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tentang</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $mentor->dataMentor->about }}</td>
                                        </tr>
                                        <tr>
                                            <td>File CV</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>
                                                @if ($mentor->dataMentor->file_cv)
                                                    <a href="{{ asset('storage/' . $mentor->dataMentor->file_cv) }}"
                                                        class="">{{ substr($mentor->dataMentor->file_cv, 3) }}</a>
                                                @else
                                                    <span>CV tidak tersedia</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td><span
                                                    class="badge @switch($mentor->dataMentor->status)
                                                                    @case(1)
                                                                        badge-active
                                                                        @break
                                                                    @case(0)
                                                                        badge-nonactive
                                                                        @break
                                                                @endswitch"><i
                                                        class="fas fa-circle" style="font-size: 10px"></i>
                                                    {{ $mentor->dataMentor->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                                </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-right mt-5 mb-2">
                                    <a href="{{ route('mentor.edit.profile', $mentor->id) }}"
                                        class="btn btn-primary btn-sm mr-2">Edit</a>
                                    {{-- a href reset password --}}
                                    <a href="{{ route('mentor.edit.password') }}" class="btn btn-warning btn-sm mr-3">Reset
                                        Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- mentor statistic (course) --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik Mentor (Data Kelas)</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="statisticMentorCourseChart" style="width: 50%; height: 50%"></canvas>
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

        let statisticMentorCourseChart = document.getElementById('statisticMentorCourseChart').getContext('2d');
        let mystatisticMentorCourseChart = new Chart(statisticMentorCourseChart, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{ $mentor->mentorCourses->where('status', 'aktif')->count() }},
                        {{ $mentor->mentorCourses->where('status', 'nonaktif')->count() }},
                        {{ $mentor->mentorCourses->where('status', 'pending')->count() }},
                        {{ $mentor->mentorCourses->where('status', 'ditolak')->count() }}
                    ],
                    backgroundColor: ['#1572e8', '#2a2f5b', '#e0a800', '#f25961']
                }],
                labels: [
                    'Aktif',
                    'Nonaktif',
                    'Pending',
                    'Ditolak'
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
