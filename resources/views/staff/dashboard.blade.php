@extends('layouts.app')

@section('content')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard Staff
</h2>

<!-- Cards -->
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

    <!-- Total Tugas -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 rounded-full bg-blue-100 text-blue-500">
            📋
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Tugas
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                24
            </p>
        </div>
    </div>

    <!-- Pending -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 rounded-full bg-yellow-100 text-yellow-500">
            ⏳
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Pending
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                8
            </p>
        </div>
    </div>

    <!-- Selesai -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 rounded-full bg-green-100 text-green-500">
            ✅
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Selesai
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                16
            </p>
        </div>
    </div>

    <!-- Hari Ini -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 rounded-full bg-purple-100 text-purple-500">
            📅
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Hari Ini
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                5
            </p>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Aktivitas</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Input data pelanggan</td>
                    <td class="px-4 py-3">30 Mar 2026</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                            Selesai
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection