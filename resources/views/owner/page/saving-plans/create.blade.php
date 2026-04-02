@extends('layouts.app')

@section('content')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Tambah Paket Setoran
</h2>

<div class="w-full max-w-3xl px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('owner.saving-plans.store') }}" method="POST">
        @csrf

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nama Paket</span>
            <input type="text" name="name" required value="{{ old('name') }}"
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                          focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                          dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                   placeholder="Contoh: Paket 125rb" />
        </label>

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nominal Mingguan (Rp)</span>
            <input type="number" min="1000" step="1000" name="weekly_amount" required value="{{ old('weekly_amount') }}"
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                          focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                          dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                   placeholder="Contoh: 125000" />
        </label>

        <label class="inline-flex items-center mt-4">
            <input type="checkbox" name="is_active" value="1" class="form-checkbox text-purple-600" {{ old('is_active', 1) ? 'checked' : '' }}>
            <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Aktifkan paket ini</span>
        </label>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('owner.saving-plans.index') }}"
               class="px-4 py-2 text-sm font-medium leading-5 text-gray-600 border border-gray-300 rounded-lg hover:border-gray-500">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
