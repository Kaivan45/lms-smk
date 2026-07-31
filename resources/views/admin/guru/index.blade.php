@extends('layouts.app')

@section('title', 'Data Guru')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h4 class="fw-medium mb-0">Data Guru</h4>
            <p class="text-muted small mb-0">Kelola akun dan data guru</p>
        </div>
        <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Guru
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.guru.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Cari nama, email, atau NIP..."
                    >
                    @if ($search)
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-outline-secondary">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>No. HP</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guru as $index => $item)
                            <tr>
                                <td data-label="#">{{ $guru->firstItem() + $index }}</td>
                                <td data-label="Nama">{{ $item->name }}</td>
                                <td data-label="Email">{{ $item->email }}</td>
                                <td data-label="NIP">{{ $item->nis_nip ?? '-' }}</td>
                                <td data-label="No. HP">{{ $item->phone ?? '-' }}</td>
                                <td class="td-action">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.guru.edit', $item) }}" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.guru.destroy', $item) }}" method="POST" class="form-delete">
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
                                        Tidak ada guru yang cocok dengan pencarian "{{ $search }}".
                                    @else
                                        Belum ada data guru.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $guru->links() }}
            </div>
        </div>
    </div>
@endsection
