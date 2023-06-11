@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Media</h4>
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
                        <a href="/mentor/course/{{ $module->course->slug }}/module">Data Module</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        Data Media
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Media Module {{ $module->title }}</div>
                                <div class="card-tools">
                                    <a href="{{ url('mentor/module/' . $module->slug . '/media/create') }}"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                        </span>
                                        Tambah Media
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mediaModuleTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Judul</th>
                                            <th class="text-center">Video</th>
                                            <th class="text-center">Durasi</th>
                                            <th class="text-center">Urutan Media</th>
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
    <script>
        $(document).ready(function() {
            $('#mediaModuleTable').DataTable({
                "columnDefs": [{
                    "targets": 'filter-none',
                    "orderable": false,
                }]
            });
            getMediaModule();
        });

        function getMediaModule() {
            $.ajax({
                url: "{{ route('get.mentor.media.module', $module->slug) }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    if (response.data.mediaModules.length > 0) {
                        $.each(response.data.mediaModules, function(index, mediaModule) {
                            var rowData = [
                                index + 1,
                                mediaModule.title,
                                `<a href="https://www.youtube.com/watch?v=${mediaModule.video_url}" target="_blank" class="btn btn-warning">Video</a>`,
                                mediaModule.duration,
                                mediaModule.no_media,
                                `<a href="/mentor/module/${response.data.module.slug}/media/${mediaModule.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="deleteMediaModule('${mediaModule.id}')">Hapus</button>`
                            ];
                            $('#mediaModuleTable').DataTable().row.add(rowData).draw(false);
                        });
                    } else {
                        console.log("Data Kosong");
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }

        function deleteMediaModule(mediaModule) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Media akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/mentor/module/' . $module->slug . '/media/${mediaModule}') }}`,
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
                                    title: 'HAPUS MEDIA GAGAL!',
                                    text: xhr.responseJSON.meta.message + " Error: " + xhr
                                        .responseJSON.data.error,
                                })
                            else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'HAPUS MEDIA GAGAL!',
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
