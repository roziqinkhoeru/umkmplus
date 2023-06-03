@extends('user.layout.app')

@section('content')
    <main>
        {{-- header area start --}}
        <section class="pt-60 pb-50" style="background: #3083FF;">
            <div class="container">
                <div class="d-sm-flex align-items-sm-center">
                    <div class="mb-sm-22 me-sm-4">
                        <figure class="image-header-category-wrapper">
                            <img src="{{ asset('assets/img/dummy/pocket-money.svg') }}" alt="good-job-hands-white">
                        </figure>
                    </div>
                    <div class="">
                        <h3 class="text-white text-4xl">Keranjang</h3>
                        <p class="fw-medium text-base mb-0" style="color: #ffffffc5">#BelajarLangsungDariAhli</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- header area end --}}

        {{-- cart-area start --}}
        <section class="cart-area pt-65 pb-70">
            <div class="container">
                {{-- cart dekstop --}}
                <div class="d-none d-md-block">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name" style="min-width: 420px">Kelas</th>
                                            <th class="product-price">Harga</th>
                                            <th class="product-price">Diskon</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove" style="min-width: 270px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartCourseDesktop">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- cart mobile --}}
                <div class="d-md-none">
                    <div class="mb-25 card" id="cartCourseMobile">
                    </div>
                </div>
            </div>
        </section>
        {{-- cart-area end --}}
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            getCartCourse();
        });

        function getCartCourse() {
            let cartCourseContentDesktop = "";
            let cartCourseContentMobile = "";
            $.ajax({
                type: "GET",
                url: "{{ route('get.cart') }}",
                success: function(response) {
                    $.map(response.data.carts, function(cartCourse, index) {
                        let option = {
                            style: 'currency',
                            currency: 'IDR',
                            useGrouping: true,
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        };
                        let discountPrice = Math.ceil(cartCourse.course.price * cartCourse.course
                            .discount / 100);
                        let subTotal = cartCourse.course.price - discountPrice;
                        let coursePrice = cartCourse.course.price.toLocaleString('id-ID', option);
                        discountPrice = discountPrice.toLocaleString('id-ID', option);
                        subTotal = subTotal.toLocaleString('id-ID', option);
                        cartCourseContentDesktop += `<tr>
                                            <td class="product-name">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('${cartCourse.course.thumbnail}') }}"
                                                        alt="thumbnail-course" class="thumbnail-course-cart">
                                                    <div style="text-align: left !important">
                                                        <p class="mb-5 text-base fw-medium">${cartCourse.course.title}</p>
                                                        <p class="mb-0">Mentor: ${cartCourse.course.mentor.name}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price"><span class="amount">${coursePrice}</span></td>
                                            <td class="product-discount"><span class="amount">${discountPrice}</span></td>
                                            <td class="product-subtotal"><span class="amount">${subTotal}</span></td>
                                            <td class="product-remove space-nowrap">
                                                <a href="#" onclick="deleteCart('${cartCourse.id}')" class="tp-btn tp-btn-6 me-2 btn-delete" id="deleteCartButton">Hapus</a>
                                                <a href="{{ url('checkout/${cartCourse.course.slug}') }}" class="tp-btn tp-btn-6">Checkout</a>
                                            </td>
                                        </tr>`;
                        cartCourseContentMobile += `
                        <div class="card-header"><span class="badge text-bg-dark">${cartCourse.course.category.name}</span></div>
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div><img src="{{ asset('${cartCourse.course.thumbnail}') }}"
                                            alt="thumbnail-course-cart" class="thumbnail-course-cart-mobile"></div>
                                    <div class="">
                                        <p class="text-base mb-5">${cartCourse.course.title}</p>
                                        <p class="text-base fw-semibold mb-0">${subTotal} <span
                                                class="text-xs text-decoration-line-through text-green fw-semibold">${coursePrice}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="#" onclick="deleteCart('${cartCourse.id}')" class="tp-btn tp-btn-6 me-2 btn-delete btn-sm text-xs">Hapus</a>
                                <a href="{{ url('checkout/${cartCourse.course.slug}') }}" class="tp-btn tp-btn-6 btn-sm text-xs">Checkout</a>
                        </div>
                        `;
                    });
                    $('#cartCourseDesktop').html(cartCourseContentDesktop);
                    $('#cartCourseMobile').html(cartCourseContentMobile);
                }
            });
        }

        function deleteCart(cart) {
            event.preventDefault();
            $("#deleteCartButton").html(`<i class="fas fa-circle-notch text-lg spinners-2"></i>`);
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus kelas dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/cart/${cart}') }}`,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Anda telah menghapus kelas dari keranjang.',
                                'success'
                            );
                            getCart();
                            getCartCourse();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON)
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal menghapus kelas dari keranjang.',
                                    xhr.responseJSON.meta.message
                                )
                            else
                                Swal.fire(
                                    'Gagal!',
                                    'Anda gagal menghapus kelas dari keranjang.',
                                    error
                                )
                            return false;
                        }
                    })
                } else {
                    $("#deleteCartButton").html(`Hapus`);
                }
            })
        }
    </script>
@endsection
