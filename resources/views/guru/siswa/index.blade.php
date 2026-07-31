@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Daftar Siswa</h4>
    <p class="text-muted small mb-3">Siswa dari kelas-kelas yang Anda ajar</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.siswa.index') }}" method="GET" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                        <select name="class_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kelas Saya</option>
                            @foreach ($myClasses as $class)
                                <option value="{{ $class->id }}" {{ (string) $classId === (string) $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($classId)
                        <div class="col-md-auto">
                            <a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-mobile-cards">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            <tr>
                                <td data-label="#">{{ $students->firstItem() + $index }}</td>
                                <td data-label="Nama">{{ $student->name }}</td>
                                <td data-label="NIS">{{ $student->nis_nip ?? '-' }}</td>
                                <td data-label="Kelas"><span class="badge bg-primary-subtle text-primary-emphasis">{{ $student->schoolClass->name ?? '-' }}</span></td>
                                <td data-label="Email">{{ $student->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    @if ($myClasses->isEmpty())
                                        Anda belum ditugaskan mengajar di kelas manapun.
                                    @else
                                        Belum ada siswa di kelas ini.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
