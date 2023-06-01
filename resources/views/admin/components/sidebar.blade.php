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
                    Hizrian
                    <span class="user-level">Administrator</span>
                    <span class="caret"></span>
                </span>
            </a>
            <div class="clearfix"></div>

            <div class="collapse in" id="collapseExample">
                <ul class="nav">
                    <li>
                        <a href="#profile">
                            <span class="link-collapse">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#edit">
                            <span class="link-collapse">Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#settings">
                            <span class="link-collapse">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- sidebar --}}
    <ul class="nav nav-primary">
        {{-- dashboard --}}
        <li class="nav-item @if ($active == 'dashboard') active @endif">
            <a href="/admin">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Learning</h4>
        </li>
        {{-- course --}}
        <li class="nav-item @if ($active == 'course') active @endif">
            <a href="/admin/course">
                <i class="fas fa-book"></i>
                <p>Course</p>
            </a>
        </li>
        {{-- mentor --}}
        <li class="nav-item @if ($active == 'mentor') active @endif">
            <a href="/admin/mentor">
                <i class="fas fa-chalkboard-teacher"></i>
                <p>Mentor</p>
            </a>
        </li>
        {{-- student --}}
        <li class="nav-item @if ($active == 'student') active @endif">
            <a href="/admin/student">
                <i class="fas fa-user-graduate"></i>
                <p>Student</p>
            </a>
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">other</h4>
        </li>
        {{-- application --}}
        <li class="nav-item @if ($active == 'application') active @endif">
            <a href="/admin/application">
                <i class="fas fa-file-alt"></i>
                <p>Application</p>
            </a>
        </li>
        {{-- blog --}}
        <li class="nav-item @if ($active == 'blog') active @endif">
            <a href="/admin/blog">
                <i class="fas fa-pen-alt"></i>
                <p>Blog</p>
            </a>
        </li>
        {{-- logout --}}
        <li class="nav-item">
            <a href="/logout" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</div>
