@extends('layouts.app')

@section('content')


<div class="flex justify-between items-center mb-4 mt-8">
    
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Users Management
    </h2>

    <a href="{{ route('owner.users.create') }}"
       class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
        + Tambah User
    </a>

</div>

<div class="mb-6 p-4 rounded-lg bg-white dark:bg-gray-800 shadow-xs">
    <div class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Mulai Setoran Global</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Atur tanggal mulai program untuk semua pengguna sekaligus.
            </p>
        </div>
        <div class="flex flex-col gap-3 xl:items-end">
            <form action="{{ route('owner.settings.global-saving-start') }}" method="POST" class="flex flex-wrap items-center gap-2">
                @csrf
                <input
                    type="date"
                    name="global_saving_started_at"
                    value="{{ $globalSavingStartedAt }}"
                    class="px-4 py-2.5 text-sm rounded-xl border border-gray-300 bg-white text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                >
                <button
                    type="submit"
                    class="px-4 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-xl hover:bg-green-700"
                >
                    {{ $globalSavingStartedAt ? 'Ubah Tanggal Mulai' : 'Mulai Setoran Global' }}
                </button>
            </form>

            <form action="{{ route('owner.users.reset-deposits') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    onclick="return confirm('Reset semua setoran, transaksi, dan riwayat untuk testing? Data pembayaran akan kembali dari awal.')"
                    class="px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700"
                >
                    Reset Semua Setoran
                </button>
            </form>
        </div>
    </div>
</div>

<div class="w-full overflow-hidden rounded-lg shadow-xs bg-white dark:bg-gray-800">
    <div class="w-full overflow-x-auto">

        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                @foreach ($users as $user)
                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                    {{-- USER + AVATAR --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div
                                class="relative w-8 h-8 mr-3 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ ucfirst($user->role) }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- EMAIL --}}
                    <td class="px-4 py-3 text-sm">
                        {{ $user->email }}
                    </td>

                    {{-- ROLE BADGE --}}
                    <td class="px-4 py-3 text-xs">
                        @php
                            $roleClass = match ($user->role) {
                                'staff' => 'text-blue-700 bg-blue-100',
                                'owner' => 'text-purple-700 bg-purple-100',
                                default => 'text-gray-700 bg-gray-100',
                            };
                        @endphp

                        <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $roleClass }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    {{-- STATUS TOGGLE --}}
                    <td class="px-4 py-3 text-xs">
                        <label class="inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                class="sr-only peer toggle-active"
                                data-id="{{ $user->id }}"
                                data-url="{{ route('owner.users.toggle-active', $user->id) }}"
                                {{ $user->is_active ? 'checked' : '' }}
                                {{ $user->role === 'owner' ? 'disabled' : '' }}
                            >

                            <div
                                class="relative w-9 h-5 bg-gray-300 rounded-full
                                peer-checked:bg-green-500
                                after:content-['']
                                after:absolute after:top-[2px] after:start-[2px]
                                after:bg-white after:h-4 after:w-4
                                after:rounded-full after:transition-all
                                peer-checked:after:translate-x-full">
                            </div>

                            <span class="ms-2 text-xs font-medium status-text">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </label>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                                <a href="{{ route('owner.users.edit', $user) }}"
                                   class="text-purple-600 hover:text-purple-800 dark:hover:text-purple-400 font-semibold">
                                    Edit
                                </a>

                                <form action="{{ route('owner.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus user ini?')"
                                        class="text-red-600 hover:text-red-800 dark:hover:text-red-400 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                        </div>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-active').forEach((checkbox) => {
        checkbox.addEventListener('change', async function () {
            const label = this.closest('label');
            const statusText = label ? label.querySelector('.status-text') : null;
            const originalState = !this.checked;

            try {
                const response = await fetch(this.dataset.url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    this.checked = originalState;
                    alert(data.message || 'Gagal mengubah status user');
                    return;
                }

                if (statusText) {
                    statusText.textContent = data.status ? 'Aktif' : 'Nonaktif';
                }
            } catch (error) {
                this.checked = originalState;
                alert('Terjadi kesalahan jaringan saat mengubah status');
            }
        });
    });
});
</script>

@endsection
