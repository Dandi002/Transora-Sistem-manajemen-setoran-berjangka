<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sistem Transora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="bg-white font-sans antialiased overflow-x-hidden">

    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-10 right-20 w-96 h-96 bg-green-300/20 organic-blob animate-float"></div>
        <div class="absolute bottom-20 left-10 w-80 h-80 bg-emerald-400/20 organic-blob animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-teal-300/20 organic-blob animate-float" style="animation-delay: 5s;"></div>
    </div>

    <nav class="sticky top-0 z-50 px-6 lg:px-12 py-5 bg-white/95 backdrop-blur-md shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-700 rounded-full flex items-center justify-center text-white font-bold">T</div>
                <span class="text-2xl font-bold text-gray-900">Transora</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-emerald-700 hover:underline">Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="px-6 lg:px-12 py-14">
        <div class="max-w-6xl mx-auto space-y-10">

            <section class="rounded-[2rem] bg-gradient-to-br from-emerald-100 to-cyan-200 p-8 md:p-10 shadow-lg">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-lg font-semibold text-gray-900 mb-4">Transora</p>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-5">Cara Kerja Setora</h1>
                        <p class="text-gray-700 text-lg leading-relaxed max-w-xl">
                            Program setoran berjangka 52 minggu untuk membantu pengguna menabung rutin, tercatat otomatis, dan transparan dari awal hingga akhir periode.
                        </p>
                    </div>
                    <div class="flex justify-center md:justify-end">
                        <img src="/img/mockup-app.png" alt="Dashboard Setoran" class="w-56 md:w-72">
                    </div>
                </div>
            </section>

            <section class="grid md:grid-cols-3 gap-5">
                <div class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
                    <p class="text-sm text-gray-500 mb-2">Periode</p>
                    <p class="text-3xl font-bold text-gray-900">52 Minggu</p>
                    <p class="text-sm text-gray-600 mt-2">Tetap dan tidak berubah.</p>
                </div>
                <div class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
                    <p class="text-sm text-gray-500 mb-2">Pemantauan</p>
                    <p class="text-3xl font-bold text-gray-900">Mingguan</p>
                    <p class="text-sm text-gray-600 mt-2">Setiap setoran dicatat per minggu.</p>
                </div>
                <div class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
                    <p class="text-sm text-gray-500 mb-2">Distribusi</p>
                    <p class="text-3xl font-bold text-gray-900">Maks 50</p>
                    <p class="text-sm text-gray-600 mt-2">Maksimal pengguna per staff.</p>
                </div>
            </section>

            <section class="rounded-2xl bg-white border border-gray-200 p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Alur Sistem Transora</h2>
                <div class="grid md:grid-cols-2 gap-5">
                    <div class="p-5 rounded-xl bg-gray-50">
                        <p class="font-semibold text-gray-900 mb-2">1. Pengguna daftar</p>
                        <p class="text-sm text-gray-600">Pengguna mendaftar, memilih paket setoran mingguan, lalu akun masuk status pending.</p>
                    </div>
                    <div class="p-5 rounded-xl bg-gray-50">
                        <p class="font-semibold text-gray-900 mb-2">2. Sistem assign staff otomatis</p>
                        <p class="text-sm text-gray-600">Sistem memilih staff dengan beban paling rendah dengan batas maksimal 50 pengguna per staff.</p>
                    </div>
                    <div class="p-5 rounded-xl bg-gray-50">
                        <p class="font-semibold text-gray-900 mb-2">3. Monitoring setoran 52 minggu</p>
                        <p class="text-sm text-gray-600">Staff menandai setoran setiap minggu pada tabel monitoring sehingga progres tiap pengguna terlihat jelas.</p>
                    </div>
                    <div class="p-5 rounded-xl bg-gray-50">
                        <p class="font-semibold text-gray-900 mb-2">4. Owner kontrol penuh</p>
                        <p class="text-sm text-gray-600">Owner mengelola akun, memantau distribusi staff, dan mengatur master paket setoran.</p>
                    </div>
                </div>
            </section>

            <section class="rounded-2xl bg-white border border-gray-200 p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pilihan Paket Setoran Mingguan</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-3 pr-4 text-sm text-gray-500">Paket</th>
                                <th class="py-3 pr-4 text-sm text-gray-500">Nominal / Minggu</th>
                                <th class="py-3 pr-4 text-sm text-gray-500">Estimasi 52 Minggu</th>
                                <th class="py-3 text-sm text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <tr class="border-b"><td class="py-3 pr-4 font-medium">Paket 25rb</td><td class="py-3 pr-4">Rp 25.000</td><td class="py-3 pr-4">Rp 1.300.000</td><td class="py-3">Aktif</td></tr>
                            <tr class="border-b"><td class="py-3 pr-4 font-medium">Paket 50rb</td><td class="py-3 pr-4">Rp 50.000</td><td class="py-3 pr-4">Rp 2.600.000</td><td class="py-3">Aktif</td></tr>
                            <tr class="border-b"><td class="py-3 pr-4 font-medium">Paket 75rb</td><td class="py-3 pr-4">Rp 75.000</td><td class="py-3 pr-4">Rp 3.900.000</td><td class="py-3">Aktif</td></tr>
                            <tr><td class="py-3 pr-4 font-medium">Paket 100rb</td><td class="py-3 pr-4">Rp 100.000</td><td class="py-3 pr-4">Rp 5.200.000</td><td class="py-3">Aktif</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-sm text-gray-500 mt-4">Catatan: Owner dapat menambah, menonaktifkan, atau menghapus paket melalui menu Master Paket.</p>
            </section>

            <section class="rounded-2xl bg-gray-900 text-white p-8">
                <h2 class="text-2xl font-bold mb-4">Transparan dari Awal Sampai Akhir</h2>
                <p class="text-gray-300 leading-relaxed">
                    Transora tidak menjanjikan keuntungan. Fokus sistem adalah membantu konsistensi menabung melalui setoran mingguan yang tercatat jelas, dapat dipantau owner dan staff, serta memiliki aturan operasional yang tegas dan terukur.
                </p>
            </section>

        </div>
    </main>

</body>
</html>
