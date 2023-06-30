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
                            <div class="slider__content-button">
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
                            <p>Berikut adalah beberapa testimoni dari para alumni yang telah mengikuti program
                                pembelajaran kami.</p>
                        </div>
                    </div>
                </div>
                <div class="testimoni-container">
                    <div class="row">
                        @if (count($testimonials) == 0)
                            {{-- empty state --}}
                            <div class="text-center col-span-full pt-30 pb-30">
                                <div class="text-center w-100 d-flex justify-content-center">
                                    <div class="rounded-3 px-5 py-4" style="background: #0e0e0e10">
                                        <p class="text-xl font-semibold mb-0">Maaf, testimoni belum tersedia</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- success state --}}
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
                                            <div
                                                class="course__bottom d-sm-flex align-items-center justify-content-between">
                                                <div class="testimoni-author-wrapper">
                                                    <img src="{{ $testimonial->courseEnroll ? asset('storage/' . $testimonial->courseEnroll->student->profile_picture) : asset('assets/img/dummy/testimoni-1.png') }}"
                                                        alt="{{ $testimonial->courseEnroll ? Str::slug($testimonial->courseEnroll->student->name) : '' }}-testimoni-profile">
                                                    <div>
                                                        <p class="testimoni-author-name">
                                                            {{ $testimonial->courseEnroll ? $testimonial->courseEnroll->student->name : '' }}
                                                        </p>
                                                        <p class="testimoni-author-job">
                                                            @if ($testimonial->courseEnroll)
                                                                @if ($testimonial->courseEnroll->student->job != null)
                                                                    {{ $testimonial->courseEnroll->student->job }}
                                                                @else
                                                                    Pelaku Usaha
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        {{-- testimoni area end --}}

        <!-- blog area start -->
        <section class="blog__area pt-120 pb-85 p-relative">
            <div class="blog__shape">
                <img class="blog__shape-1" src="{{ asset('assets/img/decoration/blog-shape-1.png') }}" alt="circle-red">
                <img class="blog__shape-2" src="{{ asset('assets/img/decoration/blog-shape-2.png') }}"
                    alt="circle-blue">
                <img class="blog__shape-3" src="{{ asset('assets/img/decoration/blog-shape-3.png') }}"
                    alt="circle-dot-green">
                <img class="blog__shape-4" src="{{ asset('assets/img/decoration/blog-shape-4.png') }}"
                    alt="circle-pink">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper mb-60 text-center">
                            <span class="section__title-pre text-uppercase text-green fw-semibold">latest blog</span>
                            <h2 class="section__title section__title-44">Berita Terbaru dari UMKMPlus</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6">
                        <div
                            class="blog__item-float blog__item-float-overlay p-relative fix transition-3 mb-30 d-flex align-items-end">
                            <div class="blog__thumb-bg w-img fix" data-background="assets/img/blog/blog-1.jpg"></div>
                            <div class="blog__content-float">
                                <div class="blog__tag-float mb-15">
                                    <a href="#">Uncategorized</a>
                                </div>
                                <h3 class="blog__title-float">
                                    <a href="blog-details.html">Individual master Courses For degree students.</a>
                                </h3>
                                <div class="blog__meta-float">
                                    <ul>
                                        <li>
                                            <span><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">Dec 28, 2022</a></span>
                                        </li>
                                        <li>
                                            <span><svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.6848 6.99994C10.6848 8.48494 9.48476 9.68494 7.99976 9.68494C6.51476 9.68494 5.31476 8.48494 5.31476 6.99994C5.31476 5.51494 6.51476 4.31494 7.99976 4.31494C9.48476 4.31494 10.6848 5.51494 10.6848 6.99994Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M7.99976 13.2025C10.6473 13.2025 13.1148 11.6425 14.8323 8.94254C15.5073 7.88504 15.5073 6.10754 14.8323 5.05004C13.1148 2.35004 10.6473 0.790039 7.99976 0.790039C5.35226 0.790039 2.88476 2.35004 1.16726 5.05004C0.492261 6.10754 0.492261 7.88504 1.16726 8.94254C2.88476 11.6425 5.35226 13.2025 7.99976 13.2025Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">1,526 views</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="blog__item mb-30 white-bg transition-3 mb-30">
                            <div class="blog__thumb w-img fix">
                                <a href="blog-details.html">
                                    <img src="assets/img/blog/blog-2.jpg" alt="">
                                </a>
                            </div>
                            <div class="blog__content">
                                <div class="blog__tag">
                                    <a href="#">University</a>
                                </div>
                                <h3 class="blog__title">
                                    <a href="blog-details.html">How stay calm from the First time.</a>
                                </h3>
                                <div class="blog__meta">
                                    <ul>
                                        <li>
                                            <span><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">Jun 14, 2022</a></span>
                                        </li>
                                        <li>
                                            <span><svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.6848 6.99994C10.6848 8.48494 9.48476 9.68494 7.99976 9.68494C6.51476 9.68494 5.31476 8.48494 5.31476 6.99994C5.31476 5.51494 6.51476 4.31494 7.99976 4.31494C9.48476 4.31494 10.6848 5.51494 10.6848 6.99994Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M7.99976 13.2025C10.6473 13.2025 13.1148 11.6425 14.8323 8.94254C15.5073 7.88504 15.5073 6.10754 14.8323 5.05004C13.1148 2.35004 10.6473 0.790039 7.99976 0.790039C5.35226 0.790039 2.88476 2.35004 1.16726 5.05004C0.492261 6.10754 0.492261 7.88504 1.16726 8.94254C2.88476 11.6425 5.35226 13.2025 7.99976 13.2025Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">1,526 views</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="blog__item mb-30 white-bg transition-3 mb-30">
                            <div class="blog__thumb w-img fix">
                                <a href="blog-details.html">
                                    <img src="assets/img/blog/blog-3.jpg" alt="">
                                </a>
                            </div>
                            <div class="blog__content">
                                <div class="blog__tag">
                                    <a href="#">HR and L&D</a>
                                </div>
                                <h3 class="blog__title">
                                    <a href="blog-details.html">Classroom adapts for the future of learning</a>
                                </h3>
                                <div class="blog__meta">
                                    <ul>
                                        <li>
                                            <span><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">Jun 14, 2022</a></span>
                                        </li>
                                        <li>
                                            <span><svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.6848 6.99994C10.6848 8.48494 9.48476 9.68494 7.99976 9.68494C6.51476 9.68494 5.31476 8.48494 5.31476 6.99994C5.31476 5.51494 6.51476 4.31494 7.99976 4.31494C9.48476 4.31494 10.6848 5.51494 10.6848 6.99994Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M7.99976 13.2025C10.6473 13.2025 13.1148 11.6425 14.8323 8.94254C15.5073 7.88504 15.5073 6.10754 14.8323 5.05004C13.1148 2.35004 10.6473 0.790039 7.99976 0.790039C5.35226 0.790039 2.88476 2.35004 1.16726 5.05004C0.492261 6.10754 0.492261 7.88504 1.16726 8.94254C2.88476 11.6425 5.35226 13.2025 7.99976 13.2025Z"
                                                        stroke="white" stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg><a href="#">1,526 views</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog area end -->

        <!-- cta area start -->
        <section class="cta__area pb-120">
            <div class="container">
                <div class="cta__inner">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="cta__item cta__item-border pt-40 pb-15 d-sm-flex align-items-start pr-110">
                                <div class="cta__icon mr-30">
                                    <span>
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.0801 0C8.84004 0 4.58002 4.26003 4.58002 9.50006C4.58002 14.6401 8.60004 18.8001 13.8401 18.9801C14.0001 18.9601 14.1601 18.9601 14.2801 18.9801C14.3201 18.9801 14.3401 18.9801 14.3801 18.9801C14.4001 18.9801 14.4001 18.9801 14.4201 18.9801C19.5401 18.8001 23.5601 14.6401 23.5801 9.50006C23.5801 4.26003 19.3201 0 14.0801 0Z"
                                                fill="#192A88" />
                                            <path
                                                d="M24.2401 24.2998C18.6601 20.5798 9.56006 20.5798 3.94002 24.2998C1.40001 25.9998 0 28.2998 0 30.7598C0 33.2198 1.40001 35.4998 3.92002 37.1799C6.72004 39.0599 10.4001 39.9999 14.0801 39.9999C17.7601 39.9999 21.4401 39.0599 24.2401 37.1799C26.7602 35.4798 28.1602 33.1998 28.1602 30.7198C28.1402 28.2598 26.7602 25.9798 24.2401 24.2998Z"
                                                fill="#192A88" />
                                            <path
                                                d="M35.0602 10.6802C35.3802 14.5603 32.6202 17.9603 28.8002 18.4203C28.7802 18.4203 28.7802 18.4203 28.7602 18.4203H28.7002C28.5802 18.4203 28.4602 18.4203 28.3602 18.4603C26.4202 18.5603 24.6402 17.9403 23.3002 16.8003C25.3602 14.9603 26.5402 12.2002 26.3002 9.20023C26.1602 7.58022 25.6002 6.10021 24.7602 4.8402C25.5202 4.4602 26.4002 4.2202 27.3002 4.1402C31.2202 3.8002 34.7202 6.72021 35.0602 10.6802Z"
                                                fill="#FF7648" />
                                            <path
                                                d="M39.0602 29.1799C38.9002 31.1199 37.6602 32.7999 35.5802 33.9399C33.5802 35.0399 31.0602 35.5599 28.5602 35.4999C30.0002 34.1999 30.8402 32.5799 31.0002 30.8599C31.2002 28.3799 30.0202 25.9998 27.6601 24.0998C26.3201 23.0398 24.7601 22.1998 23.0601 21.5798C27.4801 20.2998 33.0402 21.1598 36.4602 23.9198C38.3002 25.3998 39.2402 27.2599 39.0602 29.1799Z"
                                                fill="#FF7648" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="cta__content">
                                    <h3 class="cta__title">Become an Instructor</h3>
                                    <p>Jadilah mentor dan beri dampak positif pada para pembelajar.
                                        Bergabunglah sekarang dan ciptakan masa depan yang
                                        cerah!</p>
                                    <a href="{{ Auth::check() ? '/faq' : '/mentor/register' }}" class="tp-btn tp-btn-3 rounded-pill">Start Teaching</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="cta__item pl-85 pt-40 pb-15 d-sm-flex align-items-start">
                                <div class="cta__icon mr-30">
                                    <span>
                                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M32.2575 29.977C33.5417 29.1336 35.2283 30.0536 35.2283 31.587V34.0595C35.2283 36.4936 33.3308 39.1003 31.05 39.867L24.9358 41.8986C23.8625 42.2628 22.1183 42.2628 21.0642 41.8986L14.95 39.867C12.65 39.1003 10.7717 36.4936 10.7717 34.0595V31.5678C10.7717 30.0536 12.4583 29.1336 13.7233 29.9578L17.6717 32.5261C19.1858 33.542 21.1025 34.0403 23.0192 34.0403C24.9358 34.0403 26.8525 33.542 28.3667 32.5261L32.2575 29.977Z"
                                                fill="#FF7648" />
                                            <path
                                                d="M38.295 12.3817L26.8142 4.84924C24.7442 3.4884 21.3325 3.4884 19.2625 4.84924L7.72416 12.3817C4.02499 14.7776 4.02499 20.2017 7.72416 22.6167L10.7908 24.6101L19.2625 30.1301C21.3325 31.4909 24.7442 31.4909 26.8142 30.1301L35.2283 24.6101L37.8542 22.8851V28.7501C37.8542 29.5359 38.5058 30.1876 39.2917 30.1876C40.0775 30.1876 40.7292 29.5359 40.7292 28.7501V19.3201C41.4958 16.8476 40.71 13.9726 38.295 12.3817Z"
                                                fill="#192A88" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="cta__content">
                                    <h3 class="cta__title">Apply for Admission</h3>
                                    <p>Sudah menyelesaikan kursus? Saatnya mengajukan sertifikat dengan langkah-langkah
                                        sederhana bersama UMKMPlus.</p>
                                    <a href="/profile?content=course" class="tp-btn tp-btn-4 rounded-pill">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta area end -->
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

            // loading state
            $("#courseCategory").html(
                `<div class="text-center text-3xl col-span-full pt-65 pb-25"><i class="fas fa-spinner-third spinners-2"></i></div>`
            );

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

                    if (response.data.length === 0) {
                        // empty state
                        htmlString = emptyState('Maaf, kelas belum tersedia');
                    } else {
                        const currencyOption = {
                            style: 'currency',
                            currency: 'IDR',
                            currencyDisplay: 'symbol',
                            useGrouping: true,
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        };
                        // success state
                        $.map(response.data, function(courseData, index) {
                            let coursePrice = parseInt(courseData.price);
                            let coursePriceDiscount = courseData.price - Math.ceil(courseData.price *
                                courseData.discount / 100);
                            htmlString += `<div class="col-span-3-course">
                            <a class="course__item-2 transition-3 white-bg mb-30 fix h-100 d-block border-1 border-light-2"
                                                        href="/course/${courseData.slug}">
                                                        <div class="course__thumb-2 w-img fix">
                                                            <figure class="mb-0 position-relative">
                                                                <img src="{{ asset('storage/${courseData.thumbnail}') }}"
                                                                    alt="${courseData.slug}-course-thumbnail">
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
                                                            <p class="mb-10 fw-medium text-green-2">${courseData.price != 0 ? coursePriceDiscount.toLocaleString('id-ID', currencyOption) : 'Gratis'}
                                                            <span class="text-decoration-line-through text-xs text-green-3">${courseData.discount != 0 ? coursePrice.toLocaleString('id-ID', currencyOption) : ''}</span>
                                                            </p>
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
                                                                        <img src="{{ asset('storage/${courseData.mentor.profile_picture}') }}"
                                                                            alt="${courseData.mentor.slug}-mentor-profile" class="object-cover-center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                            </div>`
                        });
                    }

                    $("#courseCategory").html(htmlString);
                },
                // error state
                error: function() {
                    $("#courseCategory").html(errorState());
                }
            });
        }

        function mentorPopular() {
            // loading state
            $("#mentorPopular").html(
                `<div class="text-center text-3xl pt-30 pb-35"><i class="fas fa-spinner-third spinners-2"></i></div>`);

            $.ajax({
                type: "GET",
                url: "{{ route('get.dashboard.mentor.popular') }}",
                success: function(response) {
                    let htmlString = ``;

                    if (response.data.length === 0) {
                        // empty state
                        htmlString = emptyState('Maaf, mentor belum tersedia');
                    } else {
                        // success state
                        $.map(response.data, function(dataMentor, index) {
                            htmlString += `<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                            <a href="/mentor/${dataMentor.slug}"
                                class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                                <div class="mentor-card-thumbnail mt-3">
                                    <img src="{{ asset('storage/${dataMentor.profile_picture}') }}" alt="${dataMentor.slug}-mentor-profile">
                                </div>
                                <div class="course__content p-relative">
                                    <h5 class="course__title text-lg mb-1 text-center">
                                        ${dataMentor.name}
                                    </h5>
                                    <p class="mb-2 text-center">${dataMentor.job}</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="me-3 d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">school</i>${dataMentor.count_student}<span
                                                class="text-gray ms-1">Students</span>
                                        </p>
                                        <p class="d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">group</i>${dataMentor.mentor_courses_count}<span
                                                class="text-gray ms-1">Kelas</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>`
                        });
                    }

                    $("#mentorPopular").html(htmlString);
                },
                // error state
                error: function() {
                    $("#mentorPopular").html(errorState());
                }
            })
        }
    </script>
@endsection
