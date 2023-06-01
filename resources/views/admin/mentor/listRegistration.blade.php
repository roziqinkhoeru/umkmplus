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
                                <table id="registrationTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
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
                                                <td>{{ $mentor->status }}</td>
                                                <td class="space-nowrap">
                                                    <a href="{{ asset('storage/' . $mentor->file_cv) }}"
                                                        class="btn btn-primary btn-sm" download>Download File</a>
                                                    @if ($mentor->status == 'pending')
                                                        <button onclick="acceptRegistration('{{ $mentor->id }}')"
                                                            class="btn btn-success btn-sm" id="acceptButton">Terima</button>
                                                        <button class="btn btn-danger btn-sm" id="rejectedButton"
                                                            onclick="rejectedRegistration('{{ $mentor->id }}')">Ditolak</button>
                                                    @endif
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
        function acceptRegistration(mentorID) {
            event.preventDefault();
            $('#acceptButton').html('<i class="fas fa-circle-notch text-lg spinners"></i>');
            swal.fire({
                title: 'Apakah anda yakin mentor diterima?',
                text: "Akun mentor akan dibuatkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#acceptButton').html('Terima');
                    swal.fire(
                        'Berhasil!',
                        'Form akun mentor akan dibuatkan.',
                        'success'
                    )
                    window.location.href = `{{ url('admin/mentor/registration/${mentorID}') }}`;

                }
            })
        };

        function rejectedRegistration(registrationID) {
            event.preventDefault();
            $('#rejectedButton').html('<i class="fas fa-circle-notch text-lg spinners"></i>');
            swal.fire({
                title: 'Apakah anda yakin pendaftar ditolak?',
                text: "Akun mentor tidak akan dibuatkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `{{ url('/admin/mentor/registration/${registrationID}/rejected') }}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            $('#rejectedButton').html('Ditolak');
                            swal.fire(
                                'Berhasil!',
                                'Pendaftar berhasil ditolak.',
                                'success'
                            )
                        },
                        error: function(response) {
                            $('#rejectedButton').html('Ditolak');
                            swal.fire(
                                'Gagal!',
                                'Pendaftar gagal ditolak, silahkan coba lagi.',
                                response.error
                            )
                        }
                    });
                }
            })
        }


        $(document).ready(function() {
            $('#registrationTable').DataTable({});
        });
    </script>
@endsection
