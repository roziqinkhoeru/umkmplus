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
                            <h3 class="slider__title-2">Temukan Kelasmu Berdasarkan Kategori</h3>
                            <p>Belajar langsung dari para Professional dan Practitioners Business Expert dengan pengalaman
                                selama puluhan tahun di dunia bisnis.</p>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-6">
                        <div class="slider__thumb-2 p-relative">
                            <div class="slider__shape">
                                <img class="img-fluid header-image-animation-2"
                                    src="{{ asset('assets/img/brand/girl-white-laptop-analysis.png') }}"
                                    alt="girl-with-laptop-anaylis">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- slider area end --}}

        {{-- category area start --}}
        <section class="bg-white pb-60 pt-40">
            <div class="container">
                <div class="row row-gap-4">
                    @foreach ($categories as $category)
                    <div class="col-xxl-4 col-xl-4 col-md-6">
                        <div class="card card-list-category">
                            <div class="card-body">
                                <figure class="list-category-img-wrapper mb-30"><img
                                        src="{{ asset('assets/img/dummy/good-job-hand.svg') }}" alt="category-thumbnail">
                                </figure>
                                <h3 class="mb-10">{{ $category->name }}</h3>
                                <p class="mb-15">{{ $category->description }}</p>
                                <div class="d-flex"><a href="{{ url('/course/category/'.$category->slug) }}" class="card-list-category-link">Jelajahi<i
                                            class="fa-solid fa-arrow-right ms-2"></i></a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- category area end --}}
    </main>
@endsection

@section('script')
@endsection
