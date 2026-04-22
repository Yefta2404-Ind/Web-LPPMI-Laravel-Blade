@extends('layouts.admin')

@section('content')
<style>
/* ============================================
   EDIT PAGE - FULL RESPONSIVE (SAME STYLE AS CREATE)
   MOBILE FIRST APPROACH
   ============================================ */

:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #dbeafe;
    --primary-bg: #eff6ff;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --danger-light: #fee2e2;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --radius-sm: 0.5rem;
    --radius-md: 0.75rem;
    --radius-lg: 1rem;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ============================================
   MOBILE FIRST (0 - 768px)
   ============================================ */
.page-edit {
    width: 100%;
    padding: 12px;
    background: var(--gray-50);
    min-height: 100vh;
}

/* HEADER - MOBILE */
.page-header {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 20px;
    background: white;
    padding: 16px;
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-icon {
    width: 44px;
    height: 44px;
    background: var(--primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.header-icon svg {
    width: 22px;
    height: 22px;
}

.header-text h1 {
    font-size: 18px;
    font-weight: 700;
    color: var(--gray-800);
    margin: 0 0 2px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.header-text p {
    font-size: 11px;
    color: var(--gray-500);
    margin: 0;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 500;
}

.status-badge.published {
    background: #d1fae5;
    color: #059669;
}

.status-badge.draft {
    background: #fed7aa;
    color: #ea580c;
}

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-preview {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 16px;
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    flex: 1;
}

.btn-back {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    flex: 1;
}

.btn-preview:active,
.btn-back:active {
    transform: scale(0.98);
    background: var(--gray-50);
}

/* FORM LAYOUT - MOBILE */
.form-layout {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* CARDS - MOBILE */
.card {
    background: white;
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.card-header {
    padding: 14px 16px;
    background: white;
    border-bottom: 1px solid var(--gray-100);
}

.card-header h3 {
    font-size: 13px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--gray-700);
}

.card-header h3 svg {
    width: 16px;
    height: 16px;
    color: var(--primary);
}

.card-body {
    padding: 16px;
}

/* FORM ELEMENTS - MOBILE */
.form-group {
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 6px;
}

.form-label .required {
    color: var(--danger);
    margin-left: 2px;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-sm);
    font-size: 14px;
    transition: all 0.2s;
    background: white;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.input-group {
    display: flex;
    align-items: stretch;
}

.input-group-text {
    padding: 0 12px;
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-right: none;
    border-radius: var(--radius-sm) 0 0 var(--radius-sm);
    font-size: 14px;
    color: var(--gray-500);
    display: flex;
    align-items: center;
}

.input-group .form-control {
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
}

.help-text {
    font-size: 10px;
    color: var(--gray-400);
    margin-top: 5px;
    display: block;
}

.slug-copy-btn {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-left: none;
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    padding: 0 12px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    color: var(--gray-500);
}

.slug-copy-btn:active {
    background: var(--gray-100);
}

/* SWITCH TOGGLE - MOBILE */
.switch-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 8px 0;
}

.switch-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-700);
}

.switch-description {
    font-size: 10px;
    color: var(--gray-500);
    margin-top: 2px;
}

.form-switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 24px;
    flex-shrink: 0;
}

.form-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.switch-slider {
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

.switch-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: var(--shadow-sm);
}

input:checked + .switch-slider {
    background-color: var(--primary);
}

input:checked + .switch-slider:before {
    transform: translateX(24px);
}

/* BUTTONS - MOBILE */
.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 16px;
    border-radius: var(--radius-md);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    text-decoration: none;
    width: 100%;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:active {
    transform: scale(0.98);
    background: var(--primary-dark);
}

.btn-outline {
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    margin-top: 12px;
}

.btn-outline:active {
    transform: scale(0.98);
    background: var(--gray-50);
}

/* DIVIDER */
.divider {
    margin: 16px 0;
    border-top: 1px solid var(--gray-100);
}

/* IMAGE UPLOAD - MOBILE */
.image-upload-area {
    border: 2px dashed var(--gray-200);
    border-radius: var(--radius-md);
    text-align: center;
    padding: 24px 16px;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--gray-50);
}

.image-upload-area:active {
    transform: scale(0.98);
    border-color: var(--primary);
    background: var(--primary-light);
}

.image-upload-area svg {
    width: 36px;
    height: 36px;
    color: var(--gray-400);
    margin-bottom: 8px;
}

.image-upload-area p {
    font-size: 12px;
    color: var(--gray-500);
    margin: 0;
}

.image-upload-area small {
    font-size: 10px;
    color: var(--gray-400);
    display: block;
    margin-top: 4px;
}

.image-preview {
    margin-top: 12px;
    display: none;
}

.image-preview.show {
    display: block;
}

.image-preview img {
    width: 100%;
    max-height: 160px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    margin-bottom: 10px;
    border: 1px solid var(--gray-200);
}

.btn-remove {
    width: 100%;
    padding: 8px;
    background: var(--danger);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
}

.btn-remove:active {
    transform: scale(0.98);
    background: #dc2626;
}

/* TIPS CARD - MOBILE */
.tips-card {
    background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 16px;
}

.tips-card h4 {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tips-card h4 svg {
    width: 16px;
    height: 16px;
    color: var(--warning);
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    font-size: 11px;
    color: var(--gray-600);
    margin-bottom: 8px;
    padding-left: 16px;
    position: relative;
    line-height: 1.4;
}

.tips-list li:last-child {
    margin-bottom: 0;
}

.tips-list li:before {
    content: "✓";
    color: var(--primary);
    font-weight: bold;
    position: absolute;
    left: 0;
    font-size: 10px;
}

/* INVALID FEEDBACK */
.invalid-feedback {
    color: var(--danger);
    font-size: 10px;
    margin-top: 4px;
}

/* TINYMCE MOBILE OVERRIDES */
.tox-tinymce {
    border-radius: var(--radius-md) !important;
}

.tox .tox-editor-header {
    flex-direction: column !important;
}

.tox .tox-toolbar-overlord {
    overflow-x: auto !important;
}

/* ============================================
   TABLET (min-width: 768px)
   ============================================ */
@media (min-width: 768px) {
    .page-edit {
        padding: 20px 24px;
    }
    
    .page-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        margin-bottom: 24px;
    }
    
    .header-left {
        gap: 16px;
    }
    
    .header-icon {
        width: 50px;
        height: 50px;
    }
    
    .header-icon svg {
        width: 24px;
        height: 24px;
    }
    
    .header-text h1 {
        font-size: 22px;
    }
    
    .header-text p {
        font-size: 12px;
    }
    
    .btn-preview,
    .btn-back {
        width: auto;
        padding: 10px 20px;
    }
    
    .header-actions {
        gap: 12px;
    }
    
    .form-layout {
        gap: 24px;
    }
    
    .card-header {
        padding: 16px 20px;
    }
    
    .card-header h3 {
        font-size: 14px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        font-size: 13px;
    }
    
    .form-control {
        padding: 11px 14px;
        font-size: 14px;
    }
    
    .btn {
        padding: 11px 20px;
    }
    
    .tips-card {
        padding: 20px;
    }
    
    .tips-card h4 {
        font-size: 14px;
    }
    
    .tips-list li {
        font-size: 12px;
    }
}

/* ============================================
   DESKTOP (min-width: 992px)
   ============================================ */
@media (min-width: 992px) {
    .page-edit {
        padding: 24px 32px;
    }
    
    .form-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 28px;
    }
    
    .header-text h1 {
        font-size: 24px;
    }
    
    .btn-preview:hover,
    .btn-back:hover {
        transform: translateY(-1px);
        background: var(--gray-50);
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }
    
    .btn-outline:hover {
        transform: translateY(-1px);
        background: var(--gray-50);
    }
    
    .slug-copy-btn:hover {
        background: var(--gray-100);
    }
}

/* ============================================
   LARGE DESKTOP (min-width: 1200px)
   ============================================ */
@media (min-width: 1200px) {
    .page-edit {
        padding: 32px 40px;
        max-width: 1600px;
        margin: 0 auto;
    }
    
    .form-layout {
        gap: 32px;
    }
}

/* ============================================
   TOUCH DEVICE OPTIMIZATIONS
   ============================================ */
@media (hover: none) and (pointer: coarse) {
    .btn-preview,
    .btn-back,
    .btn-primary,
    .btn-outline,
    .btn-remove,
    .image-upload-area,
    .slug-copy-btn {
        min-height: 44px;
    }
    
    .form-control {
        font-size: 16px; /* Prevent zoom on focus */
    }
    
    .btn-preview:active,
    .btn-back:active,
    .btn-primary:active,
    .btn-outline:active {
        transform: scale(0.97);
    }
}

/* ============================================
   PRINT STYLES
   ============================================ */
@media print {
    .page-header .btn-preview,
    .page-header .btn-back,
    .btn-outline,
    .tips-card,
    .image-upload-area {
        display: none;
    }
    
    .card {
        border: 1px solid #ddd;
        box-shadow: none;
    }
    
    .btn-primary {
        background: #ddd;
        color: #000;
    }
}
</style>

<div class="page-edit">
    <!-- HEADER -->
    <div class="page-header">
        <div class="header-left">
            <div class="header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <div class="header-text">
                <h1>
                    Edit Halaman
                    <span class="status-badge {{ $page->status === 'published' ? 'published' : 'draft' }}">
                        @if($page->status === 'published')
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v4l3 3"/>
                            </svg>
                            Published
                        @else
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            Draft
                        @endif
                    </span>
                </h1>
                <p>Terakhir diperbarui: {{ $page->updated_at->format('d F Y H:i') }}</p>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ url('/' . $page->slug) }}" target="_blank" class="btn-preview">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Preview
            </a>
            <a href="{{ route('admin.pages.index') }}" class="btn-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" id="pageForm">
        @csrf
        @method('PUT')
        
        <div class="form-layout">
            <!-- LEFT COLUMN -->
            <div class="left-column">
                <!-- TITLE CARD -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16v16H4z"/>
                                <line x1="8" y1="8" x2="16" y2="8"/>
                                <line x1="8" y1="12" x2="16" y2="12"/>
                                <line x1="8" y1="16" x2="12" y2="16"/>
                            </svg>
                            Informasi Halaman
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">
                                Judul Halaman
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="title" id="pageTitle"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $page->title) }}" 
                                   placeholder="Masukkan judul halaman"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">/</span>
                                <input type="text" id="slugPreview" 
                                       class="form-control" 
                                       readonly 
                                       value="{{ $page->slug }}">
                                <button type="button" id="copySlugBtn" class="slug-copy-btn" title="Copy slug">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                    </svg>
                                </button>
                            </div>
                            <span class="help-text">Slug otomatis diperbarui saat judul diubah</span>
                            <input type="hidden" name="slug" id="slugInput" value="{{ $page->slug }}">
                        </div>
                    </div>
                </div>

                <!-- EDITOR CARD -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                <path d="M4 20h16"/>
                            </svg>
                            Isi Konten
                        </h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <textarea id="editor" name="content">{!! old('content', $page->content) !!}</textarea>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-column">
                <!-- PUBLISH CARD -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                            Publikasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="switch-wrapper">
                            <div>
                                <div class="switch-label">Status Halaman</div>
                                <div class="switch-description" id="statusDesc">
                                    {{ $page->status === 'published' ? 'Publik - Dapat diakses semua orang' : 'Draft - Hanya admin yang dapat melihat' }}
                                </div>
                            </div>
                            <label class="form-switch">
                                <input type="checkbox" name="status" id="statusToggle" value="1" {{ $page->status === 'published' ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Update Halaman
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">
                            Batal
                        </a>
                    </div>
                </div>

                <!-- FEATURED IMAGE CARD -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Gambar Unggulan
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($page->featured_image)
                            <div id="existingPreview" class="image-preview show">
                                <img src="{{ Storage::url($page->featured_image) }}" alt="Featured Image">
                                <button type="button" id="removeExistingImage" class="btn-remove">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 6px;">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Hapus Gambar
                                </button>
                            </div>
                        @endif
                        
                        <div id="imageDropzone" class="image-upload-area" @if($page->featured_image) style="display: none;" @endif>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Klik atau drag & drop gambar</p>
                            <small>PNG, JPG, max 2MB</small>
                        </div>
                        
                        <div id="newPreview" class="image-preview">
                            <img id="previewImg" src="#" alt="Preview">
                            <button type="button" id="removeNewImage" class="btn-remove">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 6px;">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                                Hapus Gambar
                            </button>
                        </div>
                        
                        <input type="file" name="featured_image" id="featuredImage" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-outline" style="margin-top: 12px;" onclick="document.getElementById('featuredImage').click()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Ganti Gambar
                        </button>
                        <input type="hidden" name="remove_image" id="removeImageFlag" value="0">
                    </div>
                </div>

                <!-- TIPS CARD -->
                <div class="tips-card">
                    <h4>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18h6M10 22h4M12 2v4M4.93 4.93l2.83 2.83M19.07 4.93l-2.83 2.83"/>
                            <path d="M12 8a4 4 0 0 0-4 4v2h8v-2a4 4 0 0 0-4-4z"/>
                        </svg>
                        Tips Editor
                    </h4>
                    <ul class="tips-list">
                        <li>Gunakan <strong>Heading</strong> untuk struktur konten (H1–H4)</li>
                        <li>Klik ikon <strong>Table</strong> untuk menyisipkan & mengatur tabel</li>
                        <li>Klik kanan tabel untuk opsi <strong>merge cell, align, warna</strong></li>
                        <li>Gunakan tombol <strong>Source Code</strong> untuk edit HTML langsung</li>
                        <li>Gambar bisa di-<strong>drag & drop</strong> langsung ke editor</li>
                        <li>Shortcut <strong>Ctrl + S</strong> untuk menyimpan perubahan</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // TINYMCE INITIALIZATION
    // ============================================
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '#editor',
            height: window.innerWidth < 768 ? 400 : 500,
            menubar: window.innerWidth < 768 ? false : true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
            ],
            toolbar: window.innerWidth < 768 ? [
                'undo redo | bold italic underline | alignleft aligncenter alignright',
                'bullist numlist | link image | code'
            ].join(' | ') : [
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
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                    font-size: ${window.innerWidth < 768 ? '14px' : '15px'};
                    line-height: 1.7;
                    padding: ${window.innerWidth < 768 ? '12px' : '16px'};
                    color: #1f2937;
                }
                h1 { font-size: ${window.innerWidth < 768 ? '24px' : '28px'}; font-weight: 700; margin: 24px 0 16px; color: #111827; }
                h2 { font-size: ${window.innerWidth < 768 ? '20px' : '24px'}; font-weight: 600; margin: 20px 0 12px; color: #1f2937; }
                h3 { font-size: ${window.innerWidth < 768 ? '18px' : '20px'}; font-weight: 600; margin: 16px 0 10px; color: #374151; }
                p { margin: 0 0 1em; line-height: 1.7; }
                img { max-width: 100%; height: auto; border-radius: 8px; }
                table { border-collapse: collapse; width: 100%; margin: 16px 0; display: block; overflow-x: auto; }
                th, td { border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; }
                @media (max-width: 768px) {
                    th, td { padding: 6px 8px; font-size: 12px; }
                }
            `,
            branding: false,
            promotion: false,
            resize: true,
            setup: function(editor) {
                // Ctrl + S shortcut
                editor.on('keydown', function(e) {
                    if (e.ctrlKey && e.keyCode === 83) {
                        e.preventDefault();
                        document.getElementById('pageForm').submit();
                    }
                });
            }
        });
    } else {
        console.error('TinyMCE not loaded');
        document.getElementById('editor').style.display = 'block';
        document.getElementById('editor').style.height = '400px';
        document.getElementById('editor').style.padding = '12px';
        document.getElementById('editor').style.fontFamily = 'monospace';
    }

    // ============================================
    // AUTO SLUG GENERATOR
    // ============================================
    const titleInput = document.getElementById('pageTitle');
    const slugPreview = document.getElementById('slugPreview');
    const slugInput = document.getElementById('slugInput');

    function generateSlug(text) {
        return text.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    if (titleInput && slugPreview) {
        titleInput.addEventListener('input', function() {
            let slug = generateSlug(this.value);
            slugPreview.value = slug;
            if (slugInput) slugInput.value = slug;
        });
    }

    // ============================================
    // COPY SLUG FUNCTION
    // ============================================
    const copyBtn = document.getElementById('copySlugBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const slugText = slugPreview.value;
            navigator.clipboard.writeText(slugText).then(() => {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>';
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                }, 2000);
            });
        });
    }

    // ============================================
    // STATUS TOGGLE
    // ============================================
    const statusToggle = document.getElementById('statusToggle');
    const statusDesc = document.getElementById('statusDesc');
    
    if (statusToggle && statusDesc) {
        statusToggle.addEventListener('change', function() {
            if (this.checked) {
                statusDesc.innerText = 'Publik - Dapat diakses semua orang';
            } else {
                statusDesc.innerText = 'Draft - Hanya admin yang dapat melihat';
            }
        });
    }

    // ============================================
    // IMAGE UPLOAD & PREVIEW
    // ============================================
    const fileInput = document.getElementById('featuredImage');
    const dropzone = document.getElementById('imageDropzone');
    const newPreview = document.getElementById('newPreview');
    const previewImg = document.getElementById('previewImg');
    const removeNewBtn = document.getElementById('removeNewImage');
    const existingPreview = document.getElementById('existingPreview');
    const removeExistingBtn = document.getElementById('removeExistingImage');
    const removeImageFlag = document.getElementById('removeImageFlag');

    // Handle new image upload
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB!');
                    fileInput.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(ev) {
                    previewImg.src = ev.target.result;
                    if (dropzone) dropzone.style.display = 'none';
                    if (existingPreview) existingPreview.style.display = 'none';
                    newPreview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Remove new image
    if (removeNewBtn) {
        removeNewBtn.addEventListener('click', function() {
            fileInput.value = '';
            newPreview.classList.remove('show');
            if (dropzone) dropzone.style.display = 'block';
            if (existingPreview && existingPreview.style.display === 'none') {
                existingPreview.style.display = 'block';
            }
        });
    }

    // Remove existing image
    if (removeExistingBtn && removeImageFlag) {
        removeExistingBtn.addEventListener('click', function() {
            if (confirm('Hapus gambar unggulan ini?')) {
                removeImageFlag.value = '1';
                existingPreview.style.display = 'none';
                if (dropzone) dropzone.style.display = 'block';
            }
        });
    }

    // Dropzone click & drag drop
    if (dropzone) {
        dropzone.addEventListener('click', () => fileInput.click());
        
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#2563eb';
            dropzone.style.background = '#dbeafe';
        });
        
        dropzone.addEventListener('dragleave', () => {
            dropzone.style.borderColor = '#e5e7eb';
            dropzone.style.background = '';
        });
        
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#e5e7eb';
            dropzone.style.background = '';
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }

    // ============================================
    // FORM VALIDATION
    // ============================================
    const form = document.getElementById('pageForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            const title = titleInput?.value.trim();
            if (!title) {
                e.preventDefault();
                alert('Judul halaman wajib diisi!');
                titleInput?.focus();
                return;
            }
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    Menyimpan...
                `;
            }
        });
    }

    // ============================================
    // RESPONSIVE TINYMCE RESIZE
    // ============================================


    // ============================================
    // TOUCH FEEDBACK
    // ============================================
    const touchButtons = document.querySelectorAll('.btn-preview, .btn-back, .btn-primary, .btn-outline, .btn-remove, .image-upload-area, .slug-copy-btn');
    touchButtons.forEach(btn => {
        btn.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.97)';
        });
        btn.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        btn.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
});
</script>
@endpush
@endsection