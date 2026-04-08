@extends('layouts.app')

@section('content')
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard Owner
</h2>

<p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    Ringkasan performa minggu ke-{{ $kpi['current_week'] }}.
</p>

<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <path d="M20 8v6"></path>
                <path d="M23 11h-6"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Pengguna Aktif</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['total_pengguna_aktif']) }}</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Menunggak Minggu Ini</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['user_menunggak']) }}</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-600 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Staff Terpadat</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $kpi['staff_terpadat_nama'] }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($kpi['staff_terpadat_total']) }} pengguna</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <path d="M17 11l2 2 4-4"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Staff Aktif</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['total_staff']) }}</p>
        </div>
    </div>
</div>
@endsection
