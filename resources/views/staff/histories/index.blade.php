@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.min.css">
<style>
    .history-table-wrap .dataTables_wrapper {
        color: inherit;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_length,
    .history-table-wrap .dataTables_wrapper .dataTables_filter {
        padding: 1.25rem 1rem 0;
        color: #9CA3AF !important;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_info,
    .history-table-wrap .dataTables_wrapper .dataTables_paginate {
        padding: 1rem;
        color: #9CA3AF !important;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_length,
    .history-table-wrap .dataTables_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_filter {
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_filter label,
    .history-table-wrap .dataTables_wrapper .dataTables_length label {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
    }

    .history-table-wrap .dataTables_filter input,
    .history-table-wrap .dataTables_length select {
        min-height: 2.6rem;
        border-radius: 0.75rem;
        border: 1px solid #374151;
        background: #111827;
        color: #F9FAFB;
        padding: 0.55rem 0.85rem;
        margin-left: 0 !important;
    }

    .history-table-wrap .dataTables_filter input {
        min-width: 14rem;
    }

    .history-table-wrap table.dataTable thead th {
        border-bottom: 1px solid #374151 !important;
    }

    .history-table-wrap table.dataTable.no-footer {
        border-bottom: none !important;
    }

    .history-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 0.25rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .history-badge-transfer {
        background: rgba(59, 130, 246, 0.18);
        color: #93C5FD;
    }

    .history-badge-check {
        background: rgba(16, 185, 129, 0.18);
        color: #6EE7B7;
    }

    .history-badge-uncheck {
        background: rgba(248, 113, 113, 0.18);
        color: #FCA5A5;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button {
        min-width: 6.75rem;
        margin: 0 !important;
        padding: 0.6rem 1rem !important;
        border-radius: 0.75rem !important;
        border: 1px solid #374151 !important;
        background: #111827 !important;
        color: #E5E7EB !important;
        font-weight: 600;
        text-align: center;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border-color: #22C55E !important;
        background: rgba(34, 197, 94, 0.14) !important;
        color: #DCFCE7 !important;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        border-color: #22C55E !important;
        background: #16A34A !important;
        color: #FFFFFF !important;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .history-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        opacity: 0.45;
        cursor: not-allowed !important;
        border-color: #374151 !important;
        background: #111827 !important;
        color: #6B7280 !important;
    }

    .history-table-wrap .dataTables_wrapper .dataTables_info {
        padding-top: 1.25rem;
    }

    .history-filters {
        display: grid;
        grid-template-columns: minmax(240px, 1.7fr) repeat(2, minmax(150px, 0.85fr)) minmax(150px, 0.85fr) auto auto;
        gap: 0.9rem 0.75rem;
        align-items: end;
    }

    .history-filters > * {
        min-height: 2.75rem;
    }

    .history-filters .history-filter-search {
        width: 100%;
    }

    .history-filters .history-filter-button,
    .history-filters .history-filter-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .history-table-wrap .dataTables_wrapper .dataTables_length,
        .history-table-wrap .dataTables_wrapper .dataTables_filter,
        .history-table-wrap .dataTables_wrapper .dataTables_info,
        .history-table-wrap .dataTables_wrapper .dataTables_paginate {
            padding-left: 0.85rem;
            padding-right: 0.85rem;
        }

        .history-table-wrap .dataTables_wrapper .dataTables_filter input {
            min-width: 100%;
        }

        .history-filters {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="mt-8">
    <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Riwayat Setoran</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat setoran transfer, checklist manual, dan pembatalan checklist yang sudah tercatat.</p>
        </div>

        <form method="GET" action="{{ route('staff.setoran-histories.index') }}" class="w-full">
            <div class="history-filters">
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari nama pengguna..."
                    class="history-filter-search px-4 py-2.5 text-sm rounded-xl border border-gray-300 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
                >
                <input
                    type="date"
                    name="date_from"
                    value="{{ $dateFrom ?? '' }}"
                    class="px-4 py-2.5 text-sm rounded-xl border border-gray-300 bg-white text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
                >
                <input
                    type="date"
                    name="date_to"
                    value="{{ $dateTo ?? '' }}"
                    class="px-4 py-2.5 text-sm rounded-xl border border-gray-300 bg-white text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
                >
                <select
                    name="method"
                    class="px-4 py-2.5 text-sm rounded-xl border border-gray-300 bg-white text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
                >
                    <option value="">Semua aksi</option>
                    <option value="transfer" {{ ($method ?? '') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="manual_check" {{ ($method ?? '') === 'manual_check' ? 'selected' : '' }}>Manual Check</option>
                    <option value="manual_uncheck" {{ ($method ?? '') === 'manual_uncheck' ? 'selected' : '' }}>Manual Uncheck</option>
                </select>
                <button
                    type="submit"
                    class="history-filter-button px-5 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-xl hover:bg-green-700"
                >
                    Cari
                </button>
                <a
                    href="{{ route('staff.setoran-histories.index') }}"
                    class="history-filter-link px-5 py-2.5 text-sm font-semibold text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
                >
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs bg-white dark:bg-gray-800 history-table-wrap">
        <div class="w-full overflow-x-auto">
            <table id="setoran-history-table" class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                        <th class="px-4 py-3">Pengguna</th>
                        <th class="px-4 py-3">Minggu</th>
                        <th class="px-4 py-3">Aksi</th>
                        <th class="px-4 py-3">Sumber</th>
                        <th class="px-4 py-3">Dicatat Oleh</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Jam</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($histories as $history)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-semibold">{{ $history->user?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">Minggu ke-{{ $history->week_number }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="history-badge {{
                                    $history->action_type === 'transfer_paid' ? 'history-badge-transfer' :
                                    ($history->action_type === 'manual_uncheck' ? 'history-badge-uncheck' : 'history-badge-check')
                                }}">
                                    {{
                                        $history->action_type === 'transfer_paid' ? 'Transfer' :
                                        ($history->action_type === 'manual_uncheck' ? 'Manual Uncheck' : 'Manual Check')
                                    }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $history->source_label ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $history->staff?->name ?? 'Sistem' }}</td>
                            <td class="px-4 py-3 text-sm">{{ optional($history->recorded_at)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ optional($history->recorded_at)->format('H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                Belum ada riwayat setoran yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery && document.getElementById('setoran-history-table')) {
        window.jQuery('#setoran-history-table').DataTable({
            pageLength: 10,
            order: [[5, 'desc'], [6, 'desc']],
            language: {
                search: 'Cari di tabel:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Berikutnya'
                },
                zeroRecords: 'Data tidak ditemukan',
                infoEmpty: 'Belum ada data',
                infoFiltered: '(difilter dari _MAX_ data)'
            }
        });
    }
});
</script>
@endsection
