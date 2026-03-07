@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Edit Menu</h1>
            <p class="text-muted small mb-0">{{ $menu->title }}</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Menu <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $menu->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tipe Link</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="link_type"
                                           id="typePage" value="page"
                                           {{ $menu->page_id ? 'checked' : '' }} onchange="toggleLinkType()">
                                    <label class="form-check-label" for="typePage">Halaman</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="link_type"
                                           id="typeUrl" value="url"
                                           {{ $menu->url ? 'checked' : '' }} onchange="toggleLinkType()">
                                    <label class="form-check-label" for="typeUrl">URL Custom</label>
                                </div>
                            </div>
                        </div>

                        <div id="pageSelect" class="mb-3">
                            <label class="form-label fw-semibold">Pilih Halaman</label>
                            <select name="page_id" class="form-select">
                                <option value="">-- Pilih Halaman --</option>
                                @foreach(\App\Models\Page::where('status','published')->get() as $page)
                                    <option value="{{ $page->id }}"
                                        {{ $menu->page_id == $page->id ? 'selected' : '' }}>
                                        {{ $page->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="urlInput" class="mb-3 d-none">
                            <label class="form-label fw-semibold">URL Custom</label>
                            <input type="text" name="url" class="form-control"
                                   value="{{ old('url', $menu->url) }}" placeholder="https://...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Parent Menu</label>
                            <select name="parent_id" class="form-select">
                                <option value="">— Menu Utama —</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Urutan</label>
                                <input type="number" name="order" class="form-control"
                                       value="{{ old('order', $menu->order) }}" min="0">
                            </div>
                            <div class="col-6 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active"
                                           id="isActive" {{ $menu->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="isActive">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Menu
                            </button>
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleLinkType() {
    const isUrl = document.getElementById('typeUrl').checked;
    document.getElementById('pageSelect').classList.toggle('d-none', isUrl);
    document.getElementById('urlInput').classList.toggle('d-none', !isUrl);
}
toggleLinkType();
</script>
@endpush