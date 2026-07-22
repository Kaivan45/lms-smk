<li class="nav-item">
    <a href="{{ route('admin.guru.index') }}" class="nav-link-lms {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Data Guru
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.siswa.index') }}" class="nav-link-lms {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Data Siswa
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.kepala-sekolah.index') }}" class="nav-link-lms {{ request()->routeIs('admin.kepala-sekolah.*') ? 'active' : '' }}">
        <i class="bi bi-person-workspace"></i> Kepala Sekolah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.kelas.index') }}" class="nav-link-lms {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
        <i class="bi bi-door-open"></i> Data Kelas
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-link-lms {{ request()->routeIs('admin.mata-pelajaran.*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Mata Pelajaran
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.tahun-ajaran.index') }}" class="nav-link-lms {{ request()->routeIs('admin.tahun-ajaran.*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Tahun Ajaran
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.pengumuman.index') }}" class="nav-link-lms {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
        <i class="bi bi-megaphone"></i> Pengumuman
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.penugasan-mengajar.index') }}" class="nav-link-lms {{ request()->routeIs('admin.penugasan-mengajar.*') ? 'active' : '' }}">
        <i class="bi-check2-square"></i> Penugasan
    </a>
</li>