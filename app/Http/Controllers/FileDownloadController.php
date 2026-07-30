<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileDownloadController extends Controller
{
    /**
     * Download materi. Boleh diakses oleh:
     * - Admin (semua materi)
     * - Guru pemilik penugasan terkait (materi miliknya sendiri)
     * - Siswa yang kelasnya sama dengan kelas tujuan materi ini
     */
    public function material(Material $material): StreamedResponse
    {
        $material->loadMissing('teachingAssignment');
        $user = Auth::user();

        $allowed = $user->role === 'admin'
            || ($user->role === 'guru' && $material->teachingAssignment->teacher_id === $user->id)
            || ($user->role === 'siswa' && $material->teachingAssignment->class_id === $user->class_id);

        abort_unless($allowed, 403, 'Anda tidak berhak mengakses file ini.');

        abort_unless(Storage::disk('local')->exists($material->file_path), 404, 'File tidak ditemukan.');

        return Storage::disk('local')->download(
            $material->file_path,
            $material->title.'.'.$material->file_type
        );
    }

    /**
     * Download jawaban tugas siswa. Boleh diakses oleh:
     * - Admin (semua jawaban)
     * - Guru pemilik penugasan terkait (jawaban siswa di kelasnya)
     * - Siswa pemilik jawaban itu sendiri (bukan siswa lain)
     */
    public function submission(Submission $submission): StreamedResponse
    {
        $submission->loadMissing('assignment.teachingAssignment');
        $user = Auth::user();

        $allowed = $user->role === 'admin'
            || ($user->role === 'guru' && $submission->assignment->teachingAssignment->teacher_id === $user->id)
            || ($user->role === 'siswa' && $submission->student_id === $user->id);

        abort_unless($allowed, 403, 'Anda tidak berhak mengakses file ini.');

        abort_unless(Storage::disk('local')->exists($submission->file_path), 404, 'File tidak ditemukan.');

        return Storage::disk('local')->download($submission->file_path);
    }
}
