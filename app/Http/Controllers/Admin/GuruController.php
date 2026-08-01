<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Guru\StoreGuruRequest;
use App\Http\Requests\Admin\Guru\UpdateGuruRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class GuruController extends Controller
{
    /**
     * Menampilkan daftar guru, dengan pencarian sederhana (nama/email/NIP)
     * lewat query string ?search=... dan pagination.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $guru = User::query()
            ->where('role', 'guru')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nis_nip', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.guru.index', compact('guru', 'search'));
    }

    public function create(): View
    {
        return view('admin.guru.create');
    }

    public function store(StoreGuruRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'guru';

        User::create($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(User $guru): View
    {
        $this->ensureIsGuru($guru);

        return view('admin.guru.edit', ['guru' => $guru]);
    }

    public function update(UpdateGuruRequest $request, User $guru): RedirectResponse
    {
        $this->ensureIsGuru($guru);

        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $guru->update($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(User $guru): RedirectResponse
    {
        $this->ensureIsGuru($guru);

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Guard tambahan: pastikan record yang diakses lewat route-model-binding
     * memang punya role "guru", supaya URL /admin/guru/{id} tidak bisa dipakai
     * untuk mengedit/menghapus user dengan role lain.
     */
    private function ensureIsGuru(User $user): void
    {
        abort_unless($user->role === 'guru', 404);
    }
}
