@extends('user.layout.app')

@section('content')
    @php
        $categoryUrl = request()->get('category');
    @endphp

    <main>
        {{-- slider area start --}}
        <section class="slider__area slider-height-2 include-bg d-flex align-items-center"
            data-background="{{ asset('assets/img/decoration/blue-bg.png') }}">
            <div class="container">
                <div class="row align-items-center row-gap-5">
                    <div class="col-xxl-6 col-lg-6">
                        <div class="slider__content-2 mt-30">
                            <span class="text-green fw-semibold">#BertumbuhBersama</span>
                            <h3 class="slider__title-2">Belajar Bisnis Menarik dan Inovatif Bersama Kami</h3>
                            <p>Kembangkan bisnis anda dengan belajar di umkmverse dengan bisnis expert untuk membangun
                                bisnis anda yang profitable dan sustainable.</p>
                            <div class="">
                                <a href="/course" class="tp-btn tp-btn-2 mb-15 me-4 rounded-pill">Mulai Belajar</a>
                                <a href="/mentor" class="tp-btn tp-btn-3 rounded-pill"
                                    style="height: 45px;line-height: 45px;">Jadi
                                    Mentor</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-6">
                        <div class="slider__thumb-2 p-relative">
                            <div class="slider__shape">
                                <img class="img-fluid header-image-animation-1"
                                    src="{{ asset('assets/img/brand/header-hexa.png') }}" alt="header-hex">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- slider area end --}}

        {{-- brand area start --}}
        <section class="pt-35">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center column-gap-5 row-gap-4 flex-wrap">
                    <a href="https://www.apple.com" class="d-block" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('assets/img/brand/apple-11 1.svg') }}" alt="apple-logo"
                            class="brand-logo-user"></a>
                    <a href="https://www.adobe.com" class="d-block" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('assets/img/brand/adobe.svg') }}" alt="adobe-logo" class="brand-logo-user"></a>
                    <a href="https://www.slack.com" class="d-block" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('assets/img/brand/slack-2 1.svg') }}" alt="slack-logo"
                            class="brand-logo-user"></a>
                    <a href="https://www.spotify.com" class="d-block" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('assets/img/brand/spotify-1 1.svg') }}" alt="spotify-logo"
                            class="brand-logo-user"></a>
                    <a href="https://www.google.com" class="d-block" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('assets/img/brand/google-2015 1.svg') }}" alt="google-logo"
                            class="brand-logo-user"></a>
                </div>
            </div>
        </section>
        {{-- brand area end --}}

        {{-- course area start --}}
        <section class="course__area pt-80 pb-55 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-20">
                            <h2 class="section__title section__title-44 mb-2">Pilih Kategori Kelas</h2>
                            <p>Temukan kelas dan modul pembelajaran yang tepat untuk Anda.</p>
                        </div>
                    </div>
                </div>
                <!-- Tab Katogori Kelas-->
                <div class="row gx-5 d-none d-lg-flex">
                    <ul class="nav nav-underline justify-content-center ">
                        @foreach ($categories as $category)
                            <li class="nav-item px-3 ">
                                <button class="nav-link  {{ $category->slug }}-item" aria-current="page"
                                    onclick="course('{{ $category->slug }}')">{{ $category->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="d-flex d-lg-none align-items-center justify-content-center">
                    <div class="dropdown dropdown-category">
                        <button class="btn tp-btn dropdown-toggle dropdown-category-toggle shadow-none tp-btn-3"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Kategori
                        </button>
                        <ul class="dropdown-menu dropdown-menu-category">
                            @foreach ($categories as $category)
                                <li><button class="dropdown-item {{ $category->slug }}-item"
                                        onclick="course('{{ $category->slug }}')">{{ $category->name }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row mt-30" id="courseCategory">
                    {{-- <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="course/name"
                            class="course__item white-bg transition-3 mb-30 d-block p-0 border border-1 border-light-2 rounded-3">
                            <div class="course-wrapper-image rounded-top-3 position-relative">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}" alt="course-thumbnail">
                                <div class="course-tag-wrapper">
                                    <div class="course__tag">
                                        <span class="course-badge">Branding</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course__content p-relative" style="padding: 18px 20px 24px">
                                <div class="course__bottom d-sm-flex align-items-center justify-content-between"
                                    style="padding-bottom: 12px">
                                    <div class="course__tutor">
                                        <figure class="mb-0"><img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}"
                                                alt="mentor-course">Jack Morkel</figure>
                                    </div>
                                </div>
                                <h3 class="course__title">
                                    <p class="course-title text-lg mb-3">The Bran Masterclass</p>
                                </h3>
                                <div class="d-flex align-items-center mt-3 mb-2">
                                    <i class="material-symbols-rounded me-2">sell</i>
                                    <h5 class="mb-0" style="color: #186d4b;">Rp. 850.000</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="material-symbols-rounded me-2">school</i>
                                    <div class="text-muted me-4">6 Modul</div>
                                    <i class="material-symbols-rounded me-2">group</i>
                                    <div class="text-muted ">149 Enroll</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="course/name"
                            class="course__item white-bg transition-3 mb-30 d-block p-0 border border-1 border-light-2 rounded-3">
                            <div class="course-wrapper-image rounded-top-3 position-relative">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}" alt="course-thumbnail">
                                <div class="course-tag-wrapper">
                                    <div class="course__tag">
                                        <span class="course-badge">Branding</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course__content p-relative" style="padding: 18px 20px 24px">
                                <div class="course__bottom d-sm-flex align-items-center justify-content-between"
                                    style="padding-bottom: 12px">
                                    <div class="course__tutor">
                                        <figure class="mb-0"><img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}"
                                                alt="mentor-course">Jack Morkel</figure>
                                    </div>
                                </div>
                                <h3 class="course__title">
                                    <p class="course-title text-lg mb-3">The Bran Masterclass</p>
                                </h3>
                                <div class="d-flex align-items-center mt-3 mb-2">
                                    <i class="material-symbols-rounded me-2">sell</i>
                                    <h5 class="mb-0" style="color: #186d4b;">Rp. 850.000</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="material-symbols-rounded me-2">school</i>
                                    <div class="text-muted me-4">6 Modul</div>
                                    <i class="material-symbols-rounded me-2">group</i>
                                    <div class="text-muted ">149 Enroll</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="course/name"
                            class="course__item white-bg transition-3 mb-30 d-block p-0 border border-1 border-light-2 rounded-3">
                            <div class="course-wrapper-image rounded-top-3 position-relative">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}" alt="course-thumbnail">
                                <div class="course-tag-wrapper">
                                    <div class="course__tag">
                                        <span class="course-badge">Branding</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course__content p-relative" style="padding: 18px 20px 24px">
                                <div class="course__bottom d-sm-flex align-items-center justify-content-between"
                                    style="padding-bottom: 12px">
                                    <div class="course__tutor">
                                        <figure class="mb-0"><img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}"
                                                alt="mentor-course">Jack Morkel</figure>
                                    </div>
                                </div>
                                <h3 class="course__title">
                                    <p class="course-title text-lg mb-3">The Bran Masterclass</p>
                                </h3>
                                <div class="d-flex align-items-center mt-3 mb-2">
                                    <i class="material-symbols-rounded me-2">sell</i>
                                    <h5 class="mb-0" style="color: #186d4b;">Rp. 850.000</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="material-symbols-rounded me-2">school</i>
                                    <div class="text-muted me-4">6 Modul</div>
                                    <i class="material-symbols-rounded me-2">group</i>
                                    <div class="text-muted ">149 Enroll</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="course/name"
                            class="course__item white-bg transition-3 mb-30 d-block p-0 border border-1 border-light-2 rounded-3">
                            <div class="course-wrapper-image rounded-top-3 position-relative">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}" alt="course-thumbnail">
                                <div class="course-tag-wrapper">
                                    <div class="course__tag">
                                        <span class="course-badge">Branding</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course__content p-relative" style="padding: 18px 20px 24px">
                                <div class="course__bottom d-sm-flex align-items-center justify-content-between"
                                    style="padding-bottom: 12px">
                                    <div class="course__tutor">
                                        <figure class="mb-0"><img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}"
                                                alt="mentor-course">Jack Morkel</figure>
                                    </div>
                                </div>
                                <h3 class="course__title">
                                    <p class="course-title text-lg mb-3">The Bran Masterclass</p>
                                </h3>
                                <div class="d-flex align-items-center mt-3 mb-2">
                                    <i class="material-symbols-rounded me-2">sell</i>
                                    <h5 class="mb-0" style="color: #186d4b;">Rp. 850.000</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="material-symbols-rounded me-2">school</i>
                                    <div class="text-muted me-4">6 Modul</div>
                                    <i class="material-symbols-rounded me-2">group</i>
                                    <div class="text-muted ">149 Enroll</div>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
        </section>
        {{-- course area end --}}

        {{-- mentor area start --}}
        <section class="course__area pt-55 pb-70 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-60">
                            <span class="section__title-pre text-uppercase text-green fw-semibold">#umkmnaikkelas</span>
                            <h2 class="section__title section__title-44 mb-2">Tersedia Mentor Ahli</h2>
                            <p>UMKMPlus menyediakan mentor praktisi yang berpengalaman di bidang teknis pengembangan dan
                                support bisnis.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="row">
                        @foreach ($mentorPopulars as $mentorPopular)
                            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                                <a href="/mentor/detail"
                                    class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                                    <div class="mentor-card-thumbnail mt-3">
                                        <img src="{{ asset('assets/img/dummy/mentor-1.jpg') }}" alt="mentor-1">
                                    </div>
                                    <div class="course__content p-relative">
                                        <h5 class="course__title text-lg mb-1 text-center">
                                            {{ $mentorPopular->name }}
                                        </h5>
                                        <p class="mb-2 text-center">{{ $mentorPopular->job }}</p>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="me-3 d-flex align-items-center mb-0">
                                                <i
                                                    class="material-symbols-rounded me-2">school</i>{{ $mentorPopular->total_student }}<span
                                                    class="text-gray ms-1">Students</span>
                                            </p>
                                            <p class="d-flex align-items-center mb-0">
                                                <i
                                                    class="material-symbols-rounded me-2">group</i>{{ $mentorPopular->total_course }}<span
                                                    class="text-gray ms-1">Kelas</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                    <a href="/mentor" class="tp-btn tp-btn-2 rounded-pill" type="button">Lihat Seluruh Mentor</a>
                </div>
            </div>
        </section>
        {{-- mentor area end --}}

        {{-- testimoni area start --}}
        <section class="course__area pt-70 pb-70 bg-secondaries">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-60">
                            <span class="section__title-pre text-uppercase text-green fw-semibold">success students</span>
                            <h2 class="section__title section__title-44 mb-2">Apa Kata Mereka?</h2>
                            <p>Berikut adalah beberapa testimoni dari para alumni yang telah mengikuti program
                                pembelajaran kami.</p>
                        </div>
                    </div>
                </div>
                <div class="testimoni-container">
                    <div class="row">
                        @foreach ($testimonials as $testimonial)
                            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                <div class="course__item white-bg transition-3 mb-30 rounded-4">
                                    <div class="course__content p-relative pt-3 pb-2">
                                        <div class="mb-4 d-flex align-items-center">
                                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                                <i class="fa-solid fa-star text-3xl me-2 text-star"></i>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $testimonial->rating; $i++)
                                                <i class="fa-solid fa-star text-3xl me-2 text-gray"></i>
                                            @endfor
                                        </div>
                                        <p>{{ $testimonial->testimonial }}</p>
                                        <div class="course__bottom d-sm-flex align-items-center justify-content-between">
                                            <div class="testimoni-author-wrapper">
                                                <img src="{{ asset('assets/img/dummy/testimoni-1.png') }}"
                                                    alt="testimoni-1">
                                                <div>
                                                    <p class="testimoni-author-name">{{ $testimonial->student->name }}</p>
                                                    <p class="testimoni-author-job">
                                                        @if ($testimonial->student->job != null)
                                                            {{ $testimonial->student->job }}
                                                        @else
                                                            Pelaku Usaha
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- testimoni area end --}}
    </main>
@endsection

@section('script')
    <script>
        let categoryUrl = "{{ request()->get('category') }}"
        if (categoryUrl == "") {
            course("branding")
        } else {
            course(categoryUrl)
        }

        function course(category) {
            // Mendapatkan parameter dari URL
            var urlParams = new URLSearchParams(window.location.search);
            // Mengambil nilai parameter dengan nama tertentu
            var categoryUrl = urlParams.get('category');
            // Membuat permintaan AJAX dan mengubah URL
            var request = `category=${category}`; // Request yang ingin ditambahkan
            var url = "{{ url('/') }}"; // Mendapatkan URL saat ini
            var newUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + request; // Menambahkan request ke URL

            // Mengubah URL tanpa melakukan reload halaman
            history.pushState(null, null, newUrl);

            $.ajax({
                type: "GET",
                url: "{{ route('get.course.category') }}",
                data: {
                    category: category
                },
                success: function(response) {
                    $(`.${categoryUrl}-item`).removeClass("active text-primary");
                    $(`.${category}-item`).addClass("active text-primary");
                    let htmlString = ``;
                    $.map(response.data, function(courseData, index) {
                        htmlString += `<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="course/name"
                            class="course__item white-bg transition-3 mb-30 d-block p-0 border border-1 border-light-2 rounded-3">
                            <div class="course-wrapper-image rounded-top-3 position-relative">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}" alt="course-thumbnail">
                                <div class="course-tag-wrapper">
                                    <div class="course__tag">
                                        <span class="course-badge">${courseData.category.name}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course__content p-relative" style="padding: 18px 20px 24px">
                                <div class="course__bottom d-sm-flex align-items-center justify-content-between"
                                    style="padding-bottom: 12px">
                                    <div class="course__tutor">
                                        <figure class="mb-0"><img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}"
                                                alt="mentor-course">${courseData.mentor.name}</figure>
                                    </div>
                                </div>
                                <h3 class="course__title">
                                    <p class="course-title text-lg mb-3">${courseData.title}</p>
                                </h3>
                                <div class="d-flex align-items-center mt-3 mb-2">
                                    <i class="material-symbols-rounded me-2">sell</i>
                                    <h5 class="mb-0" style="color: #186d4b;">Rp. ${courseData.price}</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="material-symbols-rounded me-2">school</i>
                                    <div class="text-muted me-4">${courseData.modules_count} Modul</div>
                                    <i class="material-symbols-rounded me-2">group</i>
                                    <div class="text-muted ">${courseData.course_enrolls_count} Enroll</div>
                                </div>
                            </div>
                        </a>
                    </div>`
                    });
                    $("#courseCategory").html(htmlString);
                }
            });
        }
    </script>
@endsection
