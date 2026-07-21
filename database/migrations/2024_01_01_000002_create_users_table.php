<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel users menampung SEMUA role (admin, guru, siswa, kepala_sekolah)
     * dibedakan lewat kolom "role". Ini pendekatan single-table untuk
     * menyederhanakan autentikasi Laravel bawaan.
     *
     * class_id hanya diisi untuk role "siswa" (menunjukkan siswa itu ada
     * di kelas mana). Foreign key-nya ditambahkan pada migration terpisah
     * setelah tabel classes dibuat, untuk menghindari circular dependency
     * (users.class_id -> classes.id, classes.homeroom_teacher_id -> users.id).
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa', 'kepala_sekolah']);
            $table->string('nis_nip', 30)->nullable()->comment('NIP untuk guru/kepsek, NIS untuk siswa');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('class_id')->nullable()->comment('Diisi hanya untuk role siswa');
            $table->rememberToken();
            $table->timestamps();

            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
