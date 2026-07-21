<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Kelas\StoreKelasRequest;
use App\Http\Requests\Admin\Kelas\UpdateKelasRequest;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar kelas beserta tahun ajaran, wali kelas,
     * dan jumlah siswa di kelas tersebut.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $kelas = ClassRoom::query()
            ->with(['academicYear', 'homeroomTeacher'])
            ->withCount('students')
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kelas.index', compact('kelas', 'search'));
    }

    public function create(): View
    {
        return view('admin.kelas.create', $this->formData());
    }

    public function store(StoreKelasRequest $request): RedirectResponse
    {
        ClassRoom::create($request->validated());

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(ClassRoom $kelas): View
    {
        return view('admin.kelas.edit', array_merge(
            ['kelas' => $kelas],
            $this->formData()
        ));
    }

    public function update(UpdateKelasRequest $request, ClassRoom $kelas): RedirectResponse
    {
        $kelas->update($request->validated());

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(ClassRoom $kelas): RedirectResponse
    {
        $kelas->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }

    /**
     * Data pendukung form (dropdown tahun ajaran & wali kelas).
     */
    private function formData(): array
    {
        return [
            'academicYears' => AcademicYear::orderByDesc('name')->get(),
            'teachers' => User::where('role', 'guru')->orderBy('name')->get(),
        ];
    }
}
