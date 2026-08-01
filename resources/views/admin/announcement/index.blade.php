@extends('layouts.app')

@section('title', 'Pengumuman')

@section('sidebar-menu')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.penugasan-mengajar.index') }}" class="nav-link-lms"><i class="bi bi-diagram-3"></i> Penugasan Mengajar</a></li>
    <li class="nav-item"><a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms active"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Pengumuman</h4>
            <p class="text-muted small mb-0">Kelola pengumuman untuk seluruh pengguna sistem</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Buat Pengumuman
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Cari judul pengumuman..."
                    >
                    @if ($search)
                        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Judul</th>
                            <th>Dibuat oleh</th>
                            <th>Tanggal</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $index => $item)
                            <tr>
                                <td data-label="#">{{ $announcements->firstItem() + $index }}</td>
                                <td data-label="Judul">{{ $item->title }}</td>
                                <td data-label="Dibuat oleh">{{ $item->creator->name ?? '-' }}</td>
                                <td data-label="Tanggal">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="td-action">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.pengumuman.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST" class="form-delete">
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    @if ($search)
                                        Tidak ada pengumuman yang cocok dengan pencarian "{{ $search }}".
                                    @else
                                        Belum ada pengumuman.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
@endsection
