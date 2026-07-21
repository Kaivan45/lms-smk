@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms active"><i class="bi bi-door-open"></i> Data Kelas</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Kelas</h4>
        <p class="text-muted small mb-0">Isi form berikut untuk menambahkan kelas baru</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @include('admin.kelas._form')
            </form>
        </div>
    </div>
@endsection
