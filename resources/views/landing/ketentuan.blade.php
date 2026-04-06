<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aturan Program - Transora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="bg-[#f4f7f5] text-[#22312f] font-sans antialiased">

    <nav class="sticky top-0 z-50 px-6 lg:px-12 py-5 bg-white/90 backdrop-blur-md border-b border-emerald-100">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-700 rounded-full flex items-center justify-center text-white font-bold">T</div>
                <span class="text-xl font-bold text-gray-900">Transora</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-emerald-700 hover:underline">Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="px-5 py-8">
        <div class="max-w-5xl mx-auto space-y-5">

            <section class="rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-100 to-teal-100 p-6 md:p-8">
                <p class="text-xs tracking-[0.12em] uppercase font-bold text-emerald-700 mb-2">Transora | Ketentuan</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Peraturan Program Tabungan Berjangka</h1>
                <p class="text-sm md:text-base text-gray-700 leading-relaxed max-w-3xl">
                    Baca aturan berikut untuk memahami batas waktu setoran, alur pencatatan, dan konsekuensi jika tidak disiplin. Semua ketentuan dibuat agar proses menabung tetap jelas dan transparan.
                </p>
            </section>

            <section class="rounded-2xl border border-[#c7ddd4] bg-[#e8f3ef] p-5 md:p-6">
                <p class="text-xs tracking-[0.12em] uppercase font-bold text-emerald-700 mb-4">Aturan Utama Program</p>

                <div class="space-y-3">
                    <article class="rounded-xl bg-white border border-[#dce9e3] p-4">
                        <h2 class="text-base font-bold text-gray-900">1. Dana tidak dapat ditarik sebelum 12 bulan</h2>
                        <p class="text-sm text-gray-600 mt-1">Setoran yang sudah masuk akan dikunci selama 52 minggu (12 bulan) sesuai periode program.</p>
                    </article>

                    <article class="rounded-xl bg-white border border-[#dce9e3] p-4">
                        <h2 class="text-base font-bold text-gray-900">2. Nominal setor tidak dapat diubah selama program berjalan</h2>
                        <p class="text-sm text-gray-600 mt-1">Nominal mengikuti paket saat pendaftaran. Jika ingin ganti nominal, lakukan di periode berikutnya.</p>
                    </article>

                    <article class="rounded-xl bg-white border border-[#dce9e3] p-4">
                        <h2 class="text-base font-bold text-gray-900">3. Menunggak 5 minggu beruntun = program dihentikan</h2>
                        <p class="text-sm text-gray-600 mt-1">Jika melewati batas tunggakan, status akun dihentikan otomatis agar alur tetap tertib.</p>
                    </article>
                </div>
            </section>

            <section class="rounded-2xl border border-[#c7ddd4] bg-[#e8f3ef] p-5 md:p-6">
                <p class="text-xs tracking-[0.12em] uppercase font-bold text-emerald-700 mb-4">Pilihan Paket Setoran</p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="rounded-xl bg-white border border-[#dce9e3] p-3 text-center">
                        <p class="text-xs text-gray-500">Paket A</p>
                        <p class="text-sm font-bold text-gray-900">Rp 25.000</p>
                        <p class="text-xs text-gray-500">/ minggu</p>
                    </div>
                    <div class="rounded-xl bg-white border border-[#dce9e3] p-3 text-center">
                        <p class="text-xs text-gray-500">Paket B</p>
                        <p class="text-sm font-bold text-gray-900">Rp 50.000</p>
                        <p class="text-xs text-gray-500">/ minggu</p>
                    </div>
                    <div class="rounded-xl bg-white border border-[#dce9e3] p-3 text-center">
                        <p class="text-xs text-gray-500">Paket C</p>
                        <p class="text-sm font-bold text-gray-900">Rp 75.000</p>
                        <p class="text-xs text-gray-500">/ minggu</p>
                    </div>
                    <div class="rounded-xl bg-white border border-[#dce9e3] p-3 text-center">
                        <p class="text-xs text-gray-500">Paket D</p>
                        <p class="text-sm font-bold text-gray-900">Rp 100.000</p>
                        <p class="text-xs text-gray-500">/ minggu</p>
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-[#c7ddd4] bg-[#e8f3ef] p-5 md:p-6">
                <p class="text-xs tracking-[0.12em] uppercase font-bold text-emerald-700 mb-4">Simulasi Progres Setoran</p>

                <div class="rounded-xl border border-[#dce9e3] bg-white p-4">
                    <div class="h-3 rounded-full bg-gray-200 overflow-hidden">
                        <div class="h-full bg-emerald-600" style="width: 35%;"></div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-3 mt-4 text-sm">
                        <div class="rounded-lg bg-emerald-50 border border-emerald-100 p-3">
                            <p class="text-gray-500">Sudah setor</p>
                            <p class="font-bold text-emerald-700">18 minggu</p>
                        </div>
                        <div class="rounded-lg bg-amber-50 border border-amber-100 p-3">
                            <p class="text-gray-500">Sisa minggu</p>
                            <p class="font-bold text-amber-700">34 minggu</p>
                        </div>
                        <div class="rounded-lg bg-gray-50 border border-gray-200 p-3">
                            <p class="text-gray-500">Status</p>
                            <p class="font-bold text-gray-800">Program berjalan</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-[#c7ddd4] bg-[#e8f3ef] p-5 md:p-6">
                <p class="text-xs tracking-[0.12em] uppercase font-bold text-emerald-700 mb-3">Peringatan Penting</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="rounded-lg bg-white border border-[#dce9e3] p-3">Tidak ada bunga atau janji keuntungan. Program ini fokus membangun kebiasaan menabung.</li>
                    <li class="rounded-lg bg-white border border-[#dce9e3] p-3">Semua setoran dicatat per minggu oleh staff, lalu bisa dipantau owner secara transparan.</li>
                    <li class="rounded-lg bg-white border border-[#dce9e3] p-3">Jika ada kendala pembayaran, pengguna wajib konfirmasi lebih awal ke staff pengampu.</li>
                </ul>
            </section>

        </div>
    </main>

</body>
</html>
