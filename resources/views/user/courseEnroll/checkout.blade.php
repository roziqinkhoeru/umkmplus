@extends('user.layout.app')

@section('content')
    {{-- MIDTRANS --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <main>
        {{-- category area start --}}
        <section class="bg-white pb-60 pt-40">
            <div class="container">
                <div class="row row-gap-4">
                    <div class="col-xxl-4 col-xl-4 col-md-6">
                        <div class="card card-list-category">
                            <div class="card-body">
                                <figure class="list-category-img-wrapper mb-30"><img
                                        src="{{ asset('assets/img/dummy/good-job-hand.svg') }}" alt="category-thumbnail">
                                </figure>
                                <h3 class="mb-10">{{ $course->title }} </h3>
                                @if ($status == '')
                                    <p class="mb-15" id="price">{{ $course->price }} </p>
                                    <p class="mb-15" id="priceDiscount">{{ $course->price }}</p>
                                    <form action="{{ url('/checkout/' . $course->title . '/getDiscount') }}" method="POST"
                                        id="discountCourse">
                                        @csrf
                                        <div class="sign__input-wrapper mb-15">
                                            <label for="password">
                                                <h5>Voucher</h5>
                                            </label>
                                            <div class="d-flex">
                                                <div class="sign__input">
                                                    <i class="fal fa-lock icon-form"></i>
                                                    <div class="toggle-eye-wrapper"></div>
                                                    <input type="text" placeholder="Masukan voucher" value=""
                                                        name="discount" id="discount" class="input-form">
                                                </div>
                                                <button type="submit" id="discount-button"
                                                    class="tp-btn rounded-pill">Klaim</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ url('/checkout/' . $course->title) }}" method="POST"
                                        id="checkoutCourse">
                                        @csrf
                                        <input hidden type="text" placeholder="Masukan voucher" value="null"
                                            name="discountID" id="discountID" class="input-form">
                                        <button type="submit" id="pay-button"
                                            class="tp-btn w-100 rounded-pill">Bayar</button>
                                    </form>
                                @elseif($status == 'pending')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- category area end --}}
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        $("#priceDiscount").hide();
        $("#discountCourse").submit(function(e) {
            e.preventDefault();
            $('#discount-button').html(
                '<i class="fas fa-circle-notch text-lg spinners"></i>'
            );
            $.ajax({
                type: "POST",
                url: "{{ url('/checkout/' . $course->title . '/getDiscount') }}",
                data: {
                    discount_code: $("#discount").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#discount-button').html(
                        'Terklaim'
                    ).prop("disabled", true);
                    $("#priceDiscount").show();
                    $("#priceDiscount").html(response.data.priceDiscount);
                    $("#discountID").val(response.data.discountID);
                    console.log(response.data.priceDiscount);
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: "Berhasil mendapatkan diskon!",
                    })
                },
                error: function(xhr, status, error) {
                    $("#priceDiscount").hide();
                    $("#priceDiscount").html('');
                    $('#discount-button').html(
                        'klaim'
                    )
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
            $.ajax({
                type: "POST",
                url: "{{ url('/checkout/' . $course->title) }}",
                data: {
                    discount: $("#discountID").val(),
                    priceDiscount: $("#priceDiscount").html(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#pay-button').html(
                        'Terbayar'
                    ).prop("disabled", true);
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay(response.data.snapToken, {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            alert("payment success!");
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                        },
                        onClose: function() {
                            Swal.fire('Keluar dari pembayaran')
                            $.ajax({
                                type: "DELETE",
                                url: "{{ url('/checkout/') }}" +
                                    "/" + response.data.orderID,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                            })
                        }
                    })
                },
                error: function(xhr, status, error) {
                    $('#pay-button').html(
                        'Bayar'
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
