@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section class="pt-60 pb-50" style="background: #3083FF;">
            <div class="container">
                <div class="d-sm-flex align-items-sm-center">
                    <div class="mb-sm-22 me-sm-4">
                        <figure class="image-header-category-wrapper">
                            <img src="{{ asset('assets/img/dummy/good-job-hands-white.svg') }}" alt="good-job-hands-white">
                        </figure>
                    </div>
                    <div class="">
                        <h3 class="text-white text-4xl">Kelas {{ $category->name }}</h3>
                        <p class="fw-medium text-base mb-0" style="color: #ffffffc5">#BelajarLangsungDariAhli</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- header area end --}}

        {{-- course area start --}}
        <section class="course__area pt-80 pb-70 grey-bg-3">
            <div class="container">
                <div class="row">
                    {{-- filter --}}
                    <div class="col-xxl-3 col-xl-3 col-lg-4">
                        <div class="course__sidebar">
                            {{-- search --}}
                            <div class="course__sidebar-widget white-bg">
                                <div class="course__sidebar-search">
                                    <form id="formSearchCourse">
                                        <input type="text" placeholder="Cari kelas..." name="searchCourse"
                                            id="searchCourse">
                                        <button type="submit" onclick="course()">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 584.4 584.4" style="enable-background:new 0 0 584.4 584.4;"
                                                xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path class="st0"
                                                            d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                                                        <path class="st1"
                                                            d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- sorting --}}
                            <form action="">
                                {{-- sort --}}
                                <div class="course__sidebar-widget white-bg">
                                    <div class="course__sidebar-info">
                                        <h3 class="course__sidebar-title">Sorting</h3>
                                        <ul id="sorting">
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="sorting m-check-input" type="radio" name="sort"
                                                        value="newRelease" id="newReleaseIn">
                                                    <label class="m-check-label" for="newReleaseIn">Baru Rilis</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="sorting m-check-input" type="radio" name="sort"
                                                        value="promotion" id="promotionIn">
                                                    <label class="m-check-label" for="promotionIn">Sedang Promo</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="sorting m-check-input" type="radio" name="sort"
                                                        value="popular" id="popularIn">
                                                    <label class="m-check-label" for="popularIn">Paling Populer</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- price --}}
                                <div class="course__sidebar-widget white-bg">
                                    <div class="course__sidebar-info">
                                        <h3 class="course__sidebar-title">Price Filter</h3>
                                        <ul id="priceFilter">
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="priceFilter m-check-input" type="radio" name="sort"
                                                        value="cheapestCourse" id="cheapestCourseIn">
                                                    <label class="m-check-label" for="cheapestCourseIn">Termurah -
                                                        Termahal</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="priceFilter m-check-input" type="radio"
                                                        value="expensiveCourse" name="sort" id="expensiveCourseIn">
                                                    <label class="m-check-label" for="expensiveCourseIn">Termahal -
                                                        Termurah</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                                    <input class="priceFilter m-check-input" type="radio"
                                                        value="freeCourse" name="sort" id="freeCourseIn">
                                                    <label class="m-check-label" for="freeCourseIn">Gratis</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- course --}}
                    <div class="col-xxl-9 col-xl-9 col-lg-8">
                        {{-- control tab --}}
                        <div class="course__tab-inner white-bg mb-35">
                            <div class="course__tab-wrapper d-flex align-items-center">
                                {{-- display option --}}
                                <div class="course__tab-btn">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#grid" type="button" role="tab"
                                                aria-controls="grid" aria-selected="true">
                                                <svg class="grid" viewBox="0 0 24 24">
                                                    <rect x="3" y="3" class="st0" width="7"
                                                        height="7" />
                                                    <rect x="14" y="3" class="st0" width="7"
                                                        height="7" />
                                                    <rect x="14" y="14" class="st0" width="7"
                                                        height="7" />
                                                    <rect x="3" y="14" class="st0" width="7"
                                                        height="7" />
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                {{-- count view course --}}
                                <div class="course__view" id="countCourse">
                                    <h4>Showing 0 Courses</h4>
                                </div>
                            </div>
                        </div>
                        {{-- course item --}}
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="course__tab-conent">
                                    <div class="tab-content" id="courseTabContent">
                                        <div class="tab-pane fade show active" id="grid" role="tabpanel"
                                            aria-labelledby="grid-tab">
                                            <div class="d-grid gap-5 grid-cols-12" id="courseCategory">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- course area end --}}
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            getCourse()
        });

        $("#formSearchCourse").submit(function(e) {
            e.preventDefault();
            getCourse()
        });

        function createSlug(title) {
            let slug = title.toLowerCase().replace(/ /g, "-");
            slug = slug.replace(/[^a-z0-9-]/g, "");
            return slug;
        }

        function getCourse() {
            // loading state
            $("#courseCategory").html(
                `<div class="text-center text-4xl col-span-full pt-100 pb-65"><i class="fas fa-spinner-third spinners-3"></i></div>`
            );
            $.ajax({
                type: "GET",
                url: "{{ url('/course/category/' . $category->slug . '/data') }}",
                data: {
                    searchCourse: $("#searchCourse").val(),
                    newRelease: $("#newReleaseIn").is(":checked"),
                    promotion: $("#promotionIn").is(":checked"),
                    popular: $("#popularIn").is(":checked"),
                    cheapestCourse: $("#cheapestCourseIn").is(":checked"),
                    expensiveCourse: $("#expensiveCourseIn").is(":checked"),
                    freeCourse: $("#freeCourseIn").is(":checked"),
                },
                success: function(response) {
                    let htmlString = ``;
                    $("#countCourse").html(`<h4>Showing ${response.courseCount} Courses</h4>`);
                    if (response.courseCount === 0) {
                        // empty state
                        htmlString = emptyState('Maaf, kelas belum tersedia');
                    } else {
                        // success state
                        $.map(response.data, function(courseData, index) {
                            let option = {
                                style: 'currency',
                                currency: 'IDR',
                                useGrouping: true,
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0,
                            };
                            let coursePriceDiscount = courseData.price - Math.ceil(courseData.price * courseData.discount / 100);
                            let coursePrice = courseData.price.toLocaleString('id-ID', option);
                            let coursePriceDiscountFormat = coursePriceDiscount.toLocaleString('id-ID', option);
                            let date = new Date(courseData.created_at);
                            let options = {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            };
                            let createAt = date.toLocaleDateString('id-ID', options);
                            htmlString += `<div class="col-span-4-course">
                                                    <a class="course__item-2 transition-3 white-bg mb-30 fix h-100 d-block"
                                                        href="{{ url('/course/${courseData.slug}') }}">
                                                        {{-- course item image --}}
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
                                                            <p class="mb-10 fw-medium text-green-2">${courseData.price != 0 ? coursePriceDiscountFormat : 'Free'}
                                                            <span class="text-decoration-line-through text-xs">${courseData.price != 0 ? coursePrice : ''}</span>
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
                    }
                    $("#courseCategory").html(htmlString);
                },
                // error state
                error: function() {
                    $("#courseCategory").html(errorState());
                }
            });
        }

        $('#sorting').on('change', '.sorting', function() {
            getCourse();
        });
        $('#priceFilter').on('change', '.priceFilter', function() {
            getCourse();
        });
    </script>
@endsection
