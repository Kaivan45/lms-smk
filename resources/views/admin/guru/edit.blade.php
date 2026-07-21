@extends('layouts.app')

@section('title', 'Edit Guru')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms active"><i class="bi bi-person-badge"></i> Data Guru</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Guru</h4>
        <p class="text-muted small mb-0">Perbarui data {{ $guru->name }}</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.guru.update', $guru) }}" method="POST">
                @method('PUT')
                @include('admin.guru._form')
            </form>
        </div>
    </div>
@endsection
