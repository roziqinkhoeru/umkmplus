@extends('user.layout.app')
@section('content')
    <main>
        {{-- header area start --}}
        <section class="pt-60 pb-50" style="background: #3083FF;">
            <div class="container">
                <div class="d-sm-flex align-items-sm-center">
                    <div class="mb-sm-22 me-sm-4">
                        <figure class="image-header-category-wrapper">
                            <img src="{{ asset('assets/img/decoration/faq.png') }}" alt="faq">
                        </figure>
                    </div>
                    <div class="">
                        <h3 class="text-white text-4xl">Frequently Asked Questions</h3>
                        <p class="fw-medium text-base mb-0" style="color: #ffffffc5">#JanganRaguTanyaKami</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- header area end --}}

        {{-- terms area start --}}
        <section class="cart-area pt-80 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section__title-wrapper text-center mb-45">
                            <h2 class="section__title section__title-44 mb-3">
                                Popular Questions
                            </h2>
                            <p class="max-w-80-md mx-auto">
                                Our authors are incredible storytellers driven by their passion for technology. They blend
                                their knowledge and enthusiasm to communicate concepts and demonstrate
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="faq__item-wrapper pr-40" style="margin-top: 0 !important">
                            <div class="faq__accordion">
                                <div class="accordion" id="faqaccordionLeft">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                What is UMKMPlus?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="faqOne" data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>UMKMPlus is an online learning website dedicated to small and medium
                                                    enterprises (UMKM) in Indonesia. It offers a platform where UMKM
                                                    entrepreneurs can access classes conducted by professional mentors in
                                                    various fields to enhance their business skills and knowledge.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                                aria-controls="collapseTwo">
                                                How do I access the classes on UMKMPlus?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo"
                                            data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>To access the classes on UMKMPlus, you need to register for an account on
                                                    our website. Once you have an account, you can log in and browse through
                                                    our selection of classes. You can enroll in the courses that interest
                                                    you and start learning at your own pace.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="true" aria-controls="collapseThree">
                                                Are the classes on UMKMPlus free?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="faqThree" data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>UMKMPlus offers both free and premium classes. While some courses may be
                                                    available at no cost, others might require a one-time payment or a
                                                    subscription fee. The pricing details are mentioned on the respective
                                                    course pages.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="true" aria-controls="collapseFour">
                                                How can I pay for premium courses?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour"
                                            data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>For premium courses, UMKMPlus accepts various payment methods, including
                                                    credit cards, debit cards, and other online payment options. All payment
                                                    transactions are processed through secure third-party payment processors
                                                    to ensure the safety of your financial information.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqFive">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="true" aria-controls="collapseFive">
                                                Are the classes live or pre-recorded?
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="faqFive"
                                            data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>The majority of the classes on UMKMPlus are pre-recorded, allowing you to
                                                    access them at your convenience. This setup allows you to learn at your
                                                    own pace and revisit the course content as needed. However, we may
                                                    occasionally offer live webinars or interactive sessions with mentors,
                                                    which will be communicated in advance.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqSix">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                aria-expanded="true" aria-controls="collapseSix">
                                                Can I interact with the mentors?
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse"
                                            aria-labelledby="faqSix" data-bs-parent="#faqaccordionLeft">
                                            <div class="accordion-body">
                                                <p>Yes, UMKMPlus encourages interaction between learners and mentors. While
                                                    most classes are pre-recorded, you can often ask questions or seek
                                                    clarification through discussion forums or designated channels.
                                                    Additionally, we may organize live Q&A sessions with mentors to
                                                    facilitate direct interaction.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="faq__item-wrapper pl-40" style="margin-top: 0 !important">
                            <div class="faq__accordion">
                                <div class="accordion" id="faqaccordionRight">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqSeven">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                aria-expanded="true" aria-controls="collapseSeven">
                                                Is my personal information safe on UMKMPlus?
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse"
                                            aria-labelledby="faqSeven" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>Protecting your privacy is of utmost importance to us. We have
                                                    implemented security measures to safeguard your personal information and
                                                    adhere to strict data protection practices. For more details, please
                                                    refer to our Privacy Policy.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqEight">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                aria-expanded="true" aria-controls="collapseEight">
                                                Can I access UMKMPlus from any device?
                                            </button>
                                        </h2>
                                        <div id="collapseEight" class="accordion-collapse collapse"
                                            aria-labelledby="faqEight" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>Yes, UMKMPlus is designed to be accessible from various devices,
                                                    including desktop computers, laptops, tablets, and smartphones. As long
                                                    as you have an internet connection, you can access our website and
                                                    classes on any compatible device.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqNine">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                                aria-expanded="true" aria-controls="collapseNine">
                                                Can I get a certificate for completing a course?
                                            </button>
                                        </h2>
                                        <div id="collapseNine" class="accordion-collapse collapse"
                                            aria-labelledby="faqNine" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>Yes, upon successful completion of a course, you will receive a
                                                    certificate of completion. This certificate can be downloaded from your
                                                    account and can serve as evidence of your participation and
                                                    achievements.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqTen">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                                aria-expanded="true" aria-controls="collapseTen">
                                                How can I get support or assistance if I encounter issues?
                                            </button>
                                        </h2>
                                        <div id="collapseTen" class="accordion-collapse collapse"
                                            aria-labelledby="faqTen" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>If you experience any technical difficulties or have questions related to
                                                    UMKMPlus, you can reach out to our support team by sending an email to
                                                    <a href="mailto:info@umkmplus.site" class="text-tp-theme-1"
                                                        style="text-decoration: underline;text-underline-offset: 2px">info@umkmplus.site</a>.
                                                    We will
                                                    promptly address your concerns and provide
                                                    assistance as needed.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqEleven">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseEleven"
                                                aria-expanded="true" aria-controls="collapseEleven">
                                                Can I suggest a topic for a new course?
                                            </button>
                                        </h2>
                                        <div id="collapseEleven" class="accordion-collapse collapse"
                                            aria-labelledby="faqEleven" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>Absolutely! We value your input and welcome suggestions for new course
                                                    topics. If you have a specific area of interest or a topic you'd like to
                                                    see covered on UMKMPlus, please feel free to contact us with your
                                                    suggestions at <a href="mailto:info@umkmplus.site"
                                                        class="text-tp-theme-1"
                                                        style="text-decoration: underline;text-underline-offset: 2px">info@umkmplus.site</a>.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqTwelfth">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwelfth"
                                                aria-expanded="true" aria-controls="collapseTwelfth">
                                                Is UMKMPlus available in languages other than Indonesian?
                                            </button>
                                        </h2>
                                        <div id="collapseTwelfth" class="accordion-collapse collapse"
                                            aria-labelledby="faqTwelfth" data-bs-parent="#faqaccordionRight">
                                            <div class="accordion-body">
                                                <p>As of now, UMKMPlus primarily operates in Indonesian. However, we may
                                                    consider expanding our language options in the future based on user
                                                    demand and other factors.</p>
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
        {{-- terms area end --}}

        <!-- app area start -->
        <section class="app__area app__bg">
            <div class="container">
                <div class="app__inner p-relative fix" style="background: #2e66b9 !important">
                    <div class="app__shape">
                        <img class="app__shape-1" src="{{ asset('assets/img/decoration/app-shape-1.png') }}"
                            alt="decoration shape 1">
                        <img class="app__shape-2" src="{{ asset('assets/img/decoration/app-shape-2.png') }}"
                            alt="decoration shape 2">
                    </div>
                    <div class="row align-items-center">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="app__wrapper p-relative z-index-1">
                                <h3 class="app__title"> Start learning By Downloading Apps</h3>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div
                                class="app__download p-relative z-index-1 d-sm-flex align-items-center justify-content-lg-end">
                                <div class="app__item mr-15">
                                    <a href="#">
                                        <span><img src="{{ asset('assets/img/decoration/google-play.png') }}"
                                                alt="google play logo"></span>
                                        Google play
                                    </a>
                                </div>
                                <div class="app__item">
                                    <a href="#" class="active">
                                        <span class="apple"><img src="{{ asset('assets/img/decoration/apple.png') }}"
                                                alt="apple logo"></span>
                                        Apple Store
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- app area end -->
    </main>
@endsection
@section('script')
    <script></script>
@endsection
