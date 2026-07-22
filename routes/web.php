<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KepalaSekolahController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeachingAssignmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepalaSekolah\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\AnnouncementController as SiswaAnnouncementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Autentikasi (bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard: satu pintu masuk setelah login, lalu diarahkan sesuai role.
| Route CRUD tiap role (guru, siswa, admin, dst) akan ditambahkan pada
| tahap fitur masing-masing, menyusul setelah tahap ini.
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | Profil & Ganti Password - dipakai semua role, tidak dibatasi middleware
    | role tertentu, cukup harus sudah login.
    |----------------------------------------------------------------------
    */
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/ganti-password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::put('/ganti-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('guru', GuruController::class)->except(['show']);
        Route::resource('siswa', SiswaController::class)->except(['show']);
        Route::resource('kepala-sekolah', KepalaSekolahController::class)
            ->except(['show'])
            ->parameters(['kepala-sekolah' => 'kepalaSekolah'])
            ->names('kepala-sekolah');
        Route::resource('kelas', KelasController::class)
            ->except(['show'])
            ->parameters(['kelas' => 'kelas']);
        Route::resource('mata-pelajaran', SubjectController::class)
            ->except(['show'])
            ->parameters(['mata-pelajaran' => 'subject'])
            ->names('mata-pelajaran');
        Route::resource('tahun-ajaran', AcademicYearController::class)
            ->except(['show'])
            ->parameters(['tahun-ajaran' => 'academicYear'])
            ->names('tahun-ajaran');
        Route::resource('pengumuman', AnnouncementController::class)
            ->except(['show'])
            ->parameters(['pengumuman' => 'announcement'])
            ->names('pengumuman');
        Route::resource('penugasan-mengajar', TeachingAssignmentController::class)
            ->except(['show'])
            ->parameters(['penugasan-mengajar' => 'teachingAssignment'])
            ->names('penugasan-mengajar');
    });

    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    });

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
        Route::get('/pengumuman', [SiswaAnnouncementController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/{announcement}', [SiswaAnnouncementController::class, 'show'])->name('pengumuman.show');
    });

    Route::middleware('role:kepala_sekolah')->prefix('kepala-sekolah')->name('kepala-sekolah.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'kepalaSekolah'])->name('dashboard');
        Route::get('/guru', [MonitoringController::class, 'guru'])->name('guru');
        Route::get('/siswa', [MonitoringController::class, 'siswa'])->name('siswa');
        Route::get('/kelas', [MonitoringController::class, 'kelas'])->name('kelas');
        Route::get('/mata-pelajaran', [MonitoringController::class, 'mataPelajaran'])->name('mata-pelajaran');
        Route::get('/pengumuman', [MonitoringController::class, 'pengumuman'])->name('pengumuman');
    });
});
