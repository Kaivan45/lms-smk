@csrf

<div class="row g-3">
    <div class="col-md-8">
        <label for="name" class="form-label">Nama Mata Pelajaran</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $subject->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Contoh: Pemrograman Web"
            required
        >
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="code" class="form-label">Kode</label>
        <input
            type="text"
            id="code"
            name="code"
            value="{{ old('code', $subject->code ?? '') }}"
            class="form-control @error('code') is-invalid @enderror"
            placeholder="Contoh: PW-01"
            required
        >
        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.mata-pelajaran.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
