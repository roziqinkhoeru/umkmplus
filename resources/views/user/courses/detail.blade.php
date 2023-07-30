@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section id="headerDetailCourse" class="pt-60 pb-60 position-relative w-100 overflow-hidden" style="background: #3083FF;">
            <div class="container">
                <div class="px-header-detail-course">
                    <p class="text-md-center mb-10 text-base" style="color: #6CFFC5;font-weight: 500">#BelajarLangsungDariAhli
                    </p>
                    <h3 class="text-md-center text-white mb-10 text-4xl">{{ $course->title }}</h3>
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
                                <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                    alt="{{ $course->slug }}-course-thumbnail">
                                <div class="dark-screen"></div>
                                <div class="course__video-play">
                                    <a href="https://www.youtube.com/watch?v={{ $course->modules[0]->mediaModules[0]->video_url }}"
                                        class="play-btn popup-video">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-course-detail-wrapper">
                            <div class="card-body">
                                <h4 class="text-2xl mb-10">{{ $course->title }}</h4>
                                @php
                                    $discoutPrice = $course->price - ceil(($course->price * $course->discount) / 100);
                                @endphp
                                <h4 class="mb-10 text-green">
                                    @if ($discoutPrice == 0)
                                        Gratis
                                    @else
                                        Rp. {{ number_format($discoutPrice, 0, ',', '.') }}
                                    @endif
                                    @if ($course->price != 0)
                                        <span class="text-decoration-line-through text-xs text-muted">Rp.
                                            {{ number_format($course->price, 0, ',', '.') }}</span>
                                    @endif
                                </h4>
                                @if ($course->price != 0)
                                    <div class="course__video-discount mb-10">
                                        <span>{{ $course->discount }}% OFF</span>
                                    </div>
                                @endif
                                <p class="mb-10 text-base">Kelas terdiri dari</p>
                                <div class="d-flex align-items-center mb-5">
                                    <i class="text-tp-theme-1 fa-regular fa-book-open me-2 text-base"></i>
                                    <p class="mb-0 me-4">{{ $course->modules_count }} Modul</p>
                                    <i class="text-tp-theme-1 fa-regular fa-file-certificate me-2 text-base"></i>
                                    <p class="mb-0">Sertifikat</p>
                                </div>
                                <div class="d-flex align-items-center mb-25">
                                    <i class="text-tp-theme-1 fa-regular fa-clapperboard-play me-2 text-base"></i>
                                    <p class="mb-0 me-4">{{ $countMediaModule }} Video</p>
                                    <i class="text-tp-theme-1 fa-regular fa-hundred-points me-2 text-base"></i>
                                    <p class="mb-0">Ujian</p>
                                </div>
                                <div class="">
                                    @if ($courseEnroll != null && Auth::check() && ($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai'))
                                        <a href="{{ url('/course/playing/' . $courseEnroll->id) }}"
                                            class="tp-btn tp-btn-2 rounded-pill mb-15">Lanjutkan Belajar</a>
                                    @elseif($courseEnroll != null && Auth::check() && $courseEnroll->status == 'menunggu pembayaran')
                                        <a href="{{ url('/checkout/' . $course->slug) }}"
                                            class="tp-btn tp-btn-2 rounded-pill mb-15">Lanjutkan Pembayaran</a>
                                    @elseif($courseEnroll != null && Auth::check() && $courseEnroll->status == 'selesai')
                                        <a href="{{ url('/course/playing/' . $courseEnroll->id) }}"
                                            class="tp-btn tp-btn-2 rounded-pill mb-15 me-2">Lanjutkan Belajar</a>
                                        <button type="button" class="tp-btn tp-btn-3 rounded-pill tp-btn-green"
                                            onclick="" title="Cetak Sertifikat"><i
                                                class="far fa-id-card-alt"></i></button>
                                    @else
                                        <div id="buttonCart">
                                            <a href="{{ url('/checkout/' . $course->slug) }}"
                                                class="tp-btn tp-btn-2 rounded-pill me-2 mb-15">Beli kelas</a>
                                            @if ($cartCourse)
                                                <button type="button" class="tp-btn tp-btn-3 rounded-pill"
                                                    onclick="deleteCart({{ $cartCourse }})"
                                                    style="background-color: #FC4C56 !important"><i
                                                        class="fa-regular fa-cart-xmark"></i></button>
                                            @else
                                                <button type="button" class="tp-btn tp-btn-3 rounded-pill"
                                                    onclick="addCart({{ $course->id }})"><i
                                                        class="fa-regular fa-cart-plus"></i></button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- course area end --}}

        {{-- description area start --}}
        <section class="pt-40 pb-60" style="background: #f9f9f9">
            <div class="container">
                <h3 class="mb-15 text-3xl">Deskripsi Kelas</h3>
                <p class="mb-40">{{ $course->description }}</p>
                <h3 class="mb-25 text-3xl">Modul Pembelajaran</h3>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="course__curriculum">
                            @foreach ($course->modules as $module)
                                <div class="accordion" id="course__accordion__module{{ $module->no_module }}">
                                    <div class="accordion-item mb-32">
                                        <h2 class="accordion-header" id="ch{{ $module->no_module }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#ch1-content-module-{{ $module->no_module }}"
                                                aria-expanded="true"
                                                aria-controls="ch1-content-module-{{ $module->no_module }}">
                                                Chapter #{{ $module->no_module }} : {{ $module->title }}
                                            </button>
                                        </h2>
                                        <div id="ch1-content-module-{{ $module->no_module }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="ch{{ $module->no_module }}"
                                            data-bs-parent="#course__accordion__module{{ $module->no_module }}">
                                            <div class="accordion-body">
                                                @foreach ($module->mediaModules as $mediaModule)
                                                    <div
                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                        <div class="course__curriculum-info">
                                                            <svg viewBox="0 0 24 24">
                                                                <polygon class="st0" points="23,7 16,12 23,17 " />
                                                                <path class="st0"
                                                                    d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z" />
                                                            </svg>
                                                            <h3> <span>Video: </span> {{ $mediaModule->title }}</h3>
                                                        </div>
                                                        <div class="course__curriculum-meta text-left text-sm-right">
                                                            <span class="time"> <i
                                                                    class="fa-regular fa-clock-rotate-left"></i></i>
                                                                {{ $mediaModule->duration }}
                                                                minutes</span>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                                        <h3> <span>Materi:</span> {{ $module->slug }}</h3>
                                                    </div>
                                                    {{-- <div class="course__curriculum-meta text-left text-sm-right">
                                                        <span class="time"> <i
                                                                class="fa-regular fa-clock-rotate-left"></i></i> 15
                                                            minutes</span>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <h3 class="mt-10 mb-20 text-3xl d-xl-none">Mentor Kelas</h3>
                        <div style="max-width: 420px">
                            <a href="/mentor/{{ $course->mentor->slug }}"
                                class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                                <div class="mentor-card-thumbnail mt-3">
                                    <img src="{{ asset('storage/' . $course->mentor->profile_picture) }}"
                                        alt="{{ $course->mentor->slug }}-mentor-profile">
                                </div>
                                <div class="course__content p-relative">
                                    <h5 class="course__title text-lg mb-1 text-center">
                                        {{ $course->mentor->name }}
                                    </h5>
                                    <p class="mb-2 text-center">{{ $course->mentor->job }}</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="me-3 d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">school</i>{{ $countMentor['countStudent'] }}<span
                                                class="text-gray ms-1">Students</span>
                                        </p>
                                        <p class="d-flex align-items-center mb-0">
                                            <i
                                                class="material-symbols-rounded me-2">group</i>{{ $countMentor['countCourse'] }}<span
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

        {{-- related courses area start --}}
        <section class="pt-50 pb-60">
            <div class="container">
                <div class="course__related">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__title-wrapper mb-40">
                                <h3 class="mb-25 text-3xl">Related Courses</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="course__slider swiper-container pb-60">
                                <div class="swiper-wrapper">
                                    @foreach ($relatedCourse as $courses)
                                        <div class="swiper-slide transition-3">
                                            <a class="course__item-2 transition-3 white-bg mb-30 fix h-100 d-block border-1 border-light-2"
                                                href="/course/{{ $courses->slug }}">
                                                <div class="course__thumb-2 w-img fix">
                                                    <figure class="mb-0 position-relative">
                                                        <img src="{{ asset('storage/' . $courses->thumbnail) }}"
                                                            alt="{{ $courses->slug }}-course-thumbnail">
                                                        <div class="course-tag-wrapper">
                                                            <div class="course__tag">
                                                                <span
                                                                    class="course-badge">{{ $courses->category->name }}</span>
                                                            </div>
                                                        </div>
                                                    </figure>
                                                </div>
                                                {{-- course item content --}}
                                                <div class="course__content-2" style="padding: 18px 24px 20px">
                                                    <h3 class="course__title-2 line-clamp-3-hover text-lg leading-lg mb-2">
                                                        {{ $courses->title }}
                                                    </h3>
                                                    @php
                                                        $discoutPrices = $courses->price - ceil(($courses->price * $courses->discount) / 100);
                                                    @endphp
                                                    <p class="mb-10 fw-medium text-green-2">
                                                        @if ($discoutPrices == 0)
                                                            Gratis
                                                        @else
                                                            Rp. {{ number_format($discoutPrices, 0, ',', '.') }}
                                                        @endif
                                                        @if ($courses->price != 0)
                                                            <span
                                                                class="text-decoration-line-through text-xs text-green-3">Rp.
                                                                {{ number_format($courses->price, 0, ',', '.') }}</span>
                                                        @endif
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
                                                                            <span>{{ $courses->modules_count }}
                                                                                Modul</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div
                                                                        class="course__action-item d-flex align-items-center">
                                                                        <div class="course__action-icon mr-5">
                                                                            <span>
                                                                                <svg width="10" height="12"
                                                                                    viewBox="0 0 10 12" fill="none"
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
                                                                            <span>{{ $courses->course_enrolls_count }}</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="course__tutor-2">
                                                            <div>
                                                                <img src="{{ asset('storage/' . $courses->mentor->profile_picture) }}"
                                                                    alt="{{ $courses->mentor->slug }}-mentor-profile"
                                                                    class="object-cover-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- related courses area end --}}
    </main>
@endsection

@section('script')
    <script>
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
                            );
                            getCart();
                            $("#buttonCart").html(`<a href="{{ url('/checkout/' . $course->slug) }}"
                                            class="tp-btn tp-btn-2 rounded-pill me-2 mb-15">Beli kelas</a>
                                            <button type="button" class="tp-btn tp-btn-3 rounded-pill"
                                                onclick="deleteCart(${response.data})" style="background-color: #FC4C56 !important"><i
                                                class="fa-regular fa-cart-xmark"></i></button>`);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.message == "Unauthenticated.") {
                                    window.location.href = "{{ route('login') }}";
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Anda gagal memasukkan ke keranjang.',
                                        xhr.responseJSON.message
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal memasukkan ke keranjang.',
                                    error
                                )
                                return false;
                            }
                        }
                    })
                }
            })
        }

        function deleteCart(cart) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus kelas dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/cart/${cart}') }}`,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Anda telah menghapus kelas dari keranjang.',
                                'success'
                            );
                            getCart();
                            $("#buttonCart").html(`<a href="{{ url('/checkout/' . $course->slug) }}"
                                            class="tp-btn tp-btn-2 rounded-pill me-2 mb-15">Beli kelas</a>
                                            <button type="button" class="tp-btn tp-btn-3 rounded-pill"
                                                onclick="addCart({{ $course->id }})"><i
                                                class="fa-regular fa-cart-plus"></i></button>`);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal menghapus kelas dari keranjang.',
                                    xhr.responseJSON.meta.message
                                )
                            else
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal menghapus kelas dari keranjang.',
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
