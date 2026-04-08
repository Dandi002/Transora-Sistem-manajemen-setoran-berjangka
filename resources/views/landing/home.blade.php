    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transora - Setoran Berjangka Transparan & Aman</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
    
        
        <link rel="stylesheet" href="css/landing.css">
    </head>
    <body class="bg-white font-sans antialiased overflow-x-hidden" style="scroll-behavior:smooth;">
        
        <!-- Background Decorative Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-10 right-20 w-96 h-96 bg-accent/10 organic-blob animate-float"></div>
            <div class="absolute bottom-20 left-10 w-80 h-80 bg-secondary/10 organic-blob animate-float" style="animation-delay: 3s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-primary/5 organic-blob animate-float" style="animation-delay: 5s;"></div>
        </div>
            
        <!-- Navigation - STICKY -->
        <nav class="sticky top-0 z-50 px-6 lg:px-12 py-6 animate-fade-in bg-white/95 backdrop-blur-md shadow-sm">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="font-display text-3xl font-bold text-gray-900">
                        Transora
                    </div>
                </div>
                
                <div class="hidden md:flex gap-10 items-center">
                    <a href="#tentang" class="text-gray-900 hover:text-primary transition-colors font-medium">Tentang</a>
                    <a href="#faq" class="text-gray-900 hover:text-primary transition-colors font-medium">FAQ</a>
                </div>
                
                <a href="{{ route('register') }}" class="inline-flex items-center bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-secondary transition-all duration-300 hover:scale-105 shadow-lg">
                    Mulai Sekarang
                </a>
            </div>
        </nav>
        
                <!-- Hero Section -->
        <section class="relative px-6 lg:px-12 pt-16 pb-28 texture">
            <div class="max-w-5xl mx-auto text-center">
                <div class="space-y-8">
                    <h1 class="font-display font-bold text-5xl lg:text-7xl leading-tight text-gray-900 opacity-0 animate-slide-up delay-100">
                        Setor Sedikit.
                        <span class="block gradient-text mt-2">Konsisten Lebih Penting.</span>
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto opacity-0 animate-slide-up delay-200">
                        Layanan setoran berjangka yang membantu kamu menabung secara rutin, tercatat otomatis, dan transparan dari awal hingga akhir periode.
                    </p>

                    <div class="flex justify-center opacity-0 animate-slide-up delay-300">
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-primary text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-secondary transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            Mulai Setoran
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section id="tentang" class="relative px-6 lg:px-12 py-24 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <span class="text-primary font-bold text-sm tracking-widest uppercase">Keunggulan Kami</span>
                    <h2 class="font-display text-5xl lg:text-6xl font-bold text-gray-900 mt-4">Kenapa Transora?</h2>
                    <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                        Solusi keuangan lengkap dengan keamanan dan kemudahan terbaik
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="bg-white rounded-3xl p-10 shadow-lg hover-lift group texture">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-gray-900 mb-4">Transparan & Terkendali </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Aturan jelas sejak awal. Tidak ada janji keuntungan,
    tidak ada risiko tersembunyi.</p>
                    </div>
                    
                    <!-- Feature Card 2 -->
                    <div class="bg-white rounded-3xl p-10 shadow-lg hover-lift group texture">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent to-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-gray-900 mb-4">Setoran 12 Bulan</h3>
                        <p class="text-gray-600 leading-relaxed">Satu periode setoran selama 12 bulan untuk membangun kebiasaan menabung
    yang konsisten dan terencana.</p>
                    </div>
                    
                    <!-- Feature Card 3 -->
                    <div class="bg-white rounded-3xl p-10 shadow-lg hover-lift group texture">
                        <div class="w-16 h-16 bg-gradient-to-br from-secondary to-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-gray-900 mb-4">Tercatat Otomatis</h3>
                        <p class="text-gray-600 leading-relaxed">Setiap setoran langsung tercatat di sistem dan dapat dipantau kapan saja
    selama periode berjalan.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Products Preview Section -->
        <section class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Card 1 -->
        <div class="rounded-3xl p-10 bg-gradient-to-br from-emerald-100 to-cyan-200 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2 mb-6">
            <span class="text-lg font-semibold">Transora</span>
            </div>

            <h3 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
            Cara kerja Setora
            </h3>

            <p class="text-gray-700 mb-6 max-w-md">
            Program setoran berjangka 12 bulan untuk membantu kamu
            menabung secara rutin, tercatat otomatis, dan transparan              
            dari awal hingga akhir.
            </p>

            <a href="{{ route('detail-sistem') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 border-b border-gray-900 w-fit">
            Lihat Detail Sistem
            <span>→</span>
            </a>
        </div>

        <!-- Image -->
        
        </div>

        <!-- Card 2 -->
        <div class="rounded-3xl p-10 bg-gradient-to-br from-green-100 to-slate-100 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2 mb-6">
            <span class="text-lg font-semibold">Transora</span>
            </div>

            <h3 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
            Aturan jelas sejak awal 
            </h3>

            <p class="text-gray-700 mb-6 max-w-md">
            Periode ditetapkan 12 bulan sejak pendaftaran.
    Tidak ada bunga, tidak ada janji keuntungan.
    Semua ketentuan dijelaskan di awal secara transparan.

            </p>

            <a href="{{ route('ketentuan') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 border-b border-gray-900 w-fit">
            Baca Ketentuan
            <span>→</span>
            </a>
        </div>

        <!-- Image -->
        
        </div>
    
    </div>
    </section>

        
        <!-- FAQ Section -->
        <section id="faq" class="relative px-6 lg:px-12 py-24 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <span class="text-primary font-bold text-sm tracking-widest uppercase">FAQ</span>
                    <h2 class="font-display text-4xl lg:text-5xl font-bold text-gray-900 mt-4">Pertanyaan yang Sering Ditanyakan</h2>
                    <p class="text-gray-600 mt-4 text-lg">
                        Jawaban singkat seputar sistem setoran Transora.
                    </p>
                </div>

                <div class="space-y-4">
                    <details class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <summary class="flex cursor-pointer list-none items-center justify-between text-lg font-semibold text-gray-900">
                            Dana bisa ditarik kapan?
                            <span class="text-primary transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-3 text-gray-600 leading-relaxed">
                            Dana hanya bisa ditarik setelah periode 52 minggu (12 bulan) selesai sesuai ketentuan program.
                        </p>
                    </details>

                    <details class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <summary class="flex cursor-pointer list-none items-center justify-between text-lg font-semibold text-gray-900">
                            Kalau telat setor bagaimana?
                            <span class="text-primary transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-3 text-gray-600 leading-relaxed">
                            Keterlambatan akan tercatat di monitoring. Jika menunggak 5 minggu berturut-turut, program dapat dihentikan otomatis.
                        </p>
                    </details>

                    <details class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <summary class="flex cursor-pointer list-none items-center justify-between text-lg font-semibold text-gray-900">
                            Bisa ganti nominal paket di tengah periode?
                            <span class="text-primary transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-3 text-gray-600 leading-relaxed">
                            Tidak. Nominal paket mengikuti pilihan saat daftar, dan perubahan bisa dilakukan saat memulai periode baru.
                        </p>
                    </details>

                    <details class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <summary class="flex cursor-pointer list-none items-center justify-between text-lg font-semibold text-gray-900">
                            Apa Transora memberikan bunga/keuntungan?
                            <span class="text-primary transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-3 text-gray-600 leading-relaxed">
                            Tidak ada janji bunga atau keuntungan. Fokus Transora adalah membantu kebiasaan menabung terstruktur dan transparan.
                        </p>
                    </details>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="font-display text-3xl font-bold">Transora</div>
                        </div>
                        <p class="text-white/70 max-w-md leading-relaxed">
                            Platform keuangan digital terpercaya yang membantu Anda mencapai kebebasan finansial. 
                        </p>
                    
                    </div>
                    
                    <div>
                    
                    </div>
                    
                  
                </div>
                
                <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-white/60">© 2024 Transora. Semua hak dilindungi. 🇮🇩</p>
                    <div class="flex gap-6 text-white/60">
                        <a href="#" class="hover:text-accent transition-colors">Privasi</a>
                        <a href="#" class="hover:text-accent transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="hover:text-accent transition-colors">FAQ</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="/js/landing.js"></script>
    </body>
    </html>

