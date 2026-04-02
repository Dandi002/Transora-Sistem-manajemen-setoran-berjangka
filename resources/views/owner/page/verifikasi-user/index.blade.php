{{-- @extends('layouts.app')

@section('content')

<div class="container px-6 mx-auto grid">

    <!-- TITLE -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Verifikasi Pengguna
    </h2>

    <!-- CARD TABLE -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">

            <table class="w-full whitespace-no-wrap">

                <!-- HEADER -->
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @forelse($users as $user)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                        <td class="px-4 py-3 text-sm font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $user->phone }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $user->alamat }}
                        </td>

                        <td class="px-4 py-3 text-sm flex gap-2">

                            <!-- Approve -->
                            <form action="/user-verifikasi/{{ $user->id }}/approve" method="POST">
                                @csrf
                                <button
                                    class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-md hover:bg-green-600 active:scale-95 transition">
                                    Approve
                                </button>
                            </form>

                            <!-- Reject -->
                            <form action="/user-verifikasi/{{ $user->id }}/reject" method="POST">
                                @csrf
                                <button
                                    class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-md hover:bg-red-600 active:scale-95 transition">
                                    Reject
                                </button>
                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Tidak ada pengguna menunggu verifikasi
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection --}}
