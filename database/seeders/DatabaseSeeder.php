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

        $students = [
            ['name' => 'Ahmad Fauzan', 'email' => 'ahmad@smk.sch.id'],
            ['name' => 'Budi Santoso', 'email' => 'budi@smk.sch.id'],
            ['name' => 'Citra Lestari', 'email' => 'citra@smk.sch.id'],
            ['name' => 'Dewi Anggraini', 'email' => 'dewi@smk.sch.id'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko@smk.sch.id'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@smk.sch.id'],
            ['name' => 'Gita Permata', 'email' => 'gita@smk.sch.id'],
            ['name' => 'Hendra Saputra', 'email' => 'hendra@smk.sch.id'],
            ['name' => 'Intan Maharani', 'email' => 'intan@smk.sch.id'],
            ['name' => 'Joko Susilo', 'email' => 'joko@smk.sch.id'],
            ['name' => 'Kevin Aditya', 'email' => 'kevin@smk.sch.id'],
            ['name' => 'Lia Ramadhani', 'email' => 'lia@smk.sch.id'],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);
        }

        $teachers = [
            ['name' => 'Andi Wijaya', 'email' => 'andi@smk.sch.id'],
            ['name' => 'Rina Kusuma', 'email' => 'rina@smk.sch.id'],
            ['name' => 'Budi Hartono', 'email' => 'budih@smk.sch.id'],
            ['name' => 'Siti Aminah', 'email' => 'siti@smk.sch.id'],
            ['name' => 'Agus Prasetyo', 'email' => 'agus@smk.sch.id'],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]);
        }
    }
}
