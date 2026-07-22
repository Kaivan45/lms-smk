<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\ClassRoom;
use App\Models\Material;
use App\Models\Submission;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Pintu masuk tunggal setelah login (/dashboard).
     * User langsung diarahkan ke dashboard sesuai role masing-masing.
     * Isi lengkap tiap dashboard (statistik, dsb) akan dibangun
     * pada tahap fitur "Dashboard" berikutnya - untuk saat ini
     * berupa halaman placeholder agar alur login bisa diuji end-to-end.
     */
    public function index(): RedirectResponse
    {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            'kepala_sekolah' => redirect()->route('kepala-sekolah.dashboard'),
        };
    }

    public function admin(): View
    {
        return view('dashboard.admin');
    } 

    public function guru(): View
    {
        return view('dashboard.guru');
    }

    public function siswa(): View
    {
        $latestAnnouncements = Announcement::latest()->take(3)->get();

        return view('dashboard.siswa', compact('latestAnnouncements'));
    }

    public function kepalaSekolah(): View
    {
        $stats = [
            'guru' => User::where('role', 'guru')->count(),
            'siswa' => User::where('role', 'siswa')->count(),
            'kelas' => ClassRoom::count(),
            'mapel' => Subject::count(),
            'materi' => Material::count(),
            'tugas' => Assignment::count(),
            'pengumpulan' => Submission::count(),
            'nilai_masuk' => Submission::whereNotNull('score')->count(),
        ];

        return view('kepala-sekolah.dashboard', compact('stats'));
    }
}
