@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Discount</h4>
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
                            Data Discount
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
                                <div class="card-title">Data Discount</div>
                                <div class="card-tools">
                                    <a href="{{ url('/mentor/discount/create') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Discount
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="discountTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="filter-none">Kode</th>
                                            <th>Diskon</th>
                                            <th class="text-center">Status</th>
                                            <th>Tanggal</th>
                                            <th class="text-center filter-none space-nowrap">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discounts as $discount)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $discount->code }}</td>
                                                <td>Rp {{ number_format($discount->discount, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge @switch($discount->status)
                                                                @case(1)
                                                                    badge-diterima
                                                                    @break
                                                                @case(0)
                                                                    badge-ditolak
                                                                    @break
                                                            @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $discount->status ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                                <td data-sort="{{ date('Y-m-d', strtotime($discount->created_at)) }}">
                                                    {{ date('d-m-Y', strtotime($discount->created_at)) }}</td>
                                                <td class="space-nowrap">
                                                    <a href="{{ url('/mentor/discount/' . $discount->id) }}"
                                                        class="btn btn-primary btn-sm mr-1">Edit</a>
                                                    @if ($discount->status == 1)
                                                        <button onclick="nonactivateDiscount('{{ $discount->id }}')"
                                                            class="btn btn-warning btn-sm mr-1">Nonaktifkan</button>
                                                    @else
                                                        <button onclick="activateDiscount('{{ $discount->id }}')"
                                                            class="btn btn-info btn-sm mr-1">Aktifkan</button>
                                                    @endif
                                                    <button onclick="deleteDiscount('{{ $discount->id }}')"
                                                        class="btn btn-danger btn-sm">Hapus</button>
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
            $('#discountTable').DataTable({
                "columnDefs": [{
                    "targets": 'filter-none',
                    "orderable": false,
                }],
            });
        });

        function nonactivateDiscount(discount) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Diskon akan dinonaktifkan!",
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
                            status: 0,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/mentor/discount/${discount}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Diskon telah dinonaktifkan.',
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

        function activateDiscount(discount) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Diskon akan diaktifkan!",
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
                            status: 1,
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/mentor/discount/${discount}/status') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Diskon telah diaktifkan.',
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

        function deleteDiscount(discount) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Diskon akan di hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        url: `{{ url('/mentor/discount/${discount}/destroy') }}`,
                        success: function(response) {
                            location.reload();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Diskon telah di hapus.',
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
    </script>
@endsection
