<div class="sidebar-content">
    {{-- user --}}
    <div class="user">
        <div class="avatar-sm float-left mr-2">
            <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="profile-user0umkmplus-admin"
                class="avatar-img rounded-circle">
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
                            <a href="/mentor/profile">
                                <span class="link-collapse">Profil Saya</span>
                            </a>
                        @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                            <a href="/admin/profile">
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
                <a href="/admin/course">
                    <i class="fas fa-book"></i>
                    <p>Kelas</p>
                </a>
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
                <a href="/mentor/student">
                    <i class="fas fa-user-graduate"></i>
                    <p>Siswa</p>
                </a>
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
            <li class="nav-item @if ($active == 'application') active @endif">
                <a href="/admin/mentor/application">
                    <i class="fas fa-file-alt"></i>
                    <p>Pendaftar Mentor</p>
                </a>
            </li>
        @endif
        {{-- blog --}}
        <li class="nav-item @if ($active == 'blog') active @endif">
            @if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1)
                <a href="/admin/blog">
                    <i class="fas fa-pen-alt"></i>
                    <p>Blog</p>
                </a>
            @elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2)
                <a href="/mentor/blog">
                    <i class="fas fa-pen-alt"></i>
                    <p>Blog</p>
                </a>
            @endif
        </li>
        {{-- logout --}}
        <li class="nav-item">
            <a href="/logout" onclick="logout()" class="hover-logout">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</div>
