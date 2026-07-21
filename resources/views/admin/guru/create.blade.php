@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms active"><i class="bi bi-person-badge"></i> Data Guru</a></li>
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Tambah Guru</h4>
        <p class="text-muted small mb-0">Isi form berikut untuk menambahkan akun guru baru</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.guru.store') }}" method="POST">
                @include('admin.guru._form')
            </form>
        </div>
    </div>
@endsection
