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
