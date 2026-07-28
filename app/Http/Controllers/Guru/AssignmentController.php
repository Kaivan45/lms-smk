<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\Assignment\StoreAssignmentRequest;
use App\Http\Requests\Guru\Assignment\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    public function create(TeachingAssignment $teachingAssignment): View
    {
        TeachingAssignmentController::ensureOwnedByCurrentTeacher($teachingAssignment);

        $teachingAssignment->load(['schoolClass', 'subject']);

        return view('guru.tugas.create', compact('teachingAssignment'));
    }

    public function store(StoreAssignmentRequest $request, TeachingAssignment $teachingAssignment): RedirectResponse
    {
        TeachingAssignmentController::ensureOwnedByCurrentTeacher($teachingAssignment);

        Assignment::create([
            'teaching_assignment_id' => $teachingAssignment->id,
            ...$request->validated(),
        ]);

        return redirect()
            ->route('guru.kelas-saya.show', $teachingAssignment)
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Assignment $assignment): View
    {
        $this->ensureOwnedByCurrentTeacher($assignment);

        $assignment->load('teachingAssignment.schoolClass', 'teachingAssignment.subject');

        return view('guru.tugas.edit', compact('assignment'));
    }

    public function update(UpdateAssignmentRequest $request, Assignment $assignment): RedirectResponse
    {
        $this->ensureOwnedByCurrentTeacher($assignment);

        $assignment->update($request->validated());

        return redirect()
            ->route('guru.kelas-saya.show', $assignment->teaching_assignment_id)
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Assignment $assignment): RedirectResponse
    {
        $this->ensureOwnedByCurrentTeacher($assignment);

        $teachingAssignmentId = $assignment->teaching_assignment_id;
        $assignment->delete();

        return redirect()
            ->route('guru.kelas-saya.show', $teachingAssignmentId)
            ->with('success', 'Tugas berhasil dihapus (beserta semua pengumpulan siswa untuk tugas ini).');
    }

    private function ensureOwnedByCurrentTeacher(Assignment $assignment): void
    {
        abort_unless($assignment->teachingAssignment->teacher_id === Auth::id(), 403, 'Anda tidak berhak mengelola tugas ini.');
    }
}
