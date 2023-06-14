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

@section('script')
    <script>
        // Mendengarkan event message dari iframe
        window.addEventListener('message', function(event) {
            // Memeriksa apakah pesan berasal dari iframe formulir Google yang disematkan
            if (event.origin === 'https://docs.google.com') {
                console.log('Pesan diterima: ');
                // Memeriksa isi pesan untuk mengetahui status pengiriman formulir
                if (event.data === 'formSubmitted') {
                    // Formulir telah terkirim
                    console.log('Formulir telah terkirim.');
                }
            }
        });
    </script>
