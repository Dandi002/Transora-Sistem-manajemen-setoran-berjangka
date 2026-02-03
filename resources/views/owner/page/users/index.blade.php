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
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Users</h2>
                        <p class="text-sm text-gray-500">Manajemen akun pengguna</p>
                    </div>
                    <a href="{{ route('users.create') }}"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg shadow">
                        + Tambah User
                    </a>
                </div>

                <!-- Alert -->
                @if (session('success'))
                    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Users Table -->
<div class="relative overflow-x-auto bg-white shadow-sm rounded-xl border border-gray-200">
    <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-sm bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 font-medium">Nama</th>
                <th class="px-6 py-3 font-medium">Email</th>
                <th class="px-6 py-3 font-medium">Role</th>
                <th class="px-6 py-3 font-medium">Status</th>
                <th class="px-6 py-3 font-medium">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
    @php
        $roleClass = match ($user->role) {
            'staff'  => 'bg-blue-100 text-blue-700',
            'owner'  => 'bg-purple-100 text-purple-700',
            default  => 'bg-gray-100 text-gray-700',
        };
    @endphp

    <span class="inline-flex px-2 py-1 rounded-md text-xs font-semibold {{ $roleClass }}">
        {{ ucfirst($user->role) }}
    </span>
</td>
<td class="px-6 py-4">
    <label class="inline-flex items-center cursor-pointer">
        <input
            type="checkbox"
            class="sr-only peer toggle-active"
            data-id="{{ $user->id }}"
            {{ $user->is_active ? 'checked' : '' }}
        >
        <div
            class="relative w-9 h-5 bg-gray-300
            peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-200
            rounded-full peer
            peer-checked:after:translate-x-full
            after:content-['']
            after:absolute after:top-[2px] after:start-[2px]
            after:bg-white after:rounded-full
            after:h-4 after:w-4 after:transition-all
            peer-checked:bg-orange-500">
        </div>
        <span
    class="ms-2 text-xs font-medium text-gray-700 select-none status-text">
    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
</span>
    </label>
</td>
                    <td class="px-6 py-4 flex gap-4">
                        <a href="{{ route('users.edit', $user) }}"
                           class="font-medium text-orange-600 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('users.destroy', $user) }}"
                              method="POST">
                            @csrf
                                @method('DELETE')
                            <button
                                onclick="return confirm('Hapus user ini?')"
                                class="font-medium text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $users->links() }}
                </div>

            </main>
        </div>
    </div>
</x-app-layout>



<script>
document.querySelectorAll('.toggle-active').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const userId = this.dataset.id;
        const statusText = this.closest('label').querySelector('.status-text');
        const isChecked = this.checked;

        fetch(`/users/${userId}/toggle-active`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(res => {
            if (!res.ok) throw res;
            return res.json();
        })
        .then(data => {
            // UPDATE TEKS
            statusText.textContent = data.status ? 'Aktif' : 'Nonaktif';
        })
        .catch(() => {
            alert('Gagal mengubah status'); 
            this.checked = !isChecked; // rollback toggle
        });
    });
});
</script>
