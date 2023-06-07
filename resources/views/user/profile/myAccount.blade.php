@extends('user.layout.app')

@section('content')
    <main>
        {{-- header --}}
        @include('user.profile.components.header')

        {{-- profile menu area start --}}
        <section class="profile__menu pb-70 grey-bg-2">
            <div class="container">
                <div class="row">
                    {{-- sidebar --}}
                    @include('user.profile.components.sidebar')

                    {{-- main content --}}
                    <div class="col-xxl-8 col-md-8">
                        <div class="profile__menu-right">
                            <div class="tab-content" id="nav-tabContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- profile menu area end --}}

        <div class="profile__edit-modal" id="profileEditModal">
            {{-- Modal --}}
        </div>
    </main>
@endsection

@section('script')
    @if (session('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @elseif (session('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Mendapatkan parameter dari URL
            var urlParams = new URLSearchParams(window.location.search);
            // Mengambil nilai parameter dengan nama tertentu
            var contentBeforeURL = urlParams.get('content');
            if (contentBeforeURL) {
                getContent(contentBeforeURL)
            } else {
                getContent('profile')
            }
        });

        // Fungsi untuk mengubah nilai aria-selected
        function setAriaSelected(element, value) {
            // element.setAttribute('aria-selected', value);
            if (value) {
                element.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        }

        // Fungsi untuk mengubah nilai aria-selected saat tombol diklik
        function toggleAriaSelected(idSelected, isActive) {
            var button = document.getElementById(idSelected); // Ganti dengan ID tombol yang sesuai
            setAriaSelected(button, isActive);
        }

        function getContent(content) {
            // Mendapatkan parameter dari URL
            var urlParams = new URLSearchParams(window.location.search);
            // Mengambil nilai parameter dengan nama tertentu
            var contentBeforeURL = urlParams.get('content');
            // Membuat permintaan AJAX dan mengubah URL
            var request = `content=${content}`; // Request yang ingin ditambahkan
            var url = "{{ url('/profile') }}"; // Mendapatkan URL saat ini
            var newUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + request; // Menambahkan request ke URL

            // Mengubah URL tanpa melakukan reload halaman
            history.pushState(null, null, newUrl);
            if (contentBeforeURL) {
                toggleAriaSelected(contentBeforeURL, false);
            }
            toggleAriaSelected(content, true);

            switch (content) {
                case 'profile':
                    getProfile()
                    break;
                case 'course':
                    getCourse()
                    break;
                case 'transaction-history':
                    getTransactionHistory()
                    break;
                case 'change-password':
                    formChangePassword()
                    break;
                default:
                    break;
            }
        }

        let htmlString = ""

        // menu profile
        function getProfile() {
            // Display loading state
            $("#nav-tabContent").html(`<div class="tab-pane fade show active" role="tabpanel">
                                        <div class="order__info">
                                            <div class="profile__info-top d-flex justify-content-between align-items-center px-9">
                                                <h3 class="profile__info-title">Informasi Akun</h3>
                                                <button class="profile__info-btn" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#profile_edit_modal"><i
                                                        class="fa-regular fa-pen-to-square"></i> Edit Profile</button>
                                            </div>
                                            <div class="order__list white-bg px-9">
                                                <div class="d-flex align-items-center justify-content-center pt-35 pb-60">
                                                    <i class="fas fa-circle-notch spinners-2" style="font-size: 54px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `);

            $.ajax({
                url: "{{ route('get.profile') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                            <div class="profile__info" id="profileInfo">
                                <div class="profile__info-top d-flex justify-content-between align-items-center px-9">
                                    <h3 class="profile__info-title">Informasi Akun</h3>
                                    <button class="profile__info-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#profile_edit_modal"><i
                                            class="fa-regular fa-pen-to-square"></i> Edit Profile</button>
                                </div>
                                <div class="profile__info-wrapper white-bg px-9">
                                    <div class="profile__info-item">
                                        <p>Nama</p>
                                        <h4>${response.data.customer.name}</h4>
                                    </div>
                                    <div class="profile__info-item">
                                        <p>Email</p>
                                        <h4>${response.data.email}</h4>
                                    </div>
                                    <div class="profile__info-item">
                                        <p>Jenis Kelamin</p>
                                        <h4>${response.data.customer.gender}</h4>
                                    </div>
                                    <div class="profile__info-item">
                                        <p>No Telepon</p>
                                        <h4>${response.data.customer.phone}</h4>
                                    </div>
                                    <div class="profile__info-item">
                                        <p>Alamat</p>
                                        <h4>${response.data.customer.address}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    $("#nav-tabContent").html(htmlString);
                    $("#profileEditModal").html(`
                        <div class="modal fade" id="profile_edit_modal" tabindex="-1" aria-labelledby="profile_edit_modal"aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="profile__edit-wrapper">
                                        <div class="profile__edit-close">
                                            <button type="button" class="profile__edit-close-btn" data-bs-toggle="modal"
                                                data-bs-target="#course_enroll_modal"><i class="fa-light fa-xmark"></i></button>
                                        </div>
                                        <form action="{{ route('update.profile') }}" method="POST" id="formUpdateProfile">
                                            @method('PUT')
                                            @csrf
                                            <div class="profile__edit-input">
                                                <p>Nama</p>
                                                <input type="text" name="name" id="name" value="${response.data.customer.name}" placeholder="Nama Anda">
                                            </div>
                                            <div class="profile__edit-input">
                                                <p>Email</p>
                                                <input type="text" name="email" id="email" value="${response.data.email}" placeholder="Email Anda">
                                            </div>
                                            <div class="profile__edit-input">
                                                <p>No Telepon</p>
                                                <input type="text" name="phone" id="phone" value="${response.data.customer.phone}" placeholder="No Telepon Anda">
                                            </div>
                                            <div class="profile__edit-input">
                                                <p>Jenis Kelamin</p>
                                                <select class="select-form w-100 h-52" aria-label="Default select example"
                                                    name="gender" id="gender" required>
                                                    <option value="laki-laki">laki-laki</option>
                                                    <option value="perempuan">perempuan</option>
                                                </select>
                                            </div>
                                            <div class="profile__edit-input">
                                                <p>Alamat</p>
                                                <input type="text" name="address" id="address" value="${response.data.customer.address}" placeholder="Alamat Anda">
                                            </div>
                                            <div class="profile__edit-input">
                                                <button type="submit" id="updateProfileButton" class="tp-btn w-100">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <form action="{{ route('update.profile') }}" method="POST" id="formUpdateProfile">
                                    @method('PUT')
                                    @csrf
                                    <div class="profile__edit-input">
                                        <p style="margin-bottom: 10px !important">Nama</p>
                                        <input type="text" name="name" id="name" value="${response.data.customer.name}" placeholder="Nama Anda">
                                    </div>
                                    <div class="profile__edit-input">
                                        <p style="margin-bottom: 10px !important">Email</p>
                                        <input type="text" name="email" id="email" value="${response.data.email}" placeholder="Email Anda" disabled>
                                    </div>
                                    <div class="profile__edit-input">
                                        <p style="margin-bottom: 10px !important">No Telepon</p>
                                        <input type="text" name="phone" id="phone" value="${response.data.customer.phone}" placeholder="No Telepon Anda">
                                    </div>
                                    <div class="profile__edit-input" style="margin-bottom:36px !important">
                                        <p style="margin-bottom: 10px !important">Alamat</p>
                                        <input type="text" name="address" id="address" value="${response.data.customer.address}" placeholder="Alamat Anda">
                                    </div>
                                    <div class="profile__edit-input">
                                        <button type="submit" id="updateProfileButton" class="tp-btn w-100">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `);
                    $("#formUpdateProfile").validate({
                        rules: {
                            name: {
                                required: true,
                                minlength: 3
                            },
                            email: {
                                required: true,
                                email: true
                            },
                            phone: {
                                required: true,
                                minlength: 10,
                                maxlength: 16
                            },
                            gender: {
                                required: true
                            },
                            address: {
                                required: true,
                                minlength: 5
                            }
                        },
                        messages: {
                            name: {
                                required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nama tidak boleh kosong',
                                minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Nama minimal 3 karakter',
                            },
                            email: {
                                required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak boleh kosong',
                                email: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Email tidak valid',
                            },
                            phone: {
                                required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>No Telepon tidak boleh kosong',
                                minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>No Telepon minimal 10 karakter',
                                maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>No Telepon maksimal 16 karakter',
                            },
                            gender: {
                                required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Jenis Kelamin tidak boleh kosong',
                            },
                            address: {
                                required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Alamat tidak boleh kosong',
                                minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Alamat minimal 5 karakter',
                            },
                        },
                        submitHandler: function(form) {
                            $('#updateProfileButton').html(
                                '<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                            $('#updateProfileButton').prop('disabled', true);
                            $.ajax({
                                url: "{{ route('update.profile') }}",
                                type: "PUT",
                                data: {
                                    name: $('#name').val(),
                                    email: $('#email').val(),
                                    phone: $('#phone').val(),
                                    gender: $('#gender').val(),
                                    address: $('#address').val(),
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log(response);
                                    $('#updateProfileButton').html('Update Profil');
                                    $('#updateProfileButton').prop('disabled', false);
                                    $('#name').val("");
                                    $('#email').val("");
                                    $('#phone').val("");
                                    $('#gender').val("");
                                    $('#address').val("");
                                    $('#profile_edit_modal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'UBAH PROFIL BERHASIL!',
                                        text: response.meta.message,
                                    })
                                    getContent('profile');
                                },
                                error: function(xhr, status, error) {
                                    $('#updateProfileButton').html('Update Profil');
                                    $('#updateProfileButton').prop('disabled', false);
                                    if (xhr.responseJSON) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'UBAH PROFIL GAGAL!',
                                            text: xhr.responseJSON.meta
                                                .message + ", Error: " + xhr
                                                .responseJSON.data.error,
                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'UBAH PROFIL GAGAL!',
                                            text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                                error,
                                        })
                                    }
                                    return false;
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        // menu my course
        function getCourse() {
            // Display loading state
            $("#nav-tabContent").html(`<div class="tab-pane fade show active" role="tabpanel">
                                        <div class="order__info">
                                            <div class="order__info-top d-flex justify-content-between align-items-center px-9">
                                                <h3 class="order__info-title">Kelas Saya</h3>
                                            </div>
                                            <div class="order__list white-bg px-9">
                                                <div class="d-flex align-items-center justify-content-center pt-35 pb-60">
                                                    <i class="fas fa-circle-notch spinners-2" style="font-size: 54px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `);
            $.ajax({
                type: "GET",
                url: "{{ route('get.profile.course') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response.data);
                    htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                                    <div class="order__info">
                                        <div class="order__info-top d-flex justify-content-between align-items-center px-9">
                                            <h3 class="order__info-title">Kelas Saya</h3>
                                        </div>
                                        <div class="order__list white-bg px-9 pb-9">
                                            <div class="d-grid gap-5 grid-cols-12">
                                                ${getMyCourse(response.data)}
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    $("#nav-tabContent").html(htmlString);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })
        }
        // get my course data
        function getMyCourse(data) {
            let myCourse = '';
            $.map(data, function(enroll) {
                let option = {
                    style: 'currency',
                    currency: 'IDR',
                    useGrouping: true,
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                };
                let coursePrice = enroll.total_price.toLocaleString('id-ID', option);
                let badgeStatus = '';
                switch (enroll.status) {
                    case 'aktif':
                        badgeStatus = 'text-bg-primary';
                        break;
                    case 'proses':
                        badgeStatus = 'text-bg-warning'
                        break;
                    case 'menunggu pembayaran':
                        badgeStatus = 'text-bg-warning'
                        break;
                    case 'selesai':
                        badgeStatus = 'text-bg-success'
                        break;
                    default:
                        break;
                }
                myCourse += `<div class="col-span-6-mycourse">
                                <div class="mycourse-item">
                                    <div class="d-flex flex-column">
                                        <div class="mb-15">
                                            <figure class="mycourse-item-image position-relative mb-15">
                                                <img src="{{ asset('${enroll.course.thumbnail}') }}" alt="${enroll.course.slug}-course-thumbnail" />
                                                <div class="course-tag-wrapper">
                                                    <div class="course__tag">
                                                        <span class="course-badge">${enroll.course.category.name}</span>
                                                    </div>
                                                </div>
                                            </figure>
                                            <div>
                                                <h4 class="mb-5">${enroll.course.title}</h4>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="mb-0">Oleh ${enroll.course.mentor.name}</p>
                                                    <p class="mb-0"><span class="badge py-2 px-3 ${badgeStatus} text-uppercase rounded-pill">${enroll.status}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            ${enroll.status == 'selesai' ? `<a href="{{ url('/course/certificate/${enroll.id}') }}" class="tp-btn tp-btn-green rounded-2 w-100 text-center" style="line-height: 44px;height: 44px">Sertifikat</a>` : `<a href="{{ url('/course/${enroll.course.slug}') }}" class="tp-btn tp-btn-4 rounded-2 w-100 text-center">Lanjutkan Belajar</a>`}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
            })
            return myCourse;
        }

        // menu transaction
        function getTransactionHistory() {
            // Display loading state
            $("#nav-tabContent").html(`<div class="tab-pane fade show active" role="tabpanel">
                                        <div class="order__info">
                                            <div
                                                class="order__info-top d-flex justify-content-between align-items-center px-9"
                                            >
                                                <h3 class="order__info-title">Riwayat Transaksi</h3>
                                            </div>
                                            <div class="order__list white-bg">
                                                <div class="d-flex align-items-center justify-content-center pt-35 pb-60 px-9">
                                                    <i class="fas fa-circle-notch spinners-2" style="font-size: 54px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `);

            $.ajax({
                type: "GET",
                url: "{{ route('get.profile.transaction.history') }}",
                dataType: "JSON",
                success: function(response) {
                    console.log(response.data);
                    htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                            <div class="order__info">
                                <div
                                    class="order__info-top d-flex justify-content-between align-items-center px-9"
                                >
                                    <h3 class="order__info-title">Riwayat Transaksi</h3>
                                </div>
                                <div class="order__list white-bg px-9">
                                    <div>
                                        ${getMyTransaction(response.data)}
                                    </div>
                                </div>
                            </div>
                        </div>`
                    $("#nav-tabContent").html(htmlString);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        // get my transaction
        function getMyTransaction(data) {
            let myTransaction = '';
            $.map(data, function(enroll) {
                let option = {
                    style: 'currency',
                    currency: 'IDR',
                    useGrouping: true,
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                };
                let coursePrice = enroll.course.price.toLocaleString('id-ID', option);
                let courseTotalPrice = enroll.course.price - Math.ceil(enroll.course.price * enroll.course
                    .discount / 100);
                let badgeStatus = '';
                let badgeText = '';
                switch (enroll.status) {
                    case 'aktif':
                        badgeStatus = 'text-bg-success';
                        badgeText = 'sukses';
                        break;
                    case 'proses':
                        badgeStatus = 'text-bg-warning'
                        badgeText = enroll.status;
                        break;
                    case 'menunggu pembayaran':
                        badgeStatus = 'text-bg-warning'
                        badgeText = enroll.status;
                        break;
                    case 'selesai':
                        badgeStatus = 'text-bg-success'
                        badgeText = 'sukses';
                        break;
                    default:
                        break;
                }
                myTransaction += `
                                <div class="card mb-25">
                                    <div class="card-header" style="background: #246ba00a">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 d-none d-md-block">Order ID:
                                                <a href="#" class="btn-anchor text-decoration-underline">${enroll.id}</a>
                                            </p>
                                            <p class="mb-0">
                                                <span class="badge text-uppercase py-1 px-2 ${badgeStatus}">
                                                    ${badgeText}
                                                </span>
                                            </p>
                                            <div class="dropdown d-md-none">
                                                <button class="btn btn-secondary dropdown-toggle shadow-none border-0 dropdown-dot-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" style="padding: 2px 0 !important;min-width: 8rem !important">
                                                    <li><a class="dropdown-item text-sm" href="#">Lihat Invoice</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap">
                                                    <div class="mr-2 mb-2 mb-sm-0"><img
                                                            src="{{ asset('${enroll.course.thumbnail}') }}"
                                                            alt="thumbnail-course" class="card-image-transaction">
                                                    </div>
                                                    <div>
                                                        <p class="mb-5 text-base fw-bold">${enroll.course.title}</p>
                                                        <p class="mb-0">Harga Produk: <span class="fw-medium">${coursePrice}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="background: #246ba00a">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <p class="mb-0">Total Pembayaran :</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="mb-0 text-green fw-bold text-base">${courseTotalPrice.toLocaleString('id-ID', option)}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                `;
            })
            return myTransaction;
        }

        // menu change password
        function formChangePassword() {
            htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                        <div class="password__change">
                            <div class="password__change-top px-9">
                                <h3 class="password__change-title">Ubah Kata Sandi</h3>
                            </div>
                            <div class="password__form white-bg px-9">
                                <form action="{{ route('profile.change.password') }}" method="POST" id="formChangePassword">
                                    @csrf @method('PUT')
                                    <div class="password__input">
                                        <p style="margin-bottom: 10px !important">Password Lama</p>
                                        <input type="password" id="old_password" name="old_password" placeholder="Masukkan Password Lama">
                                    </div>
                                    <div class="password__input">
                                        <p style="margin-bottom: 10px !important">Password Baru</p>
                                        <input type="password" id="password" name="password" placeholder="Masukkan Password Baru">
                                    </div>
                                    <div class="password__input" style="margin-bottom:36px !important">
                                        <p style="margin-bottom: 10px !important">Konfirmasi Password</p>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" >
                                    </div>
                                    <div class="password__input mb-5 text-right">
                                        <button type="submit "id="updatePasswordButton" class="tp-btn">Update password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>`
            $("#nav-tabContent").html(htmlString);
            $("#formChangePassword").validate({
                rules: {
                    old_password: {
                        required: true,
                        minlength: 8,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },
                },
                messages: {
                    old_password: {
                        required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password lama tidak boleh kosong',
                        minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Password lama minimal 8 karakter',
                    },
                    password: {
                        required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi tidak boleh kosong',
                        minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi minimal 8 karakter',
                        pattern: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kata sandi harus mengandung huruf dan angka',
                    },
                    password_confirmation: {
                        required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi kata sandi tidak boleh kosong',
                        equalTo: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Konfirmasi kata sandi tidak sama',
                    },
                },
                submitHandler: function(form) {
                    $('#updatePasswordButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                    $('#updatePasswordButton').prop('disabled', true);
                    $.ajax({
                        url: "{{ route('profile.change.password') }}",
                        type: "PUT",
                        data: {
                            old_password: $('#old_password').val(),
                            password: $('#password').val(),
                            password_confirmation: $('#password_confirmation').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#updatePasswordButton').html('Update password');
                            $('#updatePasswordButton').prop('disabled', false);
                            $('#old_password').val("");
                            $('#password').val("");
                            $('#password_confirmation').val("");
                            Swal.fire({
                                icon: 'success',
                                title: 'UBAH PASSWORD BERHASIL!',
                                text: response.meta.message,
                            })
                        },
                        error: function(xhr, status, error) {
                            $('#updatePasswordButton').html('Update password');
                            $('#updatePasswordButton').prop('disabled', false);
                            if (xhr.responseJSON) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'UBAH PASSWORD GAGAL!',
                                    text: xhr.responseJSON.meta.message + " Error: " + xhr
                                        .responseJSON.data.error,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'UBAH PASSWORD GAGAL!',
                                    text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                        error,
                                })
                            }
                            return false;
                        }
                    });
                }
            });
        }
    </script>
@endsection
