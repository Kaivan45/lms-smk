<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeachingAssignment\StoreTeachingAssignmentRequest;
use App\Http\Requests\Admin\TeachingAssignment\UpdateTeachingAssignmentRequest;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\TeachingAssignment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeachingAssignmentController extends Controller
{
    /**
     * Menampilkan daftar penugasan mengajar, dengan filter kelas & tahun ajaran
     * supaya mudah dicek "kelas ini sudah ada mapel apa saja".
     */
    public function index(Request $request): View
    {
        $classId = $request->query('class_id');
        $academicYearId = $request->query('academic_year_id');

        $teachingAssignments = TeachingAssignment::query()
            ->with(['teacher', 'schoolClass', 'subject', 'academicYear'])
            ->when($classId, fn ($query) => $query->where('class_id', $classId))
            ->when($academicYearId, fn ($query) => $query->where('academic_year_id', $academicYearId))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.teaching-assignment.index', array_merge(
            compact('teachingAssignments', 'classId', 'academicYearId'),
            $this->filterData()
        ));
    }

    public function create(): View
    {
        return view('admin.teaching-assignment.create', $this->formData());
    }

    public function store(StoreTeachingAssignmentRequest $request): RedirectResponse
    {
        TeachingAssignment::create($request->validated());

        return redirect()
            ->route('admin.penugasan-mengajar.index')
            ->with('success', 'Penugasan mengajar berhasil ditambahkan.');
    }

    public function edit(TeachingAssignment $teachingAssignment): View
    {
        return view('admin.teaching-assignment.edit', array_merge(
            ['teachingAssignment' => $teachingAssignment],
            $this->formData()
        ));
    }

    public function update(UpdateTeachingAssignmentRequest $request, TeachingAssignment $teachingAssignment): RedirectResponse
    {
        $teachingAssignment->update($request->validated());

        return redirect()
            ->route('admin.penugasan-mengajar.index')
            ->with('success', 'Penugasan mengajar berhasil diperbarui.');
    }

    public function destroy(TeachingAssignment $teachingAssignment): RedirectResponse
    {
        if ($teachingAssignment->materials()->exists() || $teachingAssignment->assignments()->exists()) {
            return redirect()
                ->route('admin.penugasan-mengajar.index')
                ->with('error', 'Penugasan ini tidak bisa dihapus karena sudah ada materi/tugas yang terhubung.');
        }

        $teachingAssignment->delete();

        return redirect()
            ->route('admin.penugasan-mengajar.index')
            ->with('success', 'Penugasan mengajar berhasil dihapus.');
    }

    /**
     * Data dropdown untuk form tambah/edit.
     */
    private function formData(): array
    {
        return [
            'teachers' => User::where('role', 'guru')->orderBy('name')->get(),
            'classes' => ClassRoom::orderBy('name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderByDesc('name')->get(),
        ];
    }

    /**
     * Data dropdown untuk filter di halaman index (cukup kelas & tahun ajaran).
     */
    private function filterData(): array
    {
        return [
            'classes' => ClassRoom::orderBy('name')->get(),
            'academicYears' => AcademicYear::orderByDesc('name')->get(),
        ];
    }
}
