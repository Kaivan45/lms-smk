@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $siswa->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            required
        >
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $siswa->email ?? '') }}"
            class="form-control @error('email') is-invalid @enderror"
            required
        >
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">
            Password
            @isset($siswa)
                <span class="text-muted small">(kosongkan jika tidak diubah)</span>
            @endisset
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="{{ isset($siswa) ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
            {{ isset($siswa) ? '' : 'required' }}
        >
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="nis_nip" class="form-label">NIS</label>
        <input
            type="text"
            id="nis_nip"
            name="nis_nip"
            value="{{ old('nis_nip', $siswa->nis_nip ?? '') }}"
            class="form-control @error('nis_nip') is-invalid @enderror"
        >
        @error('nis_nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="class_id" class="form-label">Kelas</label>
        <select id="class_id" name="class_id" class="form-select @error('class_id') is-invalid @enderror">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ (string) old('class_id', $siswa->class_id ?? '') === (string) $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
        @error('class_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($classes->isEmpty())
            <div class="form-text text-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada data kelas. Tambahkan kelas dulu di menu Data Kelas.
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <label for="phone" class="form-label">No. HP</label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $siswa->phone ?? '') }}"
            class="form-control @error('phone') is-invalid @enderror"
        >
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Alamat</label>
        <textarea
            id="address"
            name="address"
            rows="3"
            class="form-control @error('address') is-invalid @enderror"
        >{{ old('address', $siswa->address ?? '') }}</textarea>
        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
