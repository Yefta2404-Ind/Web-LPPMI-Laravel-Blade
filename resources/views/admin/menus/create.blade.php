@extends('layouts.admin')

@section('content')
<style>
:root {
    --primary: #2563eb;
    --primary-light: #3b82f6;
    --primary-soft: #dbeafe;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-600: #4b5563;
    --gray-900: #111827;
    --danger: #dc2626;
}

/* Container */
.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* Header */
.header-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.header-title h1 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
}

.header-title p {
    color: var(--gray-600);
    font-size: 0.875rem;
    margin: 0.25rem 0 0;
}

/* Buttons */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid transparent;
    cursor: pointer;
}

.btn-outline {
    border-color: var(--gray-200);
    color: var(--gray-600);
    background: white;
}

.btn-outline:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
}

/* Card */
.card {
    background: white;
    border-radius: 0.5rem;
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.card-body {
    padding: 1.5rem;
}

/* Form */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-900);
    margin-bottom: 0.375rem;
}

.form-label i {
    color: var(--primary);
    margin-right: 0.25rem;
    font-size: 0.75rem;
}

.required {
    color: var(--danger);
    margin-left: 0.125rem;
}

.form-control, .form-select {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--gray-200);
    border-radius: 0.375rem;
    font-size: 0.875rem;
    color: var(--gray-900);
    background: white;
}

.form-control:focus, .form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-soft);
}

.form-text {
    font-size: 0.75rem;
    color: var(--gray-600);
    margin-top: 0.25rem;
}

.form-text i {
    font-size: 0.625rem;
    color: var(--primary);
}

/* Radio group */
.radio-group {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--gray-50);
    border-radius: 0.375rem;
    border: 1px solid var(--gray-200);
}

.form-check-input {
    margin: 0;
    width: 1rem;
    height: 1rem;
}

.form-check-label {
    font-size: 0.875rem;
    color: var(--gray-900);
}

/* Switch */
.form-switch {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    min-height: 1.5rem;
}

.form-switch-input {
    width: 2rem;
    height: 1rem;
    background: var(--gray-200);
    border-radius: 2rem;
    appearance: none;
    cursor: pointer;
    position: relative;
}

.form-switch-input:checked {
    background: var(--primary);
}

.form-switch-input:checked::after {
    left: 1rem;
}

.form-switch-input::after {
    content: '';
    width: 0.875rem;
    height: 0.875rem;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 0.0625rem;
    left: 0.0625rem;
    transition: left 0.2s;
}

.form-switch-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-900);
}

/* Error */
.is-invalid {
    border-color: var(--danger);
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Grid */
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.col-6 {
    flex: 0 0 calc(50% - 0.5rem);
}

/* Empty state */
.d-none {
    display: none;
}

/* Action buttons */
.action-group {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

/* Info box */
.info-box {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: 0.375rem;
    padding: 0.75rem 1rem;
    margin-top: 1rem;
}

.info-box-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.info-box i {
    color: var(--primary);
    font-size: 1rem;
}

.info-box p {
    font-size: 0.75rem;
    color: var(--gray-600);
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .col-6 {
        flex: 0 0 100%;
    }
    
    .header-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .radio-group {
        flex-direction: column;
    }
    
    .action-group {
        flex-direction: column;
    }
}
</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="header-wrapper">
        <div class="header-title">
            <h1>Tambah Menu</h1>
            <p><i class="fas fa-circle-info"></i> Tambah item menu navigasi</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.menus.store') }}" method="POST">
                @csrf

                <!-- Judul -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-heading"></i>
                        Judul Menu <span class="required">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" 
                           placeholder="Contoh: Beranda, Tentang"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tipe Link -->
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-link"></i> Tipe Link</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="link_type"
                                   id="typePage" 
                                   value="page"
                                   {{ old('link_type', 'page') === 'page' ? 'checked' : '' }}
                                   onchange="toggleLinkType()">
                            <label class="form-check-label" for="typePage">Halaman</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="link_type"
                                   id="typeUrl" 
                                   value="url"
                                   {{ old('link_type') === 'url' ? 'checked' : '' }}
                                   onchange="toggleLinkType()">
                            <label class="form-check-label" for="typeUrl">URL Custom</label>
                        </div>
                    </div>
                </div>

                <!-- Pilih Halaman -->
                <div id="pageSelect" class="form-group">
                    <label class="form-label"><i class="fas fa-file"></i> Pilih Halaman</label>
                    <select name="page_id" class="form-select @error('page_id') is-invalid @enderror">
                        <option value="">-- Pilih Halaman --</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('page_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- URL Custom -->
                <div id="urlInput" class="form-group d-none">
                    <label class="form-label"><i class="fas fa-globe"></i> URL Custom</label>
                    <input type="text" 
                           name="url" 
                           class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url') }}" 
                           placeholder="https://... atau /path">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Parent Menu -->
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-sitemap"></i> Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">— Menu Utama —</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i> Kosongkan jika menu utama
                    </div>
                </div>

                <!-- Urutan dan Status -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-sort"></i> Urutan</label>
                            <input type="number" 
                                   name="order" 
                                   class="form-control"
                                   value="{{ old('order', 0) }}" 
                                   min="0">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <div class="form-switch">
                                <input type="checkbox" 
                                       name="is_active"
                                       id="isActive" 
                                       class="form-switch-input"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       value="1">
                                <label for="isActive" class="form-switch-label">Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="action-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tips -->
    <div class="info-box">
        <div class="info-box-content">
            <i class="fas fa-lightbulb"></i>
            <p>Gunakan judul singkat • Sub-menu perlu parent • Urutan kecil tampil di atas</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleLinkType() {
    const isUrl = document.getElementById('typeUrl').checked;
    const pageSelect = document.getElementById('pageSelect');
    const urlInput = document.getElementById('urlInput');
    
    if (isUrl) {
        pageSelect.classList.add('d-none');
        urlInput.classList.remove('d-none');
        document.querySelector('select[name="page_id"]').disabled = true;
        document.querySelector('input[name="url"]').disabled = false;
    } else {
        pageSelect.classList.remove('d-none');
        urlInput.classList.add('d-none');
        document.querySelector('select[name="page_id"]').disabled = false;
        document.querySelector('input[name="url"]').disabled = true;
    }
}

// Initial call
toggleLinkType();
</script>
@endpush