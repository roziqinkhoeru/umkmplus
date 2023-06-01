const emptyState = (msg) => {
    return `<div class="text-center col-span-full pt-60 pb-50">
    <div class="text-center w-100 d-flex justify-content-center">
        <div class="rounded-3 px-5 py-4" style="background: #0e0e0e10">
            <p class="text-xl font-semibold mb-0">${msg}</p>
        </div>
    </div>
</div>`;
};

const errorState = () => {
    return `<div class="col-span-full pt-50 pb-45 "><div class="text-center d-flex justify-content-center"><div class="rounded-4 px-5 py-4" style="background: #0e0e0e10"><i class="fa fa-exclamation-circle text-3xl" aria-hidden="true"></i><p class="text-2xl text-muted mt-15 mb-5 fw-bold">Tidak ada item di sini!</p><p class="text-muted mb-5">Silakan periksa koneksi Anda atau segarkan halaman ini.</p></div></div></div>`;
};
