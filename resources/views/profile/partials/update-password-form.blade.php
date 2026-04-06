<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="ep-card">
            <p class="ep-card-title">Ubah Kata Sandi</p>

            <div class="ep-field">
                <label for="update_password_current_password" class="ep-label">Kata sandi saat ini</label>
                <input id="update_password_current_password" name="current_password" type="password" class="ep-input" autocomplete="current-password" placeholder="Masukkan kata sandi saat ini">
                @error('current_password', 'updatePassword')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-field">
                <label for="update_password_password" class="ep-label">Kata sandi baru</label>
                <input id="update_password_password" name="password" type="password" class="ep-input" autocomplete="new-password" placeholder="Buat kata sandi baru">
                @error('password', 'updatePassword')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-field" style="margin-bottom: 4px;">
                <label for="update_password_password_confirmation" class="ep-label">Konfirmasi kata sandi baru</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="ep-input" autocomplete="new-password" placeholder="Ulangi kata sandi baru">
                @error('password_confirmation', 'updatePassword')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-row-end">
                <button type="submit" class="ep-btn ep-btn-save">Simpan</button>

                @if (session('status') === 'password-updated')
                    <span
                        class="ep-success"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2200)">
                        Password diperbarui
                    </span>
                @endif
            </div>
        </div>
    </form>
</section>
