@extends('layouts.app')

@section('title', 'Tambah Penugasan Mengajar')

@section('sidebar-menu')
    @include('sidebar.sidebar')
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Penugasan Mengajar</h4>
        <p class="text-muted small mb-0">Hubungkan guru dengan kelas dan mata pelajaran yang diajarnya</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.penugasan-mengajar.store') }}" method="POST">
                @include('admin.teaching-assignment._form')
            </form>
        </div>
    </div>
@endsection
