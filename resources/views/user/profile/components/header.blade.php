{{-- profile area start --}}
<section class="profile__area pt-90 pb-50 grey-bg-2">
    <div class="container">
        <div class="profile__basic-inner pb-20 white-bg">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-md-6">
                    <div class="profile__basic d-md-flex align-items-center">
                        <div class="profile__basic-thumb mr-30">
                            <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="profile-user-umkmplus">
                        </div>
                        <div class="profile__basic-content">
                            <h3 class="profile__basic-title" id="titleProfileName">
                                Welcome Back <span>{{ $profile->name }}</span>
                            </h3>
                            <p>{{ $profile->student_course_enrolls_count }} Running Courses <button
                                    onclick="getContent('course')" class="btn-anchor">View Course</button></p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-md-6">
                    <div class="profile__basic-cart d-flex align-items-center justify-content-md-end">
                        <div class="cart-info mr-10">
                            <a href="{{ route('cart.index') }}">View cart</a>
                        </div>
                        <div class="cart-item">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa-regular fa-basket-shopping"></i>
                                <span class="cart-quantity">{{ $profile->carts_count }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- profile area end --}}
