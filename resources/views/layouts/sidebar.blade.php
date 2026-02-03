<nav class="flex-1 p-4 space-y-6 overflow-y-auto">

    <!-- ================= MAIN ================= -->
    <div>
        <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
            Main
        </p>

        <a href="{{ route('dashboard') }}"
           class="flex items-center space-x-3 px-4 py-3
                  bg-gradient-to-r from-orange-400 to-orange-500
                  text-white rounded-lg shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2 7-7 7 7M5 10v10a1 1 0 001 1h3"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
    </div>

    <!-- ================= OWNER ================= -->
    @if(auth()->user()->role === 'owner')
        <div>
            <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
                Master Data
            </p>

            <a href="{{ route('users.index') }}"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4v10l8 4 8-4V7z"/>
                </svg>
                <span class="font-medium">Users</span>
            </a>
        </div>

        <div>
            <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
                Laporan
            </p>

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6"/>
                </svg>
                <span class="font-medium">Reports</span>
            </a>
        </div>
    @endif

    <!-- ================= ADMIN ================= -->
    @if(auth()->user()->role === 'admin')
        <div>
            <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
                Transaksi
            </p>

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 11V7a4 4 0 00-8 0v4"/>
                </svg>
                <span class="font-medium">Orders</span>
            </a>

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857"/>
                </svg>
                <span class="font-medium">Customers</span>
            </a>
        </div>
    @endif

    <!-- ================= SELLER ================= -->
    @if(auth()->user()->role === 'seller')
        <div>
            <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
                Transaksi
            </p>

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 11V7a4 4 0 00-8 0v4"/>
                </svg>
                <span class="font-medium">Orders</span>
            </a>
        </div>
    @endif

    <!-- ================= USER ================= -->
    @if(auth()->user()->role === 'user')
        <div>
            <p class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">
                User Menu
            </p>

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 12a5 5 0 100-10 5 5 0 000 10Z"/>
                </svg>
                <span class="font-medium">Profile</span>
            </a>
        </div>
    @endif

</nav>
