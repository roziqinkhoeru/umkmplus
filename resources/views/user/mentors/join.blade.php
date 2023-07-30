@extends('user.layout.app')

@section('content')
    {{-- header area start --}}
    <section class="pt-60 pb-50" style="background: #3083FF">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="">
                        <p class="fw-medium text-base mb-10" style="color: #ffffffc5">#BelajarLangsungDariAhli</p>
                        <h3 class="text-white text-4xl mb-15">Gabung menjadi Mentor Kami</h3>
                        <p class="mb-25 text-base" style="color: #ffffffa7">Bergabunglah sebagai mentor serta wujudkan dan
                            ciptakan
                            SDM terbaik
                            untuk Indonesia!</p>
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
                            <form action="#" method="POST" id="joinMentorForm">
                                @csrf
                                {{-- fullname --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="fullname">
                                        <h5>Nama Lengkap</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-user icon-form"></i>
                                        <input type="text" placeholder="Masukan nama lengkap" name="fullname"
                                            id="fullname" required value="{{ old('fullname') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="email">
                                        <h5>Email</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-envelope icon-form"></i>
                                        <input type="email" placeholder="Masukan email" name="email" id="email"
                                            required value="{{ old('email') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- phone --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="phone">
                                        <h5>Nomor Telepon</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-phone icon-form"></i>
                                        <input type="text" placeholder="Masukan nomor telepon" name="phone"
                                            id="phone" required value="{{ old('phone') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="address">
                                        <h5>Alamat</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-map-marked icon-form"></i>
                                        <input type="text" placeholder="Masukan alamat domisili" name="address"
                                            id="address" required value="{{ old('address') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- job --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="job">
                                        <h5>Pekerjaan</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-briefcase icon-form"></i>
                                        <input type="text" placeholder="Masukan pekerjaan " name="job" id="job"
                                            required value="{{ old('job') }}" class="input-form">
                                    </div>
                                </div>
                                {{-- gender --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="gender">
                                        <h5>Jenis Kelamin</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-venus-mars icon-form" style="z-index: 100"></i>
                                        <select class="select-form w-100 h-52 input-form float-none" name="gender"
                                            id="gender" required>
                                            <option selected value="">Pilih Jenis Kelamin</option>
                                            <option value="laki-laki">laki-laki</option>
                                            <option value="perempuan">perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- spesialisasi --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="specialist">
                                        <h5>Spesialisasi</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-user-md icon-form" style="z-index: 100"></i>
                                        <select class="select-form w-100 h-52 input-form float-none" name="specialist"
                                            id="specialist" required>
                                            <option selected value="">Pilih Spesialisasi</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- cv --}}
                                <div class="sign__input-wrapper mb-35">
                                    <label for="file_cv">
                                        <h5>CV</h5>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="file_cv" name="file_cv"
                                            accept="application/pdf, application/msword">
                                        <label class="input-group-text" for="file_cv">Upload</label>
                                    </div>
                                </div>
                                {{-- button --}}
                                <button id="registerButton" class="tp-btn w-100 rounded-pill" type="submit">Daftar
                                    menjadi
                                    mentor</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="join-info-wrapper">
                        <hr class="d-sm-none mb-35">
                        <h5 class="text-xl">General inquiries</h5>
                        <p class="mb-30 text-base">Reach us at <a href="mailto:info@umkmplus.site"
                                class="text-tp-theme-1"
                                style="text-decoration: underline;text-underline-offset: 2px">info@umkmplus.site</a> and
                            we will get back to you
                            asap.</p>
                        <h5 class="text-xl">Working as UMKMPlus?</h5>
                        <p class="mb-30 text-base">Visit our careers page or send us an email at <a
                                href="mailto:info@umkmplus.site" class="text-tp-theme-1"
                                style="text-decoration: underline;text-underline-offset: 2px">careers@umkmplus.com</a></p>
                        <h5 class="text-xl">Insurance agent?</h5>
                        <p class="mb-30 text-base">Become an insurance agent by contacting us at <a
                                href="mailto:info@umkmplus.site" class="text-tp-theme-1"
                                style="text-decoration: underline;text-underline-offset: 2px">careers@umkmplus.com</a></p>
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
        $("#joinMentorForm").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3,
                },
                email: {
                    required: true,
                    email: true,
                },
                address: {
                    required: true,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 16,
                },
                job: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                specialist: {
                    required: true,
                },
                file_cv: {
                    required: true,
                    extension: "pdf|doc|docx",
                    maxfilesize: 2 * 1024 * 1024, // 2MB (dalam byte)
                },
            },
            messages: {
                fullname: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nama lengkap tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nama lengkap minimal 3 karakter',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak valid',
                },
                address: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kota domisili tidak boleh kosong',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon tidak valid',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon minimal 10 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon maksimal 16 karakter',
                },
                job: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Pekerjaan tidak boleh kosong',
                },
                gender: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Jenis kelamin tidak boleh kosong',
                },
                specialist: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Spesialisasi tidak boleh kosong',
                },
                file_cv: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>CV tidak boleh kosong',
                    extension: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>CV harus berupa file pdf, doc, atau docx',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Ukuran file maksimum adalah 2MB',
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
                        $('#registerButton').html('Daftar menjadi mentor');
                        $('#registerButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'PENDAFTARAN GAGAL!',
                                text: xhr.responseJSON.meta.message + ', Error: ' + xhr
                                    .responseJSON.data.error,
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
