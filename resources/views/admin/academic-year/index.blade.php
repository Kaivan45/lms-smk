@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.penugasan-mengajar.index') }}" class="nav-link-lms"><i class="bi bi-diagram-3"></i> Penugasan Mengajar</a></li>
    <li class="nav-item"><a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms active"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Tahun Ajaran</h4>
            <p class="text-muted small mb-0">Kelola tahun ajaran & semester aktif</p>
        </div>
        <a href="{{ route('admin.tahun-ajaran.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Tahun Ajaran
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($academicYears as $index => $item)
                            <tr>
                                <td data-label="#">{{ $academicYears->firstItem() + $index }}</td>
                                <td data-label="Tahun Ajaran">{{ $item->name }}</td>
                                <td data-label="Semester">{{ $item->semester }}</td>
                                <td data-label="Status">
                                    @if ($item->is_active)
                                        <span class="badge bg-success-subtle text-success-emphasis">
                                            <i class="bi bi-check-circle"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="td-action">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.tahun-ajaran.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.tahun-ajaran.destroy', $item) }}" method="POST" class="form-delete">
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
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data tahun ajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $academicYears->links() }}
            </div>
        </div>
    </div>
@endsection
