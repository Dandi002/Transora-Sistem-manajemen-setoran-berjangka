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
    <body class="bg-white font-sans antialiased overflow-x-hidden">
        
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
                    <a href="#" class="text-gray-900 hover:text-primary transition-colors font-medium">Layanan</a>
                    <a href="#" class="text-gray-900 hover:text-primary transition-colors font-medium">Produk</a>
                    <a href="#" class="text-gray-900 hover:text-primary transition-colors font-medium">Edukasi</a>
                    <a href="#" class="text-gray-900 hover:text-primary transition-colors font-medium">Kontak</a>
                </div>
                
                <button class="bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-secondary transition-all duration-300 hover:scale-105 shadow-lg">
                    Mulai Sekarang
                </button>
            </div>
        </nav>
        
        <!-- Hero Section -->
        <section class="relative px-6 lg:px-12 pt-16 pb-28 texture">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        
                        
                        <h1 class="font-display font-bold text-6xl lg:text-7xl leading-tight text-gray-900 opacity-0 animate-slide-up delay-100">
                            Setor Sedikit.
                            <span class="block gradient-text mt-2">Konsisten Lebih Penting.</span>
                        </h1>
                        
                        <p class="text-xl text-gray-600 leading-relaxed max-w-xl opacity-0 animate-slide-up delay-200">
                            Layanan setoran berjangka yang membantu kamu menabung secara rutin,
                            tercatat otomatis, dan transparan dari awal hingga akhir periode.   
                        </p>
                        
                        <div class="flex flex-wrap gap-4 opacity-0 animate-slide-up delay-300">
                            <button class="bg-primary text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-secondary transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                                Mulai Setoran
                            </button>
                            
                        </div>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="relative opacity-0 animate-slide-right delay-200">
                        <div class="relative">
                            <!-- Main Image Container -->
                            <div class="relative bg-gradient-to-br from-accent to-primary p-1 rounded-[3rem] shadow-2xl hover-lift">
                                <div class="bg-gray-50 rounded-[2.9rem] p-12 h-[600px] flex items-center justify-center overflow-hidden">
                                    <!-- Finance Dashboard Mockup -->
                                    <div class="relative w-full">
                                        <div class="bg-white rounded-3xl p-8 shadow-2xl">
                                            <div class="text-center space-y-6">
                                                <!-- Balance Card -->
                                                <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white">
                                                    <div class="text-sm opacity-90 mb-2">Total Saldo</div>
                                                    <div class="font-display text-4xl font-bold">Rp 45.750.000</div>
                                                    <div class="flex justify-between mt-4 text-sm">
                                                        <span>Periode berjalan</span>
                                                        <span>💹</span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Quick Stats -->
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="bg-gray-50 rounded-xl p-4 text-left">
                                                        <div class="text-xs text-gray-500 mb-1">Tabungan</div>
                                                        <div class="font-bold text-gray-900">Rp 30.5 Jt</div>
                                                    </div>
                                                    <div class="bg-gray-50 rounded-xl p-4 text-left">
                                                        <div class="text-xs text-gray-500 mb-1">Investasi</div>
                                                        <div class="font-bold text-gray-900">Rp 15.2 Jt</div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Action Buttons -->
                                                <div class="grid grid-cols-3 gap-3">
                                                    <button class="bg-primary/10 text-primary rounded-xl p-3 text-xs font-semibold hover:bg-primary/20 transition">
                                                        Setor
                                                    </button>
                                                    <button class="bg-primary/10 text-primary rounded-xl p-3 text-xs font-semibold hover:bg-primary/20 transition">
                                                        Tarik
                                                    </button>
                                                    <button class="bg-primary/10 text-primary rounded-xl p-3 text-xs font-semibold hover:bg-primary/20 transition">
                                                        Kirim
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Floating Elements -->
                                        <div class="absolute -top-4 -right-4 bg-accent/80 text-white rounded-2xl p-3 shadow-lg animate-float">
                                        <div class="text-xs font-semibold">Setoran Masuk</div>
                                        <div class="text-xs opacity-80">Minggu ke-5</div>
                                        </div>
                                        <div class="absolute -bottom-4 -left-4 bg-secondary/80 text-white rounded-2xl p-3 shadow-lg animate-float" style="animation-delay: 1.5s;">
                                            <div class="text-xs font-semibold">📅 12 Minggu</div>
                                            <div class="text-xs opacity-80">Periode</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Floating Elements -->
                            <div class="absolute -top-8 -left-8 w-24 h-24 bg-accent/30 rounded-2xl shadow-lg animate-float flex items-center justify-center" style="animation-delay: 2s;">
                                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary/10 rounded-full shadow-lg animate-float flex items-center justify-center" style="animation-delay: 3s;">
                                <svg class="w-16 h-16 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="relative px-6 lg:px-12 py-24 bg-gradient-to-b from-white to-gray-50">
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
        <div class="mt-10 flex justify-end">
            <img src="/img/mockup-app.png"
                alt="Dashboard Setoran"
                class="w-48 md:w-56">
        </div>
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

            <a href="#"
            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 border-b border-gray-900 w-fit">
            Baca Ketentuan
            <span>→</span>
            </a>
        </div>

        <!-- Image -->
        <div class="mt-10 flex justify-end">
            <img src="/img/mockup-period.png"
                alt="Periode 12 Bulan"
                class="w-48 md:w-56">
        </div>
        </div>
    
    </div>
    </section>

        
        <!-- CTA Section -->
        <section class="relative px-6 lg:px-12 py-32 bg-gradient-to-br from-primary via-secondary to-primary overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
            </div>
            
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="font-display text-5xl lg:text-6xl font-bold text-white mb-8">
                    Mulai Perjalanan Finansial Anda
                </h2>
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Bergabunglah dengan jutaan pengguna yang sudah meraih tujuan finansial mereka. Daftar sekarang dan dapatkan bonus hingga Rp 100.000!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-xl mx-auto">
                    <input 
                        type="email" 
                        placeholder="Masukkan email Anda" 
                        class="flex-1 px-8 py-4 rounded-full text-gray-900 focus:outline-none focus:ring-2 focus:ring-accent"
                    />
                    <button class="bg-white text-primary px-10 py-4 rounded-full font-bold hover:bg-accent hover:text-white transition-all duration-300 hover:scale-105 shadow-2xl">
                        Daftar Gratis
                    </button>
                </div>
                <p class="mt-6 text-sm text-white/70">Gratis tanpa biaya admin. Terdaftar & diawasi OJK.</p>
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
                            Platform keuangan digital terpercaya yang membantu Anda mencapai kebebasan finansial. Terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK).
                        </p>
                        <div class="mt-6 flex gap-4">
                            <div class="bg-white/10 rounded-lg px-4 py-2">
                                <div class="text-xs text-white/60">Terdaftar di</div>
                                <div class="font-bold text-sm">OJK</div>
                            </div>
                            <div class="bg-white/10 rounded-lg px-4 py-2">
                                <div class="text-xs text-white/60">Dijamin</div>
                                <div class="font-bold text-sm">LPS</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                    
                    </div>
                    
                    <div>
                        <h4 class="font-bold text-lg mb-4">Perusahaan</h4>
                        <ul class="space-y-3 text-white/70">
                            <li><a href="#" class="hover:text-accent transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Karir</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Blog</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Hubungi Kami</a></li>
                        </ul>
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