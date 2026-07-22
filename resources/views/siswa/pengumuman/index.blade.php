@extends('layouts.app')

@section('title', 'Pengumuman')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Pengumuman</h4>
        <p class="text-muted small mb-0">Informasi terbaru dari sekolah</p>
    </div>

    <div class="row g-3">
        @forelse ($announcements as $item)
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="mb-1">{{ $item->title }}</h6>
                            <small class="text-muted text-nowrap ms-2">{{ $item->created_at->format('d M Y') }}</small>
                        </div>
                        <p class="text-muted small mb-2">oleh {{ $item->creator->name ?? '-' }}</p>
                        <p class="mb-2">{{ \Illuminate\Support\Str::limit($item->content, 150) }}</p>
                        <a href="{{ route('siswa.pengumuman.show', $item) }}" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted py-4">
                        Belum ada pengumuman.
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $announcements->links() }}
    </div>
@endsection
