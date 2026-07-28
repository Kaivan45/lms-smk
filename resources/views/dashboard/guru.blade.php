@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Dashboard Guru - LMS SMK</p>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-door-open text-primary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['kelas'] }}</h4>
                    <div class="text-muted small">Kelas Diajar</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-book text-primary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['mapel'] }}</h4>
                    <div class="text-muted small">Mata Pelajaran</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text text-secondary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['materi'] }}</h4>
                    <div class="text-muted small">Materi</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard-check text-secondary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['tugas'] }}</h4>
                    <div class="text-muted small">Tugas</div>
                </div>
            </div>
        </div>
    </div>

    @if ($teachingAssignments->isEmpty())
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Anda belum ditugaskan mengajar di kelas manapun. Hubungi Admin untuk diatur penugasan mengajarnya.
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-door-open me-1"></i> Kelas yang Anda Ajar</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($teachingAssignments as $item)
                        <a href="{{ route('guru.kelas-saya.show', $item) }}" class="btn btn-sm btn-outline-primary">
                            {{ $item->subject->name }} - {{ $item->schoolClass->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
