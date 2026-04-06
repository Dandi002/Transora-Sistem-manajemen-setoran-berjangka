<section>
    <div class="ep-card ep-card-danger">
        <p class="ep-card-title ep-card-title-danger">Zona Berbahaya</p>
        <p class="ep-danger-desc">Jika akun dihapus, semua data terkait akan hilang permanen.</p>
        <button
            type="button"
            class="ep-btn ep-btn-danger-outline"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Hapus akun
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Yakin ingin menghapus akun?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Tindakan ini permanen. Masukkan password untuk konfirmasi.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button class="ms-3">Hapus akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
