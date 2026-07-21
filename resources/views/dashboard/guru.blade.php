@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('sidebar-menu')
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-door-open"></i> Kelas Saya</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-file-earmark-text"></i> Materi</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-clipboard-check"></i> Tugas</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-people"></i> Daftar Siswa</a></li>
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Dashboard Guru - LMS SMK</p>

    <div class="alert alert-info">
        <i class="bi bi-info-circle me-1"></i>
        Login berhasil. Menu materi, tugas, dan penilaian akan dibangun pada tahap fitur berikutnya.
    </div>
@endsection
