@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms active"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Pengumuman</h4>
        <p class="text-muted small mb-0">Perbarui pengumuman "{{ $announcement->title }}"</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.update', $announcement) }}" method="POST">
                @method('PUT')
                @include('admin.announcement._form')
            </form>
        </div>
    </div>
@endsection
