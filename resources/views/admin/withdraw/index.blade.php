@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Withdraw</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/mentor/withdraw">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Data Withdraw
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Balance --}}
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="flaticon-graph"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pendapatan</p>
                                        <h4 class="card-title">Rp {{ number_format($revenue, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- History of Withdraw --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Withdraw</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="withdrawTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Bank</th>
                                            <th class="text-center">Nama Mentor</th>
                                            <th class="text-center">Nama Akun Bank</th>
                                            <th class="text-center">Nomer Akun Bank</th>
                                            <th class="text-center space-nowrap">Jumlah</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
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
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#withdrawTable').DataTable({
                "columnDefs": [{
                    "targets": 'filter-none',
                    "orderable": false,
                }]
            });

            getWithdraw();
        });

        function getWithdraw() {
            $.ajax({
                url: "{{ route('get.admin.withdraw') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    if (response.data.withdraws.length > 0) {
                        $.each(response.data.withdraws, function(index, withdraw) {
                            let option = {
                                style: 'currency',
                                currency: 'IDR',
                                useGrouping: true,
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0,
                            };
                            let amount = withdraw.amount.toLocaleString('id-ID', option);
                            var rowData = [
                                index + 1,
                                withdraw.customer.name,
                                withdraw.bank,
                                withdraw.account_name,
                                withdraw.account_number,
                                amount,
                                getStatusBadge(withdraw.status),
                                `${(withdraw.status == "pending" ? `<button class="btn btn-sm btn-warning" onclick="processWithdraw('${withdraw.id}')">Proses</button>`
                                : (withdraw.status == "proses" ? `<a href="/admin/withdraw/${withdraw.id}" class="btn btn-sm btn-primary">Bayar</a>`: ``))}
                                ${(withdraw.status == "ditolak" || withdraw.status == "berhasil" ? `` : `<button class="btn btn-sm btn-danger" onclick="rejectWithdraw('${withdraw.id}')">Ditolak</button>`)}`
                            ];
                            var rowNode = $('#withdrawTable').DataTable().row.add(rowData).draw(false).node();

                            $(rowNode).find('td').eq(0).addClass('text-center');
                            $(rowNode).find('td').eq(1).addClass('text-center');
                            $(rowNode).find('td').eq(2).addClass('text-center');
                            $(rowNode).find('td').eq(3).addClass('text-center');
                            $(rowNode).find('td').eq(4).addClass('text-center space-nowrap');
                            $(rowNode).find('td').eq(5).addClass('text-center text-capitalize');
                        });
                    } else {
                        console.log("Data Kosong");
                    }
                }
            });
        }

        // Function to get the status badge element based on the status
        function getStatusBadge(status) {
            switch (status) {
                case 'berhasil':
                    return '<span class="badge badge-success">Berhasil</span>';
                case 'ditolak':
                    return '<span class="badge badge-danger">Ditolak</span>';
                case 'pending':
                    return '<span class="badge badge-warning">Pending</span>';
                case 'proses':
                    return '<span class="badge badge-primary">Proses</span>';
                default:
                    return '';
            }
        }

        function rejectWithdraw(withdraw) {
            Swal.fire({
                title: 'Apakah anda yakin menolak withdraw?',
                text: "Anda tidak dapat mengembalikan data yang telah ditolak!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/withdraw/${withdraw}/status`,
                        type: "PUT",
                        data: {
                            "status": "ditolak",
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "JSON",
                        success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    location.reload();
                                });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        }

        function processWithdraw(withdraw) {
            Swal.fire({
                title: 'Apakah anda yakin memproses withdraw?',
                text: "Memproses withdraw!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Proses',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/withdraw/${withdraw}/status`,
                        type: "PUT",
                        data: {
                            "status": "proses",
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "JSON",
                        success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    location.reload();
                                });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
