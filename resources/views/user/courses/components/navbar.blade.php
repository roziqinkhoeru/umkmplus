<!-- header area start -->
<header>
    <div class="header__area">
        <div class="header__bottom header__sticky shadow-none">
            <div class="container-fluid">
                <div class="row align-items-center py-lg-3">
                    {{-- logo --}}
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-6">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}"
                                    alt="umkm-letter-logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 d-none d-lg-block">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    @if (!Auth::check())
                                        <li class="d-block d-sm-none">
                                            <a href="{{ route('login') }}">Masuk</a>
                                        </li>
                                    @else
                                        @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                            <li class="d-block d-sm-none">
                                                <a href="{{ route('admin.dashboard') }}">Profile</a>
                                            </li>
                                        @else
                                            <li class="d-block d-sm-none">
                                                <a href="{{ route('profile') }}">Profile</a>
                                            </li>
                                        @endif
                                        <li class="d-block d-sm-none">
                                            <a href="/profile?content=course">Kelas Saya</a>
                                        </li>
                                        <li class="d-block d-sm-none">
                                            <a href="/logout" onclick="logout()" class="menu-logout">Keluar</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
                        <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">
                            <div class="header__search w-100 d-none d-xl-block">
                                <form action="{{ url('/course') }}" method="GET" id="formSearch">
                                    <div class="header__search-input">
                                        <input type="text" placeholder="Cari kelas..." class="rounded-pill"
                                            id="search" name="search"
                                            @if (request()->has('search')) value="{{ request()->search }}" @endif>
                                        <button class="header__search-btn r-5" onclick="getCourse()"><svg width="18"
                                                height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.11117 15.2222C12.0385 15.2222 15.2223 12.0385 15.2223 8.11111C15.2223 4.18375 12.0385 1 8.11117 1C4.18381 1 1.00006 4.18375 1.00006 8.11111C1.00006 12.0385 4.18381 15.2222 8.11117 15.2222Z"
                                                    stroke="#031220" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M17 17L13.1334 13.1333" stroke="#031220" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{-- condition::isloggedIn=false --}}
                            @if (!Auth::check())
                                <div class="ms-4 d-none d-sm-block"><a href="{{ route('login') }}"
                                        class="tp-btn tp-btn-login rounded-pill" role="button">Masuk</a>
                                </div>
                            @else
                                <div class="ms-4 d-none d-sm-block">
                                    <p class="space-nowrap mb-0 fw-medium">Halo, {{ Auth::user()->customer->name }}</p>
                                </div>
                                <div class="ms-4 d-none d-sm-block">
                                    <a href="{{ route('profile') }}" class="d-flex align-items-center nav-icon-user">
                                        <i class="fa-solid fa-circle-user" style="font-size: 20px"></i>
                                    </a>
                                </div>
                                <div class="ms-4 d-none d-sm-block">
                                    <a href="/logout" onclick="logout()"
                                        class="d-flex align-items-center nav-icon-user menu-logout">
                                        <i class="fa-sharp fa-solid fa-right-from-bracket" style="font-size: 20px"></i>
                                    </a>
                                </div>
                            @endif

                            <div class="header__hamburger ms-4 ms-sm-5 d-xl-none">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#offcanvasmodal"
                                    class="hamurger-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->

<!-- offcanvas area start -->
<div class="offcanvas__area">
    <div class="modal fade" id="offcanvasmodal" tabindex="-1" aria-labelledby="offcanvasmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="offcanvas__wrapper" style="min-height: 100vh">
                    <div class="offcanvas__content">
                        <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo logo">
                                <a href="{{ route('dashboard') }}">
                                    <img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}"
                                        alt="umkmplus-letter-logo">
                                </a>
                            </div>
                            <div class="offcanvas__close">
                                <button class="offcanvas__close-btn" data-bs-toggle="modal"
                                    data-bs-target="#offcanvasmodal">
                                    <i class="fal fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="offcanvas__search mb-25">
                            <form action="#">
                                <input type="text" placeholder="Cari kelas...">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="mobile-menu fix"></div>
                        <div class="offcanvas__text d-none d-lg-block">
                            <p>Kembangkan bisnis anda dengan belajar di umkmverse dengan bisnis expert untuk membangun
                                bisnis anda yang profitable dan sustainable.</p>
                        </div>
                        <div class="offcanvas__map d-none d-lg-block mb-15">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63465.833100642034!2d106.79517895105631!3d-6.182311407428954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f436b8c94b07%3A0x6ea6d5398b7c82f6!2sCentral%20Jakarta%2C%20Central%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1684906591824!5m2!1sen!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="offcanvas__contact mt-30 mb-20">
                            <h4>Informasi Kontak</h4>
                            <ul>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a target="_blank"
                                            href="https://goo.gl/maps/dP4iaRBjRpNYBe3J6?coh=178571&entry=tt"
                                            rel="noopener noreferrer">Jakarta Pusat, Jakarta</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="far fa-phone"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="
                                        https://api.whatsapp.com/send?phone=6288889797697&text=Halo%20Umkmverse%20Saya%20Mau%20Tanya%20Tentang%20Umkmverse%20"
                                            target="_blank" rel="noopener noreferrer">088889797697</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="mailto:umkmplussupport@gmail.com">umkmplussupport@mail.com</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="offcanvas__social">
                            <ul>
                                <li><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.twitter.com/" target="_blank" rel="noopener noreferrer"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer"><i
                                            class="fab fa-youtube"></i></a></li>
                                <li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><i
                                            class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas area end -->
<div class="body-overlay"></div>
<!-- offcanvas area end -->
