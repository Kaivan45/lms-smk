<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcademicYear\StoreAcademicYearRequest;
use App\Http\Requests\Admin\AcademicYear\UpdateAcademicYearRequest;
use App\Models\AcademicYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AcademicYearController extends Controller
{
    public function index(): View
    {
        $academicYears = AcademicYear::orderByDesc('name')
            ->orderByDesc('semester')
            ->paginate(10);

        return view('admin.academic-year.index', compact('academicYears'));
    }

    public function create(): View
    {
        return view('admin.academic-year.create');
    }

    /**
     * Kalau checkbox "is_active" dicentang, semua tahun ajaran lain
     * otomatis dinonaktifkan dulu, supaya cuma ada 1 tahun ajaran aktif.
     */
    public function store(StoreAcademicYearRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_active']) {
            AcademicYear::query()->update(['is_active' => false]);
        }

        AcademicYear::create($data);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(AcademicYear $academicYear): View
    {
        return view('admin.academic-year.edit', compact('academicYear'));
    }

    public function update(UpdateAcademicYearRequest $request, AcademicYear $academicYear): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_active']) {
            AcademicYear::query()->where('id', '!=', $academicYear->id)->update(['is_active' => false]);
        }

        $academicYear->update($data);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(AcademicYear $academicYear): RedirectResponse
    {
        if ($academicYear->classes()->exists()) {
            return redirect()
                ->route('admin.tahun-ajaran.index')
                ->with('error', 'Tahun ajaran tidak bisa dihapus karena masih ada kelas yang menggunakannya.');
        }

        $academicYear->delete();

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
