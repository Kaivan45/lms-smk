@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Dashboard Kepala Sekolah (khusus monitoring) - LMS SMK</p>

    <div class="row g-3 mb-2">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-badge text-primary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['guru'] }}</h4>
                    <div class="text-muted small">Guru</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people text-primary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['siswa'] }}</h4>
                    <div class="text-muted small">Siswa</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-door-open text-primary fs-3"></i>
                    <h4 class="mb-0 mt-2">{{ $stats['kelas'] }}</h4>
                    <div class="text-muted small">Kelas</div>
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
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="mb-3"><i class="bi bi-compass me-1"></i> Navigasi Cepat</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('kepala-sekolah.guru') }}" class="btn btn-sm btn-outline-primary">Daftar Guru</a>
                <a href="{{ route('kepala-sekolah.siswa') }}" class="btn btn-sm btn-outline-primary">Daftar Siswa</a>
                <a href="{{ route('kepala-sekolah.kelas') }}" class="btn btn-sm btn-outline-primary">Daftar Kelas</a>
                <a href="{{ route('kepala-sekolah.mata-pelajaran') }}" class="btn btn-sm btn-outline-primary">Mata Pelajaran</a>
                <a href="{{ route('kepala-sekolah.pengumuman') }}" class="btn btn-sm btn-outline-primary">Pengumuman</a>
            </div>
        </div>
    </div>
@endsection
