@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms active"><i class="bi bi-door-open"></i> Data Kelas</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Kelas</h4>
        <p class="text-muted small mb-0">Perbarui data {{ $kelas->name }}</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kelas.update', $kelas) }}" method="POST">
                @method('PUT')
                @include('admin.kelas._form')
            </form>
        </div>
    </div>
@endsection
