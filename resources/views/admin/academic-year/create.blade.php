@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms active"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Tahun Ajaran</h4>
        <p class="text-muted small mb-0">Isi form berikut untuk menambahkan tahun ajaran baru</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST">
                @include('admin.academic-year._form')
            </form>
        </div>
    </div>
@endsection
