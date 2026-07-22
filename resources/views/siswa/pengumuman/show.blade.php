@extends('layouts.app')

@section('title', $announcement->title)

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('siswa.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h4 class="fw-medium mb-1">{{ $announcement->title }}</h4>
            <p class="text-muted small mb-3">
                Oleh {{ $announcement->creator->name ?? '-' }} &middot;
                {{ $announcement->created_at->format('d M Y, H:i') }}
            </p>
            <hr>
            <div class="lh-lg" style="white-space: pre-line;">{{ $announcement->content }}</div>
        </div>
    </div>
@endsection
