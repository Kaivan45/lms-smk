<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\Submission\GradeSubmissionRequest;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    /**
     * Menampilkan status pengumpulan SEMUA siswa di kelas untuk 1 tugas,
     * termasuk yang belum mengumpulkan sama sekali (supaya guru bisa pantau
     * siapa yang belum kumpul, bukan cuma yang sudah).
     */
    public function index(Assignment $assignment): View
    {
        $this->ensureOwnedByCurrentTeacher($assignment);

        $assignment->load('teachingAssignment.schoolClass', 'teachingAssignment.subject');

        $students = $assignment->teachingAssignment->schoolClass->students()->orderBy('name')->get();

        $submissions = Submission::where('assignment_id', $assignment->id)
            ->get()
            ->each(fn ($submission) => $submission->setRelation('assignment', $assignment))
            ->keyBy('student_id');

        return view('guru.tugas.pengumpulan', compact('assignment', 'students', 'submissions'));
    }

    public function update(GradeSubmissionRequest $request, Submission $submission): RedirectResponse
    {
        $this->ensureOwnedByCurrentTeacherViaSubmission($submission);

        $submission->update($request->validated());

        return back()->with('success', 'Nilai dan komentar berhasil disimpan.');
    }

    private function ensureOwnedByCurrentTeacher(Assignment $assignment): void
    {
        abort_unless($assignment->teachingAssignment->teacher_id === Auth::id(), 403, 'Anda tidak berhak mengelola tugas ini.');
    }

    private function ensureOwnedByCurrentTeacherViaSubmission(Submission $submission): void
    {
        $submission->loadMissing('assignment.teachingAssignment');
        abort_unless($submission->assignment->teachingAssignment->teacher_id === Auth::id(), 403, 'Anda tidak berhak menilai pengumpulan ini.');
    }
}
