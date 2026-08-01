<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(): View
    {
        $submissions = Submission::where('student_id', Auth::id())
            ->with('assignment.teachingAssignment.subject')
            ->latest('submitted_at')
            ->simplepaginate(10);

        return view('siswa.nilai.index', compact('submissions'));
    }
}
