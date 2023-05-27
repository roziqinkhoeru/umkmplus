@extends('user.layout.app')

@section('content')
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
                        <h3 class="text-white text-4xl">Chekout Kelas</h3>
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
                                <h4 class="mb-10 text-2xl">The Brand Masterclass Fundamentals</h4>
                                <p class="mb-5">Sub Total</p>
                                <p class="mb-15 text-xl fw-bold">
                                    Rp 245.000
                                    {{-- condition::isDiscount=true --}}
                                    <span class="text-green text-decoration-line-through text-xs">
                                        Rp 845.000
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
                                    <p class="col-span-2 text-right mb-6">Rp 845.000</p>
                                    {{-- condition::isDiscount=true --}}
                                    <p class="col-span-2 mb-6">Discount</p>
                                    <p class="col-span-2 text-right mb-6">Rp 600.000 (71%)</p>
                                    {{-- end condition --}}
                                </div>
                                <hr class="mb-20">
                                <div class="d-grid grid-cols-4">
                                    <form class="mb-15 col-span-4">
                                        <label for="referral" class="mb-5">
                                            Referral / Voucher Code
                                        </label>
                                        <div class="header__search-input">
                                            <input type="text" placeholder="XXXXXX" class="rounded-2 text-uppercase"
                                                name="referral" id="referral" style="letter-spacing: 3px">
                                            <button class="header__search-btn r-5">
                                                <i class="fa-regular fa-tags text-xl"
                                                    style="transform: translateY(4px);color: #031220"></i>
                                            </button>
                                        </div>
                                    </form>
                                    {{-- condition::isDiscountCodeActive=true --}}
                                    <p class="col-span-2 mb-6">Discount Referral</p>
                                    <p class="col-span-2 mb-6 text-right">
                                        Rp 120.000
                                    </p>
                                    {{-- end condition --}}
                                    <p class="col-span-2 mb-30 font-semibold">Total</p>
                                    <p class="col-span-2 mb-30 text-right fw-bold text-xl text-green">
                                        Rp. 125.000
                                    </p>
                                    <div class="col-span-4">
                                        <a class="tp-btn tp-btn-2 w-100 text-center rounded-2" href="/midtrans">Bayar
                                            Sekarang</a>
                                    </div>
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
@endsection
