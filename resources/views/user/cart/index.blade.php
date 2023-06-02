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
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="product-price">Unit Price</th>
                                            <th class="product-price">Discount</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="product-name">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/dummy/cart-1.jpg') }}" alt="">
                                                    <div style="text-align: left !important">
                                                        <p class="mb-5">University seminar series global.</p>
                                                        <p class="mb-0">Mentor: Jhon Doe</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price"><span class="amount">$130.00</span></td>
                                            <td class="product-discount"><span class="amount">$30.00</span></td>
                                            <td class="product-subtotal"><span class="amount">$100.00</span></td>
                                            <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="product-name">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/dummy/cart-1.jpg') }}" alt="">
                                                    <div style="text-align: left !important">
                                                        <p class="mb-5">University seminar series global.</p>
                                                        <p class="mb-0">Mentor: Jhon Doe</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price"><span class="amount">$120.50</span></td>
                                            <td class="product-discount"><span class="amount">$30.00</span></td>
                                            <td class="product-subtotal"><span class="amount">$90.50</span></td>
                                            <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                                placeholder="Coupon code" type="text">
                                            <button class="tp-btn" name="apply_coupon" type="submit">Apply coupon</button>
                                        </div>
                                        <div class="coupon2">
                                            <button class="tp-btn" name="update_cart" type="submit">Update cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul class="mb-20">
                                            <li>Subtotal <span>$250.00</span></li>
                                            <li>Total <span>$250.00</span></li>
                                        </ul>
                                        <a class="tp-btn" href="checkout.html">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        {{-- cart-area end --}}
    </main>
@endsection

@section('script')
    <script></script>
@endsection
