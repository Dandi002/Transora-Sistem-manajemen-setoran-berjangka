@extends('layouts.app')

@section('content')
@php
    $currentWeekNum = now()->weekOfYear;
@endphp

<div class="my-6 flex items-center justify-between gap-3">
    <div>
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Detail Staff - {{ $staff->name }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $staff->email }}
        </p>
    </div>
    <a href="{{ route('owner.staff.index') }}"
       class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
        Kembali
    </a>
</div>

<div class="mb-6 rounded-lg bg-white p-4 shadow-xs dark:bg-gray-800">
    <div class="flex items-center justify-between gap-2">
        <p class="text-sm text-gray-600 dark:text-gray-400">Kapasitas Staff</p>
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-100">
            {{ $stats['total_assigned'] }} / {{ $stats['capacity_limit'] }} pengguna
        </p>
    </div>
    <div class="mt-2 h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
        <div class="h-2.5 rounded-full {{ $stats['capacity_percent'] >= 90 ? 'bg-red-500' : ($stats['capacity_percent'] >= 70 ? 'bg-yellow-500' : 'bg-green-500') }}"
             style="width: {{ $stats['capacity_percent'] }}%"></div>
    </div>
    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
        Sisa slot: {{ $stats['remaining_capacity'] }} pengguna
    </p>
</div>

<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-lg bg-white p-4 shadow-xs dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Pengguna</p>
        <p class="mt-1 text-2xl font-semibold text-gray-700 dark:text-gray-100">{{ $stats['total_assigned'] }}</p>
    </div>
    <div class="rounded-lg bg-white p-4 shadow-xs dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Rata-rata Progress</p>
        <p class="mt-1 text-2xl font-semibold text-gray-700 dark:text-gray-100">{{ $stats['avg_progress'] }}%</p>
    </div>
    <div class="rounded-lg bg-white p-4 shadow-xs dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">Perlu Perhatian</p>
        <p class="mt-1 text-2xl font-semibold {{ $stats['late_count'] > 0 ? 'text-red-500' : 'text-green-500' }}">
            {{ $stats['late_count'] }}
        </p>
    </div>
</div>

<form method="GET" action="{{ route('owner.staff.show', $staff->id) }}" class="mb-4">
    <div class="flex flex-wrap items-center gap-2">
        <input type="text"
               name="search"
               value="{{ $search }}"
               placeholder="Cari nama atau email pengguna..."
               class="w-full max-w-sm px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">

        <select name="status"
                class="px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
            <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Semua Status</option>
            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        <select name="activity"
                class="px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
            <option value="all" {{ $activity === 'all' ? 'selected' : '' }}>Semua Keaktifan</option>
            <option value="active" {{ $activity === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ $activity === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>

        <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
            Terapkan
        </button>

        <a href="{{ route('owner.staff.show', $staff->id) }}"
           class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
            Reset
        </a>
    </div>
</form>

<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">No HP</th>
                    <th class="px-4 py-3">Paket</th>
                    <th class="px-4 py-3">Status Akun</th>
                    <th class="px-4 py-3">Progress</th>
                    <th class="px-4 py-3">Minggu Terakhir Setor</th>
                    <th class="px-4 py-3">Kondisi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse($users as $user)
                    @php
                        $done = $user->weeklyProgress->where('is_checked', true)->count();
                        $progress = round(($done / 52) * 100);
                        $lastChecked = $user->weeklyProgress
                            ->where('is_checked', true)
                            ->where('week_number', '<=', $currentWeekNum)
                            ->sortByDesc('week_number')
                            ->first();
                        $lastWeek = $lastChecked?->week_number;
                        $weeksAgo = $lastWeek ? ($currentWeekNum - $lastWeek) : $currentWeekNum;
                        $isLate = $weeksAgo > 2;
                    @endphp
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            {{ $user->phone }}
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            @if ($user->savingPlan)
                                <span class="font-semibold">{{ $user->savingPlan->name }}</span>
                                <div class="text-xs text-gray-500">Rp {{ number_format($user->savingPlan->weekly_amount, 0, ',', '.') }}/minggu</div>
                            @else
                                <span class="text-gray-400">Belum pilih paket</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                {{ $user->is_active ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            {{ $progress }}%
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            {{ $lastWeek ? 'Minggu ' . $lastWeek : '-' }}
                        </td>

                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                {{ $isLate ? 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }}">
                                {{ $isLate ? 'Perlu perhatian' : 'Normal' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"
                            class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada pengguna yang sesuai filter
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>

@endsection
