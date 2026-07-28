@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.show', $teachingAssignment) }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Tugas</h4>
        <p class="text-muted small mb-0">
            Untuk {{ $teachingAssignment->subject->name }} - {{ $teachingAssignment->schoolClass->name }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.tugas.store', $teachingAssignment) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Tugas</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
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
                    >{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input
                        type="datetime-local"
                        id="deadline"
                        name="deadline"
                        value="{{ old('deadline') }}"
                        class="form-control @error('deadline') is-invalid @enderror"
                        required
                    >
                    @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                    <a href="{{ route('guru.kelas-saya.show', $teachingAssignment) }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
