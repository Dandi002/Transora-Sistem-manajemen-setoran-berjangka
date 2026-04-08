<x-guest-layout>
    <div class="flex justify-center bg-gray-50 px-4 py-24">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl grid md:grid-cols-2 overflow-hidden">

            <!-- LEFT: BRANDING -->
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

            <!-- RIGHT: REGISTER FORM -->
            <div class="px-8 py-14 md:px-10 flex flex-col justify-center">

                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Daftar Akun
                </h2>

                <p class="text-gray-600 mb-8">
                    Mulai perjalanan menabung kamu bersama kami
                </p>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                        {{ implode(', ', $errors->all()) }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" />
                        <x-text-input
                            id="name"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            placeholder="Masukkan nama lengkap"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="nama@email.com"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="Nomor HP" />
                        <x-text-input
                            id="phone"
                            type="text"
                            name="phone"
                            :value="old('phone')"
                            required
                            placeholder="08xxxxxxxxxx"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="saving_plan_id" value="Paket Setoran Mingguan" />
                        <select
                            id="saving_plan_id"
                            name="saving_plan_id"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        >
                            <option value="">Pilih paket setoran</option>
                            @foreach (($savingPlans ?? collect()) as $plan)
                                <option value="{{ $plan->id }}" @selected((string) old('saving_plan_id') === (string) $plan->id)>
                                    {{ $plan->name }} - Rp {{ number_format($plan->weekly_amount, 0, ',', '.') }}/minggu
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('saving_plan_id')" class="mt-2" />
                    </div>
                    </div>

                    <div>
                        <x-input-label for="alamat" value="Alamat Lengkap" />
                        <textarea
                            id="alamat"
                            name="alamat"
                            rows="2"
                            required
                            placeholder="Masukkan alamat lengkap"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600 shadow-sm resize-none"
                        >{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="password" value="Kata Sandi" />
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 6 karakter"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Ulangi Kata Sandi" />
                        <x-text-input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi kata sandi"
                            class="block mt-1 w-full rounded-xl bg-white border-gray-300 focus:border-emerald-600 focus:ring-emerald-600"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-emerald-700 text-white py-3 rounded-xl font-semibold hover:bg-emerald-800 transition">
                        Daftar
                    </button>
                </form>

                

            </div>
        </div>
    </div>
</x-guest-layout>
