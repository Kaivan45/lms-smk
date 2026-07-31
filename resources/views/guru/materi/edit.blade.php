@extends('layouts.app')

@section('title', 'Edit Materi')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.show', $material->teaching_assignment_id) }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Materi</h4>
        <p class="text-muted small mb-0">
            {{ $material->teachingAssignment->subject->name }} - {{ $material->teachingAssignment->schoolClass->name }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.materi.update', $material) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Materi</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $material->title) }}"
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
                    >{{ old('description', $material->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Materi</label>
                    <div class="mb-2">
                        <a href="{{ route('files.materi', $material) }}" target="_blank" class="small">
                            <i class="bi bi-paperclip"></i> File saat ini ({{ strtoupper($material->file_type) }})
                        </a>
                    </div>
                    <input
                        type="file"
                        id="file"
                        name="file"
                        class="form-control @error('file') is-invalid @enderror"
                        accept=".pdf,.doc,.docx,.ppt,.pptx"
                    >
                    <div class="form-text">Kosongkan jika tidak ingin mengganti file. Maksimal {{ round(config('lms.max_upload_size_kb') / 1024) }} MB.</div>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                    <a href="{{ route('guru.kelas-saya.show', $material->teaching_assignment_id) }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
