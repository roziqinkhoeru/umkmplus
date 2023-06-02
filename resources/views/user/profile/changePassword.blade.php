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
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <div class="password__change">
                                        <div class="password__change-top">
                                            <h3 class="password__change-title">Change Password</h3>
                                        </div>
                                        <div class="password__form white-bg">
                                            <form action="#">
                                                <div class="password__input">
                                                    <p>Old Password</p>
                                                    <input type="password" placeholder="Enter Old Password">
                                                </div>
                                                <div class="password__input">
                                                    <p>New Password</p>
                                                    <input type="password" placeholder="Enter New Password">
                                                </div>
                                                <div class="password__input">
                                                    <p>Confirm Password</p>
                                                    <input type="password" placeholder="Confirm Password">
                                                </div>
                                                <div class="password__input">
                                                    <button type="submit" class="tp-btn">Update password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- profile menu area end --}}
    </main>
@endsection

@section('script')
    <script></script>
@endsection
