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
                        Data Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Mentor</div>
                                <div class="card-tools">
                                    <a href="/admin/mentor/add" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Mentor
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mentorTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Donna Snider</td>
                                            <td>sniderdonna@email.com</td>
                                            <td>
                                                <ol class="mb-0 pl-3">
                                                    <li class="mb-1">Database Management (category_1)</li>
                                                    <li class="mb-1">Basic Programming (category_2)</li>
                                                    <li class="mb-1">HTML (category_3)</li>
                                                </ol>
                                            </td>
                                            <td class="space-nowrap">
                                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Donna Snider</td>
                                            <td>sniderdonna@email.com</td>
                                            <td>
                                                <ol class="mb-0 pl-3">
                                                    <li class="mb-1">Database Management (category_1)</li>
                                                    <li class="mb-1">Basic Programming (category_2)</li>
                                                    <li class="mb-1">HTML (category_3)</li>
                                                </ol>
                                            </td>
                                            <td class="space-nowrap">
                                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Donna Snider</td>
                                            <td>sniderdonna@email.com</td>
                                            <td>
                                                <ol class="mb-0 pl-3">
                                                    <li class="mb-1">Database Management (category_1)</li>
                                                    <li class="mb-1">Basic Programming (category_2)</li>
                                                    <li class="mb-1">HTML (category_3)</li>
                                                </ol>
                                            </td>
                                            <td class="space-nowrap">
                                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
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
            $('#mentorTable').DataTable({});
        });
    </script>
@endsection
