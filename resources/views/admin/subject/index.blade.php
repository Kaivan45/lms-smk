@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('sidebar-menu')
    @include('sidebar.sidebar')
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Mata Pelajaran</h4>
            <p class="text-muted small mb-0">Kelola daftar mata pelajaran</p>
        </div>
        <a href="{{ route('admin.mata-pelajaran.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Mata Pelajaran
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.mata-pelajaran.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Cari nama atau kode mapel..."
                    >
                    @if ($search)
                        <a href="{{ route('admin.mata-pelajaran.index') }}" class="btn btn-outline-secondary">
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
                            <th>Kode</th>
                            <th>Nama Mata Pelajaran</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $index => $item)
                            <tr>
                                <td>{{ $subjects->firstItem() + $index }}</td>
                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $item->code }}</span></td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.mata-pelajaran.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.mata-pelajaran.destroy', $item) }}" method="POST" class="form-delete">
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
                                <td colspan="4" class="text-center text-muted py-4">
                                    @if ($search)
                                        Tidak ada mata pelajaran yang cocok dengan pencarian "{{ $search }}".
                                    @else
                                        Belum ada data mata pelajaran.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $subjects->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data siswa yang dihapus tidak dapat dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });
        });

    });
    </script>
    @endpush
@endsection
