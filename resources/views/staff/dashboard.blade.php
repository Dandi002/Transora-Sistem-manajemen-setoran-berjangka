@extends('layouts.app')

@section('content')
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard Staff
</h2>

<p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    Ringkasan kerja minggu ke-{{ $kpi['current_week'] }}.
</p>

<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 16a6 6 0 1112 0v2H2v-2z"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pengguna Saya</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['total_user_dipegang']) }}</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.593C19.01 16.013 18.082 18 16.52 18H3.48c-1.562 0-2.49-1.987-1.74-3.308L8.257 3.1zM11 14a1 1 0 10-2 0 1 1 0 002 0zm-1-7a1 1 0 00-1 1v3a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Belum Setor Minggu Ini</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['belum_setor_minggu_ini']) }}</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.36 7.36a1 1 0 01-1.414 0l-3.64-3.64a1 1 0 111.414-1.414l2.933 2.933 6.653-6.653a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Sudah Setor Minggu Ini</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ number_format($kpi['sudah_setor_minggu_ini']) }}</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-600 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 3a1 1 0 000 2h14a1 1 0 100-2H3zM3 9a1 1 0 100 2h10a1 1 0 100-2H3zM3 15a1 1 0 100 2h6a1 1 0 100-2H3z"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Kapasitas Terpakai</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $kpi['kapasitas_terpakai'] }}%</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $kpi['total_user_dipegang'] }}/{{ $kpi['kapasitas_maksimal'] }} pengguna</p>
        </div>
    </div>
</div>
@endsection
