@extends('user.courses.components.courseLayout')

@section('content')
    <main>
        {{-- main content --}}
        <section class="container-fluid">
            {{-- Dektop --}}
            <div class="w-100 margin-player">
                <div id="sidebar_button_open" class="hide pt-20">
                    <div class="d-none d-lg-flex mb-30">
                        <div class="d-flex justify-content-center align-items-center rounded-circle bg-tp-theme-1"
                            style="width: 44px;height: 44px;cursor: pointer" onclick="openSidebar()">
                            <i class="fa-sharp fa-solid fa-bars text-xl text-white"></i>
                        </div>
                    </div>
                </div>
                {{-- sidebar --}}
                <div id="sidebar_player" class="position-relative show">
                    <div class="sidebar-playing-section bg-secondaries">
                        <div class="sidebar-menu-wrapper">
                            <div class="d-flex">
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-tp-theme-1"
                                    style="width: 44px;height: 44px;cursor: pointer" onclick="closeSidebar()">
                                    <i class="fa-sharp fa-solid fa-bars text-xl text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-content-wrapper">
                            <div class="">
                                <div id="prepare" class="accordion-items">
                                    <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#prepare_class" aria-expanded="false" aria-controls="prepare_class">
                                        <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                            <div class="">
                                                <span class="text-base fw-bold d-block leading-xl"
                                                    style="margin-bottom: 2px">Persiapan Kelas</span>
                                                <span class="mb-0 d-block leading-xl text-xs">Info | Resource</span>
                                            </div>
                                            <div class="">
                                                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                    style="width: 24px;height: 24px;">
                                                    <i class="fa-solid fa-sort-down"
                                                        style="transform: translateY(-2px)"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="collapse mt-15" id="prepare_class">
                                        <div class="">
                                            {{-- info or materi --}}
                                            <button class="video-course-items" onclick="" role="presentation">
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-download" style="font-size: 10px"></i>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <a href="{{ asset('storage/' . $courseEnroll->course->file_info) }}">
                                                        <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                                    </a>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- accordion desktop --}}
                                @foreach ($courseEnroll->course->modules->sortBy('no_module') as $module)
                                    <div class="accordion-items">
                                        <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#module_{{ $module->no_module }}" aria-expanded="true"
                                            aria-controls="module_{{ $module->no_module }}">
                                            <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                                <div class="">
                                                    <span class="text-base fw-bold d-block leading-xl"
                                                        style="margin-bottom: 2px">{{ $module->title }}</span>
                                                    <span
                                                        class="mb-0 d-block leading-xl text-xs">{{ $module->mediaModules->count() }}
                                                        video</span>
                                                </div>
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-sort-down"
                                                            style="transform: translateY(-2px)"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="collapse mt-15" id="module_{{ $module->no_module }}">
                                            <div class="">
                                                {{-- File Module --}}
                                                <button class="video-course-items" onclick="" role="presentation">
                                                    <div class="">
                                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                            style="width: 24px;height: 24px;">
                                                            <i class="fa-solid fa-download" style="font-size: 10px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <a href="{{ asset('storage/' . $module->file) }}">
                                                            <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                                        </a>
                                                    </div>
                                                </button>
                                                {{-- video --}}
                                                @foreach ($module->mediaModules->sortBy('no_media') as $mediaModule)
                                                    <button class="video-course-items videoCourse{{ $mediaModule->id }}"
                                                        onclick="openVideo('{{ $mediaModule->id }}')" role="presentation">
                                                        <div class="">
                                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                                style="width: 24px;height: 24px;">
                                                                <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <p class="fw-bold mb-5 leading-xl">{{ $mediaModule->title }}</p>
                                                            <p class="text-xs mb-0 leading-xl">{{ $mediaModule->duration }}
                                                                menit</p>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- video player --}}
                <div id="video_player" class="video-player-section collapse-on">

                </div>
            </div>

            {{-- Mobile --}}
            <div class="d-block d-lg-none">
                <div class="">
                    <div id="prepare" class="accordion-items">
                        <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                            data-bs-target="#prepare_class" aria-expanded="false" aria-controls="prepare_class">
                            <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                <div class="">
                                    <span class="text-base fw-bold d-block leading-xl"
                                        style="margin-bottom: 2px">Persiapan
                                        Kelas</span>
                                    <span class="mb-0 d-block leading-xl text-xs">Info | Resource</span>
                                </div>
                                <div class="">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                        style="width: 24px;height: 24px;">
                                        <i class="fa-solid fa-sort-down" style="transform: translateY(-2px)"></i>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <div class="collapse mt-15" id="prepare_class">
                            <div class="">
                                {{-- info or materi --}}
                                <button class="video-course-items" onclick="" role="presentation">
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-download" style="font-size: 10px"></i>
                                        </div>
                                    </div>
                                    <div class="">
                                        <a href="{{ asset('storage/' . $courseEnroll->course->file_info) }}">
                                            <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                        </a>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- accordion Mobile --}}
                    @foreach ($courseEnroll->course->modules->sortBy('no_module') as $module)
                        <div class="accordion-items">
                            <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                                data-bs-target="#module_{{ $module->no_module }}" aria-expanded="false"
                                aria-controls="module_{{ $module->no_module }}">
                                <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                    <div class="">
                                        <span class="text-base fw-bold d-block leading-xl"
                                            style="margin-bottom: 2px">{{ $module->title }}</span>
                                        <span class="mb-0 d-block leading-xl text-xs">{{ $module->mediaModules->count() }}
                                            video</span>
                                    </div>
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-sort-down" style="transform: translateY(-2px)"></i>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <div class="collapse mt-15" id="module_{{ $module->no_module }}">
                                <div class="">
                                    {{-- File Module --}}
                                    <button class="video-course-items" onclick="" role="presentation">
                                        <div class="">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                style="width: 24px;height: 24px;">
                                                <i class="fa-solid fa-download" style="font-size: 10px"></i>
                                            </div>
                                        </div>
                                        <div class="">
                                            <a href="{{ asset('storage/' . $module->file) }}">
                                                <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                            </a>
                                        </div>
                                    </button>
                                    {{-- video --}}
                                    @foreach ($module->mediaModules->sortBy('no_media') as $mediaModule)
                                        <button class="video-course-items videoCourse{{ $mediaModule->id }}"
                                            onclick="openVideo('{{ $mediaModule->id }}')" role="presentation">
                                            <div class="">
                                                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                    style="width: 24px;height: 24px;">
                                                    <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <p class="fw-bold mb-5 leading-xl">{{ $mediaModule->title }}</p>
                                                <p class="text-xs mb-0 leading-xl">{{ $mediaModule->duration }} menit</p>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    @if (session('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @elseif (session('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif

    <script>
        const closeSidebar = () => {
            $('#sidebar_player').removeClass('show');
            $('#sidebar_player').addClass('hide');
            $('#video_player').removeClass('collapse-on');
            $('#video_player').addClass('collapse-off');
            $('#sidebar_button_open').removeClass('hide pt-20');
            $('#sidebar_button_open').addClass('show pt-10');
        }
        const openSidebar = () => {
            $('#sidebar_player').removeClass('hide');
            $('#sidebar_player').addClass('show');
            $('#video_player').removeClass('collapse-off');
            $('#video_player').addClass('collapse-on');
            $('#sidebar_button_open').removeClass('show pt-10');
            $('#sidebar_button_open').addClass('hide pt-20');
        }

        $(document).ready(function() {
            // Mendapatkan parameter dari URL
            var urlParams = new URLSearchParams(window.location.search);
            // Mengambil nilai parameter dengan nama tertentu
            var contentBeforeURL = urlParams.get('content');
            if (contentBeforeURL) {
                $(`.videoCourse${contentBeforeURL}`).addClass('active');
                $(`.videoCourse${contentBeforeURL}`).attr("aria-expanded", true);
                openVideo(contentBeforeURL)
            } else {
                openVideo('{{ $lastMedia->id }}')
            }
        });

        let htmlString = "";
        const openVideo = (content) => {
            // $('#video_player').removeClass('collapse-off');
            // $('#video_player').addClass('collapse-on');
            $("#infoMediaModule").html(`<i class="fas fa-circle-notch text-lg spinners-2"></i>`);
            // Mendapatkan parameter dari URL
            var urlParams = new URLSearchParams(window.location.search);
            // Mengambil nilai parameter dengan nama tertentu
            var contentBeforeURL = urlParams.get('content');
            // Membuat permintaan AJAX dan mengubah URL
            var request = `content=${content}`; // Request yang ingin ditambahkan
            var url = "{{ url('/course/playing/' . $courseEnroll->id) }}"; // Mendapatkan URL saat ini
            var newUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + request; // Menambahkan request ke URL

            // Mengubah URL tanpa melakukan reload halaman
            history.pushState(null, null, newUrl);

            $(`.videoCourse${contentBeforeURL}`).removeClass('active');
            $(`.videoCourse${content}`).addClass('active');

            $.ajax({
                type: "GET",
                url: `{{ url('/course/playing/' . $courseEnroll->id . '/media') }}`,
                data: {
                    id: content
                },
                success: function(response) {
                    htmlString = `
                    {{-- player --}}
                    <div class="mb-35">
                        <div class="w-100 rounded-4 bg-secondary" style="height: 450px"><iframe width="100%" height="450" src="https://www.youtube-nocookie.com/embed/${response.data.mediaModule.video_url}" frameborder="0" allowfullscreen></iframe></div>
                    </div>
                    <div class="d-flex justify-content-between mb-20">
                        <div class="" id="infoMediaModule">
                            <h3 class="mb-10">${response.data.mediaModule.title}</h3>
                            <p class="mb-0 text-base">Modul: ${response.data.mediaModule.module.title}</p>
                        </div>
                        <div class="">
                            ${response.data.next == "finish" ? `<a href="{{ url('/profile') }}" class="tp-btn tp-btn-4 rounded-pill" >Selesai</a>`
                            : (response.data.next == "test" ? `<a href="{{ url('/course/playing/' . $courseEnroll->id . '/test') }}" class="tp-btn tp-btn-4 rounded-pill">Ujian</a>`
                            : `<button class="tp-btn tp-btn-4 rounded-pill" onclick="openVideo('${response.data.next}')">Next</button>` )}
                        </div>
                    </div>`
                    $('#video_player').html(htmlString);
                },
                error: function(xhr, response, error) {
                    if (xhr.responseJSON)
                        Swal.fire({
                            icon: 'error',
                            title: 'GAGAL MENGAMBIL VIDEO!',
                            text: xhr.responseJSON.meta.message + " Error: " + xhr.responseJSON.data
                                .error,
                        })
                    else
                        Swal.fire({
                            icon: 'error',
                            title: 'GAGAL MENGAMBIL VIDEO!',
                            text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                error,
                        })
                    return false;
                },
            });

        }
    </script>
@endsection
