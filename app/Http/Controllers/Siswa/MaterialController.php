<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MaterialController extends Controller
{
    /**
     * Materi dikelompokkan per mata pelajaran, hanya untuk kelas siswa
     * yang sedang login. Siswa tidak pernah memilih mapel sendiri -
     * daftar ini otomatis mengikuti teaching_assignments di kelasnya.
     */
    public function index(): View
    {
        $classId = Auth::user()->class_id;

        $teachingAssignments = TeachingAssignment::where('class_id', $classId)
            ->with(['subject', 'teacher', 'materials' => fn ($query) => $query->latest()])
            ->get();

        return view('siswa.materi.index', compact('teachingAssignments'));
    }
}
