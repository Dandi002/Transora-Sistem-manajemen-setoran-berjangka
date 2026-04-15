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
    .mon-status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 600;
        padding: 0.2rem 0.55rem;
        white-space: nowrap;
    }
    .mon-status-safe { background: #DCFCE7; color: #166534; border: 1px solid #86EFAC; }
    .mon-status-complete { background: #DBEAFE; color: #1D4ED8; border: 1px solid #93C5FD; }
    .mon-status-warning { background: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; }
    .mon-status-critical { background: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; }
    .theme-dark .mon-status-safe { background: rgba(22,163,74,.15); color: #86EFAC; border-color: rgba(22,163,74,.35); }
    .theme-dark .mon-status-complete { background: rgba(59,130,246,.15); color: #93C5FD; border-color: rgba(59,130,246,.35); }
    .theme-dark .mon-status-warning { background: rgba(245,158,11,.15); color: #FCD34D; border-color: rgba(245,158,11,.35); }
    .theme-dark .mon-status-critical { background: rgba(239,68,68,.15); color: #FCA5A5; border-color: rgba(239,68,68,.35); }

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
    .week-box.checked-auto { background: #3B82F6; border-color: #2563EB; }
    .week-box.locked {
        cursor: not-allowed;
        pointer-events: none;
        opacity: 1;
    }
    .week-box.checked::after {
        content: '';
        display: block; width: 10px; height: 10px;
        margin: 3px auto 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath d='M2 6l3 3 5-5' stroke='%23fff' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-size: contain; background-repeat: no-repeat;
    }
    .week-box.checked-auto::after {
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
    $totalPct = 0;
    foreach ($users as $u) {
        $totalPct += $u->progress_percent ?? 0;
    }
    $avgPct = $users->count() > 0 ? round($totalPct / $users->count()) : 0;

    $lateCount = 0;
    foreach ($users as $u) {
        if (($u->payment_status ?? 'Lancar') !== 'Lancar') $lateCount++;
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
            Checklist manual
        </div>
        <div class="mon-leg-item">
            <span class="mon-leg-dot" style="background:#3B82F6; border:1.5px solid #2563EB;"></span>
            Pembayaran transfer
        </div>
        <div class="mon-leg-item">
            <span class="mon-leg-dot" style="background:transparent; border:1.5px solid #D1D5DB;"></span>
            Belum setor
        </div>
        <div class="mon-leg-item">
            <span class="mon-status-badge mon-status-complete">Selesai</span>
        </div>
        <div class="mon-leg-item">
            <span class="mon-status-badge mon-status-safe">Lancar</span>
        </div>
        <div class="mon-leg-item">
            <span class="mon-status-badge mon-status-warning">Waspada</span>
        </div>
        <div class="mon-leg-item">
            <span class="mon-status-badge mon-status-critical">Kritis</span>
        </div>
    </div>

    {{-- Table --}}
    <div class="mon-table-outer">
        <table class="mon-table">
            <thead>
                <tr>
                    <th class="col-name">Pengguna</th>
                    <th class="px-3 py-2 text-left">Paket</th>
                    <th class="px-3 py-2 text-left">Status</th>
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
                    <td class="px-3 py-2 text-left whitespace-nowrap">
                        <span class="mon-status-badge mon-status-{{ $user->payment_status_class }}">
                            {{ $user->payment_status }}
                        </span>
                    </td>

                    @for ($week = 1; $week <= 52; $week++)
                        @php
                            $progress = $user->weeklyProgress
                                ->where('week_number', $week)
                                ->first();
                            $isChecked = (bool) ($progress?->is_checked);
                            $isPaidTransfer = in_array($week, $user->paid_transfer_weeks ?? [], true);
                            $isStopped = ($user->payment_status ?? '') === 'Diberhentikan';
                            $checkClass = $isChecked
                                ? ($isPaidTransfer ? 'checked-auto locked' : 'checked')
                                : '';
                            $checkLabel = $isPaidTransfer ? 'Pembayaran transfer' : 'Checklist manual';
                        @endphp
                        <td>
                            @if ($isPaidTransfer || $isStopped)
                                <button type="button"
                                        class="week-box {{ $checkClass }} {{ $isStopped ? 'locked' : '' }}"
                                        title="{{ $isStopped
                                            ? 'Akun diberhentikan karena tidak setor 10 minggu berturut-turut. Checklist tidak bisa diubah.'
                                            : 'Minggu ' . $week . ' - ' . $checkLabel . '. Checklist otomatis dari pembayaran transfer dan tidak bisa diubah manual.' }}">
                                </button>
                            @else
                                <form method="POST" action="{{ route('staff.monitoring.check') }}">
                                    @csrf
                                    <input type="hidden" name="user_id"     value="{{ $user->id }}">
                                    <input type="hidden" name="week_number" value="{{ $week }}">
                                    <input type="hidden" name="is_checked"  value="{{ $isChecked ? '0' : '1' }}">
                                    <button type="submit"
                                            class="week-box {{ $checkClass }}"
                                            title="Minggu {{ $week }} - {{ $isChecked ? $checkLabel : 'Belum setor' }}. {{ $isChecked ? 'Klik untuk uncheck' : 'Klik untuk check' }}">
                                    </button>
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
                @empty
                <tr>
                    <td colspan="55" class="px-4 py-4 text-sm text-center text-gray-500 dark:text-gray-300">
                        Pengguna tidak ditemukan{{ !empty($search) ? ' untuk kata kunci "' . $search . '"' : '' }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

