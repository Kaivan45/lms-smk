<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel penugasan mengajar: satu baris = satu guru mengajar
     * satu mata pelajaran di satu kelas pada satu tahun ajaran.
     * Materi dan tugas selalu ditempelkan ke baris ini, bukan
     * langsung ke kelas, supaya jelas "milik guru & mapel apa".
     */
    public function up(): void
    {
        Schema::create('teaching_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(
                ['teacher_id', 'class_id', 'subject_id', 'academic_year_id'],
                'teaching_assignments_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teaching_assignments');
    }
};
