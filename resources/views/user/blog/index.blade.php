@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section id="headerBlog" class="pt-60 pb-60 position-relative" style="background: #3083FF;">
            <div class="container">
                <div class="px-header-detail-course">
                    <p class="text-md-center mb-10 text-base" style="color: #6CFFC5;font-weight: 500">#BelajarLangsungDariAhli
                    </p>
                    <h3 class="text-md-center text-white mb-10 text-4xl">Blog Terkini</h3>
                    <p class="mb-0 text-md-center text-base" style="color: #ffffffc5">Belajar langsung dari para Professional
                        dan
                        Practitioners Business
                        Expert dengan
                        pengalaman
                        selama puluhan tahun di dunia bisnis.</p>
                </div>
            </div>
        </section>
        {{-- header area end --}}
    </main>

    {{-- blog area start --}}
    <section class="pt-50 pb-70 bg-white">
        <div class="container">
            {{-- search --}}
            <div class="row mb-40">
                <div class="col-md-7 col-lg-5">
                    <div class="course__sidebar-search">
                        <form action="#">"
                            <input type="text" placeholder="Cari blog..." name="searchCourse" id="searchCourse"
                                style="height: 52px;line-height: 50px">
                            <button type="submit" style="top: 37px;right: 27px;">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 584.4 584.4" style="enable-background:new 0 0 584.4 584.4;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path class="st0"
                                                d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                                            <path class="st1"
                                                d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="blogItemWrapper" class="d-grid grid-cols-12 gap-7">
                <div class="col-span-4">
                    <article class="postbox__item format-image transition-3 rounded-4 overflow-hidden">
                        <div class="postbox__thumb w-img">
                            <a href="/blog/blogName">
                                <img src="{{ asset('assets/img/dummy/blog1.png') }}" alt="blog-blogName">
                            </a>
                        </div>
                        <div class="postbox__content" style="padding: 30px">
                            <div class="postbox__meta">
                                <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                                <span><i class="far fa-user"></i> Shahnewaz</span>
                            </div>
                            <h3 class="postbox__title" style="margin-bottom: 12px !important">
                                <a href="/blog/blogName" class="text-xl">Personalized Storage in Schools</a>
                            </h3>
                            <div class="postbox__text">
                                <p class="line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat.</p>
                            </div>
                            <div class="postbox__read-more">
                                <a href="/blog/blogName" class="tp-btn tp-btn-2 rounded-3">read more</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-span-4">
                    <article class="postbox__item format-image transition-3 rounded-4 overflow-hidden">
                        <div class="postbox__thumb w-img">
                            <a href="/blog/blogName">
                                <img src="{{ asset('assets/img/dummy/blog1.png') }}" alt="blog-blogName">
                            </a>
                        </div>
                        <div class="postbox__content" style="padding: 30px">
                            <div class="postbox__meta">
                                <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                                <span><i class="far fa-user"></i> Shahnewaz</span>
                            </div>
                            <h3 class="postbox__title" style="margin-bottom: 12px !important">
                                <a href="/blog/blogName" class="text-xl">Personalized Storage in Schools</a>
                            </h3>
                            <div class="postbox__text">
                                <p class="line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat.</p>
                            </div>
                            <div class="postbox__read-more">
                                <a href="/blog/blogName" class="tp-btn tp-btn-2 rounded-3">read more</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-span-4">
                    <article class="postbox__item format-image transition-3 rounded-4 overflow-hidden">
                        <div class="postbox__thumb w-img">
                            <a href="/blog/blogName">
                                <img src="{{ asset('assets/img/dummy/blog1.png') }}" alt="blog-blogName">
                            </a>
                        </div>
                        <div class="postbox__content" style="padding: 30px">
                            <div class="postbox__meta">
                                <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                                <span><i class="far fa-user"></i> Shahnewaz</span>
                            </div>
                            <h3 class="postbox__title" style="margin-bottom: 12px !important">
                                <a href="/blog/blogName" class="text-xl">Personalized Storage in Schools</a>
                            </h3>
                            <div class="postbox__text">
                                <p class="line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat.</p>
                            </div>
                            <div class="postbox__read-more">
                                <a href="/blog/blogName" class="tp-btn tp-btn-2 rounded-3">read more</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-span-4">
                    <article class="postbox__item format-image transition-3 rounded-4 overflow-hidden">
                        <div class="postbox__thumb w-img">
                            <a href="/blog/blogName">
                                <img src="{{ asset('assets/img/dummy/blog1.png') }}" alt="blog-blogName">
                            </a>
                        </div>
                        <div class="postbox__content" style="padding: 30px">
                            <div class="postbox__meta">
                                <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                                <span><i class="far fa-user"></i> Shahnewaz</span>
                            </div>
                            <h3 class="postbox__title" style="margin-bottom: 12px !important">
                                <a href="/blog/blogName" class="text-xl">Personalized Storage in Schools</a>
                            </h3>
                            <div class="postbox__text">
                                <p class="line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat.</p>
                            </div>
                            <div class="postbox__read-more">
                                <a href="/blog/blogName" class="tp-btn tp-btn-2 rounded-3">read more</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    {{-- blog area end --}}
@endsection

@section('script')
@endsection
