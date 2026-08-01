@extends('layouts.app')

@section('title', 'Data Siswa')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms active"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.penugasan-mengajar.index') }}" class="nav-link-lms"><i class="bi bi-diagram-3"></i> Penugasan Mengajar</a></li>
    <li class="nav-item"><a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Data Siswa</h4>
            <p class="text-muted small mb-0">Kelola akun dan data siswa</p>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Siswa
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.siswa.index') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Cari nama, email, atau NIS..."
                        >
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="class_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ (string) $classId === (string) $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-outline-primary">Terapkan</button>
                    @if ($search || $classId)
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $index => $item)
                            <tr>
                                <td data-label="#">{{ $siswa->firstItem() + $index }}</td>
                                <td data-label="Nama">{{ $item->name }}</td>
                                <td data-label="Email">{{ $item->email }}</td>
                                <td data-label="NIS">{{ $item->nis_nip ?? '-' }}</td>
                                <td data-label="Kelas">
                                    @if ($item->schoolClass)
                                        <span class="badge bg-primary-subtle text-primary-emphasis">{{ $item->schoolClass->name }}</span>
                                    @else
                                        <span class="text-muted small">Belum ada kelas</span>
                                    @endif
                                </td>
                                <td class="td-action">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.siswa.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.siswa.destroy', $item) }}" method="POST" class="form-delete">
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
                                    Belum ada data siswa yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $siswa->links() }}
            </div>
        </div>
    </div>
@endsection
