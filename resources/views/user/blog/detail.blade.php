@extends('user.layout.app')

@section('content')
    {{-- blog area start --}}
    <main>
        <section class="pt-70 pb-50 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid rounded-circle" src="{{ asset($blog->user->customer->profile_picture) }}"
                                alt="blog-{{ $blog->user->customer->name }}" />
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
                                    <span><i class="far fa-calendar-check"></i> {{ date("M d, Y", strtotime($blog->updated_at)) }} </span>
                                    <span><i class="far fa-user"></i> {{ $blog->user->customer->name }}</span>
                                </div>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded"
                                    src="{{ asset('storage/'.$blog->thumbnail) }}" alt="blog-thumbnail" /></figure>
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
