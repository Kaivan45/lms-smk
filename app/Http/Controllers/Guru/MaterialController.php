<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\Material\StoreMaterialRequest;
use App\Http\Requests\Guru\Material\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function create(TeachingAssignment $teachingAssignment): View
    {
        TeachingAssignmentController::ensureOwnedByCurrentTeacher($teachingAssignment);

        $teachingAssignment->load(['schoolClass', 'subject']);

        return view('guru.materi.create', compact('teachingAssignment'));
    }

    public function store(StoreMaterialRequest $request, TeachingAssignment $teachingAssignment): RedirectResponse
    {
        TeachingAssignmentController::ensureOwnedByCurrentTeacher($teachingAssignment);

        $data = $request->validated();

        $file = $request->file('file');
        $path = $file->store('materi', 'local');

        Material::create([
            'teaching_assignment_id' => $teachingAssignment->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        return redirect()
            ->route('guru.kelas-saya.show', $teachingAssignment)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Material $material): View
    {
        $this->ensureOwnedByCurrentTeacher($material);

        $material->load('teachingAssignment.schoolClass', 'teachingAssignment.subject');

        return view('guru.materi.edit', compact('material'));
    }

    public function update(UpdateMaterialRequest $request, Material $material): RedirectResponse
    {
        $this->ensureOwnedByCurrentTeacher($material);

        $data = $request->validated();

        // File baru bersifat opsional saat edit - kalau tidak diupload, file lama tetap dipakai.
        if ($request->hasFile('file')) {
            Storage::disk('local')->delete($material->file_path);

            $file = $request->file('file');
            $data['file_path'] = $file->store('materi', 'local');
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        $material->update($data);

        return redirect()
            ->route('guru.kelas-saya.show', $material->teaching_assignment_id)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        $this->ensureOwnedByCurrentTeacher($material);

        Storage::disk('local')->delete($material->file_path);

        $teachingAssignmentId = $material->teaching_assignment_id;
        $material->delete();

        return redirect()
            ->route('guru.kelas-saya.show', $teachingAssignmentId)
            ->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Guard: materi cuma boleh diedit/dihapus oleh guru pemilik penugasan terkait.
     */
    private function ensureOwnedByCurrentTeacher(Material $material): void
    {
        abort_unless($material->teachingAssignment->teacher_id === Auth::id(), 403, 'Anda tidak berhak mengelola materi ini.');
    }
}
