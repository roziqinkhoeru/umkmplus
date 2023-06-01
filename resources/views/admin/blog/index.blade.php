@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Blog</h4>
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
                        <a href="/admin/blog">Data Blog</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Blog</div>
                                <div class="card-tools">
                                    <a href="/admin/blog/create" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Buat Blog
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="blogTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Tanggal Dibuat</th>
                                            <th class="filter-none text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Database Managament</td>
                                            <td>Rafli Ferdian Ramadhan</td>
                                            <td>25 Agustus 2023 (datetime)</td>
                                            <td class="space-nowrap text-center">
                                                <a href="#" class="btn btn-primary btn-sm mr-1">Detail</a>
                                                <button onclick="" class="btn btn-danger btn-sm mr-1">Hapus</button>
                                            </td>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#blogTable').DataTable({
                columnDefs: [{
                    targets: 'filter-none',
                    orderable: false,
                }, ],
            });
        });
    </script>
@endsection
