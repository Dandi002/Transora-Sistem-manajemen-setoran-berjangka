@extends('layouts.app')

@section('content')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Edit User
</h2>

<div class="w-full max-w-5xl px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('owner.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Name</span>
            <input
                type="text"
                name="name"
                required
                value="{{ old('name', $user->name) }}"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Masukkan Nama"
            />
        </label>

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input
                type="email"
                name="email"
                required
                value="{{ old('email', $user->email) }}"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="email@domain.com"
            />
        </label>

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input
                type="password"
                name="password"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Kosongkan jika tidak diubah"
            />
        </label>

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Role</span>
            <select
                name="role"
                id="role"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600
                       dark:bg-gray-700 form-select focus:border-purple-400
                       focus:outline-none focus:shadow-outline-purple
                       dark:focus:shadow-outline-gray"
            >
                <option value="owner" @selected(old('role', $user->role) === 'owner')>Owner</option>
                <option value="staff" @selected(old('role', $user->role) === 'staff')>Staff</option>
                <option value="pengguna" @selected(old('role', $user->role) === 'pengguna')>Pengguna</option>
            </select>
        </label>

        <label id="saving-plan-wrapper" class="block mt-4 text-sm {{ old('role', $user->role) === 'pengguna' ? '' : 'hidden' }}">
            <span class="text-gray-700 dark:text-gray-400">Paket Setoran</span>
            <select
                name="saving_plan_id"
                id="saving_plan_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600
                       dark:bg-gray-700 form-select focus:border-purple-400
                       focus:outline-none focus:shadow-outline-purple
                       dark:focus:shadow-outline-gray"
            >
                <option value="">Pilih paket setoran</option>
                @foreach ($savingPlans as $plan)
                    <option value="{{ $plan->id }}" @selected((string) old('saving_plan_id', $user->saving_plan_id) === (string) $plan->id)>
                        {{ $plan->name }} - Rp {{ number_format($plan->weekly_amount, 0, ',', '.') }}/minggu
                    </option>
                @endforeach
            </select>
        </label>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('owner.users.index') }}"
               class="px-4 py-2 text-sm font-medium leading-5 text-gray-600
                      transition-colors duration-150 border border-gray-300 rounded-lg
                      hover:border-gray-500 focus:outline-none focus:shadow-outline-gray">
                Batal
            </a>

            <button type="submit"
                class="px-4 py-2 text-sm font-medium leading-5 text-white
                       transition-colors duration-150 bg-purple-600
                       border border-transparent rounded-lg
                       hover:bg-purple-700 focus:outline-none
                       focus:shadow-outline-purple">
                Update
            </button>
        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const roleSelect = document.getElementById('role');
    const wrapper = document.getElementById('saving-plan-wrapper');

    if (!roleSelect || !wrapper) {
        return;
    }

    const toggleSavingPlan = () => {
        if (roleSelect.value === 'pengguna') {
            wrapper.classList.remove('hidden');
            return;
        }

        wrapper.classList.add('hidden');
    };

    roleSelect.addEventListener('change', toggleSavingPlan);
    toggleSavingPlan();
});
</script>

@endsection
