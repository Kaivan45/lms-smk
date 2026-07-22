@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="teacher_id" class="form-label">Guru</label>
        <select id="teacher_id" name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
            <option value="">-- Pilih Guru --</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ (string) old('teacher_id', $teachingAssignment->teacher_id ?? '') === (string) $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
        @error('teacher_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($teachers->isEmpty())
            <div class="form-text text-warning"><i class="bi bi-exclamation-triangle"></i> Belum ada data guru.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label for="subject_id" class="form-label">Mata Pelajaran</label>
        <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" {{ (string) old('subject_id', $teachingAssignment->subject_id ?? '') === (string) $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
        @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($subjects->isEmpty())
            <div class="form-text text-warning"><i class="bi bi-exclamation-triangle"></i> Belum ada data mata pelajaran.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label for="class_id" class="form-label">Kelas</label>
        <select id="class_id" name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ (string) old('class_id', $teachingAssignment->class_id ?? '') === (string) $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
        @error('class_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($classes->isEmpty())
            <div class="form-text text-warning"><i class="bi bi-exclamation-triangle"></i> Belum ada data kelas.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label for="academic_year_id" class="form-label">Tahun Ajaran</label>
        <select id="academic_year_id" name="academic_year_id" class="form-select @error('academic_year_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tahun Ajaran --</option>
            @foreach ($academicYears as $year)
                <option value="{{ $year->id }}" {{ (string) old('academic_year_id', $teachingAssignment->academic_year_id ?? '') === (string) $year->id ? 'selected' : '' }}>
                    {{ $year->name }} ({{ $year->semester }}){{ $year->is_active ? ' - Aktif' : '' }}
                </option>
            @endforeach
        </select>
        @error('academic_year_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($academicYears->isEmpty())
            <div class="form-text text-warning"><i class="bi bi-exclamation-triangle"></i> Belum ada data tahun ajaran.</div>
        @endif
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.penugasan-mengajar.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
