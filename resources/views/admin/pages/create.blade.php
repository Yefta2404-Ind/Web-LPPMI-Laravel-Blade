@extends('layouts.admin')

@section('content')
<style>
/* ============================================
   MODERN PAGE CREATE - CLEAN & PROFESSIONAL
   ============================================ */

:root {
    --primary: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #eff6ff;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
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
}

/* Main Container */
.page-create {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 20px;
    background: white;
    padding: 20px 28px;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

.header-icon {
    width: 54px;
    height: 54px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--shadow-sm);
}

.header-text h1 {
    font-size: 26px;
    font-weight: 700;
    color: var(--gray-800);
    margin: 0 0 6px 0;
}

.header-text p {
    font-size: 14px;
    color: var(--gray-500);
    margin: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-back:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
    transform: translateY(-1px);
}

/* Form Layout */
.form-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 28px;
}

@media (max-width: 992px) {
    .form-layout {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}

/* Cards */
.card {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    transition: all 0.2s;
}

.card:hover {
    box-shadow: var(--shadow-md);
}

.card-header {
    padding: 18px 24px;
    background: white;
    border-bottom: 1px solid var(--gray-100);
}

.card-header h3 {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gray-700);
}

.card-header h3 svg {
    color: var(--primary);
}

.card-body {
    padding: 24px;
}

/* Form Elements */
.form-group {
    margin-bottom: 24px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 8px;
}

.form-label .required {
    color: var(--danger);
    margin-left: 4px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.2s;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.form-control-lg {
    font-size: 16px;
    padding: 14px 18px;
}

.input-group {
    display: flex;
    align-items: stretch;
}

.input-group-text {
    padding: 0 14px;
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-right: none;
    border-radius: 12px 0 0 12px;
    font-size: 14px;
    color: var(--gray-500);
    display: flex;
    align-items: center;
}

.input-group .form-control {
    border-radius: 0 12px 12px 0;
}

.help-text {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: 6px;
    display: block;
}

/* Switch Toggle */
.switch-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
}

.switch-label {
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 4px;
}

.switch-description {
    font-size: 12px;
    color: var(--gray-500);
}

.form-switch {
    position: relative;
    display: inline-block;
    width: 52px;
    height: 28px;
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
    height: 22px;
    width: 22px;
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

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    text-decoration: none;
}

.btn-primary {
    background: var(--primary);
    color: white;
    width: 100%;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-outline {
    background: white;
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    width: 100%;
    margin-top: 12px;
}

.btn-outline:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
}

/* Image Upload */
.image-upload-area {
    border: 2px dashed var(--gray-200);
    border-radius: 16px;
    text-align: center;
    padding: 40px 24px;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--gray-50);
}

.image-upload-area:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}

.image-upload-area svg {
    color: var(--gray-400);
    margin-bottom: 12px;
}

.image-upload-area p {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0;
}

.image-upload-area small {
    font-size: 11px;
    color: var(--gray-400);
    display: block;
    margin-top: 6px;
}

.image-preview {
    margin-top: 20px;
    display: none;
}

.image-preview.show {
    display: block;
}

.image-preview img {
    width: 100%;
    max-height: 220px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 12px;
    border: 1px solid var(--gray-200);
}

.btn-remove {
    width: 100%;
    padding: 10px;
    background: var(--danger);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-remove:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

/* Tips Card */
.tips-card {
    background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
    border: 1px solid var(--gray-200);
    border-radius: 20px;
    padding: 24px;
}

.tips-card h4 {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.tips-card h4 svg {
    color: var(--warning);
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    font-size: 12px;
    color: var(--gray-600);
    margin-bottom: 12px;
    padding-left: 20px;
    position: relative;
    line-height: 1.5;
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
    font-size: 12px;
}

/* TinyMCE Custom */
.tox-tinymce {
    border-radius: 12px !important;
    border: 1px solid var(--gray-200) !important;
}

.tox .tox-toolbar__primary {
    background: var(--gray-50) !important;
}

/* Divider */
.divider {
    margin: 20px 0;
    border-top: 1px solid var(--gray-100);
}

/* Responsive */
@media (max-width: 768px) {
    .page-create {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
    }
    
    .btn-back {
        width: 100%;
        justify-content: center;
    }
    
    .card-header {
        padding: 16px 20px;
    }
    
    .card-body {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .page-create {
        padding: 16px;
    }
    
    .header-left {
        flex-direction: column;
        text-align: center;
    }
    
    .header-text h1 {
        font-size: 22px;
    }
    
    .card-body {
        padding: 16px;
    }
}
</style>

<div class="page-create">
    <!-- Header -->
    <div class="page-header">
        <div class="header-left">
            <div class="header-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <div class="header-text">
                <h1>Tambah Halaman Baru</h1>
                <p>Buat halaman konten untuk website Anda</p>
            </div>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-layout">
            <!-- Left Column - Main Content -->
            <div class="left-column">
                <!-- Title Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" 
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
                                       placeholder="otomatis dari judul">
                            </div>
                            <span class="help-text">URL otomatis dibuat berdasarkan judul halaman</span>
                        </div>
                    </div>
                </div>

                <!-- Editor Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                <path d="M4 20h16"/>
                            </svg>
                            Isi Konten
                        </h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <textarea id="editor" name="content">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="right-column">
                <!-- Publish Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                            Publikasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="switch-wrapper">
                            <div>
                                <div class="switch-label">Publish Sekarang</div>
                                <div class="switch-description">Jika tidak diaktifkan, akan disimpan sebagai Draft</div>
                            </div>
                            <label class="form-switch">
                                <input type="checkbox" name="status" {{ old('status') ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <button type="submit" class="btn btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Simpan Halaman
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">
                            Batal
                        </a>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Gambar Unggulan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="imageDropzone" class="image-upload-area">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p>Klik atau drag & drop gambar</p>
                            <small>PNG, JPG, JPG, max 2MB</small>
                        </div>
                        <div id="imagePreview" class="image-preview">
                            <img id="previewImg" src="#" alt="Preview">
                            <button type="button" id="removeImage" class="btn-remove">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 6px;">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                                Hapus Gambar
                            </button>
                        </div>
                        <input type="file" name="featured_image" id="featuredImage" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-outline" style="margin-top: 16px;" onclick="document.getElementById('featuredImage').click()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Pilih Gambar
                        </button>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="tips-card">
                    <h4>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
// TinyMCE Initialization
tinymce.init({
    selector: '#editor',
    height: 500,
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
            line-height: 1.7;
            padding: 16px;
            color: #1f2937;
        }
        h1 { font-size: 28px; font-weight: 700; margin: 24px 0 16px; color: #111827; }
        h2 { font-size: 24px; font-weight: 600; margin: 20px 0 12px; color: #1f2937; }
        h3 { font-size: 20px; font-weight: 600; margin: 16px 0 10px; color: #374151; }
        h4 { font-size: 18px; font-weight: 600; margin: 14px 0 8px; color: #4b5563; }
        p { margin: 0 0 1em; line-height: 1.7; }
        table { border-collapse: collapse; width: 100%; margin: 16px 0; }
        th, td { border: 1px solid #d1d5db; padding: 10px 14px; text-align: left; }
        th { background: #f3f4f6; font-weight: 600; }
        img { max-width: 100%; height: auto; border-radius: 8px; }
        blockquote { border-left: 4px solid #3b82f6; margin: 16px 0; padding: 8px 20px; background: #eff6ff; border-radius: 0 8px 8px 0; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 6px; font-family: monospace; font-size: 13px; }
        pre { background: #1f2937; color: #e5e7eb; padding: 16px; border-radius: 8px; overflow-x: auto; }
        ul, ol { padding-left: 1.5em; margin: 0 0 1em; }
        li { margin-bottom: 0.3em; }
    `,
    branding: false,
    promotion: false
});

// Auto Slug
const titleInput = document.getElementById('pageTitle');
const slugPreview = document.getElementById('slugPreview');

if (titleInput) {
    titleInput.addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        slugPreview.value = slug;
    });
}

// Image Upload Preview
const fileInput = document.getElementById('featuredImage');
const dropzone = document.getElementById('imageDropzone');
const previewBox = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const removeBtn = document.getElementById('removeImage');

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
                dropzone.style.display = 'none';
                previewBox.classList.add('show');
            };
            reader.readAsDataURL(file);
        }
    });
}

if (removeBtn) {
    removeBtn.addEventListener('click', function() {
        fileInput.value = '';
        previewBox.classList.remove('show');
        dropzone.style.display = 'block';
    });
}

// Drag & Drop
if (dropzone) {
    dropzone.addEventListener('click', () => fileInput.click());
    
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#3b82f6';
        dropzone.style.background = '#eff6ff';
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
</script>
@endpush
@endsection