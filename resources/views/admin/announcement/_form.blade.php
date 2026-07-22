@csrf

<div class="row g-3">
    <div class="col-12">
        <label for="title" class="form-label">Judul Pengumuman</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $announcement->title ?? '') }}"
            class="form-control @error('title') is-invalid @enderror"
            required
        >
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="content" class="form-label">Isi Pengumuman</label>
        <textarea
            id="content"
            name="content"
            rows="6"
            class="form-control @error('content') is-invalid @enderror"
            required
        >{{ old('content', $announcement->content ?? '') }}</textarea>
        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
