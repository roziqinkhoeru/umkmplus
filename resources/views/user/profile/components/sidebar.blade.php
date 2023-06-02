{{-- sidebar --}}
<div class="col-xxl-4 col-md-4">
    <div class="profile__menu-left white-bg mb-50 pt-5">
        <div class="profile__menu-tab">
            <div class="nav nav-tabs flex-column justify-content-start text-start">
                {{-- my account --}}
                <button onclick="getContent('profile')" class="nav-link " type="button" role="tab"
                    aria-selected="" id="profile">
                    <i class="fa-regular fa-user"></i>
                    Akun Saya
                </button>
                {{-- my courses --}}
                <button onclick="getContent('course')" class="nav-link " type="button"
                    role="tab" aria-selected="" id="course">
                    <i class="fa-regular fa-book-open"></i>
                    Kelas Saya
                </button>
                {{-- transaction history --}}
                <button onclick="getContent('transaction-history')" class="nav-link " id="transaction-history"
                    type="button" role="tab" aria-selected="">
                    <i class="fa-regular fa-file-lines"></i>
                    Riwayat Transaksi
                </button>
                {{-- change password --}}
                <button onclick="getContent('change-password')" class="nav-link "
                    type="button" role="tab" aria-selected="" id="change-password">
                    <i class="fa-regular fa-lock"></i>
                    Ubah Kata Sandi
                </button>
                {{-- logout --}}
                <a class="nav-link menu-logout" href="/logout" onclick="logout()">
                    <i class="fa-regular fa-arrow-right-from-bracket"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
