{{-- resources/views/admin/popup/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Kelola Pop-up Banner</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            {{-- TAG FORM YANG HILANG --}}
            <form action="{{ route('admin.popup.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Upload Gambar Pop-up</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                        {{ optional($popup)->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktifkan Pop-up</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Preview gambar aktif --}}
    @if($popup && $popup->image_path)
    <div class="card mt-4">
        <div class="card-header">Preview Gambar Saat Ini</div>
        <div class="card-body text-center">
            <img src="{{ Storage::url($popup->image_path) }}"
                 style="max-width: 500px; width: 100%; border-radius: 8px;">
            <p class="mt-2">
                Status:
                <span class="badge {{ $popup->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $popup->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </p>
        </div>
    </div>
    @endif
</div>
@endsection