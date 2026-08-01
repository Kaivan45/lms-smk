<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Siswa\StoreSiswaRequest;
use App\Http\Requests\Admin\Siswa\UpdateSiswaRequest;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar siswa, dengan pencarian (nama/email/NIS)
     * dan filter berdasarkan kelas, plus pagination.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $classId = $request->query('class_id');

        $siswa = User::query()
            ->where('role', 'siswa')
            ->with('schoolClass')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nis_nip', 'like', "%{$search}%");
                });
            })
            ->when($classId, fn ($query) => $query->where('class_id', $classId))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.siswa.index', compact('siswa', 'search', 'classId', 'classes'));
    }

    public function create(): View
    {
        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.siswa.create', compact('classes'));
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'siswa';

        User::create($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(User $siswa): View
    {
        $this->ensureIsSiswa($siswa);

        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.siswa.edit', ['siswa' => $siswa, 'classes' => $classes]);
    }

    public function update(UpdateSiswaRequest $request, User $siswa): RedirectResponse
    {
        $this->ensureIsSiswa($siswa);

        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $siswa->update($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(User $siswa): RedirectResponse
    {
        $this->ensureIsSiswa($siswa);

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    private function ensureIsSiswa(User $user): void
    {
        abort_unless($user->role === 'siswa', 404);
    }
}
