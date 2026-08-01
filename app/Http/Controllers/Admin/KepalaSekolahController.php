<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KepalaSekolah\StoreKepalaSekolahRequest;
use App\Http\Requests\Admin\KepalaSekolah\UpdateKepalaSekolahRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class KepalaSekolahController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $kepalaSekolahList = User::query()
            ->where('role', 'kepala_sekolah')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kepala-sekolah.index', [
            'kepalaSekolahList' => $kepalaSekolahList,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.kepala-sekolah.create');
    }

    public function store(StoreKepalaSekolahRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'kepala_sekolah';

        User::create($data);

        return redirect()
            ->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil ditambahkan.');
    }

    public function edit(User $kepalaSekolah): View
    {
        $this->ensureIsKepalaSekolah($kepalaSekolah);

        return view('admin.kepala-sekolah.edit', ['kepalaSekolah' => $kepalaSekolah]);
    }

    public function update(UpdateKepalaSekolahRequest $request, User $kepalaSekolah): RedirectResponse
    {
        $this->ensureIsKepalaSekolah($kepalaSekolah);

        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $kepalaSekolah->update($data);

        return redirect()
            ->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil diperbarui.');
    }

    public function destroy(User $kepalaSekolah): RedirectResponse
    {
        $this->ensureIsKepalaSekolah($kepalaSekolah);

        $kepalaSekolah->delete();

        return redirect()
            ->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil dihapus.');
    }

    private function ensureIsKepalaSekolah(User $user): void
    {
        abort_unless($user->role === 'kepala_sekolah', 404);
    }
}
