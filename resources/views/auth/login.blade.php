<x-guest-layout>
    <div class="flex justify-center bg-gray-50 px-4 py-24">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl grid md:grid-cols-2 overflow-hidden">

            <div class="hidden md:flex flex-col items-center justify-center px-12 py-16 bg-gradient-to-br from-emerald-200 via-teal-50 to-cyan-200">
                <div class="mb-10 text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3 text-left self-start">
                        Transora
                    </h1>
                    <p class="text-gray-600 max-w-sm text-left self-start">
                        Sistem setoran berjangka 12 bulan yang aman & transparan
                    </p>
                </div>

                <img
                    src="storage/img/logo.png"
                    alt="Ilustrasi Transora"
                    class="w-72 max-w-full mb-12"
                />

                <p class="text-xs text-gray-500 text-center max-w-xs">
                    Kami membantu membangun kebiasaan menabung, bukan menjanjikan keuntungan.
                </p>
            </div>

            <div class="px-8 py-14 md:px-12 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Masuk ke akun kamu
                </h2>

                <p class="text-gray-600 mb-8">
                    Kelola setoran berjangka kamu dengan aman
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com"
                            class="mt-1"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Kata Sandi" />
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                            class="mt-1"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label for="remember_me" class="inline-flex items-center gap-2">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                                name="remember">
                            <span class="text-gray-600">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                            class="text-emerald-700 font-medium hover:underline">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full bg-emerald-700 text-white py-3 rounded-xl font-semibold hover:bg-emerald-800 transition">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
