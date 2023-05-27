@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section id="headerDetailCourse" class="pt-60 pb-60 position-relative" style="background: #3083FF;">
            <div class="container">
                <div class="px-header-detail-course">
                    <p class="text-md-center mb-10 text-base" style="color: #6CFFC5;font-weight: 500">#BelajarLangsungDariAhli
                    </p>
                    <h3 class="text-md-center text-white mb-10 text-4xl">The Brand Masterclass Fundamental</h3>
                    <p class="mb-0 text-md-center text-base" style="color: #ffffffc5">Belajar langsung dari para Professional
                        dan
                        Practitioners Business
                        Expert dengan
                        pengalaman
                        selama puluhan tahun di dunia bisnis.</p>
                </div>
            </div>
            <figure class="image-detail-course-header-wrapper left"><img
                    src="{{ asset('assets/img/decoration/umkmplus-laptop.png') }}" alt="umkmplus-laptop-header">
            </figure>
            <figure class="image-detail-course-header-wrapper right"><img
                    src="{{ asset('assets/img/decoration/umkmplus-laptop.png') }}" alt="umkmplus-laptop-header">
            </figure>
        </section>
        {{-- header area end --}}

        {{-- course area start --}}
        <section class="pt-70 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-32 mb-lg-0">
                            <figure class="position-relative thumbnail-course-wrapper">
                                <img src="{{ asset('assets/img/dummy/thumbnail-course-2.png') }}"
                                    alt="thumbnail_name_course">
                                <div class="dark-screen"></div>
                                <div class="course__video-play">
                                    <a href="/course-playing/courseName" class="play-btn popup-video">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-course-detail-wrapper">
                            <div class="card-body">
                                <h4 class="text-2xl mb-10">The Brand Masterclass Fundamental</h4>
                                <h4 class="mb-10 text-green">Rp. 1.850.000</h4>
                                <p class="mb-10 text-base">Kelas terdiri dari</p>
                                <div class="d-flex align-items-center mb-5">
                                    <i class="text-tp-theme-1 fa-regular fa-book-open me-2 text-base"></i>
                                    <p class="mb-0 me-4">5 Modul</p>
                                    <i class="text-tp-theme-1 fa-regular fa-file-certificate me-2 text-base"></i>
                                    <p class="mb-0">Sertifikat</p>
                                </div>
                                <div class="d-flex align-items-center mb-25">
                                    <i class="text-tp-theme-1 fa-regular fa-clapperboard-play me-2 text-base"></i>
                                    <p class="mb-0 me-4">12 Video</p>
                                    <i class="text-tp-theme-1 fa-regular fa-hundred-points me-2 text-base"></i>
                                    <p class="mb-0">Ujian</p>
                                </div>
                                <div class="">
                                    <a href="/checkout/courseName" class="tp-btn tp-btn-2 rounded-pill me-2 mb-15">Mulai
                                        Belajar</a>
                                    <button type="button" class="tp-btn tp-btn-3 rounded-pill"><i
                                            class="fa-regular fa-cart-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- course area end --}}

        {{-- description area start --}}
        <section class="pt-40 pb-70" style="background: #f9f9f9">
            <div class="container">
                <h3 class="mb-15 text-3xl">Deskripsi Kelas</h3>
                <p class="mb-40">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia eveniet minus odit porro
                    beatae, nobis quod neque quam incidunt corrupti officiis voluptate suscipit iure architecto eum. Animi
                    optio alias iure. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi similique laboriosam
                    odio? Atque, deserunt iste officia tempora iusto quaerat nostrum possimus unde fugiat? Inventore ratione
                    aperiam at eligendi quae corrupti!</p>
                <h3 class="mb-25 text-3xl">Modul Pembelajaran</h3>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="course__curriculum">
                            <div class="accordion" id="course__accordion">
                                <div class="accordion-item mb-32">
                                    <h2 class="accordion-header" id="ch1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#ch1-content" aria-expanded="true" aria-controls="ch1-content">
                                            Chapter #1 : Fundamental Branding
                                        </button>
                                    </h2>
                                    <div id="ch1-content" class="accordion-collapse collapse show" aria-labelledby="ch1"
                                        data-bs-parent="#course__accordion">
                                        <div class="accordion-body">
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg viewBox="0 0 24 24">
                                                        <polygon class="st0" points="23,7 16,12 23,17 " />
                                                        <path class="st0"
                                                            d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z" />
                                                    </svg>
                                                    <h3> <span>Video: </span> Greetings and introduction</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 15
                                                        minutes</span>
                                                </div>
                                            </div>
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg viewBox="0 0 24 24">
                                                        <polygon class="st0" points="23,7 16,12 23,17 " />
                                                        <path class="st0"
                                                            d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z" />
                                                    </svg>
                                                    <h3> <span>Video: </span> Greetings and introduction</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 15
                                                        minutes</span>
                                                </div>
                                            </div>
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg class="document" viewBox="0 0 24 24">
                                                        <path class="st0"
                                                            d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                        <polyline class="st0" points="14,2 14,8 20,8 " />
                                                        <line class="st0" x1="16" y1="13"
                                                            x2="8" y2="13" />
                                                        <line class="st0" x1="16" y1="17"
                                                            x2="8" y2="17" />
                                                        <polyline class="st0" points="10,9 9,9 8,9 " />
                                                    </svg>
                                                    <h3> <span>Materi:</span> Fundamental Branding</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 15
                                                        minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="course__accordion">
                                <div class="accordion-item mb-32">
                                    <h2 class="accordion-header" id="ch2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#ch2-content" aria-expanded="true"
                                            aria-controls="ch2-content">
                                            Chapter #2 : Learning Brand
                                            Blueprint
                                        </button>
                                    </h2>
                                    <div id="ch2-content" class="accordion-collapse  collapse show" aria-labelledby="ch2"
                                        data-bs-parent="#course__accordion-2">
                                        <div class="accordion-body">
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg viewBox="0 0 24 24">
                                                        <polygon class="st0" points="23,7 16,12 23,17 " />
                                                        <path class="st0"
                                                            d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z" />
                                                    </svg>
                                                    <h3> <span>Video: </span> Greetings and introduction</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 15
                                                        minutes</span>
                                                </div>
                                            </div>
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg class="document" viewBox="0 0 24 24">
                                                        <path class="st0"
                                                            d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                        <polyline class="st0" points="14,2 14,8 20,8 " />
                                                        <line class="st0" x1="16" y1="13"
                                                            x2="8" y2="13" />
                                                        <line class="st0" x1="16" y1="17"
                                                            x2="8" y2="17" />
                                                        <polyline class="st0" points="10,9 9,9 8,9 " />
                                                    </svg>
                                                    <h3> <span>Reading: </span> Ut enim ad minim veniam</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 22
                                                        minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="course__accordion">
                                <div class="accordion-item mb-32">
                                    <h2 class="accordion-header" id="ch-3">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#ch-3-content" aria-expanded="true"
                                            aria-controls="ch-3-content">
                                            Ujian Akhir
                                        </button>
                                    </h2>
                                    <div id="ch-3-content" class="accordion-collapse collapse show"
                                        aria-labelledby="ch-3" data-bs-parent="#course__accordion">
                                        <div class="accordion-body">
                                            <div
                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                    <svg class="document" viewBox="0 0 24 24">
                                                        <path class="st0"
                                                            d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                        <polyline class="st0" points="14,2 14,8 20,8 " />
                                                        <line class="st0" x1="16" y1="13"
                                                            x2="8" y2="13" />
                                                        <line class="st0" x1="16" y1="17"
                                                            x2="8" y2="17" />
                                                        <polyline class="st0" points="10,9 9,9 8,9 " />
                                                    </svg>
                                                    <h3> <span>Ujian:</span> Fundamental Branding</h3>
                                                </div>
                                                <div class="course__curriculum-meta text-left text-sm-right">
                                                    <span class="time"> <i
                                                            class="fa-regular fa-clock-rotate-left"></i></i> 30
                                                        minutes</span>
                                                    <span class="question">30 questions</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <h3 class="mt-10 mb-20 text-3xl d-xl-none">Mentor Kelas</h3>
                        <div style="max-width: 420px">
                            <a href="/mentor/mentorName"
                                class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                                <div class="mentor-card-thumbnail mt-3">
                                    <img src="{{ asset('assets/img/dummy/mentor-2.jpg') }}" alt="mentor-1">
                                </div>
                                <div class="course__content p-relative">
                                    <h5 class="course__title text-lg mb-1 text-center">
                                        Muhammad Dwi Akbar
                                    </h5>
                                    <p class="mb-2 text-center">Sale Manager</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="me-3 d-flex align-items-center mb-0">
                                            <i class="material-symbols-rounded me-2">school</i>2000<span
                                                class="text-gray ms-1">Students</span>
                                        </p>
                                        <p class="d-flex align-items-center mb-0">
                                            <i class="material-symbols-rounded me-2">group</i>3<span
                                                class="text-gray ms-1">Kelas</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- description area end --}}
    </main>
@endsection

@section('script')
@endsection
