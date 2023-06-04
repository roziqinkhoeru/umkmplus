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
                        <a href="{{ route('mentor.course') }}">
                            Data Mentor
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Detail Mentor
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Mentor</div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
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
                                                    <td>{{ $mentor->about }}</td>
                                                </tr>
                                                <tr>
                                                    <td>File CV</td>
                                                    <td class="text-right">
                                                        :
                                                    </td>
                                                    <td>{{ $mentor->file_cv }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td class="text-right">
                                                        :
                                                    </td>
                                                    <td><span
                                                            class="badge @switch($mentor->status)
                                                                    @case('1')
                                                                        badge-success
                                                                        @break
                                                                    @case('0')
                                                                        badge-danger
                                                                        @break
                                                                @endswitch"><i
                                                                class="fas fa-circle" style="font-size: 10px"></i>
                                                            {{ $mentor->status == 1 ? "Aktif" : "Nonaktif"  }}
                                                        </span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                                <div class="card-title">Data Kelas</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="courseTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentor->mentorCourses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->title }}</td>
                                                <td>{{ $course->category->name }}</td>
                                                <td>{{ $course->price }}</td>
                                                <td>{{ $course->discount }}</td>
                                                <td>
                                                    <span
                                                        class="badge @switch($course->status)
                                                                @case('nonaktif')
                                                                    badge-warning
                                                                    @break
                                                                @case('aktif')
                                                                    badge-success
                                                                    @break
                                                                @case('pending')
                                                                    badge-pending
                                                                    @break
                                                                @case('ditolak')
                                                                    badge-ditolak
                                                                    @break
                                                            @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $course->status }}
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
    </script>
@endsection
