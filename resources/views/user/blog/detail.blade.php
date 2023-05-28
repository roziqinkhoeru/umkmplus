@extends('user.layout.app')

@section('content')
    {{-- blog area start --}}
    <main>
        <section class="pt-70 pb-50 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                alt="blog-authorName" />
                            <div class="ms-3">
                                <div class="fw-bold">Valerie Luna</div>
                                <div class="text-muted">News, Business</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-10">Welcome to Blog Post!</h1>
                                <!-- Post meta content-->
                                <div class="postbox__meta">
                                    <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                                    <span><i class="far fa-user"></i> Shahnewaz</span>
                                </div>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded"
                                    src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="blog-thumbnail" /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <p class="text-lg mb-15">Science is an enterprise that should be cherished as an activity of
                                    the
                                    free human mind. Because it transforms who we are, how we live, and it gives us an
                                    understanding of our place in the universe.</p>
                                <p class="text-lg mb-15">The universe is large and old, and the ingredients for life as we
                                    know
                                    it are everywhere, so there's no reason to think that Earth would be unique in that
                                    regard. Whether of not the life became intelligent is a different question, and we'll
                                    see if we find that.</p>
                                <p class="text-lg mb-15">If you get asteroids about a kilometer in size, those are large
                                    enough
                                    and carry enough energy into our system to disrupt transportation, communication, the
                                    food chains, and that can be a really bad day on Earth.</p>
                                <h3 class="fw-bolder mb-15 mt-30">I have odd cosmic thoughts every day</h3>
                                <p class="text-lg mb-15">For me, the most fascinating interface is Twitter. I have odd
                                    cosmic
                                    thoughts every day and I realized I could hold them to myself or share them with people
                                    who might be interested.</p>
                                <p class="text-lg mb-15">Venus has a runaway greenhouse effect. I kind of want to know what
                                    happened there because we're twirling knobs here on Earth without knowing the
                                    consequences of it. Mars once had running water. It's bone dry today. Something bad
                                    happened there as well.</p>
                            </section>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- blog area end --}}
@endsection

@section('script')
@endsection
