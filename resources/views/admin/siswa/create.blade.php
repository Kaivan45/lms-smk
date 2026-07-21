@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms active"><i class="bi bi-people"></i> Data Siswa</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Siswa</h4>
        <p class="text-muted small mb-0">Isi form berikut untuk menambahkan akun siswa baru</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @include('admin.siswa._form')
            </form>
        </div>
    </div>
@endsection
