@extends('layouts.app')

@section('title', 'Profil Saya')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Profil Saya</h4>
        <p class="text-muted small mb-0">Kelola informasi akun Anda</p>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required
                                >
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required
                                >
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">No. HP</label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                >
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">NIS/NIP</label>
                                <input type="text" value="{{ $user->nis_nip ?? '-' }}" class="form-control" disabled>
                                <div class="form-text">NIS/NIP hanya bisa diubah oleh Admin.</div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea
                                    id="address"
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror"
                                >{{ old('address', $user->address) }}</textarea>
                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle text-primary" style="font-size: 4rem;"></i>
                    <h6 class="mt-2 mb-0">{{ $user->name }}</h6>
                    <span class="badge bg-primary-subtle text-primary-emphasis text-capitalize">
                        {{ str_replace('_', ' ', $user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
