<div class="logo-header"
    data-background-color="@php
if (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 1) {
            echo 'blue';
        } elseif (auth()->user()->roles()->first()->getOriginal()['pivot_role_id'] == 2) {
            echo 'purple';
        } @endphp">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('assets/img/brand/umkmplus-letter-admin.svg') }}" alt="umkmplu-letter-logo"
            class="navbar-brand">
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i class="icon-menu"></i>
        </span>
    </button>
    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
    <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
            <i class="icon-menu"></i>
        </button>
    </div>
</div>
