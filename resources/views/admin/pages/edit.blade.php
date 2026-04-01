@extends('layouts.admin')

@section('content')
<style>
/* ============================================
   PREMIUM PAGE EDITOR - MODERN & ELEGANT
   ============================================ */

:root {
    --primary: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #eff6ff;
    --success: #10b981;
    --success-light: #d1fae5;
    --warning: #f59e0b;
    --warning-light: #fef3c7;
    --danger: #ef4444;
    --danger-light: #fee2e2;
    --gray-50: #fafafa;
    --gray-100: #f4f4f5;
    --gray-200: #e4e4e7;
    --gray-300: #d4d4d8;
    --gray-400: #a1a1aa;
    --gray-500: #71717a;
    --gray-600: #52525b;
    --gray-700: #3f3f46;
    --gray-800: #27272a;
    --gray-900: #18181b;
    --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
}

/* Main Container - dengan margin yang cukup agar tidak tertutup sidebar */
.page-editor {
    max-width: 1400px;
    margin: 0 auto;
    padding: 24px 32px;
    background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
    min-height: calc(100vh - 60px);
}

/* Header Section */
.editor-header {
    background: white;
    border-radius: var(--radius-xl);
    padding: 20px 28px;
    margin-bottom: 28px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.header-info {
    display: flex;
    align-items: center;
    gap: 18px;
}

.header-badge {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--shadow-sm);
}

.header-title h1 {
    font-size: 24px;
    font-weight: 700;
    color: var(--gray-800);
    margin: 0 0 4px 0;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.header-title p {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 500;
}

.status-pill.published {
    background: var(--success-light);
    color: var(--success);
}

.status-pill.draft {
    background: var(--warning-light);
    color: var(--warning);
}

.header-actions {
    display: flex;
    gap: 10px;
}

.action-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-600);
    text-decoration: none;
    transition: all 0.2s;
}

.action-link:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
    transform: translateY(-1px);
}

/* Form Layout */
.editor-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
}

@media (max-width: 1024px) {
    .editor-layout {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .page-editor {
        padding: 20px;
    }
}

/* Cards */
.editor-card {
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--gray-200);
    overflow: hidden;
    transition: all 0.2s;
    margin-bottom: 24px;
}

.editor-card:last-child {
    margin-bottom: 0;
}

.editor-card:hover {
    box-shadow: var(--shadow-md);
}

.card-head {
    padding: 16px 24px;
    background: white;
    border-bottom: 1px solid var(--gray-100);
}

.card-head h3 {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gray-700);
}

.card-head h3 svg {
    color: var(--primary);
}

.card-body {
    padding: 20px 24px;
}

/* Form Elements */
.form-field {
    margin-bottom: 20px;
}

.form-field:last-child {
    margin-bottom: 0;
}

.field-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 8px;
}

.field-label .required {
    color: var(--danger);
    margin-left: 4px;
}

.field-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 14px;
    transition: all 0.2s;
    background: white;
}

.field-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.field-input-lg {
    font-size: 15px;
    padding: 12px 16px;
}

/* Slug Display */
.slug-display {
    background: var(--gray-50);
    border-radius: var(--radius-md);
    padding: 10px 14px;
    border: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.slug-text {
    font-family: 'SF Mono', 'Monaco', 'Courier New', monospace;
    font-size: 13px;
    color: var(--gray-700);
    word-break: break-all;
}

.copy-btn {
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 6px;
    border-radius: var(--radius-sm);
    transition: all 0.2s;
    display: flex;
    align-items: center;
}

.copy-btn:hover {
    color: var(--primary);
    background: var(--primary-light);
}

/* Progress Bar */
.progress-tracker {
    background: white;
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
    padding: 14px 18px;
    margin-bottom: 24px;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.progress-header span {
    font-size: 12px;
    color: var(--gray-500);
}

.progress-bar-bg {
    height: 6px;
    background: var(--gray-100);
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 10px;
    transition: width 0.3s ease;
    width: 0%;
}

/* Switch Toggle */
.toggle-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--gray-100);
    margin-bottom: 20px;
}

.toggle-info {
    flex: 1;
}

.toggle-label {
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 2px;
}

.toggle-desc {
    font-size: 11px;
    color: var(--gray-500);
}

.toggle-switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 26px;
    flex-shrink: 0;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--gray-300);
    transition: 0.3s;
    border-radius: 34px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: var(--shadow-xs);
}

input:checked + .toggle-slider {
    background-color: var(--primary);
}

input:checked + .toggle-slider:before {
    transform: translateX(22px);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    width: 100%;
    box-shadow: var(--shadow-sm);
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-secondary {
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    width: 100%;
    margin-top: 10px;
}

.btn-secondary:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
}

.btn-outline {
    background: transparent;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
}

.btn-outline:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
}

/* Image Upload */
.image-zone {
    border: 2px dashed var(--gray-200);
    border-radius: var(--radius-lg);
    text-align: center;
    padding: 28px 16px;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--gray-50);
}

.image-zone:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}

.image-zone svg {
    color: var(--gray-400);
    margin-bottom: 10px;
}

.image-zone p {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0;
}

.image-zone small {
    font-size: 11px;
    color: var(--gray-400);
    display: block;
    margin-top: 6px;
}

.image-preview-card {
    position: relative;
    margin-bottom: 16px;
}

.image-preview-card img {
    width: 100%;
    max-height: 180px;
    object-fit: cover;
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
}

.image-remove {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
    background: var(--danger);
    border: none;
    border-radius: var(--radius-sm);
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.image-remove:hover {
    background: #dc2626;
    transform: scale(1.05);
}

/* Info Card */
.info-card {
    background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
}

.info-card h4 {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    font-size: 12px;
    color: var(--gray-600);
    margin-bottom: 8px;
    padding-left: 20px;
    position: relative;
    line-height: 1.4;
}

.info-list li:last-child {
    margin-bottom: 0;
}

.info-list li:before {
    content: "✨";
    position: absolute;
    left: 0;
    font-size: 11px;
}

/* Character Counter */
.char-counter {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: 4px;
    display: flex;
    justify-content: flex-end;
}

/* TinyMCE Override */
.tox-tinymce {
    border-radius: var(--radius-md) !important;
    border: 1px solid var(--gray-200) !important;
}

.tox .tox-toolbar__primary {
    background: var(--gray-50) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .page-editor {
        padding: 16px;
    }
    
    .editor-header {
        padding: 16px 20px;
    }
    
    .header-row {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-info {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-actions {
        width: 100%;
        flex-direction: column;
    }
    
    .action-link {
        justify-content: center;
    }
    
    .card-head {
        padding: 14px 20px;
    }
    
    .card-body {
        padding: 16px 20px;
    }
}

@media (max-width: 480px) {
    .page-editor {
        padding: 12px;
    }
    
    .card-body {
        padding: 14px 16px;
    }
}
</style>

<div class="page-editor">
    <!-- Header -->
    <div class="editor-header">
        <div class="header-row">
            <div class="header-info">
                <div class="header-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div class="header-title">
                    <h1>
                        Edit Halaman
                        <span class="status-pill {{ $page->status === 'published' ? 'published' : 'draft' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                @if($page->status === 'published')
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 8v4l3 3"/>
                                @else
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                @endif
                            </svg>
                            {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </h1>
                    <p>Terakhir diperbarui: {{ $page->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ url('/' . $page->slug) }}" target="_blank" class="action-link">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    Preview
                </a>
                <a href="{{ route('admin.pages.index') }}" class="action-link">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" id="pageForm">
        @csrf 
        @method('PUT')
        
        <!-- Progress Tracker (Mobile) -->
        <div class="progress-tracker d-block d-lg-none">
            <div class="progress-header">
                <span>Kelengkapan Konten</span>
                <span id="progressPercent">0%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>

        <div class="editor-layout">
            <!-- Left Column - Main Content -->
            <div class="main-content">
                <!-- Title Section -->
                <div class="editor-card">
                    <div class="card-head">
                        <h3>
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16v16H4z"/>
                                <line x1="8" y1="8" x2="16" y2="8"/>
                                <line x1="8" y1="12" x2="16" y2="12"/>
                                <line x1="8" y1="16" x2="12" y2="16"/>
                            </svg>
                            Informasi Halaman
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-field">
                            <label class="field-label">
                                Judul Halaman
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="title" id="pageTitle"
                                   class="field-input field-input-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title', $page->title) }}" 
                                   placeholder="Masukkan judul halaman"
                                   maxlength="100"
                                   required>
                            <div class="char-counter">
                                <span id="titleCount">0</span>/100 karakter
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-field">
                            <label class="field-label">URL Slug</label>
                            <div class="slug-display">
                                <code class="slug-text">/{{ $page->slug }}</code>
                                <button type="button" class="copy-btn" onclick="copySlug()" title="Copy slug">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                    </svg>
                                </button>
                            </div>
                            <small class="char-counter" style="margin-top: 6px; justify-content: flex-start;">
                                Slug akan otomatis diperbarui saat judul diubah
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Editor Section -->
                <div class="editor-card">
                    <div class="card-head">
                        <h3>
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                <path d="M4 20h16"/>
                            </svg>
                            Editor Konten
                        </h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <textarea id="tiny-editor" name="content">{!! old('content', $page->content) !!}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar">
                <!-- Publish Card -->
                <div class="editor-card">
                    <div class="card-head">
                        <h3>
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                            Publikasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="toggle-wrapper">
                            <div class="toggle-info">
                                <div class="toggle-label">Status Halaman</div>
                                <div class="toggle-desc" id="statusDesc">
                                    {{ $page->status === 'published' ? 'Publik - Dapat diakses semua orang' : 'Draft - Hanya admin yang dapat melihat' }}
                                </div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" id="statusToggle" {{ $page->status === 'published' ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 6L6 18M6 6l12 12"/>
                            </svg>
                            Batal
                        </button>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="editor-card">
                    <div class="card-head">
                        <h3>
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Gambar Unggulan
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($page->featured_image)
                            <div class="image-preview-card" id="previewContainer">
                                <img id="previewImage" src="{{ asset('storage/'.$page->featured_image) }}" alt="Featured Image">
                                <button type="button" class="image-remove" id="removeImageBtn">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                        
                        <div id="uploadZone" class="image-zone" {{ $page->featured_image ? 'style="display: none;"' : '' }}>
                            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Klik atau drag & drop gambar</p>
                            <small>PNG, JPG, GIF • Max 2MB</small>
                        </div>
                        
                        <input type="file" name="featured_image" id="fileInput" accept="image/*" style="display: none;">
                        
                        <button type="button" class="btn btn-outline" style="width: 100%; margin-top: 14px;" onclick="document.getElementById('fileInput').click()">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Pilih Gambar
                        </button>
                        
                        <small class="char-counter" style="margin-top: 10px; text-align: center; display: block;">
                            Rekomendasi: 1200 x 630 pixel
                        </small>
                    </div>
                </div>

                <!-- Tips & Guide Card -->
                <div class="info-card">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18h6M10 22h4M12 2v4M4.93 4.93l2.83 2.83M19.07 4.93l-2.83 2.83"/>
                            <path d="M12 8a4 4 0 0 0-4 4v2h8v-2a4 4 0 0 0-4-4z"/>
                        </svg>
                        Tips & Panduan
                    </h4>
                    <ul class="info-list">
                        <li>Gunakan Heading (H1-H4) untuk struktur konten</li>
                        <li>Klik kanan pada tabel untuk opsi merge cell</li>
                        <li>Tombol Source Code (&lt;&gt;) untuk edit HTML</li>
                        <li>Drag & drop gambar langsung ke editor</li>
                        <li>Shortcut Ctrl + S untuk menyimpan</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
// TinyMCE Configuration
tinymce.init({
    selector: '#tiny-editor',
    height: 480,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
    ],
    toolbar: [
        'undo redo | blocks fontsize | bold italic underline strikethrough | forecolor backcolor',
        'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        'link image media table | charmap emoticons | preview fullscreen | code help'
    ].join(' | '),
    block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
    fontsize_formats: '10px 12px 14px 16px 18px 20px 24px 28px 32px',
    table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
    image_advtab: true,
    image_caption: true,
    automatic_uploads: true,
    images_upload_url: '{{ route("admin.pages.upload-image") }}',
    images_upload_handler: function(blobInfo) {
        return new Promise((resolve, reject) => {
            let formData = new FormData();
            formData.append('upload', blobInfo.blob(), blobInfo.filename());
            fetch('{{ route("admin.pages.upload-image") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(response => response.json())
            .then(data => resolve(data.location || data.url))
            .catch(err => reject('Upload gagal'));
        });
    },
    content_style: `
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            padding: 16px;
            color: #18181b;
        }
        h1 { font-size: 28px; font-weight: 700; margin: 24px 0 16px; }
        h2 { font-size: 24px; font-weight: 600; margin: 20px 0 12px; }
        h3 { font-size: 20px; font-weight: 600; margin: 16px 0 10px; }
        table { border-collapse: collapse; width: 100%; margin: 16px 0; }
        th, td { border: 1px solid #e4e4e7; padding: 8px 12px; }
        th { background: #f4f4f5; }
        img { max-width: 100%; height: auto; border-radius: 8px; }
        blockquote { border-left: 4px solid #3b82f6; margin: 16px 0; padding: 8px 20px; background: #eff6ff; }
        code { background: #f4f4f5; padding: 2px 6px; border-radius: 6px; }
    `,
    branding: false,
    promotion: false,
    setup: function(editor) {
        editor.on('change', function() {
            updateProgress();
        });
        editor.addShortcut('Ctrl+S', 'Save', function() {
            document.getElementById('pageForm').submit();
        });
    }
});

// Title counter & auto slug
const titleField = document.getElementById('pageTitle');
const titleCounter = document.getElementById('titleCount');
const slugDisplay = document.querySelector('.slug-text');

if (titleField) {
    titleField.addEventListener('input', function() {
        const length = this.value.length;
        if (titleCounter) titleCounter.textContent = length;
        updateProgress();
        
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        if (slugDisplay && slug) slugDisplay.textContent = '/' + slug;
    });
    if (titleCounter) titleCounter.textContent = titleField.value.length;
}

function copySlug() {
    const slug = slugDisplay ? slugDisplay.textContent : '';
    navigator.clipboard.writeText(slug).then(() => {
        showNotification('Slug berhasil disalin!', 'success');
    });
}

function updateProgress() {
    let progress = 0;
    const title = titleField?.value || '';
    const content = tinymce.get('tiny-editor')?.getContent() || '';
    const hasImage = document.getElementById('previewContainer') !== null || 
                     document.getElementById('fileInput')?.files?.length > 0;
    
    if (title && title.length > 0) progress += 40;
    if (content && content.length > 100) progress += 40;
    if (hasImage) progress += 20;
    
    const progressFill = document.getElementById('progressFill');
    const progressPercent = document.getElementById('progressPercent');
    if (progressFill) progressFill.style.width = progress + '%';
    if (progressPercent) progressPercent.textContent = progress + '%';
}

// Status toggle
const statusToggle = document.getElementById('statusToggle');
const statusDesc = document.getElementById('statusDesc');

if (statusToggle) {
    statusToggle.addEventListener('change', function() {
        if (statusDesc) {
            if (this.checked) {
                statusDesc.textContent = 'Publik - Dapat diakses semua orang';
            } else {
                statusDesc.textContent = 'Draft - Hanya admin yang dapat melihat';
            }
        }
    });
}

// Image upload handling
const fileInput = document.getElementById('fileInput');
const uploadZone = document.getElementById('uploadZone');
let previewContainer = document.getElementById('previewContainer');
const removeBtn = document.getElementById('removeImageBtn');

function showPreview(file) {
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        if (previewContainer) {
            const img = previewContainer.querySelector('img');
            if (img) img.src = e.target.result;
            previewContainer.style.display = 'block';
        } else {
            const container = document.createElement('div');
            container.className = 'image-preview-card';
            container.id = 'previewContainer';
            container.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="image-remove" id="newRemoveBtn">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            `;
            if (uploadZone) {
                uploadZone.parentNode.insertBefore(container, uploadZone);
            }
            previewContainer = container;
            if (uploadZone) uploadZone.style.display = 'none';
            
            const newRemoveBtn = document.getElementById('newRemoveBtn');
            if (newRemoveBtn) newRemoveBtn.addEventListener('click', removeImage);
        }
        updateProgress();
    };
    reader.readAsDataURL(file);
}

function removeImage() {
    if (fileInput) fileInput.value = '';
    if (previewContainer) previewContainer.style.display = 'none';
    if (uploadZone) uploadZone.style.display = 'block';
    updateProgress();
}

if (fileInput) {
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                showNotification('Ukuran file maksimal 2MB!', 'error');
                fileInput.value = '';
                return;
            }
            if (!file.type.startsWith('image/')) {
                showNotification('File harus berupa gambar!', 'error');
                fileInput.value = '';
                return;
            }
            showPreview(file);
        }
    });
}

if (removeBtn) {
    removeBtn.addEventListener('click', removeImage);
}

// Drag & drop
if (uploadZone) {
    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.style.borderColor = '#3b82f6';
        uploadZone.style.background = '#eff6ff';
    });
    
    uploadZone.addEventListener('dragleave', () => {
        uploadZone.style.borderColor = '#e4e4e7';
        uploadZone.style.background = '';
    });
    
    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.style.borderColor = '#e4e4e7';
        uploadZone.style.background = '';
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            if (fileInput) fileInput.files = dt.files;
            showPreview(file);
        } else {
            showNotification('File harus berupa gambar!', 'error');
        }
    });
    
    uploadZone.addEventListener('click', () => {
        if (fileInput) fileInput.click();
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add animation style
if (!document.querySelector('#animation-style')) {
    const style = document.createElement('style');
    style.id = 'animation-style';
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
}

// Initialize progress
setTimeout(updateProgress, 500);
</script>
@endpush
@endsection