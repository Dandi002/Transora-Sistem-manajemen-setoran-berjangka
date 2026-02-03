<header class="bg-white shadow-sm border-b border-gray-200
               sticky top-0 z-50">
    <div class="flex items-center justify-between px-8 py-4">

        <!-- Left: Title -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Overview
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Selamat datang kembali, {{ auth()->user()->name }}!
            </p>
        </div>

        <!-- Right -->
        <div class="flex items-center space-x-4">

            <!-- Search -->
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <!-- Notification -->
            <button class="relative p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                             a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341
                             C7.67 6.165 6 8.388 6 11v3.159
                             c0 .538-.214 1.055-.595 1.436L4 17h5
                             m6 0v1a3 3 0 11-6 0v-1"/>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-orange-500 rounded-full"></span>
            </button>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg
                               hover:bg-gray-100 transition">
                    <div class="bg-gradient-to-br from-orange-400 to-orange-500
                                w-9 h-9 rounded-full flex items-center justify-center
                                text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border">

                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
    