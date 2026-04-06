<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        @php
            $avatarUrl = $user->profile_photo_path
                ? asset('storage/' . $user->profile_photo_path)
                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=bfdbfe&color=1e3a8a&size=200';
        @endphp

        <div class="ep-card">
            <p class="ep-card-title">Foto Profil</p>

            <div class="ep-photo-row">
                <div class="ep-avatar">
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                </div>

                <div>
                    <p class="ep-user-name">{{ $user->name }}</p>
                    <p class="ep-user-meta">JPG, PNG, WEBP (maks 2MB)</p>

                    <div class="ep-photo-actions">
                        <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp" style="display:none"
                               onchange="document.getElementById('avatar-file-name').textContent = this.files[0] ? this.files[0].name : 'Belum ada file dipilih';document.getElementById('remove_avatar').checked = false;">
                        <label for="avatar" class="ep-btn ep-btn-primary">Unggah foto baru</label>

                        <label class="ep-btn ep-btn-ghost" for="remove_avatar">Hapus</label>
                        <input id="remove_avatar" type="checkbox" name="remove_avatar" value="1" style="display:none">
                    </div>

                    <span id="avatar-file-name" class="ep-hint">Belum ada file dipilih</span>
                </div>
            </div>

            @error('avatar')
                <p class="ep-error">{{ $message }}</p>
            @enderror
            @error('remove_avatar')
                <p class="ep-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ep-card">
            <p class="ep-card-title">Informasi Akun</p>

            <div class="ep-field">
                <label for="name" class="ep-label">Nama lengkap</label>
                <input id="name" name="name" type="text" class="ep-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-field">
                <label for="email" class="ep-label">Alamat email</label>
                <input id="email" name="email" type="email" class="ep-input" value="{{ old('email', $user->email) }}" required autocomplete="username">

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                    <div style="margin-top:8px;">
                        @if ($user->hasVerifiedEmail())
                            <span class="ep-badge ep-badge-ok">Terverifikasi</span>
                        @else
                            <span class="ep-badge ep-badge-warn">Belum verifikasi</span>
                            <button form="send-verification" class="ep-link">
                                Kirim ulang verifikasi
                            </button>
                        @endif
                    </div>
                @endif

                @if (session('status') === 'verification-link-sent')
                    <p class="ep-success" style="margin-top:6px;">Link verifikasi baru sudah dikirim.</p>
                @endif

                @error('email')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-split"></div>

            <div class="ep-field">
                <label for="phone" class="ep-label">Nomor HP</label>
                <input id="phone" name="phone" type="text" class="ep-input" value="{{ old('phone', $user->phone) }}" autocomplete="tel" placeholder="08xxxxxxxxxx">
                @error('phone')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-field" style="margin-bottom: 4px;">
                <label for="alamat" class="ep-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="ep-input ep-textarea" placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <p class="ep-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="ep-row-end">
                <button type="submit" class="ep-btn ep-btn-save">Simpan</button>

                @if (session('status') === 'profile-updated')
                    <span
                        class="ep-success"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2200)">
                        Perubahan tersimpan
                    </span>
                @endif
            </div>
        </div>
    </form>
</section>
