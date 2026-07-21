<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
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

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('guru', GuruController::class)->except(['show']);
        Route::resource('siswa', SiswaController::class)->except(['show']);
        Route::resource('kelas', KelasController::class)
            ->except(['show'])
            ->parameters(['kelas' => 'kelas']);
    });

    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    });

    Route::middleware('role:siswa')->group(function () {
        Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
    });

    Route::middleware('role:kepala_sekolah')->group(function () {
        Route::get('/kepala-sekolah/dashboard', [DashboardController::class, 'kepalaSekolah'])->name('kepala-sekolah.dashboard');
    });
});
