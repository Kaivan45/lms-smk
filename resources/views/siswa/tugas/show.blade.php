@extends('layouts.app')

@section('title', $assignment->title)

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('siswa.tugas.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <h4 class="fw-medium mb-1">{{ $assignment->title }}</h4>
            <p class="text-muted small mb-3">
                {{ $assignment->teachingAssignment->subject->name }} &middot;
                Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
                @if ($assignment->isPastDeadline())
                    <span class="badge bg-danger-subtle text-danger-emphasis">Sudah Lewat Deadline</span>
                @endif
            </p>

            @if ($assignment->description)
                <hr>
                <div style="white-space: pre-line;">{{ $assignment->description }}</div>
            @endif
        </div>
    </div>

    @if ($submission && $submission->isGraded())
        {{-- Sudah dinilai - tampilkan nilai & komentar, tidak bisa upload ulang --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-star me-1"></i> Nilai & Komentar Guru</h6>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <span class="badge bg-success-subtle text-success-emphasis fs-6">Nilai: {{ $submission->score }}</span>
                </div>
                @if ($submission->comment)
                    <p class="mb-0 text-muted">{{ $submission->comment }}</p>
                @endif
                <hr>
                <a href="{{ \Illuminate\Support\Facades\Storage::url($submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-file-earmark-arrow-down"></i> Lihat Jawaban yang Dikumpulkan
                </a>
            </div>
        </div>
    @else
        {{-- Belum dinilai (atau belum kumpul sama sekali) - tampilkan form upload --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-upload me-1"></i> {{ $submission ? 'Ganti Jawaban' : 'Kumpulkan Jawaban' }}</h6>

                @if ($submission)
                    <p class="text-muted small mb-3">
                        Anda sudah mengumpulkan pada {{ $submission->submitted_at->format('d M Y, H:i') }}.
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($submission->file_path) }}" target="_blank">Lihat file</a>.
                        Upload file baru di bawah ini untuk menggantinya.
                    </p>
                @endif

                <form action="{{ route('siswa.tugas.kumpulkan', $assignment) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input
                            type="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.jpg,.jpeg,.png"
                            required
                        >
                        <div class="form-text">Format: PDF, DOC, DOCX, PPT, PPTX, ZIP, JPG, PNG. Maksimal 10 MB.</div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload me-1"></i> {{ $submission ? 'Ganti Jawaban' : 'Kumpulkan' }}
                    </button>
                </form>
            </div>
        </div>
    @endif
@endsection
