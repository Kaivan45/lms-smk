@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}#" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Dashboard Admin - LMS SMK</p>

    <div class="alert alert-info">
        <i class="bi bi-info-circle me-1"></i>
        Login berhasil. Statistik dan menu CRUD lengkap akan dibangun pada tahap fitur berikutnya.
    </div>
@endsection
