{{-- profile area start --}}
<section class="profile__area pt-90 pb-50 grey-bg-2">
    <div class="container">
        <div class="profile__basic-inner pb-20 white-bg">
            <div class="row align-items-center">
                <div class="col-xxl-8 col-md-8">
                    <div class="profile__basic d-md-flex align-items-center">
                        <div class="profile__basic-thumb mr-30">
                            <img src="{{ asset('storage/'.$profile->profile_picture) }}"
                                alt="{{ $profile->user->username }}-user-profile" class="object-cover-center">
                        </div>
                        <div class="profile__basic-content">
                            <h3 class="profile__basic-title" id="titleProfileName">
                                Selamat Datang Kembali <span>{{ $profile->name }}</span>
                            </h3>
                            <p>{{ $profile->student_course_enrolls_count }} Kelas Berjalan <button
                                    onclick="getContent('course')" class="btn-anchor">Lihat Kelas</button></p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="profile__basic-cart d-flex align-items-center justify-content-md-end">
                        <div class="cart-info mr-10">
                            <a href="{{ route('cart.index') }}">Keranjang</a>
                        </div>
                        <div class="cart-item">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa-regular fa-basket-shopping"></i>
                                {!! $profile->carts_count == 0 ? '' : '<span class="cart-quantity">' . $profile->carts_count . '</span>' !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- profile area end --}}
