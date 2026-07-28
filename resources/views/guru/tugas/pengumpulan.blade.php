@extends('layouts.app')

@section('title', 'Pengumpulan Tugas')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <a href="{{ route('guru.kelas-saya.show', $assignment->teaching_assignment_id) }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="mb-3">
        <h4 class="fw-medium mb-0">{{ $assignment->title }}</h4>
        <p class="text-muted small mb-0">
            {{ $assignment->teachingAssignment->subject->name }} - {{ $assignment->teachingAssignment->schoolClass->name }} &middot;
            Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
            @if ($assignment->isPastDeadline())
                <span class="badge bg-danger-subtle text-danger-emphasis">Sudah Lewat Deadline</span>
            @endif
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>File Jawaban</th>
                            <th style="width: 100px;">Nilai</th>
                            <th>Komentar</th>
                            <th style="width: 90px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            @php $submission = $submissions->get($student->id); @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    @if ($submission)
                                        <span class="badge bg-success-subtle text-success-emphasis">Sudah Kumpul</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Belum Kumpul</span>
                                    @endif
                                </td>
                                @if ($submission)
                                    <td>
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($submission->file_path) }}" target="_blank">
                                            <i class="bi bi-file-earmark-arrow-down"></i> Lihat File
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('guru.pengumpulan.update', $submission) }}" method="POST" id="grade-form-{{ $submission->id }}">
                                            @csrf
                                            @method('PUT')
                                            <input
                                                type="number"
                                                name="score"
                                                min="0"
                                                max="100"
                                                value="{{ $submission->score }}"
                                                class="form-control form-control-sm"
                                                placeholder="0-100"
                                            >
                                        </form>
                                    </td>
                                    <td>
                                        <input
                                            type="text"
                                            name="comment"
                                            form="grade-form-{{ $submission->id }}"
                                            value="{{ $submission->comment }}"
                                            class="form-control form-control-sm"
                                            placeholder="Komentar (opsional)"
                                        >
                                    </td>
                                    <td>
                                        <button type="submit" form="grade-form-{{ $submission->id }}" class="btn btn-sm btn-primary">
                                            Simpan
                                        </button>
                                    </td>
                                @else
                                    <td class="text-muted small" colspan="4">Siswa belum upload jawaban.</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada siswa di kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
