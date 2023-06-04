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
                            <div class="tab-content" id="nav-tabContent">

                            </div>
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

        function getProfile() {
            $.ajax({
                url: "{{ route('get.profile') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                                    <div class="profile__info" id="profileInfo">
                                        <div class="profile__info-top d-flex justify-content-between align-items-center">
                                            <h3 class="profile__info-title">Profile Information</h3>
                                            <button class="profile__info-btn" type="button" data-bs-toggle="modal"
                                                data-bs-target="#profile_edit_modal"><i
                                                    class="fa-regular fa-pen-to-square"></i> Edit Profile</button>
                                        </div>

                                        <div class="profile__info-wrapper white-bg">
                                            <div class="profile__info-item">
                                                <p>Nama</p>
                                                <h4>${response.data.customer.name}</h4>
                                            </div>
                                            <div class="profile__info-item">
                                                <p>Email</p>
                                                <h4>${response.data.email}</h4>
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
                                                <p>Alamat</p>
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

        function getCourse() {
            $.ajax({
                        type: "GET",
                        url: "{{ route('get.profile.course') }}",
                        dataType: "JSON",
                        success: function(response) {
                            htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                                <div class="order__info">
                                    <div class="order__info-top d-flex justify-content-between align-items-center">
                                        <h3 class="order__info-title">My Orders</h3>
                                        <button type="button" class="order__info-btn"><i class="fa-regular fa-trash-can"></i> Clear</button>
                                    </div>

                                    <div class="order__list white-bg table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${$.map(response.data, function (enroll) {
                                                    let option = {
                                                        style: 'currency',
                                                        currency: 'IDR',
                                                        useGrouping: true,
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                    };
                                                    let coursePrice = enroll.total_price.toLocaleString('id-ID', option);
                                                    return `<tr>
                                                        <td class="order__id">#${enroll.id}</td>
                                                        <td><a href="course-details.html" class="order__title">${enroll.course.title}</a></td>
                                                        <td>${coursePrice}</td>
                                                        <td>${enroll.status}</td>
                                                        <td><a href="{{ url('/course/playing/${enroll.id}') }}" class="order__view-btn">View</a></td>
                                                    </tr>`;
                                                })}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
`
            $("#nav-tabContent").html(htmlString);
        },
        error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
        });
        }

        function getTransactionHistory() {
            $.ajax({
                        type: "GET",
                        url: "{{ route('get.profile.transaction.history') }}",
                        dataType: "JSON",
                        success: function(response) {
                            htmlString = `<div class="tab-pane fade show active" role="tabpanel">
                                <div class="order__info">
                                    <div class="order__info-top d-flex justify-content-between align-items-center">
                                        <h3 class="order__info-title">My Orders</h3>
                                        <button type="button" class="order__info-btn"><i class="fa-regular fa-trash-can"></i> Clear</button>
                                    </div>

                                    <div class="order__list white-bg table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${$.map(response.data, function (enroll) {
                                                    let option = {
                                                        style: 'currency',
                                                        currency: 'IDR',
                                                        useGrouping: true,
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                    };
                                                    let coursePrice = enroll.total_price.toLocaleString('id-ID', option);
                                                    return `<tr>
                                                        <td class="order__id">#${enroll.id}</td>
                                                        <td><a href="course-details.html" class="order__title">${enroll.course.title}</a></td>
                                                        <td>${coursePrice}</td>
                                                        <td><a href="course-details.html" class="order__view-btn">View</a></td>
                                                    </tr>`;
                                                })}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
`
            $("#nav-tabContent").html(htmlString);
        },
        error: function(xhr, status, error) {
        console.log(xhr.responseText);
        }
        });
        }

        function formChangePassword() {
            htmlString = `
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="password__change">
                    <div class="password__change-top">
                        <h3 class="password__change-title">Ubah Password</h3>
                    </div>
                    <div class="password__form white-bg">
                        <form action="{{ route('profile.change.password') }}" method="POST" id="formChangePassword">
                            @csrf
                            @method('PUT')
                            <div class="password__input">
                                <p>Password Lama</p>
                                <input type="password" id="old_password" name="old_password" placeholder="Masukkan Password Lama">
                            </div>
                            <div class="password__input">
                                <p>Password Baru</p>
                                <input type="password" id="password" name="password" placeholder="Masukkan Password Baru">
                            </div>
                            <div class="password__input">
                                <p>Konfirmasi Password</p>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <div class="password__input">
                                <button type="submit" id="updatePasswordButton" class="tp-btn">Update password</button>
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

    <script></script>
@endsection
