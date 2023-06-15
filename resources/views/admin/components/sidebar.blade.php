<div class="sidebar-content">
    {{-- user --}}
    <div class="user">
        <div class="avatar-sm float-left mr-2">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="admin-profile"
                    class="avatar-img rounded-circle">
            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                <img src="{{ asset("storage/".auth()->user()->customer->profile_picture) }}"
                    alt="{{ auth()->user()->username }}-profile" class="avatar-img rounded-circle">
            @endif
        </div>
        <div class="info">
            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                    {{ auth()->user()->username }}

                    @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                        <span class="user-level">Administrator</span>
                    @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                        <span class="user-level">Mentor</span>
                    @endif
                    <span class="caret"></span>
                </span>
            </a>
            <div class="clearfix"></div>

            <div class="collapse in" id="collapseExample">
                <ul class="nav">
                    <li>
                        @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                            <a href="/admin/profile">
                                <span class="link-collapse">Profil Saya</span>
                            </a>
                        @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                            <a href="/mentor/profile">
                                <span class="link-collapse">Profil Saya</span>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- sidebar --}}
    <ul class="nav nav-primary">
        {{-- dashboard --}}
        <li class="nav-item @if ($active == 'dashboard') active @endif">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <a href="/admin">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                <a href="/mentor/dashboard">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            @endif
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Learning</h4>
        </li>
        {{-- course --}}
        <li class="nav-item @if ($active == 'course') active @endif">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <a data-toggle="collapse" href="#courseMenu">
                    <i class="fas fa-book"></i>
                    <p>Kelas</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="courseMenu">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('admin.course') }}">
                                <span class="sub-item">Data Kelas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.course.application') }}">
                                <span class="sub-item">Pengajuan Kelas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                <a href="/mentor/course">
                    <i class="fas fa-book"></i>
                    <p>Kelas</p>
                </a>
            @endif
        </li>
        {{-- mentor --}}
        <li class="nav-item @if ($active == 'mentor') active @endif">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <a href="/admin/mentor">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Mentor</p>
                </a>
            @endif
        </li>
        {{-- student --}}
        <li class="nav-item @if ($active == 'student') active @endif">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <a href="/admin/student">
                    <i class="fas fa-user-graduate"></i>
                    <p>Siswa</p>
                </a>
            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                <a data-toggle="collapse" href="#studentMenu">
                    <i class="fas fa-user-graduate"></i>
                    <p>Siswa</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="studentMenu">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('mentor.student') }}">
                                <span class="sub-item">Seluruh Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mentor.uncompleted.student') }}">
                                <span class="sub-item">Siswa Belum Dinilai</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">other</h4>
        </li>
        {{-- application --}}
        @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
            <li class="nav-item @if ($active == 'testimonial') active @endif">
                <a href="/admin/testimonial">
                    <i class="fas fa-star"></i>
                    <p>Testimonial</p>
                </a>
            </li>
            <li class="nav-item @if ($active == 'application') active @endif">
                <a href="/admin/mentor/application">
                    <i class="fas fa-id-badge"></i>
                    <p>Pendaftar Mentor</p>
                </a>
            </li>
            {{-- blog --}}
            <li class="nav-item @if ($active == 'blog') active @endif">
                <a href="/admin/blog">
                    <i class="fas fa-pen-alt"></i>
                    <p>Blog</p>
                </a>
            </li>
            <li class="nav-item @if ($active == 'withdraw') active @endif">
                <a href="/admin/withdraw">
                    <i class="fas fa-money-bill"></i>
                    <p>Keuangan</p>
                </a>
            </li>
        @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
            <li class="nav-item @if ($active == 'discount') active @endif">
                <a href="{{ route('mentor.discount') }}">
                    <i class="fas fa-ticket-alt"></i>
                    <p>Kode Diskon</p>
                </a>
            </li>
            <li class="nav-item @if ($active == 'blog') active @endif">
                <a href="/mentor/blog">
                    <i class="fas fa-pen-alt"></i>
                    <p>Blog</p>
                </a>
            </li>
            <li class="nav-item @if ($active == 'withdraw') active @endif">
                <a href="/mentor/withdraw">
                    <i class="fas fa-money-bill"></i>
                    <p>Keuangan</p>
                </a>
            </li>
        @endif
        {{-- logout --}}
        <li class="nav-item">
            <a href="/logout" onclick="logout()" class="hover-logout">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</div>
