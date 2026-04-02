@extends('layouts.app')

@section('content')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Data Staff
</h2>

<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($staffs as $staff)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ $staff->name }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $staff->email }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                {{ ucfirst($staff->role) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('owner.staff.show', $staff->id) }}"
                               class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                            Tidak ada data staff
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection