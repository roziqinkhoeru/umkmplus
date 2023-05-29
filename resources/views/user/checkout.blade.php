@extends('user.layout.app')

@section('content')
    {{-- MIDTRANS --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <main>
        <main>
            {{-- header area start --}}
            <section class="pt-60 pb-50" style="background: #3083FF;">
                <div class="container">
                    <div class="d-sm-flex align-items-sm-center">
                        <div class="mb-sm-22 me-sm-4">
                            <figure class="image-header-category-wrapper">
                                <img src="{{ asset('assets/img/dummy/pocket-money.svg') }}" alt="pocket-money">
                            </figure>
                        </div>
                        <div class="">
                            <h3 class="text-white text-4xl">Checkout Kelas</h3>
                            <p class="text-base mb-0" style="color: #ffffffc5;max-width: 680px;">Belajar langsung dari para
                                Professional
                                dan Practitioners Business Expert dengan pengalaman selama puluhan tahun di dunia bisnis</p>
                        </div>
                    </div>
                </div>
            </section>
            {{-- header area end --}}

            {{-- checkout area start --}}
            <section class="pt-60 pb-50 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card card-checkout">
                                <div class="card-body">
                                    <h4 class="mb-10 text-2xl">{{ $course->title }}</h4>
                                    <p class="mb-5">Sub Total</p>
                                    <p class="mb-15 text-xl fw-bold">
                                        Rp {{ number_format(ceil($course->price * (1 - $course->discount / 100)), 0, ',', '.') }}
                                        {{-- condition::isDiscount=true --}}
                                        <span class="text-green text-decoration-line-through text-xs">
                                            Rp {{ number_format($course->price, 0, ',', '.') }}
                                        </span>
                                        {{-- end condition --}}
                                    </p>
                                    <hr class="mb-20">
                                    <p class="mb-10">Metode pembayaran yang didukung</p>
                                    <div class="d-flex align-items-center flex-wrap gap-4">
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/bca.png') }} alt="bca">
                                        </figure>
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/mandiri.png') }} alt="mandiri">
                                        </figure>
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/bni.png') }} alt="bni">
                                        </figure>
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/permata_bank.png') }} alt="permataBank">
                                        </figure>
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/gopay_landscape.png') }} alt="gopay">
                                        </figure>
                                        <figure class="checkout-support-method-wrapper">
                                            <img src={{ asset('assets/img/brand/bank_transfer_network_atm_bersama.png') }}
                                                alt="atmBersama">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card card-checkout">
                                <div class="card-body">
                                    <h4 class="mb-15 text-2xl">Rincian Pembelian</h4>
                                    <div class="d-grid grid-cols-4">
                                        <p class="col-span-2 mb-6">Subtotal</p>
                                        <p class="col-span-2 text-right mb-6">Rp
                                            <span>
                                                {{ number_format(ceil($course->price * (1 - $course->discount / 100)), 0, ',', '.') }}
                                            </span>
                                            <input hidden type="number" id="subtotal" value="{{ ceil($course->price * (1 - $course->discount / 100)) }}">
                                        </p>
                                        @if ($course->discount)
                                            <p class="col-span-2 mb-6">Discount</p>
                                            <p class="col-span-2 text-right mb-6">Rp
                                                {{ number_format(($course->price * $course->discount) / 100, 0, ',', '.') }}
                                                ({{ $course->discount }}%)</p>
                                        @endif
                                    </div>
                                    <hr class="mb-20">
                                    <div class="d-grid grid-cols-4">
                                        <form class="mb-15 col-span-4"
                                            action="{{ url('/checkout/' . $course->title . '/getDiscount') }}"
                                            method="POST" id="formReferral">
                                            @csrf
                                            <label for="referral" class="mb-5">
                                                Referral / Voucher Code
                                            </label>
                                            <div class="header__search-input">
                                                <input type="text" placeholder="XXXXXX" class="rounded-2 text-uppercase"
                                                    name="referral" id="referral" style="letter-spacing: 3px">
                                                <button class="header__search-btn r-5" id="referral-button">
                                                    <i class="fa-regular fa-tags text-xl"
                                                        style="transform: translateY(4px);color: #031220"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <p class="col-span-2 mb-6" id="discountReferralLabel"></p>
                                        <p class="col-span-2 mb-6 text-right" id="discountReferral">
                                        </p>
                                        <p class="col-span-2 mb-30 font-semibold">Total</p>
                                        <p class="col-span-2 mb-30 text-right fw-bold text-xl text-green" id="totalPrice">Rp
                                            {{ number_format(ceil($course->price * (1 - $course->discount / 100)), 0, ',', '.') }}
                                        </p>
                                        <form action="{{ url('/checkout/' . $course->title) }}" method="post"
                                            class="mb-15 col-span-4" id="checkoutCourse">
                                            <input hidden type="number"
                                                value="{{ ceil($course->price * (1 - $course->discount / 100)) }}"
                                                name="priceCheckout" id="priceCheckout" class="input-form">
                                            <input hidden type="text" value="" name="discountID" id="discountID"
                                                class="input-form">
                                            <div class="col-span-4">
                                                <button type="submit" id="pay-button"
                                                    class="tp-btn tp-btn-2 w-100 text-center rounded-2">Bayar
                                                    Sekarang</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- checkout area end --}}
        </main>
    @endsection

    @section('script')
        <script>
            $("#formReferral").submit(function(e) {
                e.preventDefault();
                $('#referral-button').html(
                    '<i class="fas fa-circle-notch text-lg spinners"></i>'
                );
                $.ajax({
                    type: "POST",
                    url: "{{ url('/checkout/' . $course->title . '/getDiscount') }}",
                    data: {
                        discount_code: $("#referral").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#referral-button').html(
                            `<i class="fa-regular fa-tags text-xl"
                                                    style="transform: translateY(4px);color: #031220"></i>`
                        );
                        $('#referral').prop("disabled", true);
                        $("#discountReferralLabel").html(`Discount Referral`);
                        let option = {
                            style: 'currency',
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        }
                        let coursePrice = new Intl.NumberFormat('id-ID', option).format(response.data.priceDiscount);
                        $("#discountReferral").html(`${coursePrice} (${response.data.discount.discount}%)`);
                        $("#discountID").val(response.data.discount.id);

                        let subtotal = Math.ceil(parseFloat($("#subtotal").val()));
                        let totalPrice = parseInt(response.data.priceDiscount);
                        let newTotalPrice = subtotal - totalPrice;
                        let newTotalPriceFormat = new Intl.NumberFormat('id-ID', option).format(newTotalPrice);
                        $("#totalPrice").html(`${newTotalPriceFormat}`);
                        $("#priceCheckout").val(`${newTotalPrice}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: "Berhasil mendapatkan diskon!",
                        })
                    },
                    error: function(xhr, status, error) {
                        $('#referral-button').html(
                            `<i class="fa-regular fa-tags text-xl"
                                                    style="transform: translateY(4px);color: #031220"></i>`
                        );
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: xhr.responseJSON.meta.message,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                    }
                });
            })

            function checkoutPayment() {
                console.log($("#priceCheckout").val());
                $.ajax({
                    type: "POST",
                    url: "{{ url('/checkout/' . $course->title) }}",
                    data: {
                        discountID: $("#discountID").val(),
                        priceCheckout: $("#priceCheckout").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#pay-button').html(
                            'Proses Pembayaran...'
                        ).prop("disabled", true);
                        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                        window.snap.pay(response.data.snapToken, {
                            onSuccess: function(result) {
                                /* You may add your own implementation here */
                                Swal.fire('Pembayaran berhasil')
                                window.location.href = "{{ url('/course/'. $course->title) }}"
                            },
                            onPending: function(result) {
                                /* You may add your own implementation here */
                                alert("wating your payment!");
                            },
                            onError: function(result) {
                                /* You may add your own implementation here */
                                Swal.fire('Pembayaran gagal')
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ url('/checkout/') }}" +
                                        "/" + response.data.orderID,
                                    data: {
                                        _token: "{{ csrf_token() }}"
                                    },
                                })
                                $('#pay-button').html(
                                    'Bayar Sekarang'
                                ).prop("disabled", false);
                            },
                            onClose: function() {
                                Swal.fire('Keluar dari pembayaran')
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                        $('#pay-button').html(
                            'Bayar Sekarang'
                        );
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: xhr.responseJSON.meta.message,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    }
                })
            }
            $("#checkoutCourse").submit(function(e) {
                e.preventDefault();
                $('#pay-button').html(
                    '<i class="fas fa-circle-notch text-lg spinners"></i>'
                );
                checkoutPayment();
            })
        </script>
    @endsection
