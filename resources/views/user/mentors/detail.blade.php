@extends('user.layout.app')

@section('content')
    <main>
        {{-- mentor area start --}}
        <section class="bg-white pt-80 pb-45">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="d-sm-flex mb-30 mb-lg-0">
                            <div class="mentor-image-wrapper">
                                <figure class="mb-0 mentor-image-circle"><img src="{{ asset($mentor->profile_picture) }}"
                                        alt="{{ $mentor->slug }}-mentor-profile"></figure>
                            </div>
                            <div class="mentor-content-wrapper">
                                <h2>{{ $mentor->name }}</h2>
                                <h6>{{ $mentor->job }}</h6>
                                <div class="d-flex align-items-center mb-10">
                                    <i class="fa-solid fa-circle-user me-2 text-xl text-tp-theme-1"
                                        style="transform: translateY(-2px)"></i>
                                    <p class="mb-0 me-4">{{ $countStudent }} Students</p>
                                    <i class="fa-regular fa-clapperboard-play me-2 text-xl text-tp-theme-1"></i>
                                    <p class="mb-0">{{ $countCourse }} Kelas</p>
                                </div>
                                <p class="mb-0 fst-italic text-xs text-muted">*Mentor sejak {{ $mentor->joinDate }}</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card rounded-2-5">
                            <div class="card-body p-4">
                                <p class="fw-bold text-tp-theme-1 mb-8 text-lg">Tentang Mentor</p>
                                <p class="mb-0">{{ $mentor->dataMentor->about }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- mentor area end --}}

        {{-- course area start --}}
        <section class="grey-bg-3 pt-45 pb-70">
            <div class="container">
                <h4 class="mb-32">Ada {{ $countCourse }} Kelas dari mentor ini</h4>
                <div class="d-grid gap-5 grid-cols-12" id="courseMentor">
                </div>
            </div>
        </section>
        {{-- course area end --}}
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            getCourseMentor();
        });

        function getCourseMentor() {
            $.ajax({
                type: "GET",
                url: "{{ url('course/mentor') }}" + "/" + "{{ $mentor->slug }}",
                success: function(response) {
                    let htmlString = "";
                    $.map(response.data, function(courseData, index) {
                        let option = {
                                style: 'currency',
                                currency: 'IDR',
                                useGrouping: true,
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0,
                            };
                            let coursePrice = new Intl.NumberFormat('id-ID', option).format(courseData.price);
                        let coursePriceDiscount = courseData.price - Math.ceil(courseData.price *
                            courseData.discount / 100);
                        let coursePriceDiscountFormat = coursePriceDiscount.toLocaleString('id-ID',
                            option);
                        htmlString += `<div class="col-span-3-course">
                        <a class="course__item-2 transition-3 white-bg mb-30 fix h-100 d-block" href="/course/${courseData.slug}">
                            {{-- course item image --}}
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
                                <h3 class="course__title-2 line-clamp-3-hover text-lg leading-lg mb-2">
                                    ${courseData.title}
                                </h3>
                                <p class="mb-10 fw-medium text-green-2">${courseData.price != 0 ? coursePriceDiscountFormat : 'Gratis'}
                                                            <span class="text-decoration-line-through text-xs">${courseData.discount != 0 ? coursePrice : ''}</span>
                                                            </p>
                                <div class="course__bottom-2 d-flex align-items-center justify-content-between">
                                    <div class="course__action">
                                        <ul>
                                            <li>
                                                <div class="course__action-item d-flex align-items-center">
                                                    <div class="course__action-icon mr-5">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-mortarboard" viewBox="0 0 16 16">
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
                                                <div class="course__action-item d-flex align-items-center">
                                                    <div class="course__action-icon mr-5">
                                                        <span>
                                                            <svg width="10" height="12" viewBox="0 0 10 12"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M5.00004 5.5833C6.28592 5.5833 7.32833 4.5573 7.32833 3.29165C7.32833 2.02601 6.28592 1 5.00004 1C3.71416 1 2.67175 2.02601 2.67175 3.29165C2.67175 4.5573 3.71416 5.5833 5.00004 5.5833Z"
                                                                    stroke="#5F6160" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M9 11.0001C9 9.22632 7.20722 7.79175 5 7.79175C2.79278 7.79175 1 9.22632 1 11.0001"
                                                                    stroke="#5F6160" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                            <img src="{{ asset('${courseData.mentor.profile_picture}') }}" alt="${courseData.mentor.slug}-mentor-profile" class="object-cover-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>`
                    });
                    $("#courseMentor").html(htmlString);
                }
            });
        }
    </script>
@endsection
