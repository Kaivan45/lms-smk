@extends('layouts.app')

@section('title', 'Data Kelas')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms active"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Data Kelas</h4>
            <p class="text-muted small mb-0">Kelola kelas, wali kelas, dan tahun ajaran</p>
        </div>
        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kelas.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Cari nama kelas..."
                    >
                    @if ($search)
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $index => $item)
                            <tr>
                                <td>{{ $kelas->firstItem() + $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{ $item->academicYear->name ?? '-' }}
                                    @if ($item->academicYear?->is_active)
                                        <span class="badge bg-success-subtle text-success-emphasis">Aktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->homeroomTeacher->name ?? '-' }}</td>
                                <td>{{ $item->students_count }} siswa</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.kelas.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.kelas.destroy', $item) }}" method="POST" class="form-delete">
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
                                <td colspan="6" class="text-center text-muted py-4">
                                    @if ($search)
                                        Tidak ada kelas yang cocok dengan pencarian "{{ $search }}".
                                    @else
                                        Belum ada data kelas.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>
@endsection
