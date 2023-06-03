@extends('user.courses.components.courseLayout')

@section('content')
    <main>
        {{-- main content --}}
        <section class="container-fluid">
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
                                                    <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- accordion --}}
                                <div class="accordion-items">
                                    <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#module_1" aria-expanded="false" aria-controls="module_1">
                                        <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                            <div class="">
                                                <span class="text-base fw-bold d-block leading-xl"
                                                    style="margin-bottom: 2px">Modul
                                                    1</span>
                                                <span class="mb-0 d-block leading-xl text-xs">2 video</span>
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
                                    <div class="collapse mt-15" id="module_1">
                                        <div class="">
                                            {{-- video --}}
                                            <button class="video-course-items" onclick="" role="presentation">
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <p class="fw-bold mb-5 leading-xl">Title Video Course
                                                        Module 1</p>
                                                    <p class="text-xs mb-0 leading-xl">100 menit</p>
                                                </div>
                                            </button>
                                            <button class="video-course-items" onclick="" role="presentation">
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <p class="fw-bold mb-5 leading-xl">Title Video Course
                                                        Module 1</p>
                                                    <p class="text-xs mb-0 leading-xl">100 menit</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-items">
                                    <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#module_2" aria-expanded="false" aria-controls="module_2">
                                        <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                            <div class="">
                                                <span class="text-base fw-bold d-block leading-xl"
                                                    style="margin-bottom: 2px">Modul
                                                    2</span>
                                                <span class="mb-0 d-block leading-xl text-xs">2 video</span>
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
                                    <div class="collapse mt-15" id="module_2">
                                        <div class="">
                                            {{-- video --}}
                                            <button class="video-course-items" onclick="" role="presentation">
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <p class="fw-bold mb-5 leading-xl">Title Video Course
                                                        Module 2</p>
                                                    <p class="text-xs mb-0 leading-xl">100 menit</p>
                                                </div>
                                            </button>
                                            <button class="video-course-items" onclick="" role="presentation">
                                                <div class="">
                                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 24px;height: 24px;">
                                                        <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <p class="fw-bold mb-5 leading-xl">Title Video Course
                                                        Module 1</p>
                                                    <p class="text-xs mb-0 leading-xl">100 menit</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- video player --}}
                <div id="video_player" class="video-player-section collapse-on">
                    {{-- player --}}
                    <div class="mb-35">
                        <div class="w-100 rounded-4 bg-secondary" style="height: 450px"></div>
                    </div>
                    <div class="d-flex justify-content-between mb-20">
                        <div class="">
                            <h3 class="mb-10">Title Video Course</h3>
                            <p class="mb-0 text-base">Modul: title module course</p>
                        </div>
                        <div class="">
                            <button class="tp-btn tp-btn-4 rounded-pill" onclick="">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-block d-lg-none">
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
                                        <p class="fw-bold mb-0 leading-xl">Download Materi</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- accordion --}}
                    <div class="accordion-items">
                        <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                            data-bs-target="#module_1" aria-expanded="false" aria-controls="module_1">
                            <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                <div class="">
                                    <span class="text-base fw-bold d-block leading-xl" style="margin-bottom: 2px">Modul
                                        1</span>
                                    <span class="mb-0 d-block leading-xl text-xs">2 video</span>
                                </div>
                                <div class="">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                        style="width: 24px;height: 24px;">
                                        <i class="fa-solid fa-sort-down" style="transform: translateY(-2px)"></i>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <div class="collapse mt-15" id="module_1">
                            <div class="">
                                {{-- video --}}
                                <button class="video-course-items" onclick="" role="presentation">
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-bold mb-5 leading-xl">Title Video Course
                                            Module 1</p>
                                        <p class="text-xs mb-0 leading-xl">100 menit</p>
                                    </div>
                                </button>
                                <button class="video-course-items" onclick="" role="presentation">
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-bold mb-5 leading-xl">Title Video Course
                                            Module 1</p>
                                        <p class="text-xs mb-0 leading-xl">100 menit</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-items">
                        <button class="btn-accordion" type="button" data-bs-toggle="collapse"
                            data-bs-target="#module_2" aria-expanded="false" aria-controls="module_2">
                            <div class="w-100 d-flex justify-content-between align-items-center gap-3">
                                <div class="">
                                    <span class="text-base fw-bold d-block leading-xl" style="margin-bottom: 2px">Modul
                                        2</span>
                                    <span class="mb-0 d-block leading-xl text-xs">2 video</span>
                                </div>
                                <div class="">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                        style="width: 24px;height: 24px;">
                                        <i class="fa-solid fa-sort-down" style="transform: translateY(-2px)"></i>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <div class="collapse mt-15" id="module_2">
                            <div class="">
                                {{-- video --}}
                                <button class="video-course-items" onclick="" role="presentation">
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-bold mb-5 leading-xl">Title Video Course
                                            Module 2</p>
                                        <p class="text-xs mb-0 leading-xl">100 menit</p>
                                    </div>
                                </button>
                                <button class="video-course-items" onclick="" role="presentation">
                                    <div class="">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                            style="width: 24px;height: 24px;">
                                            <i class="fa-solid fa-play" style="font-size: 10px"></i>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-bold mb-5 leading-xl">Title Video Course
                                            Module 1</p>
                                        <p class="text-xs mb-0 leading-xl">100 menit</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
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
    </script>
@endsection
