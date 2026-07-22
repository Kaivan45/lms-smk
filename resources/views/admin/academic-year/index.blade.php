@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('sidebar-menu')
    @include('sidebar.sidebar')
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
                <table class="table table-hover align-middle">
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
                                <td>{{ $academicYears->firstItem() + $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="badge bg-success-subtle text-success-emphasis">
                                            <i class="bi bi-check-circle"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
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
