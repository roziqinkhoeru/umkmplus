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

        {{-- contact area start --}}
        <section class="contact__area pt-30 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="contact__wrapper">
                            <div class="section__title-wrapper mb-40">
                                <h2 class="section__title">Hubungi Kami</h2>
                                <p>Punya pertanyaan atau hanya ingin menyapa? Kami akan senang mendengar dari Anda.</p>
                            </div>
                            <div class="contact__form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-xxl-6 col-xl-6 col-md-6">
                                            <div class="contact__form-input">
                                                <input type="text" id="fullname" id="fullname" required
                                                    placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-md-6">
                                            <div class="contact__form-input">
                                                <input type="email" id="email" name="email" required
                                                    placeholder="youremail@email.com">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-input">
                                                <input type="text" id="subject" name="subject" required
                                                    placeholder="Subjek">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-input">
                                                <textarea required id="messages" name="messages" placeholder="Masukkan Pesan Anda"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-agree  d-flex align-items-center mb-20">
                                                <input class="e-check-input" type="checkbox" id="e-agree">
                                                <label class="e-check-label" for="e-agree">Saya setuju dengan<a
                                                        href="/terms">Syarat dan Ketentuan</a></label>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__btn">
                                                <button class="tp-btn rounded-3 tp-btn-4">Kirim Pesan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1">
                        <div class="contact__info white-bg p-relative z-index-1">
                            <div class="contact__info-inner white-bg">
                                <ul>
                                    <li>
                                        <div class="contact__info-item d-flex align-items-start mb-35">
                                            <div class="contact__info-icon mr-15">
                                                <svg class="map" viewBox="0 0 24 24">
                                                    <path class="st0"
                                                        d="M21,10c0,7-9,13-9,13s-9-6-9-13c0-5,4-9,9-9S21,5,21,10z" />
                                                    <circle class="st0" cx="12" cy="10" r="3" />
                                                </svg>
                                            </div>
                                            <div class="contact__info-text">
                                                <h4>Jakarta Pusat, Jakarta</h4>
                                                <p><a target="_blank"
                                                        href="https://goo.gl/maps/dP4iaRBjRpNYBe3J6?coh=178571&entry=tt">Jl.
                                                        Pintu Satu Senayan, Daerah Khusus Ibukota Jakarta 10270</a></p>

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact__info-item d-flex align-items-start mb-35">
                                            <div class="contact__info-icon mr-15">
                                                <svg class="mail" viewBox="0 0 24 24">
                                                    <path class="st0"
                                                        d="M4,4h16c1.1,0,2,0.9,2,2v12c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2V6C2,4.9,2.9,4,4,4z" />
                                                    <polyline class="st0" points="22,6 12,13 2,6 " />
                                                </svg>
                                            </div>
                                            <div class="contact__info-text">
                                                <h4>Email</h4>
                                                <p><a href="mailto:info@umkmplus.site"> info@umkmplus.site</a></p>
                                                <p><a href="mailto:umkmplus2023@gmail.com">umkmplus2023@gmail.com</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact__info-item d-flex align-items-start mb-35">
                                            <div class="contact__info-icon mr-15">
                                                <svg class="call" viewBox="0 0 24 24">
                                                    <path class="st0"
                                                        d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z" />
                                                </svg>
                                            </div>
                                            <div class="contact__info-text">
                                                <h4>Telepon</h4>
                                                <p><a href="tel:+(62)-888-8979-7697">+(62) 888 8979 7697</a></p>
                                                <p><a href="tel:+(62)-823-1497-0378">+(62) 823 1497 0378</a></p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="contact__social pl-30">
                                    <h4>Ikuti Kami</h4>
                                    <ul>
                                        {{-- facebook --}}
                                        <li><a href="#" class="fb"><i class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        {{-- twitter --}}
                                        <li><a href="#" class="tw"><i class="fa-brands fa-twitter"></i></a>
                                        </li>
                                        {{-- youtube --}}
                                        <li><a href="#" class="pin"><i class="fa-brands fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- contact area end --}}
    </main>
@endsection
@section('script')
    <script></script>
@endsection
