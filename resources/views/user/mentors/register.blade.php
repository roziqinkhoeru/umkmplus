@extends('auth.layout')

@section('authContent')
    <main>
        <!-- sign up area start -->
        <section class="signup__area p-relative z-index-1 pb-145" style="padding-top: 54px">
            <div class="sign__shape">
                <img class="man-1" src="{{ asset('assets/img/decoration/man-1.png') }}" alt="decoration-man-1">
                <img class="man-2" src="{{ asset('assets/img/decoration/man-2.png') }}" alt="decoration-man-2">
                <img class="circle" src="{{ asset('assets/img/decoration/circle.png') }}" alt="decoration-circle">
                <img class="zigzag" src="{{ asset('assets/img/decoration/zigzag.png') }}" alt="decoration-zigzag">
                <img class="dot" src="{{ asset('assets/img/decoration/dot.png') }}" alt="decoration-dot">
                <img class="bg" src="{{ asset('assets/img/decoration/sign-up.png') }}" alt="decoration-sign-up">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center" style="margin-bottom: 44px">
                            <a href="/"><img src="{{ asset('assets/img/brand/umkmplus-letter-logo.svg') }}"
                                    alt="umkmplus-logo" style="margin-bottom: 30px; width: 200px; margin-top: 30px"></a>
                            <h2 class="section__title mb-2">Daftarkan Akun Mentor Anda</h2>
                            <p>Jadilah mentor</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            <div class="sign__form">
                                <form action="{{ url('/mentor/register') }}" method="POST" id="registerForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="name">
                                            <h5>Job</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-user icon-form"></i>
                                            <input type="text" placeholder="Masukan pekerjaan anda" name="job"
                                                id="job" value="{{ old('job') }}" required class="input-form">
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-22">
                                        <label for="name">
                                            <h5>CV</h5>
                                        </label>
                                        <div class="sign__input">
                                            <i class="fal fa-file icon-form"></i>
                                            <input type="file" placeholder="Masukan nama lengkap" name="file_cv"
                                                id="file_cv" value="{{ old('file_cv') }}" accept="application/pdf"
                                                required class="formFile">
                                        </div>
                                    </div>
                                    <div class="sign__action d-flex justify-content-between mb-30">
                                        <div class="sign__agree d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" id="terms" name="terms"
                                                required>
                                            <label class="m-check-label" for="terms">Saya menyetujui <a
                                                    href="/terms">Syarat dan Ketentuan</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" id="registerButton"
                                        class="tp-btn w-100 rounded-pill">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->
    </main>
@endsection

@section('script')
    <script>
        // Menambahkan aturan validasi kustom untuk ukuran maksimum file
        $.validator.addMethod('maxfilesize', function(value, element, param) {
            var maxSize = param;

            if (element.files.length > 0) {
                var fileSize = element.files[0].size; // Ukuran file dalam byte
                return fileSize <= maxSize;
            }

            return true;
        }, '');
        // validate form
        $("#registerForm").validate({
            rules: {
                job: {
                    required: true,
                },
                file_cv: {
                    required: true,
                    extension: "pdf",
                    maxfilesize: 2 * 1024 * 1024, // 2MB (dalam byte)
                },
                terms: {
                    required: true,
                },
            },
            messages: {
                job: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Pekerjaan tidak boleh kosong',
                },
                file_cv: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>File CV tidak boleh kosong',
                    extension: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>File harus dalam format PDF',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Ukuran file maksimum adalah 2MB',
                },
                terms: {
                    required: '<i class="fas fa-exclamation-circle text-sm icon-error" style="transform: translateY(-2px) !important;"></i>',
                },
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var formData = new FormData(form);

                // Menambahkan file PDF yang dipilih oleh pengguna ke objek FormData

                $('#registerButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#registerButton').prop('disabled', true);
                // Tindakan yang dilakukan ketika formulir valid dan siap dikirim
                // form.submit();
                $.ajax({
                    url: "{{ url('/mentor/register') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tindakan yang dilakukan ketika permintaan berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'PENDAFTARAN BERHASIL!',
                            text: response.meta.message,
                        })
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        // Tindakan yang dilakukan ketika permintaan gagal
                        $('#registerButton').html('Daftar');
                        $('#registerButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'PENDAFTARAN GAGAL!',
                                text: xhr.responseJSON.meta.message,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'PENDAFTARAN GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    }
                });
            }
        });
    </script>
@endsection
