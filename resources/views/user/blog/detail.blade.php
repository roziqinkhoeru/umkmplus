@extends('user.layout.app')

@section('content')
    {{-- blog area start --}}
    <main>
        <section class="pt-40 pb-50 bg-white">
            <div class="container">
                <div class="mb-50">
                    <a href="{{ route('blog.index') }}" class="tp-btn tp-btn-4 rounded-3 px-3 py-2 h-auto"
                        style="line-height: 1.5 !important"><i class="fas fa-chevron-left me-2"></i>Back</a>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid rounded-circle object-cover-center"
                                src="{{ asset('storage/'.$blog->user->customer->profile_picture) }}" alt="blog-author"
                                style="width: 50px;height: 50px;" />
                            <div class="ms-3">
                                <div class="fw-bold">{{ $blog->user->customer->name }}</div>
                                <div class="text-muted">{{ $blog->user->customer->job }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-10">{{ $blog->title }}</h1>
                                <!-- Post meta content-->
                                <div class="postbox__meta">
                                    <span><i class="far fa-calendar-check me-2"></i>
                                        {{ date('M d, Y', strtotime($blog->updated_at)) }} </span>
                                    <span><i class="far fa-user me-2"></i> {{ $blog->user->customer->name }}</span>
                                </div>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded-4" src="{{ asset("storage/".$blog->thumbnail) }}"
                                    alt="{{ $blog->slug }}-blog-thumbnail" /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                {!! $blog->content !!}
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
