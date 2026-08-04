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
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\MaterialController;
use App\Http\Controllers\Guru\StudentController as GuruStudentController;
use App\Http\Controllers\Guru\SubmissionController;
use App\Http\Controllers\Guru\TeachingAssignmentController as GuruTeachingAssignmentController;
use App\Http\Controllers\KepalaSekolah\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\AnnouncementController as SiswaAnnouncementController;
use App\Http\Controllers\Siswa\AssignmentController as SiswaAssignmentController;
use App\Http\Controllers\Siswa\GradeController as SiswaGradeController;
use App\Http\Controllers\Siswa\MaterialController as SiswaMaterialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Autentikasi (bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:4,1')
        ->name('login.attempt');
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

    /*
    |----------------------------------------------------------------------
    | Download file terproteksi - materi & jawaban tugas TIDAK bisa diakses
    | lewat link publik, harus login dan lolos cek otorisasi di controller.
    |----------------------------------------------------------------------
    */
    Route::get('/files/materi/{material}', [FileDownloadController::class, 'material'])->name('files.materi');
    Route::get('/files/jawaban/{submission}', [FileDownloadController::class, 'submission'])->name('files.jawaban');

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

    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'guru'])->name('dashboard');

        Route::get('/kelas-saya', [GuruTeachingAssignmentController::class, 'index'])->name('kelas-saya.index');
        Route::get('/kelas-saya/{teachingAssignment}', [GuruTeachingAssignmentController::class, 'show'])->name('kelas-saya.show');

        // Materi dibuat dari dalam halaman detail kelas (perlu tahu teaching_assignment_id-nya)
        Route::get('/kelas-saya/{teachingAssignment}/materi/create', [MaterialController::class, 'create'])->name('materi.create');
        Route::post('/kelas-saya/{teachingAssignment}/materi', [MaterialController::class, 'store'])->name('materi.store');

        // Edit/hapus materi tidak perlu tahu teaching_assignment_id lagi di URL, cukup id materinya
        Route::get('/materi/{material}/edit', [MaterialController::class, 'edit'])->name('materi.edit');
        Route::put('/materi/{material}', [MaterialController::class, 'update'])->name('materi.update');
        Route::delete('/materi/{material}', [MaterialController::class, 'destroy'])->name('materi.destroy');

        // Tugas - dibuat dari dalam halaman detail kelas, sama seperti materi
        Route::get('/kelas-saya/{teachingAssignment}/tugas/create', [AssignmentController::class, 'create'])->name('tugas.create');
        Route::post('/kelas-saya/{teachingAssignment}/tugas', [AssignmentController::class, 'store'])->name('tugas.store');
        Route::get('/tugas/{assignment}/edit', [AssignmentController::class, 'edit'])->name('tugas.edit');
        Route::put('/tugas/{assignment}', [AssignmentController::class, 'update'])->name('tugas.update');
        Route::delete('/tugas/{assignment}', [AssignmentController::class, 'destroy'])->name('tugas.destroy');

        // Pengumpulan & Penilaian
        Route::get('/tugas/{assignment}/pengumpulan', [SubmissionController::class, 'index'])->name('tugas.pengumpulan');
        Route::put('/pengumpulan/{submission}', [SubmissionController::class, 'update'])->name('pengumpulan.update');

        Route::get('/siswa', [GuruStudentController::class, 'index'])->name('siswa.index');
    });

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
        Route::get('/pengumuman', [SiswaAnnouncementController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/{announcement}', [SiswaAnnouncementController::class, 'show'])->name('pengumuman.show');

        Route::get('/materi', [SiswaMaterialController::class, 'index'])->name('materi.index');

        Route::get('/tugas', [SiswaAssignmentController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{assignment}', [SiswaAssignmentController::class, 'show'])->name('tugas.show');
        Route::post('/tugas/{assignment}/kumpulkan', [SiswaAssignmentController::class, 'submit'])->name('tugas.kumpulkan');

        Route::get('/nilai', [SiswaGradeController::class, 'index'])->name('nilai.index');
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
