    <x-app-layout>
        <div class="flex h-screen bg-gray-50">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg flex flex-col">
                <!-- Logo -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-800">Dashboard</h1>
                            <p class="text-xs text-gray-500">Owner Panel</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                @include('layouts.sidebar')

                <!-- User Info -->
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center space-x-3 px-4 py-3 bg-gray-50 rounded-lg">
                        <div
                            class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-full w-10 h-10 flex items-center justify-center text-white font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Owner</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <main class="flex-1 overflow-y-auto p-8">

                    <!-- Header -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Tambah User</h2>
                        <p class="text-sm text-gray-500">Buat akun pengguna baru</p>
                    </div>

                    <!-- Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 max-w-xl">
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                        <!-- FORM -->
                        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Nama -->
                            <div>
                                <label class="block mb-2.5 text-sm font-medium text-heading">Nama</label>
                                <input type="text" name="name" required
                                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium
                                            border border-default-medium rounded-base text-sm
                                            focus:ring-brand focus:border-brand"
                                    placeholder="Nama lengkap">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                                <input type="email" name="email" required
                                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium
                                            border border-default-medium rounded-base text-sm
                                            focus:ring-brand focus:border-brand"
                                    placeholder="email@domain.com">
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block mb-2.5 text-sm font-medium text-heading">Password</label>
                                <input type="password" name="password" required
                                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium
                                            border border-default-medium rounded-base text-sm
                                            focus:ring-brand focus:border-brand"
                                    placeholder="••••••••">
                            </div>

                            <!-- Role -->
                            <div>
                                <label class="block mb-2.5 text-sm font-medium text-heading">Role</label>
                                <select name="role"
                                        class="block w-full px-3 py-2.5 bg-neutral-secondary-medium
                                            border border-default-medium rounded-base text-sm
                                            focus:ring-brand focus:border-brand">
                                    <option value="">Pilih role</option>
                                    <option value="owner">Owner</option>
                                    <option value="staff">Staff</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-3 pt-4">
                                <a href="{{ route('users.index') }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        <!-- END FORM -->

                    </div>
                </main>
            </div>
        </div>
    </x-app-layout>
