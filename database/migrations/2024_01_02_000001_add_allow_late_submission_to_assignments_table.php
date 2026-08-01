<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan pengaturan per-tugas: apakah guru mengizinkan siswa
     * mengumpulkan jawaban setelah deadline lewat (terlambat) atau tidak.
     * Default true (izinkan) supaya perilaku lama tetap sama untuk tugas
     * yang sudah ada sebelum kolom ini ditambahkan.
     */
    public function up(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->boolean('allow_late_submission')->default(true)->after('deadline');
        });
    }

    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('allow_late_submission');
        });
    }
};
