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
                        Data Pendaftaran Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Pendaftaran Mentor</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mentorTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentors as $mentor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mentor->fullname }}</td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>{{ $mentor->phone }}</td>
                                                <td>{{ $mentor->address }}</td>
                                                <td class="space-nowrap">
                                                    <a href="{{ asset('storage/' . $mentor->file_cv) }}" class="btn btn-primary btn-sm" download>Download File</a>
                                                    <a href="#" onclick="registrationAccount()" class="btn btn-success btn-sm">Terima</a>
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
            $('#mentorTable').DataTable({});
        });

        function registrationAccount() {
            event.preventDefault();
            swal.fire({
                title: 'Apakah anda yakin mentor diterima?',
                text: "Akun mentor akan dibuatkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.fire(
                        'Berhasil!',
                        'Form akun mentor akan dibuatkan.',
                        'success'
                    )
                window.location.href = "{{ route('admin.mentor.registration.account', $mentor->id) }}";

                }
            })
        }
    </script>
@endsection
