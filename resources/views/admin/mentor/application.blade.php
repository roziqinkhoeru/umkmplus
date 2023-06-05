@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Application</h4>
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
                            Data Pendaftaran Mentor
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
                                <div class="card-title">Data Pendaftaran Mentor</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="registrationTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th class="filter-none">Email</th>
                                            <th class="filter-none">No Telepon</th>
                                            <th class="filter-none">Alamat</th>
                                            <th class="filter-none">Pekerjaan</th>
                                            <th class="text-center">Spesialisasi</th>
                                            <th class="text-center space-nowrap">Status</th>
                                            <th class="text-center filter-none space-nowrap">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentors as $mentor)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $mentor->fullname }}</td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>{{ $mentor->phone }}</td>
                                                <td>{{ $mentor->address }}</td>
                                                <td>{{ $mentor->job }}</td>
                                                <td class="text-center">{{ $mentor->specialist }}</td>
                                                <td class="space-nowrap text-capitalize"><span
                                                        class="badge @switch($mentor->status)
                                                            @case('pending')
                                                                badge-pending
                                                                @break
                                                            @case('diterima')
                                                                badge-diterima
                                                                @break
                                                            @case('ditolak')
                                                                badge-ditolak
                                                                @break
                                                            @default
                                                                badge-pending
                                                                @break
                                                        @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $mentor->status }}</span></td>
                                                <td class="space-nowrap">
                                                    <a href="{{ asset('storage/' . $mentor->file_cv) }}"
                                                        class="btn btn-primary btn-sm mr-1" download>Download CV</a>
                                                    @if ($mentor->status == 'pending')
                                                        <button onclick="acceptRegistration('{{ $mentor->id }}')"
                                                            class="btn btn-success btn-sm mr-1"
                                                            id="acceptButton">Terima</button>
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
            $('#acceptButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
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
                $('#acceptButton').html('Terima');
            })
        };

        function rejectedRegistration(registrationID) {
            event.preventDefault();
            $('#rejectedButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
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
                $('#rejectedButton').html('Ditolak');
            })
        }


        $(document).ready(function() {
            $('#registrationTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });
    </script>
@endsection
