<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeachingAssignmentController extends Controller
{
    /**
     * Daftar semua kelas+mapel yang diajar guru yang sedang login.
     */
    public function index(): View
    {
        $teachingAssignments = TeachingAssignment::query()
            ->where('teacher_id', Auth::id())
            ->with(['schoolClass', 'subject', 'academicYear'])
            ->withCount(['materials', 'assignments'])
            ->latest()
            ->paginate(10);

        return view('guru.kelas-saya.index', compact('teachingAssignments'));
    }

    /**
     * Detail 1 penugasan: daftar materi & tugas yang sudah dibuat untuk
     * kombinasi kelas+mapel ini.
     */
    public function show(TeachingAssignment $teachingAssignment): View
    {
        $this->ensureOwnedByCurrentTeacher($teachingAssignment);

        $teachingAssignment->load([
            'schoolClass.students',
            'subject',
            'academicYear',
            'materials' => fn ($query) => $query->latest(),
            'assignments' => fn ($query) => $query->withCount('submissions')->latest(),
        ]);

        return view('guru.kelas-saya.show', compact('teachingAssignment'));
    }

    /**
     * Guard: pastikan guru yang login memang pemilik penugasan ini,
     * supaya tidak bisa mengintip/mengedit kelas guru lain lewat URL manual.
     */
    public static function ensureOwnedByCurrentTeacher(TeachingAssignment $teachingAssignment): void
    {
        abort_unless($teachingAssignment->teacher_id === Auth::id(), 403, 'Anda tidak mengajar di kelas ini.');
    }
}
