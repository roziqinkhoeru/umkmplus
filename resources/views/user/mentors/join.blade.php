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
    <section class="pt-45 pb-60">
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
                                            id="fullname" required value="" class="input-form">
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
                                            required value="" class="input-form">
                                    </div>
                                </div>
                                {{-- domicile --}}
                                <div class="sign__input-wrapper mb-22">
                                    <label for="domicile">
                                        <h5>Kota</h5>
                                    </label>
                                    <div class="sign__input">
                                        <i class="fal fa-map-marked icon-form"></i>
                                        <input type="text" placeholder="Masukan kota domisili" name="domicile"
                                            id="domicile" required value="" class="input-form">
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
                                            id="phone" required value="" class="input-form">
                                    </div>
                                </div>
                                {{-- cv --}}
                                <div class="sign__input-wrapper mb-35">
                                    <label for="cv">
                                        <h5>CV</h5>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="cv" name="cv">
                                        <label class="input-group-text" for="cv">Upload</label>
                                    </div>
                                </div>
                                {{-- button --}}
                                <button id="loginButton" class="tp-btn w-100 rounded-pill" type="submit">Daftar menjadi
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
                        <p class="mb-30 text-base">Reach us at <a href="mailto:info@umkmplus.com" class="text-tp-theme-1"
                                style="text-decoration: underline;text-underline-offset: 2px">info@umkmplus.com</a> and
                            we will get back to you
                            asap.</p>
                        <h5 class="text-xl">Working as UMKMPlus?</h5>
                        <p class="mb-30 text-base">Visit our careers page or send us an email at <a
                                href="mailto:info@umkmplus.com" class="text-tp-theme-1"
                                style="text-decoration: underline;text-underline-offset: 2px">careers@umkmplus.com</a></p>
                        <h5 class="text-xl">Insurance agent?</h5>
                        <p class="mb-30 text-base">Become an insurance agent by contacting us at <a
                                href="mailto:info@umkmplus.com" class="text-tp-theme-1"
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
                domicile: {
                    required: true,
                    pattern: /^[a-zA-Z\s]*$/,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13,
                },
                cv: {
                    required: true,
                    extension: "pdf|doc|docx",
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
                domicile: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kota domisili tidak boleh kosong',
                    pattern: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kota domisili tidak valid',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon tidak valid',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon minimal 10 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nomor telepon maksimal 13 karakter',
                },
                cv: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>CV tidak boleh kosong',
                    extension: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>CV harus berupa file pdf, doc, atau docx',
                },
            },
        });
    </script>
@endsection
