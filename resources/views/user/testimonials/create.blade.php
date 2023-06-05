@extends('user.layout.app')

@section('content')
    {{-- header area start --}}
    <section class="pt-60 pb-50" style="background: #3083FF">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="">
                        <p class="fw-medium text-base mb-10" style="color: #ffffffc5">#BelajarLangsungDariAhli</p>
                        <h3 class="text-white text-4xl mb-15">Berikan penilaian untuk kelas ini</h3>
                        <p class="mb-25 text-base" style="color: #ffffffa7">Tolong berikan penilaian dengan sejujurnya untuk kelas ini.!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- header area end --}}

    {{-- join area start --}}
    <section class="pt-45 pb-join-section">
        <div class="container">
            <div class="position-relative">
                <div class="card-join-mentor">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="POST" id="FormTestimonial">
                                @csrf
                                {{-- titleCourse --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="titleCourse">
                                        <h5>Judul Kelas</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-user icon-form"></i>
                                        <input disabled type="text" name="titleCourse"
                                            id="titleCourse" required value="{{ $courseEnroll->course->title }}" class="input-form">
                                    </div>
                                </div>
                                {{-- testimonial --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="testimonial">
                                        <h5>Testimonial</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-message icon-form"></i>
                                        <input type="text" placeholder="Masukan testimonial" name="testimonial" id="testimonial"
                                            required value="{{ old('testimonial') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- rating --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="rating">
                                        <h5>Rating</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-star icon-form"></i>
                                        <input type="number" placeholder="Masukan Rating" name="rating"
                                            id="rating" required value="{{ old('rating') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- button --}}
                                <button id="addButton" class="tp-btn w-100 rounded-pill" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- join area end --}}
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        $("#FormTestimonial").validate({
            rules: {
                testimonial: {
                    required: true,
                    minlength: 3,
                },
                rating: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 5,
                },
            },
            messages: {
                testimonial: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Testimonial tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Testimonial minimal 3 karakter',
                },
                rating: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Rating tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Rating harus berupa angka',
                    min: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Rating minimal 1',
                    max: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Rating maksimal 5',
                },
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var formData = new FormData(form);

                $('#addButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#addButton').prop('disabled', true);
                // Tindakan yang dilakukan ketika formulir valid dan siap dikirim
                // form.submit();
                $.ajax({
                    url: "{{ url('/testimonial/'. $courseEnroll->id) }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tindakan yang dilakukan ketika permintaan berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'TESTIMONIAL BERHASIL!',
                            text: response.meta.message,
                        })
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON);
                        // Tindakan yang dilakukan ketika permintaan gagal
                        $('#addButton').html('Kirim');
                        $('#addButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'TESTIMONIAL GAGAL!',
                                text: xhr.responseJSON.meta.message + ', Error: ' + xhr.responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'TESTIMONIAL GAGAL!',
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
