@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4 mt-8">
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Master Paket</h2>

    <a href="{{ route('owner.saving-plans.create') }}"
       class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
        + Tambah Paket
    </a>
</div>

@if (session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-full overflow-hidden rounded-lg shadow-xs bg-white dark:bg-gray-800">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Nominal Mingguan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($plans as $plan)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">{{ $plan->name }}</td>
                        <td class="px-4 py-3 text-sm">Rp {{ number_format($plan->weekly_amount, 0, ',', '.') }}/minggu</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $plan->is_active ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-700 bg-gray-100 dark:bg-gray-600 dark:text-gray-100' }}">
                                {{ $plan->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('owner.saving-plans.edit', $plan) }}"
                                   class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold text-purple-700 bg-purple-100 hover:bg-purple-200 dark:text-purple-100 dark:bg-purple-700 dark:hover:bg-purple-600">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('owner.saving-plans.toggle-active', $plan) }}">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold {{ $plan->is_active ? 'text-yellow-800 bg-yellow-100 hover:bg-yellow-200 dark:text-yellow-100 dark:bg-yellow-700 dark:hover:bg-yellow-600' : 'text-green-800 bg-green-100 hover:bg-green-200 dark:text-green-100 dark:bg-green-700 dark:hover:bg-green-600' }}"
                                            onclick="return confirm('Ubah status paket ini?')">
                                        {{ $plan->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('owner.saving-plans.destroy', $plan) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold text-red-800 bg-red-100 hover:bg-red-200 dark:text-red-100 dark:bg-red-700 dark:hover:bg-red-600"
                                            onclick="return confirm('Hapus paket ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Belum ada paket setoran
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $plans->links() }}
</div>

@endsection
