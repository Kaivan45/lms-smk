@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Kelas</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $kelas->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Contoh: XII RPL 1"
            required
        >
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="academic_year_id" class="form-label">Tahun Ajaran</label>
        <select id="academic_year_id" name="academic_year_id" class="form-select @error('academic_year_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tahun Ajaran --</option>
            @foreach ($academicYears as $year)
                <option value="{{ $year->id }}" {{ (string) old('academic_year_id', $kelas->academic_year_id ?? '') === (string) $year->id ? 'selected' : '' }}>
                    {{ $year->name }} ({{ $year->semester }}){{ $year->is_active ? ' - Aktif' : '' }}
                </option>
            @endforeach
        </select>
        @error('academic_year_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($academicYears->isEmpty())
            <div class="form-text text-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada tahun ajaran. Tambahkan dulu di menu Tahun Ajaran.
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <label for="homeroom_teacher_id" class="form-label">Wali Kelas <span class="text-muted small">(opsional)</span></label>
        <select id="homeroom_teacher_id" name="homeroom_teacher_id" class="form-select @error('homeroom_teacher_id') is-invalid @enderror">
            <option value="">-- Belum Ada Wali Kelas --</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ (string) old('homeroom_teacher_id', $kelas->homeroom_teacher_id ?? '') === (string) $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
        @error('homeroom_teacher_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($teachers->isEmpty())
            <div class="form-text text-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada data guru. Tambahkan dulu di menu Data Guru.
            </div>
        @endif
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
