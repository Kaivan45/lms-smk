@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah')

@section('sidebar-menu')
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-bar-chart"></i> Rekap Nilai</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-clipboard-data"></i> Rekap Tugas</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-person-badge"></i> Daftar Guru</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-people"></i> Daftar Siswa</a></li>
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Dashboard Kepala Sekolah (khusus monitoring) - LMS SMK</p>

    <div class="alert alert-info">
        <i class="bi bi-info-circle me-1"></i>
        Login berhasil. Statistik monitoring lengkap akan dibangun pada tahap fitur berikutnya.
    </div>
@endsection
