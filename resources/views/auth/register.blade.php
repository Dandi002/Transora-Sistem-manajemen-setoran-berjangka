<x-guest-layout>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    {{-- Global Error --}}
    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full"
                type="text"
                name="phone"
                :value="old('phone')"
                required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" class="block mt-1 w-full"
                type="text"
                name="alamat"
                :value="old('alamat')"
                required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Paket Setoran -->
        <div class="mt-4">
            <x-input-label for="saving_plan_id" :value="__('Paket Setoran')" />
            <select id="saving_plan_id" name="saving_plan_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">{{ __('Pilih paket setoran') }}</option>
                @foreach (($savingPlans ?? collect()) as $plan)
                    <option value="{{ $plan->id }}" @selected((string) old('saving_plan_id') === (string) $plan->id)>
                        {{ $plan->name }} - Rp {{ number_format($plan->weekly_amount, 0, ',', '.') }}/minggu
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('saving_plan_id')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
