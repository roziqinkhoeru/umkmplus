@extends('user.courses.components.courseLayout')

@section('content')
    <main>
        {{-- course area start --}}
        <section class="course__area pt-80 pb-70 grey-bg-3">
            <div class="container">
                {{-- filter test --}}
                <div class="card">
                    <div class="card-body">
                        <iframe src="{{ $course->google_form }}?embedded=true" width="100%" height="720" frameborder="0"
                            marginheight="0" marginwidth="0">Memuat…</iframe>
                    </div>
                </div>
                <div class="row pt-25">
                    <div class="col-md-12">
                        <div class="float-right text-right">
                            <a href="{{ url('/course/playing/' . $courseEnroll->id . '/test/finish') }}"
                                class="tp-btn tp-btn-4 rounded-2">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- course area end --}}
    </main>
@endsection

