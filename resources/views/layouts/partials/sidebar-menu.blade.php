@php $role = auth()->user()->role; @endphp

@if ($role === 'admin')
    <li class="nav-item"><a href="{{ route('admin.guru.index') }}" class="nav-link-lms"><i class="bi bi-person-badge"></i> Data Guru</a></li>
    <li class="nav-item"><a href="{{ route('admin.siswa.index') }}" class="nav-link-lms"><i class="bi bi-people"></i> Data Siswa</a></li>
    <li class="nav-item"><a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms"><i class="bi bi-person-workspace"></i> Kepala Sekolah</a></li>
    <li class="nav-item"><a href="{{ route('admin.kelas.index') }}" class="nav-link-lms"><i class="bi bi-door-open"></i> Data Kelas</a></li>
    <li class="nav-item"><a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms"><i class="bi bi-calendar3"></i> Tahun Ajaran</a></li>
    <li class="nav-item"><a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@elseif ($role === 'guru')
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-door-open"></i> Kelas Saya</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-file-earmark-text"></i> Materi</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-clipboard-check"></i> Tugas</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-people"></i> Daftar Siswa</a></li>
@elseif ($role === 'siswa')
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-file-earmark-text"></i> Materi</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-clipboard-check"></i> Tugas</a></li>
    <li class="nav-item"><a href="#" class="nav-link-lms"><i class="bi bi-star"></i> Nilai</a></li>
    <li class="nav-item"><a href="{{ route('siswa.pengumuman.index') }}" class="nav-link-lms"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@elseif ($role === 'kepala_sekolah')
    <li class="nav-item"><a href="{{ route('kepala-sekolah.guru') }}" class="nav-link-lms {{ request()->routeIs('kepala-sekolah.guru') ? 'active' : '' }}"><i class="bi bi-person-badge"></i> Daftar Guru</a></li>
    <li class="nav-item"><a href="{{ route('kepala-sekolah.siswa') }}" class="nav-link-lms {{ request()->routeIs('kepala-sekolah.siswa') ? 'active' : '' }}"><i class="bi bi-people"></i> Daftar Siswa</a></li>
    <li class="nav-item"><a href="{{ route('kepala-sekolah.kelas') }}" class="nav-link-lms {{ request()->routeIs('kepala-sekolah.kelas') ? 'active' : '' }}"><i class="bi bi-door-open"></i> Daftar Kelas</a></li>
    <li class="nav-item"><a href="{{ route('kepala-sekolah.mata-pelajaran') }}" class="nav-link-lms {{ request()->routeIs('kepala-sekolah.mata-pelajaran') ? 'active' : '' }}"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('kepala-sekolah.pengumuman') }}" class="nav-link-lms {{ request()->routeIs('kepala-sekolah.pengumuman') ? 'active' : '' }}"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
@endif

<li class="nav-item mt-2 pt-2 border-top">
    <a href="{{ route('profile.edit') }}" class="nav-link-lms {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="bi bi-person"></i> Profil
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('profile.password.edit') }}" class="nav-link-lms {{ request()->routeIs('profile.password.*') ? 'active' : '' }}">
        <i class="bi bi-key"></i> Ganti Password
    </a>
</li>
