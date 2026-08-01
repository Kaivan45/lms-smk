@extends('layouts.app')

@section('title', 'Nilai')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Nilai</h4>
    <p class="text-muted small mb-3">Rekap nilai tugas Anda</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th>Tugas</th>
                            <th>Mata Pelajaran</th>
                            <th>Dikumpulkan</th>
                            <th>Nilai</th>
                            <th>Komentar Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $item)
                            <tr>
                                <td data-label="Tugas">{{ $item->assignment->title ?? '-' }}</td>
                                <td data-label="Mapel">{{ $item->assignment->teachingAssignment->subject->name ?? '-' }}</td>
                                <td data-label="Dikumpulkan">
                                    {{ $item->submitted_at->format('d M Y') }}
                                    @if ($item->isLate())
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Terlambat</span>
                                    @endif
                                </td>
                                <td data-label="Nilai">
                                    @if ($item->isGraded())
                                        <span class="badge bg-success-subtle text-success-emphasis">{{ $item->score }}</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Belum dinilai</span>
                                    @endif
                                </td>
                                <td data-label="Komentar" class="text-muted small td-block">{{ $item->comment ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Anda belum mengumpulkan tugas apapun.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
@endsection
