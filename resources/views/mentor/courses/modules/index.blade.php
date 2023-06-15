@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Module</h4>
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
                        <a href="/mentor/course">Data Kelas</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/mentor/course/{{ $course->slug }}">Kelas {{ $course->title }}</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Module</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Module Kelas {{ $course->title }}</div>
                                <div class="card-tools">
                                    <a href="{{ url('/mentor/course/' . $course->slug . '/module/create') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Module
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="moduleTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th class="text-center">Urutan Module</th>
                                            <th class="text-center">File</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
            $('#moduleTable').DataTable({
                "columnDefs": [{
                    "targets": 'filter-none',
                    "orderable": false,
                }]
            });
            getModuleModule();
        });

        function getModuleModule() {
            $.ajax({
                url: "{{ route('get.mentor.module', $course->slug) }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    if (response.data.modules.length > 0) {
                        $.each(response.data.modules, function(index, module) {
                            var rowData = [
                                index + 1,
                                module.title,
                                module.no_module,
                                `<a href="{{ asset('storage/${module.file}') }}" target="_blank" class="btn btn-info btn-sm">Lihat</a>`,
                                `<a href="/mentor/module/${module.slug}/media" class="btn btn-sm btn-primary mr-1">Media</a>
                                <a href="/mentor/course/{{ $course->slug }}/module/${module.slug}/edit" class="btn btn-sm btn-warning mr-1">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="deleteModule('${module.slug}')">Hapus</button>`
                            ];
                            var rowNode = $('#moduleTable').DataTable().row.add(rowData).draw(false)
                                .node();
                            $(rowNode).find('td').eq(0).addClass('text-center');
                            $(rowNode).find('td').eq(2).addClass('text-center');
                            $(rowNode).find('td').eq(3).addClass('text-center filter-none');
                            $(rowNode).find('td').eq(4).addClass(
                                'text-center filter-none space-nowrap');

                        });
                    }
                },
                error: function() {
                }
            });
        }

        function deleteModule(module) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Modul akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/mentor/course/' . $course->slug . '/module/${module}') }}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            $.notify({
                                icon: 'flaticon-alarm-1',
                                title: 'UMKMPlus mentor',
                                message: response.meta.message,
                            }, {
                                type: 'secondary',
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                time: 2000,
                            });
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'HAPUS MODULE GAGAL!',
                                    text: xhr.responseJSON.meta.message + " Error: " + xhr
                                        .responseJSON.data.error,
                                })
                            else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'HAPUS MODULE GAGAL!',
                                    text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                        error,
                                })
                            return false;
                        }
                    });
                }
            });
        }
    </script>
@endsection
