@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar-menu')
    @include('sidebar.sidebar')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Dashboard Admin - LMS SMK</p>

    <div class="alert alert-info">
        <i class="bi bi-info-circle me-1"></i>
        Login berhasil. Statistik dan menu CRUD lengkap akan dibangun pada tahap fitur berikutnya.
    </div>
@endsection
