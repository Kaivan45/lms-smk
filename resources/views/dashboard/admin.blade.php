@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Dashboard Admin - LMS SMK</p>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.guru.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge text-primary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['guru'] }}</h4>
                        <div class="text-muted small">Guru</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.siswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people text-primary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['siswa'] }}</h4>
                        <div class="text-muted small">Siswa</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.kelas.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-door-open text-primary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['kelas'] }}</h4>
                        <div class="text-muted small">Kelas</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.mata-pelajaran.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-primary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['mapel'] }}</h4>
                        <div class="text-muted small">Mata Pelajaran</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <a href="{{ route('admin.penugasan-mengajar.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-diagram-3 text-secondary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['penugasan_mengajar'] }}</h4>
                        <div class="text-muted small">Penugasan Mengajar</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4">
            <a href="{{ route('admin.kepala-sekolah.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-workspace text-secondary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['kepala_sekolah'] }}</h4>
                        <div class="text-muted small">Kepala Sekolah</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4">
            <a href="{{ route('admin.pengumuman.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-megaphone text-secondary fs-3"></i>
                        <h4 class="mb-0 mt-2">{{ $stats['pengumuman'] }}</h4>
                        <div class="text-muted small">Pengumuman</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @if (!$activeAcademicYear || $classesWithoutHomeroom > 0)
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-1"></i>
            @if (!$activeAcademicYear)
                Belum ada tahun ajaran yang aktif. <a href="{{ route('admin.tahun-ajaran.index') }}" class="alert-link">Atur di sini</a>.
            @endif
            @if ($classesWithoutHomeroom > 0)
                {{ $classesWithoutHomeroom }} kelas belum punya wali kelas. <a href="{{ route('admin.kelas.index') }}" class="alert-link">Lihat data kelas</a>.
            @endif
        </div>
    @endif

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"><i class="bi bi-megaphone me-1"></i> Pengumuman Terbaru</h6>
                        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Buat Baru
                        </a>
                    </div>

                    @forelse ($latestAnnouncements as $item)
                        <div class="border-bottom py-2">
                            <a href="{{ route('admin.pengumuman.edit', $item) }}" class="text-decoration-none text-dark fw-medium">
                                {{ $item->title }}
                            </a>
                            <div class="text-muted small">{{ $item->created_at->diffForHumans() }}</div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="mb-3"><i class="bi bi-calendar3 me-1"></i> Tahun Ajaran Aktif</h6>
                    @if ($activeAcademicYear)
                        <span class="badge bg-success-subtle text-success-emphasis fs-6">
                            {{ $activeAcademicYear->name }} - {{ $activeAcademicYear->semester }}
                        </span>
                    @else
                        <p class="text-muted small mb-0">Belum ada tahun ajaran aktif.</p>
                    @endif

                    <hr>

                    <h6 class="mb-3"><i class="bi bi-compass me-1"></i> Navigasi Cepat</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.guru.create') }}" class="btn btn-sm btn-outline-primary">+ Guru</a>
                        <a href="{{ route('admin.siswa.create') }}" class="btn btn-sm btn-outline-primary">+ Siswa</a>
                        <a href="{{ route('admin.kelas.create') }}" class="btn btn-sm btn-outline-primary">+ Kelas</a>
                        <a href="{{ route('admin.penugasan-mengajar.create') }}" class="btn btn-sm btn-outline-primary">+ Penugasan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
