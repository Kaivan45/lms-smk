@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <h4 class="fw-medium mb-1">Selamat datang, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Dashboard Siswa - LMS SMK</p>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h6 class="mb-0"><i class="bi bi-alarm me-1"></i> Tugas Mendekati Deadline</h6>
                <form action="{{ route('siswa.dashboard') }}" method="GET">
                    <select name="deadline_filter" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="3" {{ $deadlineFilter === '3' ? 'selected' : '' }}>3 Hari ke Depan</option>
                        <option value="7" {{ $deadlineFilter === '7' ? 'selected' : '' }}>1 Minggu ke Depan</option>
                        <option value="14" {{ $deadlineFilter === '14' ? 'selected' : '' }}>2 Minggu ke Depan</option>
                        <option value="30" {{ $deadlineFilter === '30' ? 'selected' : '' }}>1 Bulan ke Depan</option>
                        <option value="all" {{ $deadlineFilter === 'all' ? 'selected' : '' }}>Semua</option>
                    </select>
                </form>
            </div>

            @forelse ($upcomingAssignments as $item)
                @php
                    $daysLeft = now()->diffInDays($item->deadline, false);
                    $isUrgent = $daysLeft <= 1;
                    $isSubmitted = $mySubmittedIds->contains($item->id);
                @endphp
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <a href="{{ route('siswa.tugas.show', $item) }}" class="text-decoration-none text-dark fw-medium">
                            {{ $item->title }}
                        </a>
                        <div class="text-muted small">{{ $item->teachingAssignment->subject->name ?? '-' }}</div>
                    </div>
                    <div class="text-end">
                        @if ($isSubmitted)
                            <span class="badge bg-success-subtle text-success-emphasis">Sudah Kumpul</span>
                        @elseif ($isUrgent)
                            <span class="badge bg-danger-subtle text-danger-emphasis">Deadline {{ $item->deadline->diffForHumans() }}</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning-emphasis">Deadline {{ $item->deadline->diffForHumans() }}</span>
                        @endif
                        <div class="text-muted small mt-1">{{ $item->deadline->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">
                    Sudah tidak ada tugas dengan deadline di rentang waktu ini.
                </p>
            @endforelse
        </div>
    </div>

   <div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">
                <i class="bi bi-megaphone-fill text-primary me-2"></i>
                Pengumuman Terbaru
            </h6>

            <a href="{{ route('siswa.pengumuman.index') }}"
               class="btn btn-sm btn-outline-primary rounded-pill">
                Lihat Semua
            </a>
        </div>

        @forelse ($latestAnnouncements as $item)
            <a href="{{ route('siswa.pengumuman.show', $item) }}"
               class="text-decoration-none announcement-link"  data-id="{{ $item->id }}">

                <div class="d-flex align-items-start p-3 mb-2 rounded-3 announcement-item">

                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:48px;height:48px;">
                            <i class="bi bi-megaphone-fill text-primary"></i>
                        </div>
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1 text-dark">
                            {{ $item->title }}
                        </h6>

                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            {{ $item->created_at->diffForHumans() }}
                        </small>
                    </div>

                    <div class="ms-2">
                        <span class="badge bg-primary-subtle text-primary badge-baru"
                            data-id="{{ $item->id }}">
                            Baru
                        </span>
                    </div>

                </div>
            </a>
        @empty
            <div class="text-center py-4">
                <i class="bi bi-megaphone display-5 text-muted"></i>
                <p class="text-muted mt-2 mb-0">
                    Belum ada pengumuman.
                </p>
            </div>
        @endforelse
    </div>
</div>

    <div class="row g-3 mt-1">
        <div class="col-6 col-md-3">
            <a href="{{ route('siswa.materi.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text text-primary fs-3"></i>
                        <div class="text-muted small mt-2">Materi</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('siswa.tugas.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-check text-primary fs-3"></i>
                        <div class="text-muted small mt-2">Tugas</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('siswa.nilai.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-star text-primary fs-3"></i>
                        <div class="text-muted small mt-2">Nilai</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('siswa.pengumuman.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-megaphone text-primary fs-3"></i>
                        <div class="text-muted small mt-2">Pengumuman</div>
                    </div>
                </div>
            </a>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Ambil daftar pengumuman yang sudah dibaca
            let readAnnouncements = JSON.parse(localStorage.getItem("readAnnouncements")) || [];

            // Sembunyikan badge jika sudah dibaca
            document.querySelectorAll(".badge-baru").forEach(function (badge) {
                let id = badge.dataset.id;

                if (readAnnouncements.includes(id)) {
                    badge.remove();
                }
            });

            // Saat link diklik
            document.querySelectorAll(".announcement-link").forEach(function (link) {

                link.addEventListener("click", function () {

                    let id = this.dataset.id;

                    if (!readAnnouncements.includes(id)) {
                        readAnnouncements.push(id);
                        localStorage.setItem(
                            "readAnnouncements",
                            JSON.stringify(readAnnouncements)
                        );
                    }

                });

            });

        });
        </script>
@endsection
