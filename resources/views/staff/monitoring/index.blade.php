@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap');

    .monitor-wrap * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
    .monitor-wrap { padding: 1.5rem 0; max-width: 100%; overflow-x: hidden; }

    .mon-title    { font-size: 1.375rem; font-weight: 600; color: #111827; letter-spacing: -0.02em; }
    .mon-subtitle { font-size: 0.8125rem; color: #6B7280; margin-top: 2px; margin-bottom: 1.25rem; }
    .theme-dark .mon-title    { color: #F9FAFB; }
    .theme-dark .mon-subtitle { color: #9CA3AF; }

    /* Stat cards */
    .mon-stats { display: flex; gap: 12px; margin-bottom: 1.25rem; flex-wrap: wrap; }
    .mon-stat  { flex: 1; min-width: 120px; background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 10px; padding: 0.75rem 1rem; }
    .theme-dark .mon-stat { background: #1F2937; border-color: #374151; }
    .mon-stat-label { font-size: 0.75rem; color: #6B7280; margin-bottom: 4px; }
    .mon-stat-val   { font-size: 1.375rem; font-weight: 600; color: #111827; line-height: 1; }
    .theme-dark .mon-stat-val { color: #F9FAFB; }
    .mon-stat-val.danger { color: #EF4444; }

    /* Legend */
    .mon-legend { display: flex; gap: 14px; align-items: center; margin-bottom: 0.875rem; flex-wrap: wrap; }
    .mon-leg-item { display: flex; align-items: center; gap: 5px; font-size: 0.75rem; color: #6B7280; }
    .mon-leg-dot  { width: 14px; height: 14px; border-radius: 4px; flex-shrink: 0; }

    /* Table */
    .mon-table-outer { overflow-x: auto; max-width: 100%; border: 1px solid #E5E7EB; border-radius: 12px; }
    .theme-dark .mon-table-outer { border-color: #374151; }

    .mon-table { border-collapse: collapse; font-size: 0.75rem; width: 100%; min-width: max-content; }

    .mon-table thead th {
        background: #F9FAFB; color: #9CA3AF; font-weight: 500;
        padding: 7px 3px; text-align: center;
        position: sticky; top: 0;
        border-bottom: 1px solid #E5E7EB;
        white-space: nowrap; font-size: 0.6875rem; z-index: 1;
    }
    .theme-dark .mon-table thead th { background: #1F2937; border-color: #374151; color: #6B7280; }

    .mon-table thead th.col-name {
        text-align: left; padding: 7px 14px;
        position: sticky; left: 0; z-index: 3;
        min-width: 140px; border-right: 1px solid #E5E7EB;
    }
    .theme-dark .mon-table thead th.col-name { border-right-color: #374151; }
    .mon-table thead th.col-wk-active { color: #059669; }

    .mon-table tbody td {
        border-bottom: 1px solid #F3F4F6;
        text-align: center; padding: 5px 2px; vertical-align: middle;
    }
    .theme-dark .mon-table tbody td { border-color: #374151; }
    .mon-table tbody tr:last-child td { border-bottom: none; }
    .mon-table tbody tr:hover td { background: #F9FAFB; }
    .theme-dark .mon-table tbody tr:hover td { background: #1F2937; }

    .mon-table tbody td.col-name {
        text-align: left; padding: 8px 14px;
        position: sticky; left: 0;
        background: #fff; font-weight: 600; color: #111827;
        z-index: 1; border-right: 1px solid #E5E7EB; min-width: 140px;
    }
    .theme-dark .mon-table tbody td.col-name { background: #111827; color: #F9FAFB; border-right-color: #374151; }
    .mon-table tbody tr:hover td.col-name { background: #F9FAFB; }
    .theme-dark .mon-table tbody tr:hover td.col-name { background: #1F2937; }

    /* Week box */
    .week-box {
        display: inline-block; width: 20px; height: 20px;
        border-radius: 5px; border: 1.5px solid #D1D5DB;
        background: transparent; cursor: pointer;
        transition: background 0.15s, border-color 0.15s;
        position: relative; padding: 0;
    }
    .theme-dark .week-box { border-color: #4B5563; }
    .week-box:hover { border-color: #9CA3AF; }
    .week-box.checked { background: #10B981; border-color: #059669; }
    .week-box.checked::after {
        content: '';
        display: block; width: 10px; height: 10px;
        margin: 3px auto 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath d='M2 6l3 3 5-5' stroke='%23fff' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-size: contain; background-repeat: no-repeat;
    }

    /* hide default form margin */
    .mon-table form { margin: 0; }
</style>

@php
    $currentWeekNum = now()->weekOfYear;

    $totalPct = 0;
    foreach ($users as $u) {
        $done = $u->weeklyProgress->where('is_checked', true)->count();
        $totalPct += round($done / 52 * 100);
    }
    $avgPct = $users->count() > 0 ? round($totalPct / $users->count()) : 0;

    $lateCount = 0;
    foreach ($users as $u) {
        $last = $u->weeklyProgress
            ->where('is_checked', true)
            ->where('week_number', '<=', $currentWeekNum)
            ->sortByDesc('week_number')
            ->first();
        $weeksAgo = $last ? ($currentWeekNum - $last->week_number) : $currentWeekNum;
        if ($weeksAgo > 2) $lateCount++;
    }
@endphp

<div class="monitor-wrap">

    <div class="mon-title">Monitoring 52 Minggu</div>
    <div class="mon-subtitle">Pantau progress setoran seluruh Pengguna</div>

    <form method="GET" action="{{ route('staff.monitoring.index') }}" class="mb-4">
        <div class="flex flex-wrap items-center gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama pengguna..."
                class="w-full max-w-sm px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
            >
            <button
                type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700"
            >
                Cari
            </button>
            @if(!empty($search))
                <a
                    href="{{ route('staff.monitoring.index') }}"
                    class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
                >
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Stat Cards --}}
    <div class="mon-stats">
        <div class="mon-stat">
            <div class="mon-stat-label">Total Pengguna</div>
            <div class="mon-stat-val">{{ $users->count() }}</div>
        </div>
        <div class="mon-stat">
            <div class="mon-stat-label">Rata-rata Progress</div>
            <div class="mon-stat-val">{{ $avgPct }}%</div>
        </div>
        <div class="mon-stat">
            <div class="mon-stat-label">Perlu Perhatian</div>
            <div class="mon-stat-val {{ $lateCount > 0 ? 'danger' : '' }}">{{ $lateCount }} orang</div>
        </div>
        <div class="mon-stat">
            <div class="mon-stat-label">Minggu Aktif</div>
            <div class="mon-stat-val" style="color:#059669;">{{ $currentWeekNum }}</div>
        </div>
    </div>

    {{-- Legend --}}
    <div class="mon-legend">
        <div class="mon-leg-item">
            <span class="mon-leg-dot" style="background:#10B981; border:1.5px solid #059669;"></span>
            Sudah setor
        </div>
        <div class="mon-leg-item">
            <span class="mon-leg-dot" style="background:transparent; border:1.5px solid #D1D5DB;"></span>
            Belum setor
        </div>
    </div>

    {{-- Table --}}
    <div class="mon-table-outer">
        <table class="mon-table">
            <thead>
                <tr>
                    <th class="col-name">Pengguna</th>
                    <th class="px-3 py-2 text-left">Paket</th>
                    @for ($i = 1; $i <= 52; $i++)
                        <th class="{{ $i == $currentWeekNum ? 'col-wk-active' : '' }}">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td class="col-name">{{ $user->name }}</td>
                    <td class="px-3 py-2 text-left whitespace-nowrap">
                        @if ($user->savingPlan)
                            <span class="font-semibold">{{ $user->savingPlan->name }}</span><br>
                            <span class="text-[11px] text-gray-500">Rp {{ number_format($user->savingPlan->weekly_amount, 0, ',', '.') }}/minggu</span>
                        @else
                            <span class="text-gray-400">Belum pilih paket</span>
                        @endif
                    </td>

                    @for ($week = 1; $week <= 52; $week++)
                        @php
                            $isChecked = $user->weeklyProgress
                                ->where('week_number', $week)
                                ->where('is_checked', true)
                                ->isNotEmpty();
                        @endphp
                        <td>
                            <form method="POST" action="{{ route('staff.monitoring.check') }}">
                                @csrf
                                <input type="hidden" name="user_id"     value="{{ $user->id }}">
                                <input type="hidden" name="week_number" value="{{ $week }}">
                                <input type="hidden" name="is_checked"  value="{{ $isChecked ? '0' : '1' }}">
                                <button type="submit"
                                        class="week-box {{ $isChecked ? 'checked' : '' }}"
                                        title="Minggu {{ $week }} - {{ $isChecked ? 'Klik untuk uncheck' : 'Klik untuk check' }}">
                                </button>
                            </form>
                        </td>
                    @endfor
                </tr>
                @empty
                <tr>
                    <td colspan="54" class="px-4 py-4 text-sm text-center text-gray-500 dark:text-gray-300">
                        Pengguna tidak ditemukan{{ !empty($search) ? ' untuk kata kunci "' . $search . '"' : '' }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

