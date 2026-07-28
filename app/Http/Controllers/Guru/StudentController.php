<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\TeachingAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Daftar siswa dari SEMUA kelas yang diajar guru ini (bisa lebih dari 1
     * kelas), dengan filter dropdown supaya bisa difokuskan ke 1 kelas saja.
     */
    public function index(Request $request): View
    {
        $classId = $request->query('class_id');

        // Ambil kelas-kelas unik yang diajar guru ini (buang duplikat kalau
        // guru mengajar >1 mapel di kelas yang sama)
        $myClassIds = TeachingAssignment::where('teacher_id', Auth::id())
            ->pluck('class_id')
            ->unique();

        $myClasses = ClassRoom::whereIn('id', $myClassIds)->orderBy('name')->get();

        $students = User::where('role', 'siswa')
            ->whereIn('class_id', $myClassIds)
            ->with('schoolClass')
            ->when($classId, fn ($query) => $query->where('class_id', $classId))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('guru.siswa.index', compact('students', 'myClasses', 'classId'));
    }
}
