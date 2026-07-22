@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Tahun Ajaran</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $academicYear->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Contoh: 2025/2026"
            required
        >
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="semester" class="form-label">Semester</label>
        <select id="semester" name="semester" class="form-select @error('semester') is-invalid @enderror" required>
            <option value="">-- Pilih Semester --</option>
            @foreach (['Ganjil', 'Genap'] as $semester)
                <option value="{{ $semester }}" {{ old('semester', $academicYear->semester ?? '') === $semester ? 'selected' : '' }}>
                    {{ $semester }}
                </option>
            @endforeach
        </select>
        @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input
                type="checkbox"
                id="is_active"
                name="is_active"
                value="1"
                class="form-check-input"
                {{ old('is_active', $academicYear->is_active ?? false) ? 'checked' : '' }}
            >
            <label for="is_active" class="form-check-label">
                Jadikan tahun ajaran aktif
            </label>
            <div class="form-text">
                Hanya boleh ada 1 tahun ajaran aktif. Jika dicentang, tahun ajaran lain otomatis dinonaktifkan.
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.tahun-ajaran.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
