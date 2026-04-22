@extends('layouts.cms')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --secondary: #2563eb;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --border-radius: 8px;
        --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
        --shadow:    0 1px 3px 0 rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    body { font-family:'Inter',-apple-system,sans-serif; background:var(--gray-50); }

    /* ── Layout ── */
    .edit-container { max-width:1200px; margin:0 auto; padding:24px; }
    @media(max-width:768px){ .edit-container{ padding:16px; } }

    .page-header { margin-bottom:32px; }
    .page-title  { font-size:24px; font-weight:700; color:var(--gray-800); margin-bottom:8px; }
    .page-description { color:var(--gray-500); font-size:14px; line-height:1.5; max-width:600px; }

    /* ── Alerts ── */
    .success-alert {
        background:#f0fdf4; border:1px solid #dcfce7;
        border-radius:6px; padding:16px; margin-bottom:24px;
        animation:fadeIn .3s ease-out;
    }
    .success-title { color:#166534; font-weight:600; font-size:14px; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
    .success-message { color:#166534; font-size:13px; line-height:1.5; margin:0; }

    .error-alert { background:#fef2f2; border:1px solid #fee2e2; border-radius:6px; padding:16px; margin-bottom:24px; }
    .error-title { color:#991b1b; font-weight:600; font-size:14px; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
    .error-list  { margin:0; padding-left:20px; color:#991b1b; font-size:13px; line-height:1.5; }
    .error-list li { margin-bottom:4px; }

    @keyframes fadeIn { from{opacity:0;transform:translateY(-10px)} to{opacity:1;transform:translateY(0)} }

    /* ── Toast Notification ── */
    .notification-toast { position:fixed; top:24px; right:24px; z-index:9999; width:100%; max-width:400px; }
    .notification {
        background:white; border-radius:var(--border-radius); box-shadow:var(--shadow-md);
        padding:16px; margin-bottom:12px; border-left:4px solid transparent;
        display:flex; align-items:flex-start; gap:12px;
        transform:translateX(120%); opacity:0;
        transition:transform .3s ease-out, opacity .3s ease-out;
    }
    .notification.show  { transform:translateX(0); opacity:1; }
    .notification.success { border-left-color:var(--success); }
    .notification.error   { border-left-color:var(--danger); }
    .notification.warning { border-left-color:var(--warning); }
    .notification-icon    { font-size:20px; flex-shrink:0; margin-top:2px; }
    .notification-content { flex:1; }
    .notification-title   { font-weight:600; color:var(--gray-800); font-size:14px; margin-bottom:4px; }
    .notification-message { color:var(--gray-600); font-size:13px; line-height:1.4; }
    .notification-close {
        background:none; border:none; color:var(--gray-400); cursor:pointer;
        font-size:14px; padding:2px; display:flex; align-items:center;
        justify-content:center; transition:color .2s ease; flex-shrink:0; margin-top:2px;
    }
    .notification-close:hover { color:var(--gray-600); }

    /* ── Form Card ── */
    .form-card    { background:white; border-radius:var(--border-radius); box-shadow:var(--shadow); border:1px solid var(--gray-200); overflow:hidden; margin-bottom:32px; }
    .form-content { padding:32px; }
    @media(max-width:640px){ .form-content{ padding:24px; } }

    .form-group { margin-bottom:24px; }

    .form-label {
        display:flex; align-items:center; justify-content:space-between;
        font-weight:500; color:var(--gray-700); margin-bottom:8px; font-size:14px;
    }
    .form-label .required { color:var(--danger); font-size:12px; font-weight:400; }
    .form-label .optional  { color:var(--gray-400); font-size:12px; font-weight:400; }

    .form-input, .form-select {
        width:100%; padding:10px 12px;
        border:1px solid var(--gray-300); border-radius:6px;
        font-size:14px; color:var(--gray-800);
        font-family:'Inter',-apple-system,sans-serif;
        background:white; transition:all .2s ease;
    }
    .form-input:focus, .form-select:focus {
        outline:none; border-color:var(--secondary);
        box-shadow:0 0 0 3px rgba(37,99,235,.1);
    }
    .form-input:hover, .form-select:hover { border-color:var(--gray-400); }
    .form-select {
        appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 12px center; background-size:16px; cursor:pointer;
    }

    .tox-tinymce           { border-radius:6px !important; border-color:var(--gray-300) !important; }
    .tox-tinymce:focus-within { border-color:var(--secondary) !important; box-shadow:0 0 0 3px rgba(37,99,235,.1) !important; }

    /* ── File Upload ── */
    .file-upload { position:relative; }
    .file-input  {
        width:100%; padding:40px 20px;
        border:2px dashed var(--gray-300); border-radius:8px;
        background:var(--gray-50); text-align:center;
        cursor:pointer; transition:all .2s ease; position:relative;
    }
    .file-input:hover { border-color:var(--secondary); background:var(--gray-100); }
    .file-input input  { position:absolute; width:100%; height:100%; top:0; left:0; opacity:0; cursor:pointer; }
    .upload-content    { pointer-events:none; }
    .upload-icon  { font-size:32px; color:var(--gray-400); margin-bottom:12px; }
    .upload-text  { color:var(--gray-600); font-size:14px; margin-bottom:4px; font-weight:500; }
    .upload-hint  { color:var(--gray-500); font-size:12px; }

    /* ── Thumbnail Preview (untuk edit, gambar yang sudah ada) ── */
    .thumbnail-preview { margin-top:16px; }
    .preview-container { position:relative; display:inline-block; }
    .preview-image     { max-width:100%; max-height:250px; border-radius:6px; border:1px solid var(--gray-200); box-shadow:var(--shadow-sm); }
    .remove-preview    {
        position:absolute; top:8px; right:8px;
        width:28px; height:28px; background:white; border-radius:50%;
        border:1px solid var(--gray-300); display:flex; align-items:center;
        justify-content:center; cursor:pointer; color:var(--gray-600);
        font-size:12px; transition:all .2s ease;
    }
    .remove-preview:hover { background:var(--danger); color:white; border-color:var(--danger); }

    /* ── Existing Image Section ── */
    .existing-image-section {
        margin-top:16px;
        padding:16px;
        background:var(--gray-50);
        border-radius:8px;
        border:1px solid var(--gray-200);
    }
    .existing-image-label {
        font-size:13px; font-weight:500; color:var(--gray-600);
        margin-bottom:12px; display:flex; align-items:center; gap:8px;
    }
    .existing-image-wrapper { display:flex; align-items:flex-start; gap:16px; flex-wrap:wrap; }
    .existing-image-preview {
        width:120px; height:120px; object-fit:cover;
        border-radius:6px; border:1px solid var(--gray-200);
    }
    .existing-image-info { flex:1; min-width:200px; }
    .existing-image-name { font-size:13px; color:var(--gray-700); margin-bottom:8px; word-break:break-all; }
    .btn-remove-image {
        background:white; color:var(--danger); border:1px solid var(--danger);
        padding:6px 12px; border-radius:6px; font-size:12px;
        cursor:pointer; transition:all .2s ease; display:inline-flex; align-items:center; gap:6px;
    }
    .btn-remove-image:hover { background:var(--danger); color:white; }

    /* ── Gallery Preview (untuk edit, multiple images) ── */
    .gallery-preview-wrap { margin-top:16px; }
    .gallery-grid {
        display:grid;
        grid-template-columns:repeat(auto-fill, minmax(120px,1fr));
        gap:10px;
    }
    .gallery-item {
        position:relative; border-radius:6px; overflow:hidden;
        border:1px solid var(--gray-200); aspect-ratio:1;
        background:var(--gray-100);
    }
    .gallery-item img { width:100%; height:100%; object-fit:cover; display:block; }
    .gallery-item-remove {
        position:absolute; top:4px; right:4px;
        width:22px; height:22px;
        background:rgba(0,0,0,.55); color:white;
        border-radius:50%; border:none; cursor:pointer;
        font-size:10px; display:flex; align-items:center; justify-content:center;
        transition:background .2s;
    }
    .gallery-item-remove:hover { background:var(--danger); }
    .gallery-count {
        margin-top:8px; font-size:12px; color:var(--gray-500);
        display:flex; align-items:center; justify-content:space-between;
    }
    .gallery-clear-btn {
        font-size:12px; color:var(--danger); background:none;
        border:none; cursor:pointer; padding:0; text-decoration:underline;
    }

    /* ── Misc ── */
    .form-help { display:block; font-size:12px; color:var(--gray-500); margin-top:6px; line-height:1.4; }
    .has-error .form-input, .has-error .form-select { border-color:var(--danger); }
    .error-text { display:block; font-size:12px; color:var(--danger); margin-top:4px; }

    .form-actions { display:flex; gap:12px; margin-top:32px; padding-top:24px; border-top:1px solid var(--gray-200); }
    @media(max-width:640px){ .form-actions{ flex-direction:column; } }

    .btn {
        padding:10px 20px; border-radius:6px; font-size:14px; font-weight:500;
        text-decoration:none; cursor:pointer; border:1px solid transparent;
        transition:all .2s ease; display:inline-flex; align-items:center;
        justify-content:center; gap:8px; font-family:'Inter',-apple-system,sans-serif;
    }
    .btn-primary { background:var(--secondary); color:white; border-color:var(--secondary); }
    .btn-primary:hover { background:#1d4ed8; transform:translateY(-1px); box-shadow:var(--shadow-md); }
    .btn-outline { background:white; color:var(--gray-700); border-color:var(--gray-300); }
    .btn-outline:hover { background:var(--gray-50); border-color:var(--gray-400); }
    .btn-block { width:100%; }
    .btn-loading { position:relative; color:transparent !important; pointer-events:none; }
    .btn-loading::after {
        content:''; position:absolute; width:16px; height:16px;
        border:2px solid rgba(255,255,255,.3); border-radius:50%;
        border-top-color:white; animation:spin 1s linear infinite;
    }
    @keyframes spin { to{ transform:rotate(360deg); } }

    /* Divider */
    .divider {
        display:flex; align-items:center; text-align:center; margin:20px 0;
    }
    .divider::before, .divider::after {
        content:''; flex:1; border-bottom:1px solid var(--gray-200);
    }
    .divider span { padding:0 16px; color:var(--gray-400); font-size:12px; text-transform:uppercase; }
</style>

<div class="edit-container">
    <div class="notification-toast" id="notificationToast"></div>

    <div class="page-header">
        <h1 class="page-title">Edit Berita</h1>
        <p class="page-description">Perbarui informasi berita di bawah ini.</p>
    </div>

    {{-- Session success --}}
    @if(session('success'))
        <div class="success-alert" id="sessionSuccessAlert">
            <div class="success-title">✅ Berhasil!</div>
            <p class="success-message">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="error-alert">
            <div class="error-title">❌ Terdapat kesalahan</div>
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form id="newsForm" action="{{ route('staff.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-content">

                {{-- Judul --}}
                <div class="form-group @error('title') has-error @enderror">
                    <label class="form-label">
                        Judul Berita <span class="required">* Wajib</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                           class="form-input" placeholder="Masukkan judul berita">
                    @error('title') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                {{-- Kategori --}}
                <div class="form-group @error('category_id') has-error @enderror">
                    <label class="form-label">
                        Kategori <span class="required">* Wajib</span>
                    </label>
                    <select name="category_id" required class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                {{-- Tags --}}
                <div class="form-group @error('tags') has-error @enderror">
                    <label class="form-label">
                        Tags <span class="optional">Opsional</span>
                    </label>
                    <input type="text" name="tags" value="{{ old('tags', $news->tags) }}"
                           class="form-input" placeholder="contoh: kampus, teknologi, seminar">
                    <span class="form-help">Pisahkan tag dengan koma</span>
                    @error('tags') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                {{-- Isi Berita --}}
                <div class="form-group @error('content') has-error @enderror">
                    <label class="form-label">
                        Isi Berita <span class="required">* Wajib</span>
                    </label>
                    <textarea name="content" id="content">{{ old('content', $news->content) }}</textarea>
                    @error('content') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                {{-- Upload Gambar Baru (multiple) --}}
                <div class="form-group @error('images') has-error @enderror">
                    <label class="form-label">
                        Tambah Gambar Baru
                        <span class="optional">Opsional · gambar pertama = thumbnail</span>
                    </label>

                    <div class="file-upload">
                        <div class="file-input" id="dropZone">
                            <input type="file" name="images[]" id="imagesInput"
                                   accept="image/jpeg,image/png,image/gif,image/webp"
                                   multiple onchange="handleImages(event)">
                            <div class="upload-content">
                                <div class="upload-icon">🖼️</div>
                                <div class="upload-text">Klik atau drag &amp; drop gambar di sini</div>
                                <div class="upload-hint">Tambah gambar baru (tidak akan menghapus gambar yang sudah ada)</div>
                            </div>
                        </div>
                    </div>

                    <span class="form-help">Format: JPG, PNG, GIF, WebP | Maksimal: 2MB per gambar</span>
                    @error('images')   <span class="error-text">{{ $message }}</span> @enderror
                    @error('images.*') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                {{-- Preview gambar baru yang dipilih --}}
                <div class="thumbnail-preview" id="thumbnailWrap" style="display:none;">
                    <p style="font-size:12px;color:var(--gray-500);margin-bottom:8px;font-weight:500;">
                        📌 Thumbnail Baru (gambar pertama)
                    </p>
                    <div class="preview-container">
                        <img id="thumbnailPreview" class="preview-image" alt="Thumbnail Baru">
                        <div class="remove-preview" onclick="clearAllImages()">✕</div>
                    </div>
                </div>

                <div class="gallery-preview-wrap" id="galleryWrap" style="display:none;">
                    <p style="font-size:12px;color:var(--gray-500);margin-bottom:8px;font-weight:500;">
                        🗂️ Gambar Baru yang Dipilih
                    </p>
                    <div class="gallery-grid" id="galleryGrid"></div>
                    <div class="gallery-count" id="galleryCount">
                        <span id="galleryCountText"></span>
                        <button type="button" class="gallery-clear-btn" onclick="clearAllImages()">Hapus semua</button>
                    </div>
                </div>

                {{-- Gambar yang sudah ada (existing images) --}}
                @if(isset($news->images) && $news->images->count() > 0)
                    <div class="existing-image-section" id="existingImagesSection">
                        <div class="existing-image-label">
                            🖼️ Gambar yang Sudah Ada
                        </div>
                        <div class="gallery-grid" id="existingGalleryGrid">
                            @foreach($news->images as $image)
                                <div class="gallery-item" data-image-id="{{ $image->id }}">
                                    <img src="{{ Storage::url($image->path) }}" alt="Gambar berita">
                                    @if($loop->first)
                                        <span style="position:absolute;bottom:4px;left:4px;background:var(--secondary);color:white;font-size:9px;padding:2px 5px;border-radius:3px;">thumbnail</span>
                                    @endif
                                    <button type="button" class="gallery-item-remove" onclick="markImageForRemoval({{ $image->id }}, this)" title="Tandai untuk dihapus">✕</button>
                                </div>
                            @endforeach
                        </div>
                        <div class="gallery-count" style="margin-top:12px;">
                            <span>{{ $news->images->count() }} gambar</span>
                            <button type="button" class="gallery-clear-btn" onclick="markAllImagesForRemoval()">Tandai semua untuk dihapus</button>
                        </div>
                        <span class="form-help">Klik ✕ pada gambar untuk menandai gambar tersebut akan dihapus saat disimpan.</span>
                    </div>
                @endif

                {{-- Hidden inputs untuk menandai gambar yang akan dihapus --}}
                <input type="hidden" name="removed_image_ids" id="removedImageIds" value="">

            </div>

            {{-- Actions --}}
            <div class="form-actions" style="padding:0 32px 32px 32px;">
                <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                    💾 Update Berita
                </button>
                <a href="{{ route('staff.news.index') }}" class="btn btn-outline btn-block">
                    ← Batal
                </a>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
/* ═══════════════════════════════════════════════
   CSRF Token
═══════════════════════════════════════════════ */
const csrfToken = document.querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content') || '{{ csrf_token() }}';

/* ═══════════════════════════════════════════════
   Toast Notification
═══════════════════════════════════════════════ */
function showNotification(type, title, message, duration = 5000) {
    const container = document.getElementById('notificationToast');
    if (!container) return;

    const el = document.createElement('div');
    el.className = `notification ${type}`;
    const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : '⚠️';

    el.innerHTML = `
        <div class="notification-icon">${icon}</div>
        <div class="notification-content">
            <div class="notification-title">${title}</div>
            <div class="notification-message">${message}</div>
        </div>
        <button class="notification-close" onclick="closeNotification(this)">✕</button>
    `;

    container.appendChild(el);
    requestAnimationFrame(() => el.classList.add('show'));

    if (duration > 0) {
        setTimeout(() => closeNotification(el.querySelector('.notification-close')), duration);
    }
}

function closeNotification(btn) {
    const el = btn.closest('.notification');
    if (!el) return;
    el.classList.remove('show');
    setTimeout(() => el.remove(), 300);
}

/* ═══════════════════════════════════════════════
   Validasi gambar
═══════════════════════════════════════════════ */
const VALID_TYPES = ['image/jpeg','image/png','image/gif','image/webp'];
const MAX_SIZE    = 2 * 1024 * 1024; // 2MB

function validateImageFile(file) {
    if (!VALID_TYPES.includes(file.type)) {
        showNotification('error', 'Format Tidak Didukung', `${file.name}: hanya JPG, PNG, GIF, WebP`);
        return false;
    }
    if (file.size > MAX_SIZE) {
        showNotification('error', 'File Terlalu Besar', `${file.name}: maksimal 2MB`);
        return false;
    }
    return true;
}

/* ═══════════════════════════════════════════════
   State: daftar file baru yang dipilih
═══════════════════════════════════════════════ */
let selectedFiles = [];

function syncInputFiles() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    document.getElementById('imagesInput').files = dt.files;
}

function handleImages(event) {
    const incoming = Array.from(event.target.files);
    const valid    = incoming.filter(validateImageFile);

    if (valid.length === 0) return;

    valid.forEach(file => {
        const isDupe = selectedFiles.some(f => f.name === file.name && f.size === file.size);
        if (!isDupe) selectedFiles.push(file);
    });

    syncInputFiles();
    renderPreviews();
}

function removeImage(index) {
    selectedFiles.splice(index, 1);
    syncInputFiles();
    renderPreviews();
}

function clearAllImages() {
    selectedFiles = [];
    syncInputFiles();
    renderPreviews();
}

function renderPreviews() {
    const galleryWrap   = document.getElementById('galleryWrap');
    const thumbnailWrap = document.getElementById('thumbnailWrap');
    const grid          = document.getElementById('galleryGrid');
    const countText     = document.getElementById('galleryCountText');

    grid.innerHTML = '';

    if (selectedFiles.length === 0) {
        galleryWrap.style.display   = 'none';
        thumbnailWrap.style.display = 'none';
        return;
    }

    // Thumbnail = gambar pertama
    thumbnailWrap.style.display = 'block';
    const thumbReader = new FileReader();
    thumbReader.onload = e => {
        document.getElementById('thumbnailPreview').src = e.target.result;
    };
    thumbReader.readAsDataURL(selectedFiles[0]);

    // Gallery grid
    galleryWrap.style.display = 'block';
    countText.textContent     = `${selectedFiles.length} gambar baru dipilih`;

    selectedFiles.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const item = document.createElement('div');
            item.className = 'gallery-item';
            item.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}">
                ${i === 0 ? '<span style="position:absolute;bottom:4px;left:4px;background:var(--secondary);color:white;font-size:9px;padding:2px 5px;border-radius:3px;">thumbnail baru</span>' : ''}
                <button type="button" class="gallery-item-remove" onclick="removeImage(${i})" title="Hapus">✕</button>
            `;
            grid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

/* ═══════════════════════════════════════════════
   Manajemen Hapus Gambar Existing
═══════════════════════════════════════════════ */
let removedImageIds = [];

function updateRemovedImagesInput() {
    document.getElementById('removedImageIds').value = removedImageIds.join(',');
}

function markImageForRemoval(imageId, btnElement) {
    if (removedImageIds.includes(imageId)) {
        // Batal hapus
        removedImageIds = removedImageIds.filter(id => id !== imageId);
        const galleryItem = btnElement.closest('.gallery-item');
        if (galleryItem) {
            galleryItem.style.opacity = '1';
            galleryItem.style.opacity = '';
            btnElement.style.background = 'rgba(0,0,0,.55)';
            btnElement.textContent = '✕';
            showNotification('info', 'Dibatalkan', 'Gambar tidak jadi dihapus');
        }
    } else {
        // Tandai hapus
        removedImageIds.push(imageId);
        const galleryItem = btnElement.closest('.gallery-item');
        if (galleryItem) {
            galleryItem.style.opacity = '0.4';
            btnElement.style.background = '#ef4444';
            btnElement.textContent = '✓';
            showNotification('warning', 'Akan Dihapus', 'Gambar ini akan dihapus saat Anda menyimpan perubahan');
        }
    }
    updateRemovedImagesInput();
}

function markAllImagesForRemoval() {
    if (!confirm('Tandai SEMUA gambar yang sudah ada untuk dihapus? Tindakan ini akan menghapus semua gambar saat Anda menyimpan perubahan.')) {
        return;
    }
    
    const existingItems = document.querySelectorAll('#existingGalleryGrid .gallery-item');
    existingItems.forEach(item => {
        const imageId = parseInt(item.dataset.imageId);
        if (imageId && !removedImageIds.includes(imageId)) {
            removedImageIds.push(imageId);
            item.style.opacity = '0.4';
            const removeBtn = item.querySelector('.gallery-item-remove');
            if (removeBtn) {
                removeBtn.style.background = '#ef4444';
                removeBtn.textContent = '✓';
            }
        }
    });
    
    updateRemovedImagesInput();
    showNotification('warning', 'Semua Gambar Akan Dihapus', 'Semua gambar yang sudah ada akan dihapus saat Anda menyimpan perubahan');
}

/* ═══════════════════════════════════════════════
   TinyMCE — Upload gambar ke editor
═══════════════════════════════════════════════ */
function uploadImageToServer(file) {
    return new Promise((resolve, reject) => {
        if (!VALID_TYPES.includes(file.type)) {
            showNotification('error', 'Upload Gagal', 'Format tidak didukung: JPG, PNG, GIF, WebP');
            return reject('Format tidak didukung');
        }
        if (file.size > MAX_SIZE) {
            showNotification('error', 'Upload Gagal', 'Ukuran file maksimal 2MB');
            return reject('File terlalu besar');
        }

        const formData = new FormData();
        formData.append('file', file);

        fetch('{{ route("upload.image") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN':    csrfToken,
                'X-Requested-With':'XMLHttpRequest',
                'Accept':          'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Server error: ' + res.status);
            return res.json();
        })
        .then(data => {
            if (data?.location) {
                showNotification('success', 'Upload Berhasil', 'Gambar berhasil disisipkan ke editor');
                resolve(data.location);
            } else {
                throw new Error('Respons server tidak valid');
            }
        })
        .catch(err => {
            showNotification('error', 'Upload Gagal', err.message);
            reject(err.message);
        });
    });
}

/* ═══════════════════════════════════════════════
   DOMContentLoaded
═══════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {

    /* ── TinyMCE ── */
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: [
            'advlist','autolink','lists','link','image','charmap','preview',
            'anchor','searchreplace','visualblocks','code','fullscreen',
            'insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | table | code fullscreen',
        toolbar_mode: 'sliding',
        automatic_uploads: true,
        images_upload_url: '{{ route("upload.image") }}',

        images_upload_handler: function (blobInfo) {
            return uploadImageToServer(blobInfo.blob());
        },

        file_picker_types: 'image',
        file_picker_callback: function (callback, value, meta) {
            if (meta.filetype !== 'image') return;
            const input = document.createElement('input');
            input.type   = 'file';
            input.accept = 'image/*';
            input.onchange = function () {
                const file = this.files[0];
                if (!file) return;
                uploadImageToServer(file)
                    .then(url => callback(url))
                    .catch(err => console.error('file_picker error:', err));
            };
            input.click();
        },

        setup: function (editor) {
            editor.on('change', () => editor.save());
        }
    });

    /* ── Session success alert ── */
    const sessionAlert = document.getElementById('sessionSuccessAlert');
    if (sessionAlert) {
        const msg = sessionAlert.querySelector('.success-message')?.textContent || '';
        showNotification('success', 'Berhasil!', msg);
        setTimeout(() => {
            sessionAlert.style.transition = 'opacity .3s';
            sessionAlert.style.opacity    = '0';
            setTimeout(() => sessionAlert.remove(), 300);
        }, 5000);
    }

    /* ── Form submit ── */
    const form      = document.getElementById('newsForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function (e) {
        // Sync TinyMCE ke textarea
        tinymce.get('content')?.save();

        const title    = form.querySelector('[name="title"]')?.value.trim()     || '';
        const category = form.querySelector('[name="category_id"]')?.value      || '';
        const content  = tinymce.get('content')?.getContent()                   || '';

        if (!title) {
            showNotification('error', 'Judul Kosong', 'Judul berita wajib diisi');
            e.preventDefault(); return;
        }
        if (!category) {
            showNotification('error', 'Kategori Belum Dipilih', 'Silakan pilih kategori berita');
            e.preventDefault(); return;
        }
        const emptyContent = !content || ['','<p></p>','<p><br></p>'].includes(content.trim());
        if (emptyContent) {
            showNotification('error', 'Konten Kosong', 'Isi berita wajib diisi');
            e.preventDefault(); return;
        }

        // Loading state
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
    });
});

/* ── Cleanup TinyMCE saat navigasi ── */
window.addEventListener('beforeunload', () => tinymce.get('content')?.remove());
</script>
@endsection