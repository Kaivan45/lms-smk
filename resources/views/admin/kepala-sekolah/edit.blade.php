@extends('layouts.app')

@section('title', 'Edit Kepala Sekolah')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms active"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Kepala Sekolah</h4>
        <p class="text-muted small mb-0">Perbarui data {{ $kepalaSekolah->name }}</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kepala-sekolah.update', $kepalaSekolah) }}" method="POST">
                @method('PUT')
                @include('admin.kepala-sekolah._form')
            </form>
        </div>
    </div>
@endsection
