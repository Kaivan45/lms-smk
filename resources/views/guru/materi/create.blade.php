@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.show', $teachingAssignment) }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Materi</h4>
        <p class="text-muted small mb-0">
            Untuk {{ $teachingAssignment->subject->name }} - {{ $teachingAssignment->schoolClass->name }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.materi.store', $teachingAssignment) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Materi</label>
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
                    <label for="description" class="form-label">Deskripsi <span class="text-muted small">(opsional)</span></label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Materi</label>
                    <input
                        type="file"
                        id="file"
                        name="file"
                        class="form-control @error('file') is-invalid @enderror"
                        accept=".pdf,.doc,.docx,.ppt,.pptx"
                        required
                    >
                    <div class="form-text">Format: PDF, DOC, DOCX, PPT, PPTX. Maksimal 10 MB.</div>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
