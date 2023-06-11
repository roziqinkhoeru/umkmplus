<div class="container-fluid">
    <div class="collapse" id="search-nav">
        <form id="navbarSearchForm" class="navbar-left navbar-form nav-search mr-md-3" onsubmit="searchNavbarForm(event)">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pr-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" id="searchNavbar"
                    name="searchNavbar">
            </div>
        </form>
    </div>
    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        {{-- toggle nav search --}}
        <li class="nav-item toggle-nav-search hidden-caret">
            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                aria-controls="search-nav">
                <i class="fa fa-search"></i>
            </a>
        </li>
        {{-- quick link --}}
        <li class="nav-item dropdown hidden-caret">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-layer-group"></i>
            </a>
            <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                <div class="quick-actions-header">
                    <span class="title mb-1">Quick Actions</span>
                    <span class="subtitle op-8">Shortcuts</span>
                </div>
                <div class="quick-actions-scroll scrollbar-outer">
                    <div class="quick-actions-items">
                        <div class="row m-0">
                            {{-- dashboard --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="{{ route('admin.dashboard') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background: #6861ce">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <span class="text">Dashboard</span>
                                    </div>
                                </a>
                            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                <a class="col-6 col-md-4 p-0" href="{{ route('mentor.dashboard') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background: #6861ce">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <span class="text">Dashboard</span>
                                    </div>
                                </a>
                            @endif
                            {{-- course --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="{{ route('admin.course') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-dark rounded-circle">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <span class="text">Kelas</span>
                                    </div>
                                </a>
                            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                <a class="col-6 col-md-4 p-0" href="{{ route('mentor.course') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-dark rounded-circle">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <span class="text">Kelas</span>
                                    </div>
                                </a>
                            @endif
                            {{-- mentor --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="{{ route('admin.mentor') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-success rounded-circle">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <span class="text">Mentors</span>
                                    </div>
                                </a>
                            @endif
                            {{-- student --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="{{ route('admin.student') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-danger rounded-circle">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <span class="text">Students</span>
                                    </div>
                                </a>
                            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                <a class="col-6 col-md-4 p-0" href="{{ route('mentor.student') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-danger rounded-circle">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <span class="text">Students</span>
                                    </div>
                                </a>
                            @endif
                            {{-- application --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="{{ route('admin.mentor.application') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-warning rounded-circle">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <span class="text">Applications</span>
                                    </div>
                                </a>
                            @endif
                            {{-- code discount --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                <a class="col-6 col-md-4 p-0" href="{{ route('mentor.discount') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-warning rounded-circle">
                                            <i class="fas fa-ticket-alt"></i>
                                        </div>
                                        <span class="text">Code Discount</span>
                                    </div>
                                </a>
                            @endif
                            {{-- blog --}}
                            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                <a class="col-6 col-md-4 p-0" href="/admin/blog">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle">
                                            <i class="fas fa-pen-alt"></i>
                                        </div>
                                        <span class="text">Blog</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="/admin/withdraw">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle">
                                            <i class="fas fa-money-bill"></i>
                                        </div>
                                        <span class="text">Withdraw</span>
                                    </div>
                                </a>
                            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                <a class="col-6 col-md-4 p-0" href="/mentor/blog">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle">
                                            <i class="fas fa-pen-alt"></i>
                                        </div>
                                        <span class="text">Blog</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="/mentor/withdraw">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle">
                                            <i class="fas fa-money-bill"></i>
                                        </div>
                                        <span class="text">Withdraw</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </li>
        {{-- profile --}}
        <li class="nav-item dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                        <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="admin-profile"
                            class="avatar-img rounded-circle">
                    @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                        <img src="{{ asset(auth()->user()->customer->profile_picture) }}"
                            alt="{{ auth()->user()->username }}-profile" class="avatar-img rounded-circle">
                    @endif
                </div>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg">
                                @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                    <img src="{{ asset('assets/template/admin/img/profile.jpg') }}"
                                        alt="admin-profile" class="avatar-img rounded">
                                @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                    <img src="{{ asset(auth()->user()->customer->profile_picture) }}"
                                        alt="{{ auth()->user()->username }}-profile" class="avatar-img rounded">
                                @endif
                            </div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->username }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                                @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                                    <a href="/admin/profile" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                                    <a href="/mentor/profile" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item hover-logout" href="{{ url('logout') }}"
                            onclick="logout()">Logout</a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</div>

<script>
    function logout() {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan keluar dari akun ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Berhasil!',
                    'Anda telah keluar dari akun ini.',
                    'success'
                )
                window.location.href = "{{ route('logout') }}";
            }
        })
    }
    // on submit form search
    const searchNavbarForm = (e) => {
        e.preventDefault();
        const search = document.getElementById('searchNavbar').value;
        if (search == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kata kunci tidak boleh kosong!',
            })
        } else {
            window.location.href = `/dashboard/search/${search}`;
        }
    }
</script>
