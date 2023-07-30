@extends('user.layout.app')
@section('content')
    <main>
        {{-- header area start --}}
        <section class="pt-60 pb-50" style="background: #3083FF;">
            <div class="container">
                <div class="d-sm-flex align-items-sm-center">
                    <div class="mb-sm-22 me-sm-4">
                        <figure class="image-header-category-wrapper">
                            <img src="{{ asset('assets/img/decoration/tutorial-academy.png') }}" alt="faq">
                        </figure>
                    </div>
                    <div class="">
                        <h3 class="text-white text-4xl">How to Get Started with UMKMPlus: A Step-by-Step Tutorial</h3>
                        <p class="fw-medium text-base mb-0" style="color: #ffffffc5">#KamiSiapMembantu</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- header area end --}}

        {{-- tutorial area start --}}
        <section class="tutorial-area pt-65 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto">
                        <div class="text-justify">
                            <p class="text-base fst-italic mb-25">January 01, 2023</p>
                            <p class="text-base mb-35">Welcome to UMKMPlus! This tutorial will guide you through the process
                                of getting started with our online learning platform for small and medium enterprises (UMKM)
                                in Indonesia. By the end of this tutorial, you'll be ready to explore our courses and access
                                valuable resources to boost your entrepreneurial journey.
                            </p>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 1: Create an Account</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Visit UMKMPlus Website:</h5>
                                    <p class="text-base mb-25">Go to <a href="https://umkmplus.site"
                                            class="btn-anchor">www.umkmplus.co.id</a> in your web browser to access our
                                        website.
                                    </p>
                                    <h5 class="text-lg mb-15">2. Click "Sign Up":</h5>
                                    <p class="text-base mb-25">On the homepage, locate and click the <a
                                            href="{{ route('register') }}" class="btn-anchor">Sign Up</a>. You
                                        can find this at the top-right corner of the page.
                                    </p>
                                    <h5 class="text-lg mb-15">3. Fill in the Registration Form:</h5>
                                    <p class="text-base mb-25">Enter your name, email address, create a secure password, and
                                        select your business type (e.g., Sole Proprietorship, Partnership, etc.). Click
                                        "Sign Up" to proceed.</p>
                                    <h5 class="text-lg mb-15">4. Verify Your Email:</h5>
                                    <p class="text-base mb-25">A verification email will be sent to the address you
                                        provided. Check your inbox and click the verification link to activate your account.
                                    </p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 2: Explore Course Catalog</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Log In to Your Account:</h5>
                                    <p class="text-base mb-25">Once your account is activated, return to the UMKMPlus
                                        homepage and click <a href="{{ route('login') }}" class="btn-anchor">Log In</a> at
                                        the top-right corner. Enter your email and password
                                        to access your account.</p>
                                    <h5 class="text-lg mb-15">2. Browse Courses:</h5>
                                    <p class="text-base mb-25">Click on <a href="{{ route('course.index') }}"
                                            class="btn-anchor">Courses</a> in the navigation menu to explore our extensive
                                        selection of courses. You can use filters to find courses that align with your
                                        interests and business needs.</p>
                                    <h5 class="text-lg mb-15">3. View Course Details:</h5>
                                    <p class="text-base mb-25">Click on any course to view its details, including the course
                                        description, curriculum, instructor information, and pricing details (if
                                        applicable).</p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 3: Enroll in a Course</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Choose a Course:</h5>
                                    <p class="text-base mb-25">Select a course that interests you and matches your business
                                        goals.</p>
                                    <h5 class="text-lg mb-15">2. Click "Enroll":</h5>
                                    <p class="text-base mb-25">On the course page, click the "Enroll" button. If it's a
                                        premium course, you will be prompted to complete the payment process.</p>
                                    <h5 class="text-lg mb-15">3. Complete the Payment (for Premium Courses):</h5>
                                    <p class="text-base mb-25">Follow the payment instructions to complete the enrollment
                                        for premium courses. UMKMPlus utilizes secure third-party payment processors to
                                        ensure the safety of your financial information.
                                    </p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 4: Start Learning</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Access Your Course:</h5>
                                    <p class="text-base mb-25">Once enrolled, go to <a href="/profile?content=course"
                                            class="btn-anchor">My
                                            Courses</a> in your account dashboard
                                        to find the course you've enrolled in.</p>
                                    <h5 class="text-lg mb-15">2. Begin the Course:</h5>
                                    <p class="text-base mb-25">Click on the course title to start your learning journey.
                                        Courses consist of video lessons, downloadable resources, quizzes, and assignments.
                                    </p>
                                    <h5 class="text-lg mb-15">3. Learn at Your Own Pace:</h5>
                                    <p class="text-base mb-25">Feel free to learn at your own pace. You can pause, rewind,
                                        and review the course content as many times as needed.</p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 5: Interact and Engage</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Join the Community:</h5>
                                    <p class="text-base mb-25">Connect with other UMKMPlus learners and mentors by joining
                                        our community discussions and forums.</p>
                                    <h5 class="text-lg mb-15">2. Ask Questions:</h5>
                                    <p class="text-base mb-25">If you have any doubts or need clarifications, use the
                                        discussion forum or designated communication channels to ask questions directly to
                                        the mentor or other learners.
                                    </p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">Step 6: Earn Your Certificate</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1. Complete the Course:</h5>
                                    <p class="text-base mb-25">Finish all the course modules, quizzes, and assignments to
                                        complete the course successfully.</p>
                                    <h5 class="text-lg mb-15">2. Download Your Certificate:</h5>
                                    <p class="text-base mb-25">Upon successful completion, download your certificate from
                                        the course page or your account dashboard.</p>
                                </div>
                            </div>
                            <p class="mb-15 text-base">Congratulations! You've successfully learned how to get started with
                                UMKMPlus. Now, it's time to unlock your potential and thrive as an entrepreneur with our
                                valuable courses and supportive community.</p>
                            <p class="mb-15 text-base">If you have any questions or need further assistance, don't hesitate
                                to contact our support team at <a href="mailto:info@umkmplus.co.id"
                                    class="btn-anchor">info@umkmplus.co.id</a>.</p>
                            <p class="mb-15 text-base">Happy Learning and Best Wishes for Your UMKM Journey!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- tutorial area end --}}
    </main>
@endsection
@section('script')
    <script></script>
@endsection
