@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms active"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Mata Pelajaran</h4>
        <p class="text-muted small mb-0">Perbarui data {{ $subject->name }}</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.mata-pelajaran.update', $subject) }}" method="POST">
                @method('PUT')
                @include('admin.subject._form')
            </form>
        </div>
    </div>
@endsection
