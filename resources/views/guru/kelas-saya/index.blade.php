@extends('layouts.app')

@section('title', 'Kelas Saya')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Kelas Saya</h4>
    <p class="text-muted small mb-3">Daftar kelas dan mata pelajaran yang Anda ajar</p>

    <div class="row g-3">
        @forelse ($teachingAssignments as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <span class="badge bg-primary-subtle text-primary-emphasis mb-2">{{ $item->schoolClass->name ?? '-' }}</span>
                        <h6 class="mb-1">{{ $item->subject->name ?? '-' }}</h6>
                        <p class="text-muted small mb-3">
                            {{ $item->academicYear->name ?? '-' }} ({{ $item->academicYear->semester ?? '-' }})
                        </p>
                        <div class="d-flex gap-3 small text-muted mb-3">
                            <span><i class="bi bi-file-earmark-text"></i> {{ $item->materials_count }} materi</span>
                            <span><i class="bi bi-clipboard-check"></i> {{ $item->assignments_count }} tugas</span>
                        </div>
                        <a href="{{ route('guru.kelas-saya.show', $item) }}" class="btn btn-sm btn-primary w-100">
                            Kelola <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted py-4">
                        Anda belum ditugaskan mengajar di kelas manapun. Hubungi Admin untuk pengaturan penugasan mengajar.
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $teachingAssignments->links() }}
    </div>
@endsection
