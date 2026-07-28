@extends('layouts.app')

@section('title', 'Tugas')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Tugas</h4>
    <p class="text-muted small mb-3">Daftar tugas dari semua mata pelajaran di kelas Anda</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignments as $item)
                            @php $submission = $mySubmissions->get($item->id); @endphp
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->teachingAssignment->subject->name ?? '-' }}</td>
                                <td>{{ $item->deadline->format('d M Y H:i') }}</td>
                                <td>
                                    @if ($submission && $submission->isGraded())
                                        <span class="badge bg-success-subtle text-success-emphasis">Dinilai: {{ $submission->score }}</span>
                                    @elseif ($submission)
                                        <span class="badge bg-primary-subtle text-primary-emphasis">Sudah Kumpul</span>
                                    @elseif ($item->isPastDeadline())
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Lewat Deadline</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Belum Kumpul</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('siswa.tugas.show', $item) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada tugas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $assignments->links() }}
            </div>
        </div>
    </div>
@endsection
