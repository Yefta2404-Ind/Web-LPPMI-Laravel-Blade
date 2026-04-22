@extends('layouts.admin')

@section('page-title', 'Edit Menu')

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
.edit-menu-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .edit-menu-page { padding: 32px 24px 64px; } }

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

/* ── HEADER ── */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
}
@media (min-width: 640px) { .page-header { margin-bottom: 28px; } }

.header-left h1 {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.02em;
    margin-bottom: 6px;
}
@media (min-width: 640px) { .header-left h1 { font-size: 1.5rem; margin-bottom: 8px; } }

.header-left p {
    font-size: 0.8rem; color: var(--ink-3);
}
@media (min-width: 640px) { .header-left p { font-size: 0.85rem; } }

.btn-back {
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
@media (min-width: 640px) { .btn-back { padding: 10px 20px; font-size: 0.875rem; } }
.btn-back:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
    transform: translateY(-1px);
}

/* ── FORM CARD ── */
.form-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    animation: fadeIn 0.4s ease;
}
@media (min-width: 640px) { .form-card { border-radius: var(--r-2xl); } }
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-body {
    padding: 20px;
}
@media (min-width: 640px) { .card-body { padding: 32px; } }

/* ── FORM ELEMENTS ── */
.form-group {
    margin-bottom: 24px;
}
@media (min-width: 640px) { .form-group { margin-bottom: 28px; } }

.form-label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
}
@media (min-width: 640px) { .form-label { font-size: 0.84rem; margin-bottom: 10px; } }
.required {
    color: var(--red);
    margin-left: 4px;
}

.form-control, .form-select {
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
    .form-control, .form-select { padding: 11px 15px; font-size: 0.9rem; }
}
.form-control:focus, .form-select:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-ring);
}
.form-control.error, .form-select.error {
    border-color: var(--red);
    background: var(--red-bg);
}

/* Radio Group */
.radio-group {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.radio-item {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}
.radio-item input[type="radio"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: var(--blue);
}
.radio-item label {
    font-size: 0.8rem;
    color: var(--ink-2);
    cursor: pointer;
}
@media (min-width: 640px) { .radio-item label { font-size: 0.85rem; } }

/* Row Grid */
.row-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    margin-bottom: 24px;
}
@media (min-width: 640px) { .row-grid { grid-template-columns: 1fr 1fr; gap: 20px; } }

/* Switch Toggle */
.switch-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 0;
}
.switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 24px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    inset: 0;
    background: var(--border-md);
    border-radius: 24px;
    cursor: pointer;
    transition: background 0.2s;
}
.slider::after {
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
.switch input:checked + .slider {
    background: var(--green);
}
.switch input:checked + .slider::after {
    transform: translateX(24px);
}
.switch-label {
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
    cursor: pointer;
}
@media (min-width: 640px) { .switch-label { font-size: 0.84rem; } }

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

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    border: 1.5px solid transparent;
}
@media (min-width: 640px) {
    .btn-primary, .btn-secondary { padding: 12px 28px; font-size: 0.875rem; }
}
@media (max-width: 640px) {
    .btn-primary, .btn-secondary { width: 100%; }
}

.btn-primary {
    background: var(--blue);
    color: white;
    border-color: var(--blue);
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.btn-primary:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.4);
}
.btn-primary:active { transform: translateY(0); }

.btn-secondary {
    background: var(--surface);
    color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-secondary:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
}

/* Info Card */
.info-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-lg);
    margin-top: 20px;
}
@media (min-width: 640px) {
    .info-card { gap: 16px; padding: 18px 24px; border-radius: var(--r-xl); margin-top: 24px; }
}
.info-icon {
    font-size: 1.1rem;
    flex-shrink: 0;
    color: var(--blue);
}
.info-content {
    flex: 1;
    font-size: 0.75rem;
    color: var(--ink-3);
    line-height: 1.5;
}
@media (min-width: 640px) { .info-content { font-size: 0.8rem; } }
.info-content strong {
    display: block;
    margin-bottom: 6px;
    color: var(--ink-2);
    font-weight: 700;
}
.info-content p { margin: 0; }

/* Touch-friendly */
@media (max-width: 640px) {
    .form-control, .form-select, .btn-primary, .btn-secondary {
        font-size: 16px;
        touch-action: manipulation;
    }
}
</style>

<div class="edit-menu-page">
    
    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('admin.menus.index') }}"><i class="fas fa-bars"></i> Menu Navigasi</a>
        <i class="fas fa-chevron-right"></i>
        <span>Edit Menu</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="header-left">
            <h1>
                <i class="fas fa-pen" style="margin-right: 8px; color: var(--blue);"></i>
                Edit Menu
            </h1>
            <p>{{ $menu->title }}</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">
        <div class="card-body">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST" id="menuForm">
                @csrf 
                @method('PUT')

                {{-- Judul Menu --}}
                <div class="form-group">
                    <label class="form-label">
                        Judul Menu <span class="required">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           class="form-control @error('title') error @enderror"
                           value="{{ old('title', $menu->title) }}" 
                           placeholder="Masukkan judul menu"
                           required 
                           autofocus>
                    @error('title')
                        <p class="error-message" style="margin-top: 6px; font-size: 0.7rem; color: var(--red);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Tipe Link --}}
                <div class="form-group">
                    <label class="form-label">Tipe Link</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="link_type" value="page" 
                                   {{ $menu->page_id ? 'checked' : '' }} onchange="toggleLinkType()">
                            <span>Halaman</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="link_type" value="url" 
                                   {{ $menu->url ? 'checked' : '' }} onchange="toggleLinkType()">
                            <span>URL Custom</span>
                        </label>
                    </div>
                </div>

                {{-- Pilih Halaman --}}
                <div id="pageSelect" class="form-group">
                    <label class="form-label">Pilih Halaman</label>
                    <select name="page_id" class="form-select">
                        <option value="">-- Pilih Halaman --</option>
                        @foreach(\App\Models\Page::where('status','published')->get() as $page)
                            <option value="{{ $page->id }}"
                                {{ $menu->page_id == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="field-hint" style="margin-top: 6px; font-size: 0.7rem; color: var(--ink-4);">
                        <i class="fas fa-info-circle"></i> Halaman yang sudah dipublikasikan akan muncul di sini
                    </div>
                </div>

                {{-- URL Custom --}}
                <div id="urlInput" class="form-group d-none">
                    <label class="form-label">URL Custom</label>
                    <input type="text" 
                           name="url" 
                           class="form-control @error('url') error @enderror"
                           value="{{ old('url', $menu->url) }}" 
                           placeholder="https://example.com/halaman">
                    @error('url')
                        <p class="error-message" style="margin-top: 6px; font-size: 0.7rem; color: var(--red);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                    <div class="field-hint" style="margin-top: 6px; font-size: 0.7rem; color: var(--ink-4);">
                        <i class="fas fa-link"></i> Masukkan URL lengkap (termasuk https://)
                    </div>
                </div>

                {{-- Parent Menu --}}
                <div class="form-group">
                    <label class="form-label">Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">— Menu Utama —</option>
                        @foreach($parents as $parent)
                            @if($parent->id != $menu->id)
                                <option value="{{ $parent->id }}"
                                    {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->title }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="field-hint" style="margin-top: 6px; font-size: 0.7rem; color: var(--ink-4);">
                        <i class="fas fa-folder"></i> Pilih menu induk jika ingin membuat sub-menu
                    </div>
                </div>

                {{-- Urutan & Status --}}
                <div class="row-grid">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Urutan</label>
                        <input type="number" 
                               name="order" 
                               class="form-control"
                               value="{{ old('order', $menu->order) }}" 
                               min="0"
                               placeholder="0">
                        <div class="field-hint" style="margin-top: 6px; font-size: 0.7rem; color: var(--ink-4);">
                            <i class="fas fa-sort"></i> Semakin kecil angka, semakin atas posisinya
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0; display: flex; align-items: flex-end;">
                        <div class="switch-wrapper">
                            <label class="switch">
                                <input type="checkbox" name="is_active" id="isActive" {{ $menu->is_active ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                            <label class="switch-label" for="isActive">Status Aktif</label>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Update Menu
                    </button>
                    <a href="{{ route('admin.menus.index') }}" class="btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="info-card">
        <div class="info-icon">
            <i class="fas fa-info-circle"></i>
        </div>
        <div class="info-content">
            <strong>Informasi Menu</strong>
            <p>Menu yang aktif akan ditampilkan di navigasi website. Pastikan URL atau halaman yang dipilih valid untuk menghindari link rusak.</p>
        </div>
    </div>
</div>

<script>
function toggleLinkType() {
    const isUrl = document.querySelector('input[name="link_type"]:checked')?.value === 'url';
    const pageSelect = document.getElementById('pageSelect');
    const urlInput = document.getElementById('urlInput');
    
    if (pageSelect) pageSelect.classList.toggle('d-none', isUrl);
    if (urlInput) urlInput.classList.toggle('d-none', !isUrl);
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize toggle
    toggleLinkType();
    
    // Form validation and submission
    const form = document.getElementById('menuForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('input[name="title"]');
            const linkType = form.querySelector('input[name="link_type"]:checked');
            
            // Validate title
            if (!title.value.trim()) {
                e.preventDefault();
                title.classList.add('error');
                showNotification('Judul menu harus diisi', 'error');
                title.focus();
                return false;
            }
            
            // Validate link type selection
            if (!linkType) {
                e.preventDefault();
                showNotification('Pilih tipe link (Halaman atau URL Custom)', 'error');
                return false;
            }
            
            // Validate page selection if page type
            if (linkType.value === 'page') {
                const pageSelect = form.querySelector('select[name="page_id"]');
                if (!pageSelect.value) {
                    e.preventDefault();
                    pageSelect.classList.add('error');
                    showNotification('Pilih halaman yang akan ditautkan', 'error');
                    pageSelect.focus();
                    return false;
                }
            }
            
            // Validate URL if URL type
            if (linkType.value === 'url') {
                const urlInput = form.querySelector('input[name="url"]');
                const urlValue = urlInput.value.trim();
                if (!urlValue) {
                    e.preventDefault();
                    urlInput.classList.add('error');
                    showNotification('URL tidak boleh kosong', 'error');
                    urlInput.focus();
                    return false;
                }
                if (!urlValue.startsWith('http://') && !urlValue.startsWith('https://')) {
                    e.preventDefault();
                    urlInput.classList.add('error');
                    showNotification('URL harus dimulai dengan http:// atau https://', 'error');
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
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
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
        .d-none { display: none; }
    `;
    document.head.appendChild(style);
});
</script>
@endsection