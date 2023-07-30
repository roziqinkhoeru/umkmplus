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
                            <span class="text-green fw-semibold">#TerhubungdenganKami</span>
                            <h3 class="slider__title-2">Kontak Kami</h3>
                            <p>
                                Punya pertanyaan atau hanya ingin menyapa? Kami akan senang mendengar dari Anda.
                            </p>
                            <div class="slider__search mb-20">
                                <form action="#" id="">
                                    <div class="slider__search-input p-relative">
                                        <input type="email" placeholder="youremail@email.com" name="email"
                                            id="email" style="background: #F1F1F1">
                                        <button type="submit" class="tp-btn-search-header">Subscribe</button>
                                        <div class="slider__search-input-icon"
                                            style="transform: translateY(-57%) !important;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                                <path
                                                    d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                            </svg>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-1 d-none d-xxl-block"></div>
                    <div class="col-xxl-5 col-lg-6">
                        <div class="slider__thumb-2 p-relative">
                            <div class="slider__shape">
                                <img class="img-fluid header-image-animation-2"
                                    src="{{ asset('assets/img/decoration/header-hexa-2.png') }}"
                                    alt="hexa-header-umkmplus-2">
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
                                <h3 class="section__title">Hubungi Kami</h3>
                            </div>
                            <div class="contact__form">
                                <form action="#" id="contactForm">
                                    <div class="row">
                                        <div class="col-xxl-6 col-xl-6 col-md-6">
                                            <div class="contact__form-input pb-4">
                                                <input type="text" id="fullname" name="fullname" required
                                                    placeholder="Nama Lengkap" class="mb-1">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-md-6">
                                            <div class="contact__form-input pb-4">
                                                <input type="email" id="email" name="email" required
                                                    placeholder="youremail@email.com" class="mb-1">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-input pb-4">
                                                <input type="text" id="subject" name="subject" required
                                                    placeholder="Subjek" class="mb-1">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-input pb-3">
                                                <textarea required id="messages" name="messages" placeholder="Masukkan Pesan Anda" class="mb-1"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__form-agree  d-flex align-items-center mb-20">
                                                <input class="e-check-input" type="checkbox" id="terms" name="terms">
                                                <label class="e-check-label" for="terms">Saya setuju dengan<a
                                                        href="/terms">Syarat dan Ketentuan</a></label>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div class="contact__btn">
                                                <button class="tp-btn rounded-3 tp-btn-4" id="contactFormButton">Kirim
                                                    Pesan</button>
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
                                        <li><a href="https://www.facebook.com/" rel="noopener noreferrer" target="_blank"
                                                class="fb"><i class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        {{-- twitter --}}
                                        <li><a href="https://www.twitter.com/" rlrel="noopener noreferrer"
                                                target="_blank" class="tw"><i class="fa-brands fa-twitter"></i></a>
                                        </li>
                                        {{-- youtube --}}
                                        <li><a href="https://www.youtube.com/" rlrel="noopener noreferrer"
                                                target="_blank" class="pin"><i class="fa-brands fa-youtube"></i></a>
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
    <script>
        // validate form
        $("#contactForm").validate({
            rules: {
                fullname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                subject: {
                    required: true,
                },
                messages: {
                    required: true,
                },
                terms: {
                    required: true,
                },
            },
            messages: {
                fullname: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nama lengkap tidak boleh kosong',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak valid',
                },
                subject: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Subjek tidak boleh kosong',
                },
                messages: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Pesan tidak boleh kosong',
                },
                terms: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Anda harus menyetujui syarat dan ketentuan',
                },
            },
        });
    </script>
@endsection
