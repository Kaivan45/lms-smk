@extends('layouts.app')

@section('title', 'Materi')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Materi</h4>
    <p class="text-muted small mb-3">Materi pembelajaran dari semua mata pelajaran di kelas Anda</p>

    @forelse ($teachingAssignments as $item)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">{{ $item->subject->name ?? '-' }}</h6>
                    <span class="text-muted small">{{ $item->teacher->name ?? '-' }}</span>
                </div>

                @forelse ($item->materials as $material)
                    <div class="d-flex justify-content-between align-items-center border-top py-2">
                        <div>
                            <div class="fw-medium small">{{ $material->title }}</div>
                            @if ($material->description)
                                <div class="text-muted small">{{ $material->description }}</div>
                            @endif
                            <div class="text-muted small">{{ $material->created_at->format('d M Y') }}</div>
                        </div>
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($material->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary text-nowrap">
                            <i class="bi bi-download"></i> {{ strtoupper($material->file_type) }}
                        </a>
                    </div>
                @empty
                    <p class="text-muted small mb-0 pt-2">Belum ada materi untuk mapel ini.</p>
                @endforelse
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">
                Belum ada mata pelajaran yang terhubung ke kelas Anda.
            </div>
        </div>
    @endforelse
@endsection
