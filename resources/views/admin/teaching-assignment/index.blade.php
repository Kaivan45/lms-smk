@extends('layouts.app')

@section('title', 'Penugasan Mengajar')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Penugasan Mengajar</h4>
            <p class="text-muted small mb-0">Hubungkan guru, kelas, mata pelajaran, dan tahun ajaran</p>
        </div>
        <a href="{{ route('admin.penugasan-mengajar.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Penugasan
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.penugasan-mengajar.index') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <select name="class_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ (string) $classId === (string) $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="academic_year_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tahun Ajaran</option>
                        @foreach ($academicYears as $year)
                            <option value="{{ $year->id }}" {{ (string) $academicYearId === (string) $year->id ? 'selected' : '' }}>
                                {{ $year->name }} ({{ $year->semester }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($classId || $academicYearId)
                    <div class="col-md-auto">
                        <a href="{{ route('admin.penugasan-mengajar.index') }}" class="btn btn-outline-secondary">Reset Filter</a>
                    </div>
                @endif
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachingAssignments as $index => $item)
                            <tr>
                                <td>{{ $teachingAssignments->firstItem() + $index }}</td>
                                <td>{{ $item->teacher->name ?? '-' }}</td>
                                <td>{{ $item->subject->name ?? '-' }}</td>
                                <td><span class="badge bg-primary-subtle text-primary-emphasis">{{ $item->schoolClass->name ?? '-' }}</span></td>
                                <td>{{ $item->academicYear->name ?? '-' }} ({{ $item->academicYear->semester ?? '-' }})</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.penugasan-mengajar.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.penugasan-mengajar.destroy', $item) }}" method="POST" class="form-delete">
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
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data penugasan mengajar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $teachingAssignments->links() }}
            </div>
        </div>
    </div>
@endsection
