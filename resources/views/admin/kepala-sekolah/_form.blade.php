@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $kepalaSekolah->name ?? '') }}"
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
            value="{{ old('email', $kepalaSekolah->email ?? '') }}"
            class="form-control @error('email') is-invalid @enderror"
            required
        >
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">
            Password
            @isset($kepalaSekolah)
                <span class="text-muted small">(kosongkan jika tidak diubah)</span>
            @endisset
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="{{ isset($kepalaSekolah) ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
            {{ isset($kepalaSekolah) ? '' : 'required' }}
        >
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="nis_nip" class="form-label">NIP</label>
        <input
            type="text"
            id="nis_nip"
            name="nis_nip"
            value="{{ old('nis_nip', $kepalaSekolah->nis_nip ?? '') }}"
            class="form-control @error('nis_nip') is-invalid @enderror"
        >
        @error('nis_nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="form-label">No. HP</label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $kepalaSekolah->phone ?? '') }}"
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
        >{{ old('address', $kepalaSekolah->address ?? '') }}</textarea>
        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.kepala-sekolah.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
