@extends('user.layout.app')

@section('content')
    <main>
        {{-- slider area start --}}
        <section class="slider__area slider-height-3 include-bg d-flex align-items-center"
            data-background="{{ asset('assets/img/decoration/blue-bg.png') }}">
            <div class="container">
                <div class="row align-items-center row-gap-5">
                    <div class="col-xxl-6 col-lg-6">
                        <div class="slider__content-2 mt-30">
                            <span class="text-green fw-semibold">#BelajarLangsungDariAhli</span>
                            <h3 class="slider__title-2">Mentor Terpopuler</h3>
                            <p>Belajar langsung dari para Professional dan Practitioners Business Expert dengan pengalaman
                                selama puluhan tahun di dunia bisnis.</p>
                            <div class="slider__search mb-20">
                                <form action="#" id="formSearchMentor">
                                    <div class="slider__search-input p-relative">
                                        <input type="text" placeholder="Cari mentor..." name="searchMentor"
                                            id="searchMentor" style="background: #F1F1F1">
                                        <button type="submit" class="tp-btn-search-header">Search</button>
                                        <div class="slider__search-input-icon"
                                            style="transform: translateY(-57%) !important;">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.625 15.75C12.56 15.75 15.75 12.56 15.75 8.625C15.75 4.68997 12.56 1.5 8.625 1.5C4.68997 1.5 1.5 4.68997 1.5 8.625C1.5 12.56 4.68997 15.75 8.625 15.75Z"
                                                    stroke="#828282" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M16.5 16.5L15 15" stroke="#828282" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-6">
                        <div class="slider__thumb-2 p-relative">
                            <div class="slider__shape">
                                <img class="img-fluid header-image-animation-2"
                                    src="{{ asset('assets/img/brand/man-and-women-pen.png') }}"
                                    alt="man-and-women-pen-header">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- slider area end --}}

        {{-- mentor area start --}}
        <section class="pt-40 pb-60 bg-white">
            <div class="container">
                <p class="mb-30 fw-semibold text-xl">Ada 200+ Mentor Ahli Untukmu</p>
                <div class="row" id="mentorData">
                </div>
            </div>
        </section>
        {{-- mentor are end --}}
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            mentor()
        });
        $("#formSearchMentor").submit(function(e) {
            e.preventDefault();
            mentor()
        });

        function createSlug(title) {
            let slug = title.toLowerCase().replace(/ /g, "-");
            slug = slug.replace(/[^a-z0-9-]/g, "");
            return slug;
        }

        function mentor() {
            let name = $("#searchMentor").val()
            // Membuat permintaan AJAX dan mengubah URL
            var request = `name=${name}`; // Request yang ingin ditambahkan
            var url = "{{ url('/mentor') }}"; // Mendapatkan URL saat ini
            var newUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + request; // Menambahkan request ke URL

            // Mengubah URL tanpa melakukan reload halaman
            history.pushState(null, null, newUrl);

            $.ajax({
                type: "GET",
                url: "{{ route('get.mentor') }}",
                data: {
                    name: name
                },
                success: function(response) {
                    let htmlString = ``;
                    $.map(response.data, function(mentorData, index) {
                        htmlString += `<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <a href="/mentor/${createSlug(mentorData.name)}"
                            class="course__item white-bg transition-3 mb-30 rounded-2-5 border border-1 border-light-2 d-block">
                            <div class="mentor-card-thumbnail mt-3">
                                <img src="{{ asset('${mentorData.profile_picture}') }}" alt="mentor-1">
                            </div>
                            <div class="course__content p-relative">
                                <h5 class="course__title text-lg mb-1 text-center">
                                    ${mentorData.name}
                                </h5>
                                <p class="mb-2 text-center">Personal Branding</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="me-3 d-flex align-items-center mb-0">
                                        <i class="material-symbols-rounded me-2">school</i>${mentorData.total_student}<span
                                            class="text-gray ms-1">Students</span>
                                    </p>
                                    <p class="d-flex align-items-center mb-0">
                                        <i class="material-symbols-rounded me-2">group</i>${mentorData.total_course}<span
                                            class="text-gray ms-1">Kelas</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>`
                    });
                    $("#mentorData").html(htmlString);
                }
            });
        }
    </script>
@endsection
