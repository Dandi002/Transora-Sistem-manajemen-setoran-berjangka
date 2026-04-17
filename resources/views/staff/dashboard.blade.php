@extends('layouts.app')

@section('content')
<style>
    .staff-kpi-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
    }

    .theme-dark .staff-kpi-card {
        background: linear-gradient(180deg, #1f2937 0%, #18212f 100%);
        border-color: #374151;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
    }

    .theme-dark .staff-kpi-label {
        color: #9ca3af !important;
    }

    .theme-dark .staff-kpi-value {
        color: #f9fafb !important;
    }

    .theme-dark .staff-kpi-subtext {
        color: #94a3b8 !important;
    }

    .theme-dark .staff-kpi-icon-green {
        background: rgba(34, 197, 94, 0.18) !important;
    }

    .theme-dark .staff-kpi-icon-blue {
        background: rgba(59, 130, 246, 0.18) !important;
    }

    .theme-dark .staff-kpi-icon-red {
        background: rgba(239, 68, 68, 0.18) !important;
    }

    .theme-dark .staff-kpi-icon-purple {
        background: rgba(139, 92, 246, 0.18) !important;
    }
</style>
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard Staff
</h2>

<p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
    Ringkasan kerja minggu ke-{{ $kpi['current_week'] }}.
</p>

{{-- Saldo Setoran --}}
<div style="margin-bottom: 1rem;">
    <div style="display: flex; align-items: center; gap: 16px; padding: 1.25rem 1.5rem;" class="staff-kpi-card">
        <div style="display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: #d1fae5; flex-shrink: 0;" class="staff-kpi-icon-green">
            <svg style="width: 20px; height: 20px; color: #065f46;" fill="none" stroke="#065f46" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10v2m0 12v2M4 12a8 8 0 1016 0 8 8 0 10-16 0z"/>
            </svg>
        </div>
        <div>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 2px;" class="staff-kpi-label">Saldo Setoran</p>
            <p style="font-size: 24px; font-weight: 600; color: #111827; letter-spacing: -0.5px;" class="staff-kpi-value">
                Rp {{ number_format($kpi['total_saldo_diterima'] ?? 0, 0, ',', '.') }}
            </p>
        </div>
    </div>
</div>

{{-- KPI Grid --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 2rem;">

    {{-- Pengguna Saya --}}
    <div style="display: flex; flex-direction: column; gap: 12px; padding: 1rem 1.1rem;" class="staff-kpi-card">
        <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #dbeafe;" class="staff-kpi-icon-blue">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="#1d4ed8" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 4px;" class="staff-kpi-label">Pengguna Saya</p>
            <p style="font-size: 22px; font-weight: 600; color: #111827;" class="staff-kpi-value">{{ number_format($kpi['total_user_dipegang']) }}</p>
        </div>
    </div>

    {{-- Belum Setor --}}
    <div style="display: flex; flex-direction: column; gap: 12px; padding: 1rem 1.1rem;" class="staff-kpi-card">
        <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #fee2e2;" class="staff-kpi-icon-red">
            <svg style="width: 16px; height: 16px;" fill="#b91c1c" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.593C19.01 16.013 18.082 18 16.52 18H3.48c-1.562 0-2.49-1.987-1.74-3.308L8.257 3.1zM11 14a1 1 0 10-2 0 1 1 0 002 0zm-1-7a1 1 0 00-1 1v3a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 4px;" class="staff-kpi-label">Belum Setor Minggu Ini</p>
            <p style="font-size: 22px; font-weight: 600; color: #111827;" class="staff-kpi-value">{{ number_format($kpi['belum_setor_minggu_ini']) }}</p>
        </div>
    </div>

    {{-- Sudah Setor --}}
    <div style="display: flex; flex-direction: column; gap: 12px; padding: 1rem 1.1rem;" class="staff-kpi-card">
        <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #dcfce7;" class="staff-kpi-icon-green">
            <svg style="width: 16px; height: 16px;" fill="#15803d" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.36 7.36a1 1 0 01-1.414 0l-3.64-3.64a1 1 0 111.414-1.414l2.933 2.933 6.653-6.653a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 4px;" class="staff-kpi-label">Sudah Setor Minggu Ini</p>
            <p style="font-size: 22px; font-weight: 600; color: #111827;" class="staff-kpi-value">{{ number_format($kpi['sudah_setor_minggu_ini']) }}</p>
        </div>
    </div>

    {{-- Kapasitas Terpakai --}}
    <div style="display: flex; flex-direction: column; gap: 12px; padding: 1rem 1.1rem;" class="staff-kpi-card">
        <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #ede9fe;" class="staff-kpi-icon-purple">
            <svg style="width: 16px; height: 16px;" fill="#6d28d9" viewBox="0 0 20 20">
                <path d="M3 3a1 1 0 000 2h14a1 1 0 100-2H3zM3 9a1 1 0 100 2h10a1 1 0 100-2H3zM3 15a1 1 0 100 2h6a1 1 0 100-2H3z"/>
            </svg>
        </div>
        <div>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 4px;" class="staff-kpi-label">Kapasitas Terpakai</p>
            <p style="font-size: 22px; font-weight: 600; color: #111827;" class="staff-kpi-value">{{ $kpi['kapasitas_terpakai'] }}%</p>
            <p style="font-size: 11px; color: #9ca3af; margin-top: 2px;" class="staff-kpi-subtext">/{{ $kpi['kapasitas_maksimal'] }} pengguna</p>
        </div>
    </div>

</div>
@endsection 
