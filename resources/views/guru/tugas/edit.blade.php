@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.show', $assignment->teaching_assignment_id) }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Tugas</h4>
        <p class="text-muted small mb-0">
            {{ $assignment->teachingAssignment->subject->name }} - {{ $assignment->teachingAssignment->schoolClass->name }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.tugas.update', $assignment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Tugas</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $assignment->title) }}"
                        class="form-control @error('title') is-invalid @enderror"
                        required
                    >
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Instruksi / Deskripsi Tugas</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description', $assignment->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input
                        type="datetime-local"
                        id="deadline"
                        name="deadline"
                        value="{{ old('deadline', $assignment->deadline->format('Y-m-d\TH:i')) }}"
                        class="form-control @error('deadline') is-invalid @enderror"
                        required
                    >
                    @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        id="allow_late_submission"
                        name="allow_late_submission"
                        value="1"
                        class="form-check-input"
                        {{ old('allow_late_submission', $assignment->allow_late_submission) ? 'checked' : '' }}
                    >
                    <label for="allow_late_submission" class="form-check-label">
                        Izinkan siswa mengumpulkan setelah deadline (terlambat)
                    </label>
                    <div class="form-text">
                        Kalau dicentang, siswa masih bisa upload jawaban walau sudah lewat deadline (akan ditandai "Terlambat"). Kalau tidak dicentang, upload otomatis ditutup begitu deadline lewat.
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                    <a href="{{ route('guru.kelas-saya.show', $assignment->teaching_assignment_id) }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

            <hr>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-medium small">Hapus Tugas</div>
                    <div class="text-muted small">Ini akan menghapus semua pengumpulan siswa untuk tugas ini juga.</div>
                </div>
                <form action="{{ route('guru.tugas.destroy', $assignment) }}" method="POST" class="form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
