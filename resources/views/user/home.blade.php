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
                                <a href="{{ route('category') }}" class="tp-btn tp-btn-2 mb-15 me-4 rounded-pill">Mulai
                                    Belajar</a>
                                <a href="{{ route('mentor') }}" class="tp-btn tp-btn-3 rounded-pill"
                                    style="height: 45px;line-height: 45px;">Temukan
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
                <div class="d-flex align-items-center justify-content-center column-gap-15 row-gap-4 flex-wrap">
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
        <section class="course__area pt-80 pb-50 bg-white">
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
                                <button class="nav-link text-body-tertiary {{ $category->slug }}-item" aria-current="page"
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
                <div class="d-grid gap-5 grid-cols-12 mt-30" id="courseCategory">
                </div>
            </div>
        </section>
        {{-- course area end --}}

        {{-- mentor area start --}}
        <section class="course__area pt-50 pb-70 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-45">
                            <span class="section__title-pre text-uppercase text-green fw-semibold">#umkmnaikkelas</span>
                            <h2 class="section__title section__title-44 mb-2">Tersedia Mentor Ahli</h2>
                            <p>UMKMPlus menyediakan mentor praktisi yang berpengalaman di bidang teknis pengembangan dan
                                support bisnis.</p>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="row" id="mentorPopular">
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('mentor') }}" class="tp-btn tp-btn-2 rounded-pill" type="button">Lihat Seluruh
                        Mentor</a>
                </div>
            </div>
        </section>
        {{-- mentor area end --}}

        {{-- testimoni area start --}}
        <section class="course__area pt-70 pb-70 bg-secondaries">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-45">
                            <span class="section__title-pre text-uppercase text-green fw-semibold">success students</span>
                            <h2 class="section__title section__title-44 mb-2">Apa Kata Mereka?</h2>
                            <p>Berikut ada;lah beberapa testimoni dari para alumni yang telah mengikuti program
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
                                                <img src="{{ asset($testimonial->student->profile_picture) }}"
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
        $(document).ready(function() {
            course("branding")
            mentorPopular()
        });

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

            $("#courseCategory").html(`<p class="text-center text-base col-span-full">Loading...</p>`);

            $.ajax({
                type: "GET",
                url: "{{ route('get.dashboard.course.category') }}",
                data: {
                    category: category
                },
                success: function(response) {
                    $(`.${categoryUrl}-item`).removeClass("active text-primary");
                    $(`.${category}-item`).addClass("active text-primary");
                    let htmlString = ``;
                    $.map(response.data, function(courseData, index) {
                        let coursePrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(courseData.price);
                        htmlString += `<div class="col-span-3-course">
                            <a class="course__item-2 transition-3 white-bg mb-30 fix h-100 d-block border-1 border-light-2"
                                                        href="/course/courseName">
                                                        <div class="course__thumb-2 w-img fix">
                                                            <figure class="mb-0 position-relative">
                                                                <img src="{{ asset('${courseData.thumbnail}') }}"
                                                                    alt="course-thumbnail">
                                                                <div class="course-tag-wrapper">
                                                                    <div class="course__tag">
                                                                        <span class="course-badge">${courseData.category.name}</span>
                                                                    </div>
                                                                </div>
                                                            </figure>
                                                        </div>
                                                        {{-- course item content --}}
                                                        <div class="course__content-2" style="padding: 18px 24px 0">
                                                            <h3
                                                                class="course__title-2 line-clamp-3-hover text-lg leading-lg mb-2">
                                                                ${courseData.title}
                                                            </h3>
                                                            <p class="mb-10 fw-medium text-green-2">${coursePrice}</p>
                                                            <div
                                                                class="course__bottom-2 d-flex align-items-center justify-content-between">
                                                                <div class="course__action">
                                                                    <ul>
                                                                        <li>
                                                                            <div
                                                                                class="course__action-item d-flex align-items-center">
                                                                                <div class="course__action-icon mr-5">
                                                                                    <span>
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-mortarboard"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                                                                                            <path
                                                                                                d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                                                                                        </svg>

                                                                                    </span>
                                                                                </div>
                                                                                <div class="course__action-content">
                                                                                    <span>${courseData.modules_count} Modul</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div
                                                                                class="course__action-item d-flex align-items-center">
                                                                                <div class="course__action-icon mr-5">
                                                                                    <span>
                                                                                        <svg width="10" height="12"
                                                                                            viewBox="0 0 10 12"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M5.00004 5.5833C6.28592 5.5833 7.32833 4.5573 7.32833 3.29165C7.32833 2.02601 6.28592 1 5.00004 1C3.71416 1 2.67175 2.02601 2.67175 3.29165C2.67175 4.5573 3.71416 5.5833 5.00004 5.5833Z"
                                                                                                stroke="#5F6160"
                                                                                                stroke-width="1.5"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round" />
                                                                                            <path
                                                                                                d="M9 11.0001C9 9.22632 7.20722 7.79175 5 7.79175C2.79278 7.79175 1 9.22632 1 11.0001"
                                                                                                stroke="#5F6160"
                                                                                                stroke-width="1.5"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round" />
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="course__action-content">
                                                                                    <span>${courseData.course_enrolls_count}</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="course__tutor-2">
                                                                    <div>
                                                                        <img src="{{ asset('${courseData.mentor.profile_picture}') }}"
                                                                            alt="mentor-course-name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                            </div>`
                    });
                    $("#courseCategory").html(htmlString);
                }
            });
        }

        function mentorPopular() {
            $("#mentorPopular").html(`<p class="text-center text-base">Loading...</p>`);
            $.ajax({
                type: "GET",
                url: "{{ route('get.dashboard.mentor.popular') }}",
                success: function(response) {
                    let htmlString = ``;
                    $.map(response.data, function(mentorData, index) {
                        htmlString += `<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                            <a href="/mentor/detail"
                                class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                                <div class="mentor-card-thumbnail mt-3">
                                    <img src="{{ asset('${mentorData.profile_picture}') }}" alt="mentor-1">
                                </div>
                                <div class="course__content p-relative">
                                    <h5 class="course__title text-lg mb-1 text-center">
                                        ${mentorData.name}
                                    </h5>
                                    <p class="mb-2 text-center">${mentorData.job}</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="me-3 d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">school</i>${mentorData.total_student}<span
                                                class="text-gray ms-1">Students</span>
                                        </p>
                                        <p class="d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">group</i>${mentorData.total_course}<span
                                                class="text-gray ms-1">Kelas</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>`
                    });
                    $("#mentorPopular").html(htmlString);
                }
            })
        }

        function addCart(course) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan memasukkan ke keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cart.store') }}",
                        data: {
                            course_id: course,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Anda telah memasukkan ke keranjang.',
                                'success'
                            )
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal memasukkan ke keranjang.',
                                    xhr.responseJSON.meta.message
                                )
                            else
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal memasukkan ke keranjang.',
                                    error
                                )
                            return false;
                        }
                    })
                }
            })
        }
    </script>
@endsection
