@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Mata Pelajaran</h4>
    <p class="text-muted small mb-3">Data mata pelajaran (khusus lihat, tidak bisa diubah)</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Kode</th>
                            <th>Nama Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $index => $item)
                            <tr>
                                <td>{{ $subjects->firstItem() + $index }}</td>
                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $item->code }}</span></td>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada data mata pelajaran.</td>
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
@endsection
