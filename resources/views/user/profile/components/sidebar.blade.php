{{-- sidebar --}}
<div class="col-xxl-4 col-md-4">
    <div class="profile__menu-left white-bg mb-50 pt-5">
        <div class="profile__menu-tab">
            <div class="nav nav-tabs flex-column justify-content-start text-start">
                {{-- my account --}}
                <a href="/profile" class="nav-link {{ $active == 'account' ? 'active' : '' }}" type="button" role="tab"
                    aria-selected="{{ $active == 'account' ? 'true' : 'false' }}">
                    <i class="fa-regular fa-user"></i>
                    Akun Saya
                </a>
                {{-- my courses --}}
                <a href="/profile/my-courses" class="nav-link {{ $active == 'courses' ? 'active' : '' }}" type="button"
                    role="tab" aria-selected="{{ $active == 'courses' ? 'true' : 'false' }}">
                    <i class="fa-regular fa-book-open"></i>
                    Kelas Saya
                </a>
                {{-- transaction history --}}
                <a href="/profile/transaction-history" class="nav-link {{ $active == 'transaction' ? 'active' : '' }}"
                    type="button" role="tab" aria-selected="{{ $active == 'transaction' ? 'true' : 'false' }}">
                    <i class="fa-regular fa-file-lines"></i>
                    Riwayat Transaksi
                </a>
                {{-- change password --}}
                <a href="/profile/change-password" class="nav-link {{ $active == 'changePassword' ? 'active' : '' }}"
                    type="button" role="tab" aria-selected="{{ $active == 'changePassword' ? 'true' : 'false' }}">
                    <i class="fa-regular fa-lock"></i>
                    Ubah Kata Sandi
                </a>
                {{-- logout --}}
                <a class="nav-link menu-logout" href="/logout" onclick="logout()">
                    <i class="fa-regular fa-arrow-right-from-bracket"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
