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
                                    <tbody>
                                        <tr>
                                            <td class="product-name">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/dummy/thumbnail-course-2.png') }}"
                                                        alt="thumbnail-course" class="thumbnail-course-cart">
                                                    <div style="text-align: left !important">
                                                        <p class="mb-5 text-base fw-medium">University seminar series
                                                            global.</p>
                                                        <p class="mb-0">Mentor: Jhon Doe</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price"><span class="amount">$130.00</span></td>
                                            <td class="product-discount"><span class="amount">$30.00</span></td>
                                            <td class="product-subtotal"><span class="amount">$100.00</span></td>
                                            <td class="product-remove space-nowrap">
                                                <a href="#" class="tp-btn tp-btn-6 me-2 btn-delete">Hapus</a>
                                                <a href="#" class="tp-btn tp-btn-6">Checkout</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="product-name">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/dummy/thumbnail-course.png') }}"
                                                        alt="thumbnail-course" class="thumbnail-course-cart">
                                                    <div style="text-align: left !important">
                                                        <p class="mb-5 text-base fw-medium">University seminar series
                                                            global.</p>
                                                        <p class="mb-0">Mentor: Jhon Doe</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price"><span class="amount">$120.50</span></td>
                                            <td class="product-discount"><span class="amount">$30.00</span></td>
                                            <td class="product-subtotal"><span class="amount">$90.50</span></td>
                                            <td class="product-remove space-nowrap">
                                                <a href="#" class="tp-btn tp-btn-6 me-2 btn-delete">Hapus</a>
                                                <a href="#" class="tp-btn tp-btn-6">Checkout</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- cart mobile --}}
                <div class="d-md-none">
                    <div class="mb-25 card">
                        <div class="card-header"><span class="badge text-bg-dark">nameCategory</span></div>
                        <div class="card-body">
                            <div class="d-flex gap-3">
                                <div><img src="{{ asset('assets/img/dummy/thumbnail-course-2.png') }}"
                                        alt="thumbnail-course-cart" class="thumbnail-course-cart-mobile"></div>
                                <div class="">
                                    <p class="text-base mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                    <p class="text-base fw-semibold mb-0">Rp 720.000 <span
                                            class="text-xs text-decoration-line-through text-green fw-semibold">Rp
                                            240.000</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="#" class="tp-btn tp-btn-6 me-2 btn-delete btn-sm text-xs">Hapus</a>
                            <a href="#" class="tp-btn tp-btn-6 btn-sm text-xs">Checkout</a>
                        </div>
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
