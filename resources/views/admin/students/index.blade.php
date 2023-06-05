@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Siswa</h4>
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
                                <div class="card-title">Data Siswa</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="studentTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th class="filter-none">Email</th>
                                            <th class="filter-none">No Telepon</th>
                                            <th class="filter-none">Alamat</th>
                                            <th>Jumlah Kelas</th>
                                            <th class="text-center filter-none">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->phone }}</td>
                                                <td> {{ $student->address }} </td>
                                                <td> {{ $student->student_course_enrolls_count }} </td>
                                                <td class="space-nowrap text-center">
                                                    <a href="{{ url('admin/student/' . $student->id) }}"
                                                        class="btn btn-primary btn-sm">Detail</a>
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
            $('#studentTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });
    </script>
@endsection
