@extends('layouts.admin')

@section('page-title', 'Tambah Menu Baru')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

:root {
    --ink:        #0c0e14;
    --ink-2:      #1e2130;
    --ink-3:      #4a5068;
    --ink-4:      #8891aa;
    --surface:    #ffffff;
    --surface-2:  #f6f7fb;
    --surface-3:  #eef0f8;
    --border:     rgba(30, 33, 48, 0.09);
    --border-md:  rgba(30, 33, 48, 0.15);

    --blue:       #2563eb;
    --blue-2:     #1d4ed8;
    --blue-bg:    #eff4ff;
    --blue-text:  #1a3ea8;
    --blue-ring:  rgba(37, 99, 235, 0.2);

    --green:      #059669;
    --green-bg:   #ecfdf5;
    --green-ring: rgba(5, 150, 105, 0.2);

    --red:        #dc2626;
    --red-bg:     #fff1f2;
    --red-ring:   rgba(220, 38, 38, 0.2);

    --amber:      #d97706;
    --amber-bg:   #fffbeb;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl: 28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface-2); color: var(--ink-2); }

/* ── MAIN CONTAINER ── */
.menu-dashboard {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .menu-dashboard { padding: 32px 24px 64px; } }

/* ── BREADCRUMB ── */
.sc-crumb {
    width: 100%;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 20px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .sc-crumb { font-size: 0.78rem; margin-bottom: 24px; } }
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ── HEADER SECTION ── */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 20px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    padding: 20px 24px;
}
@media (min-width: 640px) {
    .dashboard-header { padding: 24px 32px; border-radius: var(--r-2xl); margin-bottom: 28px; }
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}
@media (min-width: 640px) { .header-left { gap: 20px; } }

.header-icon {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, var(--blue), var(--blue-2));
    border-radius: var(--r-lg);
    display: flex; align-items: center; justify-content: center;
    color: white;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
@media (min-width: 640px) { .header-icon { width: 56px; height: 56px; } }

.dashboard-title {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.02em;
    margin-bottom: 4px;
}
@media (min-width: 640px) { .dashboard-title { font-size: 1.5rem; } }

.dashboard-subtitle {
    font-size: 0.8rem; color: var(--ink-3);
}
@media (min-width: 640px) { .dashboard-subtitle { font-size: 0.85rem; } }

.btn-outline-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--surface);
    color: var(--ink-2);
    border: 1.5px solid var(--border-md);
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
@media (min-width: 640px) { .btn-outline-custom { padding: 10px 20px; font-size: 0.875rem; } }
.btn-outline-custom:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
    transform: translateY(-2px);
}

/* ── ALERT ── */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    border-radius: var(--r-md);
    margin-bottom: 24px;
    animation: slideDown 0.3s ease-out;
}
@media (min-width: 640px) { .alert { padding: 16px 20px; margin-bottom: 28px; } }
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
.alert-error {
    background: var(--red-bg);
    border-left: 4px solid var(--red);
}
.alert-error svg {
    flex-shrink: 0;
    margin-top: 2px;
    color: var(--red);
}
.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--red);
    opacity: 0.5;
    transition: opacity 0.2s;
    line-height: 1;
}
.alert-close:hover { opacity: 1; }

/* ── MAIN CARD ── */
.main-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    margin-bottom: 24px;
}
@media (min-width: 640px) { .main-card { border-radius: var(--r-2xl); margin-bottom: 28px; } }

.card-header-custom {
    padding: 16px 20px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
@media (min-width: 640px) { .card-header-custom { padding: 20px 24px; } }

.header-left-section {
    display: flex;
    align-items: center;
    gap: 10px;
}
@media (min-width: 640px) { .header-left-section { gap: 12px; } }

.section-icon {
    width: 36px; height: 36px;
    background: var(--blue-bg);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue);
}
@media (min-width: 640px) { .section-icon { width: 40px; height: 40px; } }

.header-left-section h3 {
    font-family: 'Sora', sans-serif;
    font-size: 0.9rem; font-weight: 700;
    color: var(--ink);
    margin: 0 0 2px 0;
}
@media (min-width: 640px) { .header-left-section h3 { font-size: 1rem; margin-bottom: 4px; } }
.header-left-section p {
    font-size: 0.7rem; color: var(--ink-4);
    margin: 0;
}
@media (min-width: 640px) { .header-left-section p { font-size: 0.75rem; } }

.info-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: var(--surface);
    border: 1px solid var(--border-md);
    border-radius: 99px;
    font-size: 0.7rem;
    color: var(--ink-3);
}
@media (min-width: 640px) {
    .info-badge { gap: 8px; padding: 8px 16px; font-size: 0.75rem; }
}

/* Card Body */
.card-body-custom {
    padding: 20px;
}
@media (min-width: 640px) { .card-body-custom { padding: 32px; } }

/* Form Elements */
.form-group-custom {
    margin-bottom: 24px;
}
@media (min-width: 640px) { .form-group-custom { margin-bottom: 28px; } }

.form-label-custom {
    display: block;
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
    margin-bottom: 8px;
}
@media (min-width: 640px) { .form-label-custom { font-size: 0.84rem; margin-bottom: 10px; } }

.form-control-custom, .form-select-custom {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid var(--border-md);
    border-radius: var(--r-md);
    font-size: 0.85rem;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
    background: var(--surface);
}
@media (min-width: 640px) {
    .form-control-custom, .form-select-custom { padding: 11px 15px; font-size: 0.9rem; }
}
.form-control-custom:focus, .form-select-custom:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-ring);
}
.form-control-custom.is-invalid, .form-select-custom.is-invalid {
    border-color: var(--red);
    background: var(--red-bg);
}
.invalid-feedback {
    font-size: 0.7rem;
    color: var(--red);
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
}
@media (min-width: 640px) { .invalid-feedback { font-size: 0.75rem; margin-top: 8px; } }
.form-text {
    font-size: 0.7rem;
    color: var(--ink-4);
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
@media (min-width: 640px) { .form-text { font-size: 0.75rem; margin-top: 8px; } }
.form-text i { font-size: 0.65rem; color: var(--blue); }

.text-danger { color: var(--red); }

/* Radio Group */
.radio-group {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .radio-group { gap: 24px; } }
.radio-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 0.8rem;
    color: var(--ink-2);
}
@media (min-width: 640px) { .radio-label { font-size: 0.85rem; gap: 10px; } }
.radio-label input {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: var(--blue);
}

/* Row Grid */
.row-custom {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    margin-bottom: 24px;
}
@media (min-width: 640px) { .row-custom { grid-template-columns: 1fr 1fr; gap: 20px; } }

/* Toggle Switch */
.toggle-switch-form {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
}
.toggle-switch-form input {
    display: none;
}
.toggle-slider-form {
    position: relative;
    width: 48px;
    height: 24px;
    background: var(--border-md);
    border-radius: 24px;
    transition: background 0.2s;
}
.toggle-slider-form::after {
    content: '';
    position: absolute;
    left: 3px;
    top: 3px;
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    transition: transform 0.2s;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}
.toggle-switch-form input:checked + .toggle-slider-form {
    background: var(--green);
}
.toggle-switch-form input:checked + .toggle-slider-form::after {
    transform: translateX(24px);
}
.toggle-label {
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--ink-2);
}
@media (min-width: 640px) { .toggle-label { font-size: 0.85rem; } }

/* Form Actions */
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}
@media (min-width: 640px) {
    .form-actions { gap: 16px; margin-top: 32px; padding-top: 28px; }
}
@media (max-width: 640px) {
    .form-actions { flex-direction: column; }
}

.btn-primary-custom, .btn-secondary-custom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
    border: 1.5px solid transparent;
}
@media (min-width: 640px) {
    .btn-primary-custom, .btn-secondary-custom { padding: 12px 28px; font-size: 0.875rem; }
}
@media (max-width: 640px) {
    .btn-primary-custom, .btn-secondary-custom { width: 100%; }
}

.btn-primary-custom {
    background: var(--blue);
    color: white;
    border-color: var(--blue);
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.btn-primary-custom:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.4);
}
.btn-primary-custom:active { transform: translateY(0); }

.btn-secondary-custom {
    background: var(--surface);
    color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-secondary-custom:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
}

/* Tips Card */
.tips-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    background: var(--blue-bg);
    border: 1.5px solid rgba(37,99,235,0.2);
    border-radius: var(--r-lg);
}
@media (min-width: 640px) {
    .tips-card { gap: 16px; padding: 20px 24px; border-radius: var(--r-xl); }
}
.tips-icon {
    width: 36px; height: 36px;
    background: rgba(37,99,235,0.15);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue);
    flex-shrink: 0;
}
@media (min-width: 640px) { .tips-icon { width: 40px; height: 40px; } }
.tips-content {
    flex: 1;
}
.tips-content strong {
    display: block;
    font-size: 0.8rem;
    color: var(--blue-text);
    margin-bottom: 8px;
    font-weight: 700;
}
@media (min-width: 640px) { .tips-content strong { font-size: 0.85rem; margin-bottom: 10px; } }
.tips-content ul {
    margin: 0;
    padding-left: 20px;
}
.tips-content li {
    font-size: 0.7rem;
    color: var(--blue-text);
    margin-bottom: 6px;
    line-height: 1.4;
}
@media (min-width: 640px) { .tips-content li { font-size: 0.75rem; margin-bottom: 8px; } }
.tips-content li:last-child { margin-bottom: 0; }

/* Utility */
.d-none { display: none; }

/* Touch-friendly */
@media (max-width: 640px) {
    .form-control-custom, .form-select-custom, .btn-primary-custom, .btn-secondary-custom {
        font-size: 16px;
        touch-action: manipulation;
    }
}
</style>

<div class="menu-dashboard">
    
    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('admin.menus.index') }}"><i class="fas fa-bars"></i> Menu Navigasi</a>
        <i class="fas fa-chevron-right"></i>
        <span>Tambah Menu Baru</span>
    </div>

    {{-- HEADER --}}
    <div class="dashboard-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="fas fa-plus" style="font-size: 1.25rem;"></i>
            </div>
            <div>
                <h1 class="dashboard-title">Tambah Menu</h1>
                <p class="dashboard-subtitle">Buat item menu navigasi baru</p>
            </div>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn-outline-custom">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- ALERT NOTIFICATIONS --}}
    @if($errors->any())
    <div class="alert alert-error" id="errorAlert">
        <i class="fas fa-exclamation-circle" style="font-size: 1rem;"></i>
        <div>
            <strong style="display: block; margin-bottom: 6px;">Terjadi kesalahan</strong>
            <ul style="margin: 0; padding-left: 20px; font-size: 0.75rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    {{-- MAIN CARD --}}
    <div class="main-card">
        <div class="card-header-custom">
            <div class="header-left-section">
                <div class="section-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h3>Form Tambah Menu</h3>
                    <p>Isi informasi menu navigasi baru</p>
                </div>
            </div>
            <div class="header-right-section">
                <span class="info-badge">
                    <i class="fas fa-info-circle"></i>
                    Menu Baru
                </span>
            </div>
        </div>

        <div class="card-body-custom">
            <form action="{{ route('admin.menus.store') }}" method="POST" id="createMenuForm">
                @csrf

                {{-- Judul Menu --}}
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        Judul Menu <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           class="form-control-custom @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" 
                           placeholder="Contoh: Beranda, Tentang Kami, Layanan"
                           required 
                           autofocus>
                    @error('title')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Nama menu yang akan ditampilkan di navigasi website
                    </div>
                </div>

                {{-- Tipe Link --}}
                <div class="form-group-custom">
                    <label class="form-label-custom">Tipe Link</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" 
                                   name="link_type" 
                                   value="page" 
                                   {{ old('link_type', 'page') === 'page' ? 'checked' : '' }} 
                                   onchange="toggleLinkType()">
                            <span>Halaman (Page)</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" 
                                   name="link_type" 
                                   value="url" 
                                   {{ old('link_type') === 'url' ? 'checked' : '' }} 
                                   onchange="toggleLinkType()">
                            <span>URL Custom</span>
                        </label>
                    </div>
                </div>

                {{-- Pilih Halaman --}}
                <div id="pageSelect" class="form-group-custom">
                    <label class="form-label-custom">Pilih Halaman</label>
                    <select name="page_id" class="form-select-custom @error('page_id') is-invalid @enderror">
                        <option value="">-- Pilih Halaman --</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('page_id')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        <i class="fas fa-file-alt"></i>
                        Pilih halaman yang sudah dipublikasikan
                    </div>
                </div>

                {{-- URL Custom --}}
                <div id="urlInput" class="form-group-custom d-none">
                    <label class="form-label-custom">URL Custom</label>
                    <input type="url" 
                           name="url" 
                           class="form-control-custom @error('url') is-invalid @enderror" 
                           value="{{ old('url') }}" 
                           placeholder="https://example.com/halaman">
                    @error('url')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        <i class="fas fa-link"></i>
                        Masukkan URL lengkap (https://) atau path internal (/kontak)
                    </div>
                </div>

                {{-- Parent Menu --}}
                <div class="form-group-custom">
                    <label class="form-label-custom">Parent Menu</label>
                    <select name="parent_id" class="form-select-custom @error('parent_id') is-invalid @enderror">
                        <option value="">— Menu Utama (Tanpa Parent) —</option>
                        @include('admin.menus.partials.options', [
                            'menus' => $parents,
                            'level' => 0
                        ])
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        <i class="fas fa-folder"></i>
                        Kosongkan untuk menu utama, pilih parent untuk sub-menu
                    </div>
                </div>

                {{-- Urutan dan Status --}}
                <div class="row-custom">
                    <div class="form-group-custom" style="margin-bottom: 0;">
                        <label class="form-label-custom">Urutan</label>
                        <input type="number" 
                               name="order" 
                               class="form-control-custom @error('order') is-invalid @enderror" 
                               value="{{ old('order', 0) }}" 
                               min="0">
                        @error('order')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-sort"></i>
                            Semakin kecil angka, semakin atas posisinya
                        </div>
                    </div>
                    <div class="form-group-custom" style="margin-bottom: 0;">
                        <label class="form-label-custom">Status</label>
                        <label class="toggle-switch-form">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="toggle-slider-form"></span>
                            <span class="toggle-label">Aktif</span>
                        </label>
                        <div class="form-text" style="margin-top: 8px;">
                            <i class="fas fa-eye"></i>
                            Menu nonaktif tidak akan ditampilkan di website
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions">
                    <button type="submit" class="btn-primary-custom" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Menu
                    </button>
                    <a href="{{ route('admin.menus.index') }}" class="btn-secondary-custom">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tips Card --}}
    <div class="tips-card">
        <div class="tips-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        <div class="tips-content">
            <strong>Tips & Panduan:</strong>
            <ul>
                <li>Gunakan judul menu yang singkat dan mudah diingat (maksimal 30 karakter)</li>
                <li>Menu dengan sub-menu akan otomatis menampilkan dropdown di frontend</li>
                <li>URL Custom bisa digunakan untuk link eksternal atau halaman khusus</li>
                <li>Urutan menu menentukan posisi tampilan (ascending dari kecil ke besar)</li>
                <li>Menu dapat memiliki nested level unlimited (sub-menu dari sub-menu)</li>
                <li>Menu nonaktif tidak akan ditampilkan meskipun sudah tersimpan</li>
            </ul>
        </div>
    </div>
</div>

<script>
function toggleLinkType() {
    const selectedRadio = document.querySelector('input[name="link_type"]:checked');
    const isUrl = selectedRadio && selectedRadio.value === 'url';
    
    const pageSelect = document.getElementById('pageSelect');
    const urlInput = document.getElementById('urlInput');
    const pageSelectField = document.querySelector('select[name="page_id"]');
    const urlField = document.querySelector('input[name="url"]');
    
    if (isUrl) {
        if (pageSelect) pageSelect.classList.add('d-none');
        if (urlInput) urlInput.classList.remove('d-none');
        if (pageSelectField) pageSelectField.disabled = true;
        if (urlField) urlField.disabled = false;
    } else {
        if (pageSelect) pageSelect.classList.remove('d-none');
        if (urlInput) urlInput.classList.add('d-none');
        if (pageSelectField) pageSelectField.disabled = false;
        if (urlField) urlField.disabled = true;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize toggle
    toggleLinkType();
    
    // Auto dismiss alert
    const alertEl = document.getElementById('errorAlert');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.3s';
            alertEl.style.opacity = '0';
            setTimeout(() => alertEl.remove(), 300);
        }, 5000);
    }
    
    // Update toggle label text
    const toggleCheckbox = document.querySelector('input[name="is_active"]');
    const toggleLabel = document.querySelector('.toggle-label');
    
    if (toggleCheckbox && toggleLabel) {
        const updateLabel = function() {
            toggleLabel.textContent = this.checked ? 'Aktif' : 'Nonaktif';
        };
        toggleCheckbox.addEventListener('change', updateLabel);
        updateLabel.call(toggleCheckbox);
    }
    
    // Form validation and submission
    const form = document.getElementById('createMenuForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('input[name="title"]');
            const linkType = form.querySelector('input[name="link_type"]:checked');
            
            // Validate title
            if (!title.value.trim()) {
                e.preventDefault();
                title.classList.add('is-invalid');
                showNotification('Judul menu harus diisi', 'error');
                title.focus();
                return false;
            }
            
            // Validate link type
            if (!linkType) {
                e.preventDefault();
                showNotification('Pilih tipe link', 'error');
                return false;
            }
            
            // Validate page or URL
            if (linkType.value === 'page') {
                const pageSelect = form.querySelector('select[name="page_id"]');
                if (!pageSelect.value) {
                    e.preventDefault();
                    pageSelect.classList.add('is-invalid');
                    showNotification('Pilih halaman yang akan ditautkan', 'error');
                    pageSelect.focus();
                    return false;
                }
            } else if (linkType.value === 'url') {
                const urlInput = form.querySelector('input[name="url"]');
                const urlValue = urlInput.value.trim();
                if (!urlValue) {
                    e.preventDefault();
                    urlInput.classList.add('is-invalid');
                    showNotification('URL tidak boleh kosong', 'error');
                    urlInput.focus();
                    return false;
                }
                if (!urlValue.startsWith('http://') && !urlValue.startsWith('https://') && !urlValue.startsWith('/')) {
                    e.preventDefault();
                    urlInput.classList.add('is-invalid');
                    showNotification('URL harus dimulai dengan http://, https://, atau /', 'error');
                    urlInput.focus();
                    return false;
                }
            }
            
            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            }
        });
    }
    
    // Remove error styling on input
    const inputs = document.querySelectorAll('.form-control-custom, .form-select-custom');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
    
    // Fix for iOS zoom on input focus
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });
    
    // Notification Toast
    function showNotification(message, type = 'success') {
        const existingToast = document.querySelector('.notification-toast');
        if (existingToast) existingToast.remove();
        
        const colors = { success: '#059669', error: '#dc2626' };
        const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle' };
        
        const toast = document.createElement('div');
        toast.className = 'notification-toast';
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 10000;
            min-width: 280px;
            max-width: 360px;
            background: var(--surface);
            border-radius: var(--r-md);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            border-left: 4px solid ${colors[type]};
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.8rem;
            color: var(--ink-2);
            animation: slideInRight 0.3s ease;
        `;
        
        toast.innerHTML = `
            <i class="fas ${icons[type]}" style="color: ${colors[type]}; font-size: 1rem;"></i>
            <span style="flex: 1">${message}</span>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: var(--ink-4); cursor: pointer; font-size: 1.1rem;">×</button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }
    
    // Add animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection