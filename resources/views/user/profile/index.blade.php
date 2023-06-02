@extends('user.layout.app')

@section('content')
    <main>
        @include('user.profile.layout')

        {{-- profile menu area start --}}
        <section class="profile__menu pb-70 grey-bg-2">
            <div class="container">
                <div class="row">
                    @include('user.profile.sidebar')
                    {{-- main content --}}
                    <div class="col-xxl-8 col-md-8">
                        <div class="profile__menu-right">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-account" role="tabpanel"
                                    aria-labelledby="nav-account-tab">
                                    <div class="profile__info">

                                        <div class="profile__info-top d-flex justify-content-between align-items-center">
                                            <h3 class="profile__info-title">Profile Information</h3>
                                            <button class="profile__info-btn" type="button" data-bs-toggle="modal"
                                                data-bs-target="#profile_edit_modal"><i
                                                    class="fa-regular fa-pen-to-square"></i> Edit Profile</button>
                                        </div>

                                        <div class="profile__info-wrapper white-bg">
                                            <div class="profile__info-item">
                                                <p>Name</p>
                                                <h4>Shahnewaz Sakil</h4>
                                            </div>
                                            <div class="profile__info-item">
                                                <p>Email</p>
                                                <h4>info@educal.com</h4>
                                            </div>
                                            <div class="profile__info-item">
                                                <p>Phone</p>
                                                <h4>(325) 463-5693</h4>
                                            </div>
                                            <div class="profile__info-item">
                                                <p>Address</p>
                                                <h4>Abingdon, Maryland(MD), 21009</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                                    <div class="order__info">
                                        <div class="order__info-top d-flex justify-content-between align-items-center">
                                            <h3 class="order__info-title">My Orders</h3>
                                            <button type="button" class="order__info-btn"><i
                                                    class="fa-regular fa-trash-can"></i> Clear</button>
                                        </div>

                                        <div class="order__list white-bg table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="order__id">#3520</td>
                                                        <td><a href="course-details.html" class="order__title">University
                                                                seminar series global.</a></td>
                                                        <td>$144.00</td>
                                                        <td><a href="course-details.html" class="order__view-btn">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="order__id">#2441</td>
                                                        <td><a href="course-details.html" class="order__title">Web coding
                                                                and apache basics</a></td>
                                                        <td>$59.54</td>
                                                        <td><a href="course-details.html" class="order__view-btn">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="order__id">#2357</td>
                                                        <td><a href="course-details.html" class="order__title">Economics
                                                                historical development</a></td>
                                                        <td>$89.90</td>
                                                        <td><a href="course-details.html" class="order__view-btn">View</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-password" role="tabpanel"
                                    aria-labelledby="nav-password-tab">
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

        <div class="profile__edit-modal">
            {{-- Modal --}}
            <div class="modal fade" id="profile_edit_modal" tabindex="-1" aria-labelledby="profile_edit_modal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="profile__edit-wrapper">
                            <div class="profile__edit-close">
                                <button type="button" class="profile__edit-close-btn" data-bs-toggle="modal"
                                    data-bs-target="#course_enroll_modal"><i class="fa-light fa-xmark"></i></button>
                            </div>
                            <form action="#">
                                <div class="profile__edit-input">
                                    <p>Name</p>
                                    <input type="text" placeholder="Your Name">
                                </div>
                                <div class="profile__edit-input">
                                    <p>Email</p>
                                    <input type="text" placeholder="Your Email">
                                </div>
                                <div class="profile__edit-input">
                                    <p>Phone</p>
                                    <input type="text" placeholder="Your Phone">
                                </div>
                                <div class="profile__edit-input">
                                    <p>Address</p>
                                    <input type="text" placeholder="Your Address">
                                </div>
                                <div class="profile__edit-input">
                                    <button type="submit" class="tp-btn w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script></script>
@endsection
