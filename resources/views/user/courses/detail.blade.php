@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section id="headerDetailCourse" class="pt-85 pb-85 position-relative" style="background: #3083FF;">
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
        <section class="pt-70 pb-70">
            <div class="container"></div>
        </section>
        {{-- course area end --}}

        {{-- description area start --}}
        <section class="pt-70 pb-70 grey-bg-3">
            <div class="container"></div>
        </section>
        {{-- description area end --}}
    </main>
@endsection

@section('script')
@endsection
