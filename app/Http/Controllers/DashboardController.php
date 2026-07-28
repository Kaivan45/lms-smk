<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\ClassRoom;
use App\Models\Material;
use App\Models\Submission;
use App\Models\Subject;
use App\Models\TeachingAssignment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Pintu masuk tunggal setelah login (/dashboard).
     * User langsung diarahkan ke dashboard sesuai role masing-masing.
     * Isi lengkap tiap dashboard (statistik, dsb) akan dibangun
     * pada tahap fitur "Dashboard" berikutnya - untuk saat ini
     * berupa halaman placeholder agar alur login bisa diuji end-to-end.
     */
    public function index(): RedirectResponse
    {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            'kepala_sekolah' => redirect()->route('kepala-sekolah.dashboard'),
        };
    }

    public function admin(): View
    {
        $stats = [
            'guru' => User::where('role', 'guru')->count(),
            'siswa' => User::where('role', 'siswa')->count(),
            'kepala_sekolah' => User::where('role', 'kepala_sekolah')->count(),
            'kelas' => ClassRoom::count(),
            'mapel' => Subject::count(),
            'penugasan_mengajar' => TeachingAssignment::count(),
            'pengumuman' => Announcement::count(),
        ];

        $activeAcademicYear = AcademicYear::where('is_active', true)->first();
        $latestAnnouncements = Announcement::latest()->take(5)->get();
        $classesWithoutHomeroom = ClassRoom::whereNull('homeroom_teacher_id')->count();

        return view('dashboard.admin', compact(
            'stats',
            'activeAcademicYear',
            'latestAnnouncements',
            'classesWithoutHomeroom'
        ));
    }

    public function guru(): View
    {
        $teacherId = Auth::id();

        $teachingAssignments = TeachingAssignment::where('teacher_id', $teacherId)
            ->with(['schoolClass', 'subject'])
            ->get();

        $stats = [
            'kelas' => $teachingAssignments->pluck('class_id')->unique()->count(),
            'mapel' => $teachingAssignments->pluck('subject_id')->unique()->count(),
            'materi' => Material::whereIn('teaching_assignment_id', $teachingAssignments->pluck('id'))->count(),
            'tugas' => Assignment::whereIn('teaching_assignment_id', $teachingAssignments->pluck('id'))->count(),
        ];

        return view('dashboard.guru', compact('stats', 'teachingAssignments'));
    }

    public function siswa(Request $request): View
    {
        $latestAnnouncements = Announcement::latest()->take(3)->get();

        $classId = Auth::user()->class_id;
        $deadlineFilter = $request->query('deadline_filter', '7'); // default: 1 minggu

        $upcomingAssignmentsQuery = Assignment::whereHas(
            'teachingAssignment',
            fn ($query) => $query->where('class_id', $classId)
        )
            ->with('teachingAssignment.subject')
            ->where('deadline', '>=', now())
            ->orderBy('deadline');

        if ($deadlineFilter !== 'all') {
            $upcomingAssignmentsQuery->where('deadline', '<=', now()->addDays((int) $deadlineFilter));
        }

        $upcomingAssignments = $upcomingAssignmentsQuery->get();

        $mySubmittedIds = Submission::where('student_id', Auth::id())
            ->whereIn('assignment_id', $upcomingAssignments->pluck('id'))
            ->pluck('assignment_id');

        return view('dashboard.siswa', compact('latestAnnouncements', 'upcomingAssignments', 'mySubmittedIds', 'deadlineFilter'));
    }

    public function kepalaSekolah(): View
    {
        $stats = [
            'guru' => User::where('role', 'guru')->count(),
            'siswa' => User::where('role', 'siswa')->count(),
            'kelas' => ClassRoom::count(),
            'mapel' => Subject::count(),
            'materi' => Material::count(),
            'tugas' => Assignment::count(),
            'pengumpulan' => Submission::count(),
            'nilai_masuk' => Submission::whereNotNull('score')->count(),
        ];

        return view('kepala-sekolah.dashboard', compact('stats'));
    }
}
