@extends('layouts.app')

@section('title', 'Pengumuman')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Pengumuman</h4>
    <p class="text-muted small mb-3">Daftar pengumuman (khusus lihat, tidak bisa diubah)</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Judul</th>
                            <th>Dibuat oleh</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $index => $item)
                            <tr>
                                <td data-label="#">{{ $announcements->firstItem() + $index }}</td>
                                <td data-label="Judul">{{ $item->title }}</td>
                                <td data-label="Dibuat oleh">{{ $item->creator->name ?? '-' }}</td>
                                <td data-label="Tanggal">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada pengumuman.</td>
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
