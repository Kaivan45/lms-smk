@extends('layouts.app')

@section('title', $teachingAssignment->subject->name . ' - ' . $teachingAssignment->schoolClass->name)

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Kelas Saya
    </a>

    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">{{ $teachingAssignment->subject->name }}</h4>
            <p class="text-muted small mb-0">
                {{ $teachingAssignment->schoolClass->name }} &middot;
                {{ $teachingAssignment->academicYear->name }} ({{ $teachingAssignment->academicYear->semester }}) &middot;
                {{ $teachingAssignment->schoolClass->students->count() }} siswa
            </p>
        </div>
    </div>

    {{-- Bagian Materi --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"><i class="bi bi-file-earmark-text me-1"></i> Materi</h6>
                <a href="{{ route('guru.materi.create', $teachingAssignment) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Materi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Tipe File</th>
                            <th>Tanggal</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachingAssignment->materials as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis text-uppercase">{{ $material->file_type }}</span></td>
                                <td>{{ $material->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($material->file_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary" aria-label="Lihat file">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('guru.materi.edit', $material) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('guru.materi.destroy', $material) }}" method="POST" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada materi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bagian Tugas --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"><i class="bi bi-clipboard-check me-1"></i> Tugas</h6>
                <a href="{{ route('guru.tugas.create', $teachingAssignment) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Tugas
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Deadline</th>
                            <th>Pengumpulan</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachingAssignment->assignments as $assignment)
                            <tr>
                                <td>
                                    {{ $assignment->title }}
                                    @if ($assignment->isPastDeadline())
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Lewat Deadline</span>
                                    @endif
                                </td>
                                <td>{{ $assignment->deadline->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('guru.tugas.pengumpulan', $assignment) }}">
                                        {{ $assignment->submissions_count }} pengumpulan
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('guru.tugas.pengumpulan', $assignment) }}" class="btn btn-sm btn-outline-secondary" aria-label="Nilai">
                                            <i class="bi bi-star"></i>
                                        </a>
                                        <a href="{{ route('guru.tugas.edit', $assignment) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada tugas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
