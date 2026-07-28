<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\User;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function guru(): View
    {
        $guru = User::where('role', 'guru')->orderBy('name')->simplepaginate(10);

        return view('kepala-sekolah.guru', compact('guru'));
    }

    public function siswa(): View
    {
        $siswa = User::where('role', 'siswa')->with('schoolClass')->orderBy('name')->simplepaginate(10);

        return view('kepala-sekolah.siswa', compact('siswa'));
    }

    public function kelas(): View
    {
        $kelas = ClassRoom::with(['academicYear', 'homeroomTeacher'])
            ->withCount('students')
            ->orderBy('name')
            ->simplepaginate(10);

        return view('kepala-sekolah.kelas', compact('kelas'));
    }

    public function mataPelajaran(): View
    {
        $subjects = Subject::orderBy('name')->simplepaginate(10);

        return view('kepala-sekolah.mata-pelajaran', compact('subjects'));
    }

    public function pengumuman(): View
    {
        $announcements = Announcement::with('creator')->latest()->simplepaginate(10);

        return view('kepala-sekolah.pengumuman', compact('announcements'));
    }
}
