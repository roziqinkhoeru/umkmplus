<!-- footer area start -->
<footer>
    <div class="footer__area">
        <div class="footer__top grey-bg-4 pt-95 pb-45">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-7 col-sm-7">
                        <div class="footer__widget footer-col-1 mb-50">
                            <div class="footer__logo">
                                <div class="logo">
                                    <a href="/">
                                        <img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}"
                                            alt="umkm-letter-logo">
                                    </a>
                                </div>
                            </div>
                            <div class="footer__widget-content">
                                <div class="footer__widget-info">
                                    <p class="mb-4">Merupakan platform virtual ecosystem yang dibangun untuk membantu
                                        UMKM
                                        meningkatkan pengetahuan dan pengembangan bisnis.</p>
                                    <div class="footer__social">
                                        <h4>Follow Us</h4>
                                        <ul>
                                            {{-- facebook --}}
                                            <li>
                                                <a href="https://www.facebook.com" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            {{-- twitter --}}
                                            <li>
                                                <a href="https://www.twitter.com" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            {{-- instagram --}}
                                            <li>
                                                <a href="https://www.instagram.com" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                            {{-- linkedin --}}
                                            <li>
                                                <a href="https://www.linkedin.com" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-5 col-sm-5">
                        <div class="footer__widget mb-50">
                            <h3 class="footer__widget-title fw-bold">Company</h3>
                            <div class="footer__widget-content">
                                <ul>
                                    <li class="hover-right">
                                        <a href="/about">About</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/course/category">Course</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/mentor">Mentor</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/blog">Blog</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-5 col-sm-5">
                        <div class="footer__widget mb-50">
                            <h3 class="footer__widget-title fw-bold">Support</h3>
                            <div class="footer__widget-content">
                                <ul>
                                    <li class="hover-right">
                                        <a href="/contact">Contact</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/faq">FAQ's</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/tutorial">Tutorial</a>
                                    </li>
                                    <li class="hover-right">
                                        <a href="/terms">Syarat dan Ketentuan</a>
                                    </li>
                                    @if (!Auth::check())
                                        <li class="hover-right">
                                            <a href="/mentor/register">Become Our Mentor</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-7 col-sm-7">
                        <div class="footer__widget footer-col-4 mb-50">
                            <h3 class="footer__widget-title fw-bold">Subscribe for our newsletter</h3>

                            <div class="footer__subscribe">
                                <p>Terima buletin mingguan dengan materi pendidikan, buku-buku populer, dan banyak lagi!
                                </p>
                                <form action="#">
                                    <div class="footer__subscribe-input">
                                        <input type="email" placeholder="youremail@email.com" class="rounded-pill"
                                            required>
                                        <button type="submit" class="tp-btn-subscribe rounded-pill">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom grey-bg-4">
            <div class="footer__bottom-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="footer__copyright text-left">
                                <p><span class="fw-bold">&copy;Copyright</span> UMKM-Plus 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
