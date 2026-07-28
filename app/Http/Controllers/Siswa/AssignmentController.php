<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreSubmissionRequest;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    /**
     * Daftar semua tugas dari mapel-mapel di kelas siswa, lengkap status
     * pengumpulannya (belum kumpul / sudah kumpul / sudah dinilai).
     */
    public function index(): View
    {
        $classId = Auth::user()->class_id;

        $assignments = Assignment::whereHas('teachingAssignment', fn ($query) => $query->where('class_id', $classId))
            ->with(['teachingAssignment.subject'])
            ->latest()
            ->paginate(10);

        $mySubmissions = Submission::where('student_id', Auth::id())
            ->whereIn('assignment_id', $assignments->pluck('id'))
            ->get()
            ->keyBy('assignment_id');

        return view('siswa.tugas.index', compact('assignments', 'mySubmissions'));
    }

    public function show(Assignment $assignment): View
    {
        $this->ensureBelongsToStudentClass($assignment);

        $assignment->load('teachingAssignment.subject', 'teachingAssignment.schoolClass');

        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        return view('siswa.tugas.show', compact('assignment', 'submission'));
    }

    public function submit(StoreSubmissionRequest $request, Assignment $assignment): RedirectResponse
    {
        $this->ensureBelongsToStudentClass($assignment);

        $existing = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        // Kalau sudah pernah dinilai, jawaban tidak boleh diubah lagi.
        if ($existing && $existing->isGraded()) {
            return back()->with('error', 'Tugas ini sudah dinilai, jawaban tidak bisa diubah lagi.');
        }

        $file = $request->file('file');
        $path = $file->store('jawaban-tugas', 'public');

        if ($existing) {
            Storage::disk('public')->delete($existing->file_path);
            $existing->update(['file_path' => $path, 'submitted_at' => now()]);
        } else {
            Submission::create([
                'assignment_id' => $assignment->id,
                'student_id' => Auth::id(),
                'file_path' => $path,
                'submitted_at' => now(),
            ]);
        }

        return redirect()
            ->route('siswa.tugas.show', $assignment)
            ->with('success', 'Jawaban berhasil dikumpulkan.');
    }

    /**
     * Guard: tugas ini harus memang untuk kelas siswa yang login,
     * supaya siswa tidak bisa akses/upload ke tugas kelas lain lewat URL.
     */
    private function ensureBelongsToStudentClass(Assignment $assignment): void
    {
        $assignment->loadMissing('teachingAssignment');
        abort_unless($assignment->teachingAssignment->class_id === Auth::user()->class_id, 403, 'Tugas ini bukan untuk kelas Anda.');
    }
}
