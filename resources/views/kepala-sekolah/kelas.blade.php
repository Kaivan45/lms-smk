@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Daftar Kelas</h4>
    <p class="text-muted small mb-3">Data kelas (khusus lihat, tidak bisa diubah)</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $index => $item)
                            <tr>
                                <td>{{ $kelas->firstItem() + $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->academicYear->name ?? '-' }}</td>
                                <td>{{ $item->homeroomTeacher->name ?? '-' }}</td>
                                <td>{{ $item->students_count }} siswa</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data kelas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>
@endsection
