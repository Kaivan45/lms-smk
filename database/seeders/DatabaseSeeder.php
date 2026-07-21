<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeder ini hanya membuat data dasar yang dibutuhkan
     * supaya sistem bisa langsung dipakai/testing:
     * - 1 akun admin
     * - 1 tahun ajaran aktif
     * - beberapa mata pelajaran contoh
     *
     * Data guru/siswa/kelas akan ditambahkan lewat menu CRUD Admin
     * pada tahap pengembangan fitur selanjutnya.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smk.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        AcademicYear::create([
            'name' => '2025/2026',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);

        $subjects = [
            ['name' => 'Pemrograman Web', 'code' => 'PW-01'],
            ['name' => 'Basis Data', 'code' => 'BD-01'],
            ['name' => 'Matematika', 'code' => 'MTK-01'],
            ['name' => 'Bahasa Indonesia', 'code' => 'BIN-01'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
