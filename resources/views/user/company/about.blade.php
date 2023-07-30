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
                            <span class="text-green fw-semibold">#BelajarLangsunDariPakar</span>
                            <h3 class="slider__title-2">Memberdayakan Pengusaha UMKM Menuju Sukses</h3>
                            <p>Pelajari langsung dari para ahli bisnis yang profesional dan praktisi dengan pengalaman
                                bertahun-tahun di industri.</p>
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

        {{-- umkmplus area start --}}
        <section class="umkmplus__area pb-35">
            <div class="container">
                <div class="d-flex justify-content-center mb-25">
                    <div class="umkmplus-container-about">
                        <img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}" alt="UMKMPlus Letter Logo">
                    </div>
                </div>
                <p class="text-base text-center">Selamat datang di UMKMPlus, gerbang menuju keunggulan dalam kewirausahaan
                    dan
                    pertumbuhan bisnis! Kami adalah platform pembelajaran online yang didedikasikan untuk memberdayakan
                    usaha kecil dan menengah (UMKM) di Indonesia. Misi kami adalah membekali pengusaha UMKM dengan
                    pengetahuan, keterampilan, dan bimbingan yang dibutuhkan untuk berkembang dalam lanskap bisnis yang
                    kompetitif saat ini. Di UMKMPlus, kami membayangkan Indonesia yang sejahtera, di mana setiap usaha kecil
                    dan menengah dapat memaksimalkan potensinya dan berkontribusi secara signifikan terhadap pertumbuhan
                    ekonomi negara. Kami percaya bahwa dengan memelihara dan mendukung bisnis UMKM, kami dapat mendorong
                    inovasi, menciptakan lapangan kerja, dan menumbuhkan ekosistem kewirausahaan yang dinamis.</p>
            </div>
        </section>
        {{-- umkmplus area end --}}

        {{-- counter area start --}}
        <section class="counter__area pt-15 pb-60">
            <div class="container">
                <div class="counter__inner grey-bg-2 rounded-4">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="counter__item d-flex align-items-start counter__item-border">
                                <div class="counter__icon mr-15">
                                    <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M37 19.1667C37 9.23075 28.936 1.16675 19 1.16675C9.064 1.16675 1 9.23075 1 19.1667C1 29.1027 9.064 37.1667 19 37.1667"
                                            stroke="#031220" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M11.8 2.9668H13.6C10.09 13.4788 10.09 24.8548 13.6 35.3668H11.8"
                                            stroke="#031220" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M24.4 2.9668C26.146 8.2228 27.028 13.6948 27.028 19.1668" stroke="#031220"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M2.80005 26.3667V24.5667C8.05605 26.3127 13.528 27.1947 19 27.1947"
                                            stroke="#031220" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2.80005 13.7665C13.312 10.2565 24.688 10.2565 35.2001 13.7665"
                                            stroke="#031220" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path class="search"
                                            d="M30.16 36.0867C33.3412 36.0867 35.92 33.5078 35.92 30.3267C35.92 27.1455 33.3412 24.5667 30.16 24.5667C26.9789 24.5667 24.4 27.1455 24.4 30.3267C24.4 33.5078 26.9789 36.0867 30.16 36.0867Z"
                                            stroke="#3D6CE7" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path class="search" d="M37.0001 37.1667L35.2001 35.3667" stroke="#3D6CE7"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="counter__content">
                                    <h4><span class="counter">{{ $daysDifference }}</span>+</h4>
                                    <p>Tahun Pengalaman di Dunia Bisnis</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="counter__item d-flex align-items-start counter__item-border">
                                <div class="counter__icon mr-15">
                                    <svg width="50" height="38" viewBox="0 0 50 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.6984 27.5676V25.3757H16.1609V27.5676H14.6984Z" fill="#031220"
                                            stroke="#F5F6F8" stroke-width="0.1" />
                                        <path d="M18.9289 27.5676V25.3757H20.3914V27.5676H18.9289Z" fill="#031220"
                                            stroke="#F5F6F8" stroke-width="0.1" />
                                        <path
                                            d="M17.5234 25.9512C14.1936 25.9512 11.7765 23.4538 11.7765 20.0065V19.0436H13.239V20.0065C13.239 21.2677 13.6787 22.3416 14.436 23.1004C15.1932 23.8591 16.2649 24.2997 17.5234 24.2997C18.7821 24.2997 19.8538 23.8591 20.611 23.1004C21.3682 22.3416 21.8078 21.2677 21.8078 20.0065V14.6279H23.2703V20.006C23.2707 23.4538 20.8532 25.9512 17.5234 25.9512Z"
                                            fill="#031220" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path
                                            d="M15.2448 8.89414L25.4444 8.89327V12.1213C25.4444 14.2014 23.9423 15.8832 22.1085 15.8832H13.9511C13.5654 15.8832 13.262 16.2371 13.262 16.6588V23.2591L9.42375 18.0384V13.3221C9.42375 11.6064 10.6626 10.221 12.1734 10.221H12.6784H12.7032L12.7182 10.2013C13.3495 9.37396 14.2661 8.89414 15.2448 8.89414ZM10.8859 17.4764H10.911L11.7096 18.5626L11.7999 18.6854V18.533V16.6588C11.7999 15.3145 12.7704 14.2316 13.9515 14.2316H22.1085C23.1468 14.2316 23.9816 13.2789 23.9816 12.1213V10.5948V10.5448H23.9316L15.2445 10.5448L15.2444 10.5448C14.6109 10.5457 14.0256 10.9051 13.6774 11.5015C13.6774 11.5015 13.6774 11.5015 13.6774 11.5015L13.4607 11.8725H12.173C11.4577 11.8725 10.8859 12.5288 10.8859 13.3221V17.4264V17.4764Z"
                                            fill="#031220" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path d="M42.9272 32.716V21.0804H44.3897V32.716H42.9272Z" fill="#031220"
                                            stroke="#F5F6F8" stroke-width="0.1" />
                                        <path
                                            d="M7.07152 32.7159H5.60862V6.08232C5.60862 4.82863 6.51389 3.81892 7.61448 3.81892H26.0965V5.4705H7.61487C7.3095 5.4705 7.07152 5.75095 7.07152 6.08232V32.7159Z"
                                            fill="#031220" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path
                                            d="M10.2844 32.0648H8.82229V30.104C8.82229 28.2623 10.2812 26.7664 12.0711 26.7664H23.1184C24.9083 26.7664 26.3668 28.2627 26.3668 30.104V31.5266H24.9043V30.104C24.9043 29.1711 24.1002 28.418 23.1184 28.418H12.0707C11.0885 28.418 10.2844 29.1715 10.2844 30.104V32.0648Z"
                                            fill="#031220" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path
                                            d="M0.34435 35.8766L0.344278 35.8765L0.05 35.6292V31.807H49.95V35.6292L49.6558 35.8773C49.5603 35.9573 49.0814 36.3514 48.4465 36.7253C47.81 37.1002 47.0245 37.4499 46.3141 37.4499H3.68516C2.9745 37.4499 2.18909 37.1002 1.55278 36.7252C0.918101 36.3512 0.439536 35.9568 0.34435 35.8766ZM1.5125 34.7592V34.7844L1.5328 34.7994C1.84194 35.0277 2.22749 35.2768 2.61064 35.469C2.99207 35.6603 3.3778 35.7988 3.68516 35.7988H46.3145C46.6216 35.7988 47.0073 35.6603 47.3888 35.469C47.772 35.2768 48.1578 35.0277 48.4676 34.7994L48.4879 34.7844V34.7592V33.509V33.459H48.4379H1.5625H1.5125V33.509V34.7592Z"
                                            fill="#031220" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path class="video"
                                            d="M31.8141 23.2115V19.0489V18.9989H31.7641H30.2215C29.1088 18.9989 28.1863 17.876 28.1863 16.4732V2.57745C28.1863 1.17324 29.1089 0.05 30.2215 0.05H45.3773C46.4916 0.05 47.4164 1.17335 47.4164 2.57745V16.4732C47.4164 17.8759 46.492 18.9989 45.3773 18.9989H36.2426H36.2225L36.208 19.0127L31.8141 23.2115ZM30.1715 1.70158V1.70539C30.0271 1.72498 29.9017 1.82807 29.8117 1.97022C29.7108 2.12959 29.6488 2.34555 29.6488 2.57789V16.4732C29.6488 16.7051 29.7108 16.9206 29.8117 17.0797C29.912 17.2377 30.0562 17.3473 30.2215 17.3473H33.2766V19.5336V19.6506L33.3611 19.5698L35.6865 17.3473H45.3769C45.543 17.3473 45.6882 17.2379 45.7893 17.0798C45.891 16.9208 45.9535 16.7052 45.9535 16.4732V2.57745C45.9535 2.34526 45.8911 2.12925 45.7895 1.96982C45.6885 1.81136 45.5433 1.70158 45.3769 1.70158H30.2215H30.1715Z"
                                            fill="#3D6CE7" stroke="#F5F6F8" stroke-width="0.1" />
                                        <path class="video"
                                            d="M36.2705 6.36712L36.1933 6.3168V6.40902V11.6887V11.7809L36.2705 11.7306L40.3256 9.09143L40.39 9.04954L40.3256 9.00763L36.2705 6.36712ZM43.318 9.04952L34.7308 14.6386V3.45831L43.318 9.04952Z"
                                            fill="#3D6CE7" stroke="#F5F6F8" stroke-width="0.1" />
                                    </svg>
                                </div>
                                <div class="counter__content">
                                    <h4><span class="counter">{{ $countCourse }}</span>+</h4>
                                    <p>Kursus Online Lokal yang Inovatif</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="counter__item d-flex align-items-start counter__item-border">
                                <div class="counter__icon mr-15">
                                    <svg width="44" height="41" viewBox="0 0 44 41" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.3422 18.3518C23.5378 18.3322 23.7725 18.3322 23.9877 18.3518C28.6435 18.1953 32.3408 14.3806 32.3408 9.68568C32.3408 4.89291 28.4675 1 23.6551 1C18.8624 1 14.9695 4.89291 14.9695 9.68568C14.989 14.3806 18.6863 18.1953 23.3422 18.3518Z"
                                            stroke="#031220" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M10.8983 4.91248C7.10324 4.91248 4.05152 7.98376 4.05152 11.7593C4.05152 15.4566 6.98587 18.4692 10.644 18.6061C10.8005 18.5866 10.9766 18.5866 11.1526 18.6061"
                                            stroke="#031220" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M33.1235 25.5703C37.8576 28.7394 37.8576 33.9039 33.1235 37.0534C27.7438 40.6529 18.9212 40.6529 13.5416 37.0534C8.80748 33.8843 8.80748 28.7198 13.5416 25.5703C18.9016 21.9904 27.7243 21.9904 33.1235 25.5703Z"
                                            stroke="#031220" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.12298 36.2123C5.71449 35.9188 4.38426 35.3515 3.28876 34.5103C0.237038 32.2215 0.237038 28.446 3.28876 26.1572C4.36469 25.3356 5.67537 24.7879 7.06429 24.4749"
                                            stroke="#031220" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path class="star"
                                            d="M35.8077 22.6875L37.3377 25.7729C37.5464 26.2024 38.1027 26.6143 38.5722 26.6932L41.3454 27.1578C43.1188 27.4558 43.5361 28.7531 42.2582 30.0328L40.1022 32.2066C39.7371 32.5747 39.5372 33.2847 39.6502 33.7931L40.2674 36.484C40.7542 38.614 39.6328 39.4379 37.7637 38.3247L35.1644 36.7733C34.6949 36.4928 33.9212 36.4928 33.4431 36.7733L30.8437 38.3247C28.9834 39.4379 27.8532 38.6052 28.34 36.484L28.9573 33.7931C29.0703 33.2847 28.8703 32.5747 28.5052 32.2066L26.3492 30.0328C25.08 28.7531 25.4886 27.4558 27.2621 27.1578L30.0353 26.6932C30.496 26.6143 31.0524 26.2024 31.261 25.7729L32.7911 22.6875C33.6256 21.0133 34.9818 21.0133 35.8077 22.6875Z"
                                            fill="#F5F6F8" stroke="#3D6CE7" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="counter__content">
                                    <h4><span class="counter">{{ $countMentor }}</span>+</h4>
                                    <p>Mentor yang Profesional</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="counter__item d-flex align-items-start">
                                <div class="counter__icon mr-15">
                                    <svg x="0px" y="0px" viewBox="0 0 67.4 70.6" xml:space="preserve">
                                        <path class="st0"
                                            d="M59.7,25.4c0,0.1,0.4,2.8,6.4,12.2c0.6,0.8,0.8,1.8,0.6,2.8c-0.1,0.5-0.4,1-0.7,1.4c-0.3,0.4-0.8,0.8-1.2,1
                             c-1.7,0.9-3.4,1.8-5.2,2.5c0.4,3.7,0.4,7.4,0,11.1c-0.7,3.7-7.1,4.3-10.8,4.3c-0.3,0-0.7,0-1,0.1c-0.3,0.1-0.6,0.3-0.8,0.5
                             c-0.2,0.2-0.4,0.5-0.5,0.8c-0.1,0.3-0.2,0.6-0.1,1v5c0,0.1,0,0.3-0.1,0.4c0,0.1-0.1,0.2-0.2,0.4c-0.1,0.1-0.2,0.2-0.3,0.2
                             c-0.1,0.1-0.3,0.1-0.4,0.1s-0.3,0-0.4-0.1c-0.1-0.1-0.2-0.1-0.3-0.2c-0.1-0.1-0.2-0.2-0.2-0.4c0-0.1-0.1-0.3-0.1-0.4v-5
                             c0-0.6,0.1-1.2,0.3-1.8c0.2-0.6,0.6-1.1,1-1.5c0.4-0.4,1-0.7,1.5-0.9c0.6-0.2,1.2-0.3,1.8-0.2c4.9,0,8.4-1,8.7-2.6
                             c0.7-3.6-0.1-10.8-0.1-11.3c0,0,0,0,0,0c0-0.2,0-0.5,0.1-0.7c0.1-0.2,0.3-0.3,0.5-0.4c1.9-0.8,3.8-1.7,5.6-2.7
                             c0.2-0.1,0.4-0.3,0.6-0.4c0.2-0.2,0.3-0.4,0.4-0.6c0.1-0.4,0-0.9-0.3-1.2c-6.4-10.1-6.8-12.9-6.8-13.2C55.1,4.4,38,2.7,32.8,2.7
                             c-0.5,0-0.9,0-1.2,0l0,0c-0.2,0-0.4,0-0.5,0c-3.2,0-15.6,0.7-21.9,10.1h11c0.8,0,1.6,0.2,2.3,0.6c0.7,0.4,1.3,0.9,1.8,1.5
                             c0.5-0.6,1.1-1.2,1.8-1.5c0.7-0.4,1.5-0.6,2.3-0.6h18c0.3,0,0.5,0.1,0.7,0.3c0.2,0.2,0.3,0.5,0.3,0.7V52c0,0.1,0,0.3-0.1,0.4
                             c-0.1,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.2,0.2-0.3,0.2c-0.1,0.1-0.3,0.1-0.4,0.1h-18c-0.8,0-1.6,0.3-2.2,0.9s-0.9,1.4-0.9,2.2
                             c0,0.3-0.1,0.5-0.3,0.7c-0.2,0.2-0.5,0.3-0.7,0.3c-0.3,0-0.5-0.1-0.7-0.3c-0.2-0.2-0.3-0.4-0.3-0.7c0-0.8-0.3-1.6-0.9-2.2
                             c-0.6-0.6-1.4-0.9-2.2-0.9h-4.5c0,0,0,0,0,0.1c0,0,0.1,0.1,0.1,0.1c2.2,4.8,2.3,14.5,2.3,14.9c0,0.3-0.1,0.5-0.3,0.7
                             c-0.2,0.2-0.5,0.3-0.7,0.3h0c-0.3,0-0.5-0.1-0.7-0.3c-0.2-0.2-0.3-0.5-0.3-0.7l0,0c0-0.2-0.1-9.7-2.1-14c-0.2-0.4-0.4-0.7-0.6-1.1
                             H2.2c-0.3,0-0.5-0.1-0.7-0.3c-0.2-0.2-0.3-0.5-0.3-0.7V13.9c0-0.3,0.1-0.5,0.3-0.7c0.2-0.2,0.5-0.3,0.7-0.3h4.5
                             C13.5,1.2,28.8,0.7,31,0.7l0.5,0c0.3,0,0.8,0,1.3,0C38.4,0.7,57,2.5,59.7,25.4z M26.2,15.8c-0.6,0.6-0.9,1.4-0.9,2.2v34
                             c0.9-0.7,2-1,3.1-1h17V14.9h-17C27.6,14.9,26.8,15.2,26.2,15.8z M22.4,15.8c-0.6-0.6-1.4-0.9-2.2-0.9h-17V51h17c1.1,0,2.2,0.4,3.1,1
                             V18C23.3,17.2,22.9,16.4,22.4,15.8z M7.7,22.2h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7c0-0.3-0.1-0.5-0.3-0.7
                             c-0.2-0.2-0.5-0.3-0.7-0.3H7.7c-0.3,0-0.5,0.1-0.7,0.3s-0.3,0.5-0.3,0.7c0,0.3,0.1,0.5,0.3,0.7C7.2,22.1,7.4,22.2,7.7,22.2z
                              M7.7,30.1h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7C19.3,28.1,19,28,18.8,28H7.7
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C7.1,30,7.4,30.1,7.7,30.1z M18.8,37.9H7.7c-0.1,0-0.3,0-0.4-0.1
                             c-0.1-0.1-0.2-0.1-0.3-0.2c-0.1-0.1-0.2-0.2-0.2-0.3c-0.1-0.1-0.1-0.3-0.1-0.4c0-0.1,0-0.3,0.1-0.4c0.1-0.1,0.1-0.2,0.2-0.3
                             c0.1-0.1,0.2-0.2,0.3-0.2c0.1-0.1,0.3-0.1,0.4-0.1h11.1c0.1,0,0.3,0,0.4,0.1c0.1,0.1,0.2,0.1,0.3,0.2c0.1,0.1,0.2,0.2,0.2,0.3
                             c0.1,0.1,0.1,0.3,0.1,0.4c0,0.1,0,0.3-0.1,0.4c-0.1,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.2,0.2-0.3,0.2C19,37.9,18.9,37.9,18.8,37.9z
                              M7.7,45.8h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3H7.7
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C7.1,45.7,7.4,45.8,7.7,45.8z M40.9,22.2H29.8
                             c-0.3,0-0.5-0.1-0.7-0.3c-0.2-0.2-0.3-0.5-0.3-0.7c0-0.3,0.1-0.5,0.3-0.7c0.2-0.2,0.5-0.3,0.7-0.3h11.1c0.3,0,0.5,0.1,0.7,0.3
                             s0.3,0.5,0.3,0.7c0,0.3-0.1,0.5-0.3,0.7C41.5,22.1,41.2,22.2,40.9,22.2z M29.8,30.1h11.1c0.3,0,0.5-0.1,0.7-0.3
                             c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3H29.8c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7
                             s0.1,0.5,0.3,0.7C29.3,30,29.6,30.1,29.8,30.1z M40.9,37.9H29.8c-0.1,0-0.3,0-0.4-0.1c-0.1-0.1-0.2-0.1-0.3-0.2
                             c-0.1-0.1-0.2-0.2-0.2-0.3c-0.1-0.1-0.1-0.3-0.1-0.4c0-0.1,0-0.3,0.1-0.4c0.1-0.1,0.1-0.2,0.2-0.3c0.1-0.1,0.2-0.2,0.3-0.2
                             c0.1-0.1,0.3-0.1,0.4-0.1h11.1c0.1,0,0.3,0,0.4,0.1c0.1,0.1,0.2,0.1,0.3,0.2c0.1,0.1,0.2,0.2,0.2,0.3c0.1,0.1,0.1,0.3,0.1,0.4
                             c0,0.1,0,0.3-0.1,0.4c-0.1,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.2,0.2-0.3,0.2C41.2,37.9,41,37.9,40.9,37.9z M29.8,45.8h5.5
                             c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3h-5.5c-0.3,0-0.5,0.1-0.7,0.3
                             c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C29.3,45.7,29.6,45.8,29.8,45.8z" />
                                        <path class="st1"
                                            d="M7.7,22.2h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7c0-0.3-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3
                             H7.7c-0.3,0-0.5,0.1-0.7,0.3s-0.3,0.5-0.3,0.7c0,0.3,0.1,0.5,0.3,0.7C7.2,22.1,7.4,22.2,7.7,22.2z" />
                                        <path class="st1"
                                            d="M7.7,30.1h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7C19.3,28.1,19,28,18.8,28H7.7
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C7.1,30,7.4,30.1,7.7,30.1z" />
                                        <path class="st1"
                                            d="M7.7,37.9h11.1c0.1,0,0.3,0,0.4-0.1c0.1-0.1,0.2-0.1,0.3-0.2c0.1-0.1,0.2-0.2,0.2-0.3c0.1-0.1,0.1-0.3,0.1-0.4
                             c0-0.1,0-0.3-0.1-0.4c-0.1-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.1-0.1-0.3-0.1-0.4-0.1H7.7c-0.1,0-0.3,0-0.4,0.1
                             C7.2,36,7.1,36.1,7,36.2c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.1-0.1,0.3-0.1,0.4c0,0.1,0,0.3,0.1,0.4c0.1,0.1,0.1,0.2,0.2,0.3
                             c0.1,0.1,0.2,0.2,0.3,0.2C7.4,37.9,7.6,37.9,7.7,37.9L7.7,37.9z" />
                                        <path class="st1"
                                            d="M7.7,45.8h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3H7.7
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C7.1,45.7,7.4,45.8,7.7,45.8L7.7,45.8z" />
                                        <path class="st1"
                                            d="M29.8,22.2h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7c0-0.3-0.1-0.5-0.3-0.7s-0.5-0.3-0.7-0.3H29.8
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7c0,0.3,0.1,0.5,0.3,0.7C29.3,22.1,29.6,22.2,29.8,22.2L29.8,22.2z" />
                                        <path class="st1"
                                            d="M29.8,30.1h11.1c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3
                             H29.8c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C29.3,30,29.6,30.1,29.8,30.1z" />
                                        <path class="st1"
                                            d="M29.8,37.9h11.1c0.1,0,0.3,0,0.4-0.1c0.1-0.1,0.2-0.1,0.3-0.2c0.1-0.1,0.2-0.2,0.2-0.3c0.1-0.1,0.1-0.3,0.1-0.4
                             c0-0.1,0-0.3-0.1-0.4c-0.1-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.1-0.1-0.3-0.1-0.4-0.1H29.8c-0.1,0-0.3,0-0.4,0.1
                             c-0.1,0.1-0.2,0.1-0.3,0.2c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.1-0.1,0.3-0.1,0.4c0,0.1,0,0.3,0.1,0.4c0.1,0.1,0.1,0.2,0.2,0.3
                             c0.1,0.1,0.2,0.2,0.3,0.2C29.6,37.9,29.7,37.9,29.8,37.9L29.8,37.9z" />
                                        <path class="st1"
                                            d="M29.8,45.8h5.5c0.3,0,0.5-0.1,0.7-0.3c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7c-0.2-0.2-0.5-0.3-0.7-0.3h-5.5
                             c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.5-0.3,0.7s0.1,0.5,0.3,0.7C29.3,45.7,29.6,45.8,29.8,45.8L29.8,45.8z" />
                                    </svg>
                                </div>
                                <div class="counter__content">
                                    <h4><span class="counter">{{ $countStudent }}</span>+</h4>
                                    <p>Pelajar Aktif Terdaftar di UMKMPlus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- counter area end --}}

        {{-- research area start --}}
        <section class="research__area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="research__wrapper-2">
                            <div class="section__title-wrapper-2">
                                <span class="section__title-pre-2">#TemukanPotensimu</span>
                                <h3 class="section__title-2">Lebih dari Sekedar Belajar</h3>
                            </div>
                            <p>Belajar dan praktik langsung dengan mentor yang berpengalaman di bidangnya. Dapatkan
                                pengalaman belajar yang menyenangkan dan bermanfaat.</p>
                            <div class="research__btn-2 mb-70">
                                <a href="{{ route('course.index') }}" class="tp-btn tp-btn-4 rounded-3">Mulai
                                    Sekarang</a>
                            </div>

                            <div class="research__download">
                                <div class="research__download-bg include-bg"
                                    data-background="{{ asset('assets/img/decoration/research-bg.jpg') }}"></div>
                                <div class="research__content-2 p-relative z-index-1">
                                    <h3 class="research__title-2">
                                        Coming Soon at Mobile App Store
                                    </h3>
                                    <div class="research__store">
                                        <ul>
                                            <li>
                                                <a href="https://play.google.com/store/games" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <img src="{{ asset('assets/img/brand/google-play-store.png') }}"
                                                        alt="google-play-store"> Google play
                                                </a>
                                            </li>
                                            <li class="me-0">
                                                <a href="https://www.apple.com/app-store/" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <img src="{{ asset('assets/img/brand/apple-store.png') }}"
                                                        alt="apple-store">Apple store
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="research__thumb-2">
                                    <img src="{{ asset('assets/img/decoration/umkmplus-mobile-mockup.png') }}"
                                        alt="UMKMPlus Mobile Mockup" style="height: 358px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5 offset-xxl-1 col-xl-5 offset-xl-1 col-lg-6">
                        <div class="research__features-wrapper pt-35">
                            <div class="research__features-item d-sm-flex align-items-start mb-40">
                                <div class="research__features-icon mr-25">
                                    <span>
                                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M26 13.9961V15.1656C26 19.8436 24.8875 21 20.45 21H6.55C2.1125 21 1 19.8305 1 15.1656V6.83443C1 2.16951 2.1125 1 6.55 1H8.5"
                                                stroke="#6151FB" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M13.5 21.5V25.5" stroke="#6151FB" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 14.75H26" stroke="#6151FB" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.875 26H19.125" stroke="#6151FB" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M20.825 10.2127H14.875C13.15 10.2127 12.575 9.0627 12.575 7.9127V3.5127C12.575 2.1377 13.7 1.0127 15.075 1.0127H20.825C22.1 1.0127 23.125 2.0377 23.125 3.31269V7.9127C23.125 9.1877 22.1 10.2127 20.825 10.2127Z"
                                                stroke="#6151FB" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M24.6375 8.39985L23.125 7.33735V3.88735L24.6375 2.82485C25.3875 2.31235 26 2.62485 26 3.53735V7.69985C26 8.61235 25.3875 8.92485 24.6375 8.39985Z"
                                                stroke="#6151FB" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="research__features-content">
                                    <h4>Pembelajaran Online<br> Pelatihan dan Pakar</h4>
                                    <p>Belajar dari mana saja di dunia di ponsel desktop dengan koneksi internet.
                                    </p>
                                </div>
                            </div>
                            <div class="research__features-item d-sm-flex align-items-start mb-40">
                                <div class="research__features-icon mr-25">
                                    <span class="yellow-bg">
                                        <svg width="28" height="27" viewBox="0 0 28 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4 19.746H6.47299C2.092 19.746 1 18.654 1 14.273V6.47299C1 2.092 2.092 1 6.47299 1H20.162C24.543 1 25.635 2.092 25.635 6.47299"
                                                stroke="#F4930E" stroke-width="1.7" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M11.3999 25.6218V19.7458" stroke="#F4930E" stroke-width="1.7"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 14.5459H11.4" stroke="#F4930E" stroke-width="1.7"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.16211 25.6218H11.4001" stroke="#F4930E" stroke-width="1.7"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M26.9999 14.3509V21.7739C26.9999 24.8549 26.2329 25.6219 23.152 25.6219H18.537C15.456 25.6219 14.689 24.8549 14.689 21.7739V14.3509C14.689 11.2699 15.456 10.5029 18.537 10.5029H23.152C26.2329 10.5029 26.9999 11.2699 26.9999 14.3509Z"
                                                stroke="#F4930E" stroke-width="1.7" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M20.8179 21.4359H20.8296" stroke="#F4930E" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="research__features-content">
                                    <h4>Lebih dari {{ $countCourse }}+ <br> Video Course (all coures)</h4>
                                    <p>
                                        Video pembelajaran yang menarik dan mudah dipahami di berbagai kalangan.
                                    </p>
                                </div>
                            </div>
                            <div class="research__features-item d-sm-flex align-items-start">
                                <div class="research__features-icon mr-25">
                                    <span class="green-bg">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.6185 23.8234H7.24516C3.5585 23.8234 2.3335 21.3734 2.3335 18.9118V9.08842C2.3335 5.40176 3.5585 4.17676 7.24516 4.17676H14.6185C18.3052 4.17676 19.5302 5.40176 19.5302 9.08842V18.9118C19.5302 22.5984 18.2935 23.8234 14.6185 23.8234Z"
                                                stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M22.7736 19.9502L19.5303 17.6752V10.3135L22.7736 8.03849C24.3603 6.93015 25.6669 7.60682 25.6669 9.55515V18.4452C25.6669 20.3935 24.3603 21.0702 22.7736 19.9502Z"
                                                stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M13.4165 12.8345C14.383 12.8345 15.1665 12.051 15.1665 11.0845C15.1665 10.118 14.383 9.33447 13.4165 9.33447C12.45 9.33447 11.6665 10.118 11.6665 11.0845C11.6665 12.051 12.45 12.8345 13.4165 12.8345Z"
                                                stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="research__features-content">
                                    <h4>Pembelajaran <br>yang Up to date ({{ $currentYear }})</h4>
                                    <p>
                                        Materi pembelajaran yang up to date dan sesuai dengan kebutuhan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- research area end --}}

        {{-- category area start --}}
        <section class="category__area pt-70 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4">
                        <div class="category__wrapper">
                            <div class="section__title-wrapper-2">
                                <span class="section__title-pre-2">#KategoriPelatihan</span>
                                <h3 class="section__title-2 section__title-2-30">Jelajahi Kategori Populer Kami</h3>
                            </div>
                            <p>Kami memiliki berbagai kategori pelatihan yang dapat Anda pilih sesuai dengan kebutuhan
                                Anda.</p>
                            <div class="category__btn">
                                <a href="{{ route('category') }}" class="tp-btn tp-btn-3 rounded-3">Lihat Semua
                                    Kategori</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="category__item-wrapper">
                            <div class="row">
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon">
                                            <a href="/course/category/desain">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M28.733 3.71736C26.5787 9.08912 21.1789 16.3914 16.6605 20.0145L13.9047 22.2247C13.555 22.4765 13.2052 22.7004 12.8135 22.8542C12.8135 22.6024 12.7996 22.3227 12.7576 22.0569C12.6037 20.8818 12.0721 19.7907 11.1349 18.8534C10.1836 17.9022 9.02254 17.3426 7.83348 17.1887C7.5537 17.1747 7.27392 17.1468 6.99414 17.1747C7.14802 16.7411 7.38583 16.3354 7.6796 15.9997L9.86188 13.2438C13.471 8.7254 20.8012 3.29769 26.159 1.15738C26.9844 0.849623 27.7817 1.07345 28.2853 1.59104C28.8169 2.10863 29.0687 2.906 28.733 3.71736Z"
                                                        stroke="#4270FF" stroke-width="1.56" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12.8136 22.8543C12.8136 24.393 12.226 25.8619 11.1209 26.981C10.2676 27.8343 9.10649 28.4219 7.72158 28.6037L4.2803 28.9814C2.40578 29.1913 0.797051 27.5965 1.02087 25.694L1.39858 22.2527C1.73431 19.1891 4.29429 17.2307 7.00815 17.1747C7.28793 17.1608 7.58169 17.1747 7.84748 17.1887C9.03655 17.3426 10.1976 17.8882 11.1489 18.8534C12.0861 19.7907 12.6177 20.8818 12.7716 22.0569C12.7856 22.3227 12.8136 22.5885 12.8136 22.8543Z"
                                                        stroke="#4270FF" stroke-width="1.56" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M18.1433 18.4477C18.1433 14.7966 15.1776 11.8309 11.5265 11.8309"
                                                        stroke="#4270FF" stroke-width="1.56" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M26.3688 16.0137L27.404 17.0349C29.4884 19.1192 29.4884 21.1756 27.404 23.26L23.2633 27.4007C21.2069 29.4571 19.1225 29.4571 17.0662 27.4007"
                                                        stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" />
                                                    <path
                                                        d="M2.57353 12.9081C0.517156 10.8237 0.517156 8.76737 2.57353 6.68301L6.71426 2.54228C8.77064 0.485906 10.855 0.485906 12.9114 2.54228L13.9466 3.57747"
                                                        stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" />
                                                    <path d="M13.9606 3.59143L8.78467 8.76734" stroke="#4270FF"
                                                        stroke-width="1.56" stroke-linecap="round" />
                                                    <path d="M26.3688 16.0137L22.228 20.1404" stroke="#4270FF"
                                                        stroke-width="1.56" stroke-linecap="round" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/desain">Art & Design</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon pink-bg">
                                            <a href="/course/category/sdm">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.32007 25.2251V22.1201" stroke="#FF6470"
                                                        stroke-width="1.6" stroke-linecap="round" />
                                                    <path d="M16 25.225V19.015" stroke="#FF6470" stroke-width="1.6"
                                                        stroke-linecap="round" />
                                                    <path d="M23.6799 25.225V15.895" stroke="#FF6470" stroke-width="1.6"
                                                        stroke-linecap="round" />
                                                    <path
                                                        d="M23.6801 6.77502L22.9901 7.58502C19.1651 12.055 14.0351 15.22 8.32007 16.645"
                                                        stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" />
                                                    <path d="M19.2849 6.77502H23.6799V11.155" stroke="#FF6470"
                                                        stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.5 31H20.5C28 31 31 28 31 20.5V11.5C31 4 28 1 20.5 1H11.5C4 1 1 4 1 11.5V20.5C1 28 4 31 11.5 31Z"
                                                        stroke="#FF6470" stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/sdm">SDM</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon green-bg">
                                            <a href="/course/category/branding">
                                                <svg width="34" height="32" viewBox="0 0 34 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M31.4 6.76923H25.5333V5.03846C25.5321 3.96781 25.1384 2.94138 24.4385 2.18431C23.7386 1.42724 22.7898 1.00134 21.8 1H12.2C11.2102 1.00134 10.2614 1.42724 9.5615 2.18431C8.86163 2.94138 8.4679 3.96781 8.46667 5.03846V6.76923H2.6C2.17565 6.76923 1.76869 6.95158 1.46863 7.27616C1.16857 7.60074 1 8.04097 1 8.5L1 20.0385C1.00134 20.3952 1.10454 20.7427 1.29548 21.0336C1.48641 21.3244 1.75576 21.5443 2.06667 21.6632V29.2692C2.06667 29.7283 2.23524 30.1685 2.5353 30.4931C2.83535 30.8177 3.24232 31 3.66667 31H30.3333C30.7577 31 31.1646 30.8177 31.4647 30.4931C31.7648 30.1685 31.9333 29.7283 31.9333 29.2692V21.6632C32.2442 21.5443 32.5136 21.3244 32.7045 21.0336C32.8955 20.7427 32.9987 20.3952 33 20.0385V8.5C33 8.04097 32.8314 7.60074 32.5314 7.27616C32.2313 6.95158 31.8243 6.76923 31.4 6.76923ZM9.53333 5.03846C9.53422 4.27371 9.81545 3.54055 10.3154 2.99978C10.8153 2.45902 11.493 2.1548 12.2 2.15385H21.8C22.507 2.1548 23.1847 2.45902 23.6846 2.99978C24.1846 3.54055 24.4658 4.27371 24.4667 5.03846V6.76923H23.3787L23.4 5.03846C23.3989 4.57978 23.23 4.14022 22.9302 3.81588C22.6304 3.49155 22.224 3.30883 21.8 3.30769H12.18C11.756 3.30883 11.3496 3.49155 11.0498 3.81588C10.75 4.14022 10.5811 4.57978 10.58 5.03846V5.04423L10.5947 6.76923H9.53333V5.03846ZM22.3333 5.03053L22.312 6.76923H11.6613L11.6447 5.03846C11.6447 4.88545 11.7009 4.73871 11.8009 4.63052C11.9009 4.52232 12.0366 4.46154 12.178 4.46154H21.8C21.9402 4.46152 22.0747 4.52122 22.1746 4.6277C22.2744 4.73419 22.3314 4.8789 22.3333 5.03053ZM30.8667 29.2692C30.8667 29.4222 30.8105 29.569 30.7105 29.6772C30.6104 29.7854 30.4748 29.8462 30.3333 29.8462H3.66667C3.52522 29.8462 3.38956 29.7854 3.28954 29.6772C3.18952 29.569 3.13333 29.4222 3.13333 29.2692V21.7692H6.86667V23.5C6.86667 23.653 6.92286 23.7998 7.02288 23.9079C7.1229 24.0161 7.25855 24.0769 7.4 24.0769H9.53333C9.67478 24.0769 9.81044 24.0161 9.91046 23.9079C10.0105 23.7998 10.0667 23.653 10.0667 23.5V21.7692H23.9333V23.5C23.9333 23.653 23.9895 23.7998 24.0895 23.9079C24.1896 24.0161 24.3252 24.0769 24.4667 24.0769H26.6C26.7415 24.0769 26.8771 24.0161 26.9771 23.9079C27.0771 23.7998 27.1333 23.653 27.1333 23.5V21.7692H30.8667V29.2692ZM7.93333 22.9231V20.0385C7.93332 19.9615 7.94786 19.8853 7.97606 19.8146C8.00427 19.7439 8.04554 19.6802 8.09733 19.6274C8.14532 19.5742 8.20279 19.532 8.26628 19.5035C8.32976 19.475 8.39793 19.4607 8.46667 19.4615C8.60812 19.4615 8.74377 19.5223 8.84379 19.6305C8.94381 19.7387 9 19.8855 9 20.0385V22.9231H7.93333ZM25 22.9231V20.0385C25 19.8855 25.0562 19.7387 25.1562 19.6305C25.2562 19.5223 25.3919 19.4615 25.5333 19.4615C25.6045 19.4612 25.6749 19.4767 25.7403 19.5071C25.8057 19.5375 25.8646 19.5821 25.9133 19.6382C25.9624 19.6904 26.0013 19.7527 26.0277 19.8215C26.054 19.8902 26.0673 19.964 26.0667 20.0385V22.9231H25ZM31.9333 20.0385C31.9333 20.1915 31.8771 20.3382 31.7771 20.4464C31.6771 20.5546 31.5415 20.6154 31.4 20.6154H27.1333V20.0385C27.1333 19.5794 26.9648 19.1392 26.6647 18.8146C26.3646 18.49 25.9577 18.3077 25.5333 18.3077C25.109 18.3077 24.702 18.49 24.402 18.8146C24.1019 19.1392 23.9333 19.5794 23.9333 20.0385V20.6154H10.0667V20.0385C10.0667 19.5794 9.8981 19.1392 9.59804 18.8146C9.29798 18.49 8.89101 18.3077 8.46667 18.3077C8.04232 18.3077 7.63535 18.49 7.3353 18.8146C7.03524 19.1392 6.86667 19.5794 6.86667 20.0385V20.6154H2.6C2.45855 20.6154 2.3229 20.5546 2.22288 20.4464C2.12286 20.3382 2.06667 20.1915 2.06667 20.0385V8.5C2.06667 8.34699 2.12286 8.20025 2.22288 8.09205C2.3229 7.98386 2.45855 7.92308 2.6 7.92308H31.4C31.5415 7.92308 31.6771 7.98386 31.7771 8.09205C31.8771 8.20025 31.9333 8.34699 31.9333 8.5V20.0385Z"
                                                        fill="#59C578" stroke="#59C578" stroke-width="0.4" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/branding">Branding</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon orange-bg position-relative">
                                            <a href="javascript:void(0)">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21.3334 10.6666H10.6667V21.3333H21.3334V10.6666Z"
                                                        stroke="#F37F43" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M6.66675 29.3334C8.86675 29.3334 10.6667 27.5334 10.6667 25.3334V21.3334H6.66675C4.46675 21.3334 2.66675 23.1334 2.66675 25.3334C2.66675 27.5334 4.46675 29.3334 6.66675 29.3334Z"
                                                        stroke="#F37F43" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M6.66675 10.6666H10.6667V6.66663C10.6667 4.46663 8.86675 2.66663 6.66675 2.66663C4.46675 2.66663 2.66675 4.46663 2.66675 6.66663C2.66675 8.86663 4.46675 10.6666 6.66675 10.6666Z"
                                                        stroke="#F37F43" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M21.3333 10.6666H25.3333C27.5333 10.6666 29.3333 8.86663 29.3333 6.66663C29.3333 4.46663 27.5333 2.66663 25.3333 2.66663C23.1333 2.66663 21.3333 4.46663 21.3333 6.66663V10.6666Z"
                                                        stroke="#F37F43" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M25.3333 29.3334C27.5333 29.3334 29.3333 27.5334 29.3333 25.3334C29.3333 23.1334 27.5333 21.3334 25.3333 21.3334H21.3333V25.3334C21.3333 27.5334 23.1333 29.3334 25.3333 29.3334Z"
                                                        stroke="#F37F43" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            {{-- new --}}
                                            <div class="new-category-container">
                                                <div class="new-category-caption">
                                                    <div class="new-category-title">soon</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="javascript:void(0)">Business</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon">
                                            <a href="/course/category/finance">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.25 18.625C12.25 20.08 13.375 21.25 14.755 21.25H17.575C18.775 21.25 19.75 20.23 19.75 18.955C19.75 17.59 19.15 17.095 18.265 16.78L13.75 15.205C12.865 14.89 12.265 14.41 12.265 13.03C12.265 11.77 13.24 10.735 14.44 10.735H17.26C18.64 10.735 19.765 11.905 19.765 13.36"
                                                        stroke="#2675FF" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M16 9.25V22.75" stroke="#2675FF" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M31 16C31 24.28 24.28 31 16 31C7.72 31 1 24.28 1 16C1 7.72 7.72 1 16 1"
                                                        stroke="#2675FF" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M31 7V1H25" stroke="#2675FF" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M23.5 8.5L31 1" stroke="#2675FF" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/finance">Finance</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon purple-bg position-relative">
                                            <a href="javascript:void(0)">
                                                <svg width="27" height="29" viewBox="0 0 27 29" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M25.0833 14.175V8.14001C25.0833 2.43085 23.7517 1 18.3967 1H7.68667C2.33167 1 1 2.43085 1 8.14001V24.0916C1 27.86 3.06835 28.7525 5.57585 26.0608L5.58999 26.0467C6.75165 24.8142 8.52248 24.9133 9.52832 26.2591L10.9592 28.1717"
                                                        stroke="#E33CFF" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M7.375 8.08331H18.7083" stroke="#E33CFF" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M8.79175 13.75H17.2917" stroke="#E33CFF" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M21.8405 19.0912L16.8255 24.1063C16.6272 24.3046 16.443 24.6729 16.4005 24.9421L16.1313 26.8546C16.0322 27.5488 16.5139 28.0304 17.208 27.9313L19.1205 27.6621C19.3897 27.6196 19.7722 27.4354 19.9564 27.2371L24.9714 22.2221C25.8355 21.3579 26.2464 20.3521 24.9714 19.0771C23.7105 17.8163 22.7047 18.2271 21.8405 19.0912Z"
                                                        stroke="#E33CFF" stroke-width="1.5" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M21.1155 19.8137C21.5405 21.3437 22.7305 22.5337 24.2605 22.9587"
                                                        stroke="#E33CFF" stroke-width="1.5" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            {{-- new --}}
                                            <div class="new-category-container">
                                                <div class="new-category-caption">
                                                    <div class="new-category-title">soon</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="javascript:void(0)">Content Writing</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon green-bg-2 position-relative">
                                            <a href="javascript:void(0)">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.25 18.75V10" stroke="#20AD96" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M6.5625 27.5C8.80616 27.5 10.625 25.6812 10.625 23.4375C10.625 21.1938 8.80616 19.375 6.5625 19.375C4.31884 19.375 2.5 21.1938 2.5 23.4375C2.5 25.6812 4.31884 27.5 6.5625 27.5Z"
                                                        stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M6.25 10C8.32107 10 10 8.32107 10 6.25C10 4.17893 8.32107 2.5 6.25 2.5C4.17893 2.5 2.5 4.17893 2.5 6.25C2.5 8.32107 4.17893 10 6.25 10Z"
                                                        stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M23.75 10C25.8211 10 27.5 8.32107 27.5 6.25C27.5 4.17893 25.8211 2.5 23.75 2.5C21.6789 2.5 20 4.17893 20 6.25C20 8.32107 21.6789 10 23.75 10Z"
                                                        stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M6.41248 18.75C6.97498 16.5625 8.97497 14.9375 11.3375 14.95L15.625 14.9625C18.9 14.975 21.6875 12.875 22.7125 9.94995"
                                                        stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            {{-- new --}}
                                            <div class="new-category-container">
                                                <div class="new-category-caption">
                                                    <div class="new-category-title">soon</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="javascript:void(0)">Data Science</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon yellow-bg">
                                            <a href="/course/category/tech-and-ecommerce">
                                                <svg width="34" height="30" viewBox="0 0 34 30" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.6258 21.5381C13.5005 21.5379 13.3793 21.4933 13.2839 21.412L9.86503 18.5011C9.80677 18.4515 9.75999 18.3898 9.7279 18.3204C9.69582 18.2509 9.6792 18.1753 9.6792 18.0988C9.6792 18.0223 9.69582 17.9467 9.7279 17.8773C9.75999 17.8078 9.80677 17.7462 9.86503 17.6966L13.2839 14.7856C13.391 14.6986 13.528 14.6569 13.6655 14.6695C13.8029 14.6822 13.93 14.7481 14.0195 14.8533C14.1089 14.9584 14.1537 15.0944 14.1441 15.2321C14.1346 15.3698 14.0715 15.4983 13.9684 15.5902L11.025 18.0988L13.9684 20.6075C14.0507 20.6776 14.1096 20.7712 14.137 20.8758C14.1644 20.9804 14.1591 21.0909 14.1217 21.1923C14.0844 21.2938 14.0168 21.3813 13.9281 21.4431C13.8394 21.505 13.7339 21.5381 13.6258 21.5381Z"
                                                        fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                                                    <path
                                                        d="M20.3744 21.5381C20.2663 21.5381 20.1608 21.505 20.0721 21.4431C19.9834 21.3813 19.9158 21.2938 19.8785 21.1923C19.8411 21.0909 19.8358 20.9804 19.8632 20.8758C19.8906 20.7712 19.9495 20.6776 20.0318 20.6075L22.9752 18.0988L20.0318 15.5902C19.9287 15.4983 19.8656 15.3698 19.8561 15.2321C19.8465 15.0944 19.8913 14.9584 19.9807 14.8533C20.0702 14.7481 20.1973 14.6822 20.3347 14.6695C20.4722 14.6569 20.6092 14.6986 20.7163 14.7856L24.1352 17.6966C24.1934 17.7462 24.2402 17.8078 24.2723 17.8773C24.3044 17.9467 24.321 18.0223 24.321 18.0988C24.321 18.1753 24.3044 18.2509 24.2723 18.3204C24.2402 18.3898 24.1934 18.4515 24.1352 18.5011L20.7163 21.412C20.6209 21.4933 20.4997 21.5379 20.3744 21.5381Z"
                                                        fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                                                    <path
                                                        d="M15.7925 23.7215C15.7557 23.7214 15.719 23.7176 15.683 23.7102C15.5461 23.6812 15.4262 23.599 15.3498 23.4817C15.2734 23.3644 15.2467 23.2215 15.2755 23.0845L17.4061 12.9713C17.435 12.8342 17.5172 12.7142 17.6346 12.6377C17.752 12.5612 17.895 12.5345 18.0321 12.5634C18.1692 12.5923 18.2892 12.6745 18.3657 12.7919C18.4422 12.9093 18.4689 13.0523 18.44 13.1894L16.3087 23.3026C16.2836 23.421 16.2187 23.5272 16.1247 23.6034C16.0308 23.6797 15.9135 23.7214 15.7925 23.7215Z"
                                                        fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                                                    <path
                                                        d="M29.4528 29.2332H4.54717C3.60677 29.232 2.70523 28.8579 2.04027 28.1929C1.3753 27.528 1.0012 26.6264 1 25.686V4.54717C1.0012 3.60677 1.3753 2.70523 2.04027 2.04027C2.70523 1.3753 3.60677 1.0012 4.54717 1H29.4528C30.3932 1.0012 31.2948 1.3753 31.9597 2.04027C32.6247 2.70523 32.9988 3.60677 33 4.54717V25.686C32.9988 26.6264 32.6247 27.528 31.9597 28.1929C31.2948 28.8579 30.3932 29.232 29.4528 29.2332ZM4.54717 2.0566C3.88663 2.0566 3.25315 2.319 2.78607 2.78607C2.319 3.25315 2.0566 3.88663 2.0566 4.54717V25.686C2.0566 26.3466 2.319 26.9801 2.78607 27.4471C3.25315 27.9142 3.88663 28.1766 4.54717 28.1766H29.4528C30.1134 28.1766 30.7469 27.9142 31.2139 27.4471C31.681 26.9801 31.9434 26.3466 31.9434 25.686V4.54717C31.9434 3.88663 31.681 3.25315 31.2139 2.78607C30.7469 2.319 30.1134 2.0566 29.4528 2.0566H4.54717Z"
                                                        fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                                                    <path
                                                        d="M32.4717 9.45962H1.5283C1.38819 9.45962 1.25381 9.40396 1.15474 9.30488C1.05566 9.20581 1 9.07143 1 8.93132C1 8.7912 1.05566 8.65683 1.15474 8.55775C1.25381 8.45868 1.38819 8.40302 1.5283 8.40302H32.4717C32.6118 8.40302 32.7462 8.45868 32.8453 8.55775C32.9443 8.65683 33 8.7912 33 8.93132C33 9.07143 32.9443 9.20581 32.8453 9.30488C32.7462 9.40396 32.6118 9.45962 32.4717 9.45962Z"
                                                        fill="#FEA425" stroke="#F5B455" stroke-width="0.5" />
                                                    <path
                                                        d="M10.0264 6.93135C9.6958 6.93135 9.3726 6.83331 9.09769 6.64962C8.82278 6.46593 8.60851 6.20484 8.48199 5.89938C8.35546 5.59392 8.32236 5.2578 8.38686 4.93352C8.45136 4.60924 8.61058 4.31137 8.84437 4.07758C9.07816 3.84379 9.37603 3.68458 9.7003 3.62007C10.0246 3.55557 10.3607 3.58868 10.6662 3.7152C10.9716 3.84173 11.2327 4.056 11.4164 4.3309C11.6001 4.60581 11.6981 4.92902 11.6981 5.25965C11.6975 5.70283 11.5212 6.12768 11.2078 6.44106C10.8945 6.75443 10.4696 6.93075 10.0264 6.93135ZM10.0264 4.64456C9.90478 4.64456 9.78586 4.68063 9.68471 4.74822C9.58356 4.81581 9.50472 4.91187 9.45816 5.02426C9.41161 5.13666 9.39943 5.26033 9.42316 5.37965C9.44689 5.49897 9.50548 5.60857 9.5915 5.69459C9.67752 5.78061 9.78712 5.83919 9.90644 5.86293C10.0258 5.88666 10.1494 5.87448 10.2618 5.82792C10.3742 5.78137 10.4703 5.70253 10.5379 5.60138C10.6055 5.50023 10.6415 5.3813 10.6415 5.25965C10.6413 5.09658 10.5765 4.94024 10.4612 4.82493C10.3458 4.70962 10.1895 4.64476 10.0264 4.64456Z"
                                                        fill="#FFAD2D" />
                                                    <path
                                                        d="M4.88976 6.91546C4.55892 6.91561 4.23546 6.81763 3.96031 6.63392C3.68516 6.4502 3.47068 6.18901 3.34401 5.88338C3.21733 5.57775 3.18414 5.24141 3.24865 4.91692C3.31316 4.59242 3.47246 4.29435 3.7064 4.06041C3.94035 3.82647 4.23842 3.66716 4.56291 3.60266C4.88741 3.53815 5.22374 3.57133 5.52937 3.69801C5.83501 3.82469 6.0962 4.03917 6.27991 4.31432C6.46363 4.58946 6.56161 4.91292 6.56146 5.24377C6.56106 5.687 6.38481 6.11197 6.07139 6.42539C5.75797 6.73881 5.333 6.91506 4.88976 6.91546ZM4.88976 4.62792C4.76793 4.62777 4.64878 4.66376 4.54741 4.73134C4.44603 4.79892 4.36698 4.89505 4.32025 5.00757C4.27352 5.12008 4.26122 5.24393 4.2849 5.36345C4.30858 5.48296 4.36717 5.59276 4.45327 5.67897C4.53937 5.76517 4.6491 5.8239 4.76858 5.84772C4.88807 5.87155 5.01193 5.8594 5.12451 5.81281C5.23708 5.76622 5.33331 5.68728 5.40101 5.58599C5.46872 5.4847 5.50486 5.3656 5.50486 5.24377C5.50466 5.08062 5.43981 4.92421 5.32452 4.80878C5.20924 4.69335 5.0529 4.62831 4.88976 4.62792Z"
                                                        fill="#FFAD2D" />
                                                    <path
                                                        d="M15.1631 6.94716C14.8325 6.94701 14.5094 6.84884 14.2346 6.66506C13.9598 6.48128 13.7456 6.22014 13.6192 5.91467C13.4928 5.60919 13.4598 5.27309 13.5244 4.94886C13.589 4.62464 13.7483 4.32684 13.9821 4.09312C14.2159 3.85941 14.5138 3.70027 14.838 3.63583C15.1623 3.57138 15.4984 3.60453 15.8038 3.73108C16.1092 3.85763 16.3702 4.0719 16.5539 4.34679C16.7376 4.62168 16.8356 4.94486 16.8356 5.27546C16.8354 5.71889 16.6591 6.14409 16.3455 6.45757C16.0318 6.77106 15.6066 6.94716 15.1631 6.94716ZM15.1631 4.66036C15.0415 4.66051 14.9227 4.69671 14.8216 4.76439C14.7206 4.83207 14.6418 4.92819 14.5954 5.04059C14.549 5.153 14.5369 5.27665 14.5607 5.39592C14.5845 5.51519 14.6432 5.62471 14.7292 5.71066C14.8153 5.79661 14.9249 5.85512 15.0442 5.87879C15.1635 5.90246 15.2871 5.89024 15.3994 5.84366C15.5118 5.79708 15.6078 5.71824 15.6754 5.61711C15.7429 5.51597 15.779 5.39708 15.779 5.27546C15.7788 5.11226 15.7138 4.95581 15.5983 4.84048C15.4829 4.72514 15.3263 4.66036 15.1631 4.66036Z"
                                                        fill="#FFAD2D" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/tech-and-ecommerce">Tech & E-Comm</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                    <div class="category__item text-center mb-45">
                                        <div class="category__icon violet-bg">
                                            <a href="/course/category/marketing">
                                                <svg width="34" height="30" id="_x31_"
                                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m18.5 20c-.061 0-.121-.011-.18-.033l-13-5c-.193-.074-.32-.26-.32-.467v-6c0-.207.127-.393.32-.467l13-5c.155-.06.326-.038.463.055.136.093.217.247.217.412v16c0 .165-.081.319-.217.412-.085.058-.183.088-.283.088zm-12.5-5.844 12 4.616v-14.544l-12 4.616z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m5.5 15h-3.5c-1.103 0-2-.897-2-2v-3c0-1.103.897-2 2-2h3.5c.276 0 .5.224.5.5v6c0 .276-.224.5-.5.5zm-3.5-6c-.552 0-1 .448-1 1v3c0 .552.448 1 1 1h3v-5z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m7.5 22h-3c-.249 0-.46-.183-.495-.43l-1-7c-.039-.273.151-.526.425-.565.268-.034.526.151.565.425l.939 6.57h2.006l-.668-5.954c-.03-.274.167-.521.441-.553.265-.029.521.167.553.441l.73 6.51c.016.142-.029.283-.124.389-.094.106-.229.167-.372.167z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m20.5 9c-.161 0-.319-.078-.416-.223-.153-.229-.091-.54.139-.693l3-2c.228-.152.539-.092.693.139.153.229.091.54-.139.693l-3 2c-.085.057-.181.084-.277.084z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m23.5 18c-.096 0-.192-.027-.277-.084l-3-2c-.229-.153-.292-.464-.139-.693.154-.23.466-.291.693-.139l3 2c.229.153.292.464.139.693-.097.145-.255.223-.416.223z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="m23.5 12.5h-3c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h3c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">
                                                <a href="/course/category/marketing">Marketing</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                @if (!Auth::check())
                                    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                        <div class="category__item text-center mb-45">
                                            <div class="category__icon add">
                                                <a href="{{ route('mentor.register') }}">+</a>
                                            </div>
                                            <div class="category__content">
                                                <h4 class="category__title add">
                                                    <a href="{{ route('mentor.register') }}">Add</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- category area end --}}
    </main>
@endsection

@section('script')
    <script></script>
@endsection
