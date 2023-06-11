@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Withdraw</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/mentor/dashboard">
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
                <div class="col-sm-6 col-md-4">
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
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="flaticon-coins"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Saldo</p>
                                        <h4 class="card-title">Rp {{ number_format($balance, 0, ',', '.') }}</h4>
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
                                <div class="card-tools">
                                    <a href="{{ url('/mentor/withdraw/create') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Permohonan Withdraw
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="withdrawTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="filter-none">Bank</th>
                                            <th class="">Nama Akun Bank</th>
                                            <th class="filter-none">Nomor Akun Bank</th>
                                            <th class="space-nowrap">Jumlah</th>
                                            <th class="text-center space-nowrap filter-none">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $withdraw->bank }}</td>
                                                <td class="">{{ $withdraw->account_name }}</td>
                                                <td class="">{{ $withdraw->account_number }}</td>
                                                <td class="space-nowrap">
                                                    {{ 'Rp ' . number_format($withdraw->amount, 0, ',', '.') }}</td>
                                                <td class="text-center text-capitalize">
                                                    <span
                                                        class="badge @switch($withdraw->status)
                                                                @case('berhasil')
                                                                    badge-diterima
                                                                    @break
                                                                @case('ditolak')
                                                                    badge-ditolak
                                                                    @break
                                                                @case('pending')
                                                                    badge-waiting
                                                                @break
                                                                @case('proses')
                                                                    badge-primary
                                                                @break
                                                            @endswitch"><i
                                                            class="fas fa-circle" style="font-size: 10px"></i>
                                                        {{ $withdraw->status }}
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
        });
    </script>
@endsection
