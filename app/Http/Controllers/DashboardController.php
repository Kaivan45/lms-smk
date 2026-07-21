<?php

namespace App\Http\Controllers;

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
        return view('dashboard.siswa');
    }

    public function kepalaSekolah(): View
    {
        return view('dashboard.kepala-sekolah');
    }
}
