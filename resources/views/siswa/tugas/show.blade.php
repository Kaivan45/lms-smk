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
                    @if (! $assignment->allow_late_submission)
                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Pengumpulan Ditutup</span>
                    @endif
                @endif
            </p>

            @if ($assignment->description)
                <hr>
                <div style="white-space: pre-line;">{{ $assignment->description }}</div>
            @endif
        </div>
    </div>

    @php
        $isLate = $submission && $submission->submitted_at->greaterThan($assignment->deadline);
        $submissionClosed = $assignment->isPastDeadline() && ! $assignment->allow_late_submission;
    @endphp

    @if ($submission && $submission->isGraded())
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-star me-1"></i> Nilai & Komentar Guru</h6>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-success-subtle text-success-emphasis fs-6">Nilai: {{ $submission->score }}</span>
                    @if ($isLate)
                        <span class="badge bg-danger-subtle text-danger-emphasis">Dikumpulkan Terlambat</span>
                    @endif
                </div>
                @if ($submission->comment)
                    <p class="mb-0 text-muted">{{ $submission->comment }}</p>
                @endif
                <hr>
                <a href="{{ route('files.jawaban', $submission) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-file-earmark-arrow-down"></i> Lihat Jawaban yang Dikumpulkan
                </a>
            </div>
        </div>
    @elseif ($submissionClosed && ! $submission)
        <div class="alert alert-secondary">
            <i class="bi bi-lock me-1"></i>
            Pengumpulan untuk tugas ini sudah ditutup karena sudah melewati deadline dan guru tidak mengizinkan pengumpulan terlambat.
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-upload me-1"></i> {{ $submission ? 'Ganti Jawaban' : 'Kumpulkan Jawaban' }}</h6>

                @if ($submission)
                    <p class="text-muted small mb-2">
                        Anda sudah mengumpulkan pada {{ $submission->submitted_at->format('d M Y, H:i') }}
                        @if ($isLate)
                            <span class="badge bg-danger-subtle text-danger-emphasis">Terlambat</span>
                        @endif
                        .
                        <a href="{{ route('files.jawaban', $submission) }}" target="_blank">Lihat file</a>.
                    </p>
                @endif

                {{-- INI KUNCINYA: kalau $submissionClosed true, form TIDAK ditampilkan
                     sama sekali - baik untuk siswa yang belum kumpul MAUPUN yang
                     sudah kumpul tapi mau ganti jawaban --}}
                @if ($submissionClosed)
                    <div class="alert alert-secondary mb-0">
                        <i class="bi bi-lock me-1"></i>
                        Deadline sudah lewat dan guru tidak mengizinkan pengumpulan terlambat, jadi jawaban tidak bisa diganti lagi.
                    </div>
                @else
                    @if ($assignment->isPastDeadline())
                        <div class="alert alert-warning py-2">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Deadline sudah lewat. Anda masih bisa mengumpulkan, tapi akan ditandai <strong>Terlambat</strong>.
                        </div>
                    @endif

                    <p class="text-muted small mb-2">Upload file baru di bawah ini{{ $submission ? ' untuk menggantinya' : '' }}.</p>

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
                            <div class="form-text">Format: PDF, DOC, DOCX, PPT, PPTX, ZIP, JPG, PNG. Maksimal {{ round(config('lms.max_upload_size_kb') / 1024) }} MB.</div>
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i> {{ $submission ? 'Ganti Jawaban' : 'Kumpulkan' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endif
@endsection