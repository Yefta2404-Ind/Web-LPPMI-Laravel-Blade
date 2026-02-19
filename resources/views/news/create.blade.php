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
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, sans-serif;
        background: var(--gray-50);
    }

    .create-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 24px;
        position: relative;
    }

    @media (max-width: 768px) {
        .create-container {
            padding: 16px;
        }
    }

    /* Header */
    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .page-description {
        color: var(--gray-500);
        font-size: 14px;
        line-height: 1.5;
        max-width: 600px;
    }

    /* Success Alert */
    .success-alert {
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        border-radius: 6px;
        padding: 16px;
        margin-bottom: 24px;
        animation: fadeIn 0.3s ease-out;
    }

    .success-title {
        color: #166534;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .success-message {
        color: #166534;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Error Alert */
    .error-alert {
        background: #fef2f2;
        border: 1px solid #fee2e2;
        border-radius: 6px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .error-title {
        color: #991b1b;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .error-list {
        margin: 0;
        padding-left: 20px;
        color: #991b1b;
        font-size: 13px;
        line-height: 1.5;
    }

    .error-list li {
        margin-bottom: 4px;
    }

    /* Notification Toast */
    .notification-toast {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 9999;
        width: 100%;
        max-width: 400px;
    }

    .notification {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 16px;
        margin-bottom: 12px;
        border-left: 4px solid transparent;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    }

    .notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .notification.success {
        border-left-color: var(--success);
    }

    .notification.success .notification-icon {
        color: var(--success);
    }

    .notification.error {
        border-left-color: var(--danger);
    }

    .notification.error .notification-icon {
        color: var(--danger);
    }

    .notification.warning {
        border-left-color: var(--warning);
    }

    .notification.warning .notification-icon {
        color: var(--warning);
    }

    .notification-icon {
        font-size: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 14px;
        margin-bottom: 4px;
    }

    .notification-message {
        color: var(--gray-600);
        font-size: 13px;
        line-height: 1.4;
    }

    .notification-close {
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        font-size: 14px;
        padding: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .notification-close:hover {
        color: var(--gray-600);
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 32px;
    }

    .form-content {
        padding: 32px;
    }

    @media (max-width: 640px) {
        .form-content {
            padding: 24px;
        }
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-label .required {
        color: var(--danger);
        font-size: 12px;
        font-weight: 400;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 14px;
        color: var(--gray-800);
        font-family: 'Inter', -apple-system, sans-serif;
        background: white;
        transition: all 0.2s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input:hover,
    .form-select:hover,
    .form-textarea:hover {
        border-color: var(--gray-400);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--gray-400);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        cursor: pointer;
    }

    .form-textarea {
        min-height: 200px;
        resize: vertical;
        line-height: 1.6;
    }

    /* File Input */
    .file-upload {
        position: relative;
    }

    .file-input {
        width: 100%;
        padding: 40px 20px;
        border: 2px dashed var(--gray-300);
        border-radius: 8px;
        background: var(--gray-50);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .file-input:hover {
        border-color: var(--gray-400);
        background: var(--gray-100);
    }

    .file-input:has(input:focus) {
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .file-input input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-content {
        pointer-events: none;
    }

    .upload-icon {
        font-size: 32px;
        color: var(--gray-400);
        margin-bottom: 12px;
    }

    .upload-text {
        color: var(--gray-600);
        font-size: 14px;
        margin-bottom: 4px;
        font-weight: 500;
    }

    .upload-hint {
        color: var(--gray-500);
        font-size: 12px;
    }

    /* Image Preview */
    .image-preview {
        margin-top: 16px;
        display: none;
    }

    .preview-container {
        position: relative;
        display: inline-block;
    }

    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 6px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    .remove-preview {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        background: white;
        border-radius: 50%;
        border: 1px solid var(--gray-300);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--gray-600);
        font-size: 12px;
        transition: all 0.2s ease;
    }

    .remove-preview:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    /* Form Help */
    .form-help {
        display: block;
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 6px;
        line-height: 1.4;
    }

    /* Error State */
    .has-error .form-input,
    .has-error .form-select,
    .has-error .form-textarea,
    .has-error .file-input {
        border-color: var(--danger);
    }

    .has-error .form-input:focus,
    .has-error .form-select:focus,
    .has-error .form-textarea:focus,
    .has-error .file-input:has(input:focus) {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .error-text {
        display: block;
        font-size: 12px;
        color: var(--danger);
        margin-top: 4px;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
    }

    @media (max-width: 640px) {
        .form-actions {
            flex-direction: column;
        }
    }

    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Inter', -apple-system, sans-serif;
    }

    .btn-primary {
        background: var(--secondary);
        color: white;
        border-color: var(--secondary);
    }

    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-outline {
        background: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-outline:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-block {
        width: 100%;
    }

    /* Loading State */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s linear infinite;
    }

    .btn-outline.btn-loading::after {
        border: 2px solid rgba(107, 114, 128, 0.3);
        border-top-color: var(--gray-600);
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="create-container">
    <!-- Notification Toast Container -->
    <div class="notification-toast" id="notificationToast"></div>
    
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Buat Berita Baru</h1>
        <p class="page-description">
            Isi formulir di bawah untuk membuat berita baru. Pastikan semua informasi yang Anda berikan akurat dan lengkap.
        </p>
    </div>

    <!-- Success Alert (from session) -->
    @if(session('success'))
        <div class="success-alert" id="sessionSuccessAlert">
            <div class="success-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Berhasil!
            </div>
            <p class="success-message">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="error-alert">
            <div class="error-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                Terdapat kesalahan dalam pengisian form
            </div>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <form id="newsForm" action="{{ route('staff.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-content">
                <!-- Judul -->
                <div class="form-group @error('title') has-error @enderror">
                    <label class="form-label">
                        Judul Berita
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}"
                        required
                        class="form-input"
                        placeholder="Masukkan judul berita"
                        maxlength="200"
                    >
                    @error('title')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="form-group @error('category_id') has-error @enderror">
                    <label class="form-label">
                        Kategori
                        <span class="required">*</span>
                    </label>
                    <select name="category_id" required class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option 
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="form-group @error('tags') has-error @enderror">
                    <label class="form-label">
                        Tags
                    </label>
                    <input 
                        type="text" 
                        name="tags"
                        value="{{ old('tags') }}"
                        class="form-input"
                        placeholder="contoh: kampus, teknologi, seminar"
                    >
                    <span class="form-help">Pisahkan tag dengan koma</span>
                    @error('tags')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten -->
                <div class="form-group @error('content') has-error @enderror">
                    <label class="form-label">
                        Isi Berita
                        <span class="required">*</span>
                    </label>
                    <textarea 
                        name="content" 
                        required
                        class="form-textarea"
                        placeholder="Tulis isi berita di sini..."
                        rows="8"
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="form-group @error('image') has-error @enderror">
                    <label class="form-label">
                        Gambar Utama
                    </label>
                    <div class="file-upload">
                        <div class="file-input">
                            <input 
                                type="file" 
                                name="image" 
                                accept="image/*"
                                onchange="previewImage(event)"
                                id="imageInput"
                            >
                            <div class="upload-content">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-text">Unggah gambar</div>
                                <div class="upload-hint">Klik atau drag & drop file di sini</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="image-preview" id="imagePreviewContainer">
                        <div class="preview-container">
                            <img id="imagePreview" class="preview-image" alt="Preview gambar">
                            <div class="remove-preview" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                    
                    <span class="form-help">Format: JPG, PNG, GIF | Maksimal: 2MB</span>
                    @error('image')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Berita
                    </button>
                    <a href="{{ route('staff.news.index') }}" class="btn btn-outline btn-block">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Notification System
function showNotification(type, title, message, duration = 5000) {
    const container = document.getElementById('notificationToast');
    if (!container) return;
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    // Set icon based on type
    let icon = '';
    if (type === 'success') {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
    } else if (type === 'error') {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
    } else if (type === 'warning') {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>';
    }
    
    notification.innerHTML = `
        <div class="notification-icon">${icon}</div>
        <div class="notification-content">
            <div class="notification-title">${title}</div>
            <div class="notification-message">${message}</div>
        </div>
        <button class="notification-close" onclick="closeNotification(this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    `;
    
    container.appendChild(notification);
    
    // Trigger animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Auto remove after duration
    if (duration > 0) {
        setTimeout(() => {
            closeNotification(notification.querySelector('.notification-close'));
        }, duration);
    }
    
    return notification;
}

function closeNotification(closeBtn) {
    const notification = closeBtn.closest('.notification');
    if (!notification) return;
    
    notification.classList.remove('show');
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 300);
}

// Image Preview
function previewImage(event) {
    const file = event.target.files[0];
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        // Validasi ukuran file (2MB)
        if (file.size > 2 * 1024 * 1024) {
            showNotification('error', 'Ukuran File Terlalu Besar', 'Ukuran file maksimal 2MB');
            resetImageInput();
            return;
        }
        
        // Validasi tipe file
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            showNotification('error', 'Format File Tidak Didukung', 'Format file harus JPG, PNG, GIF, atau WebP');
            resetImageInput();
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        container.style.display = 'none';
    }
}

// Remove Image Preview
function removeImage() {
    const container = document.getElementById('imagePreviewContainer');
    const input = document.getElementById('imageInput');
    
    container.style.display = 'none';
    if (input) {
        input.value = '';
    }
}

// Reset Image Input
function resetImageInput() {
    const container = document.getElementById('imagePreviewContainer');
    const input = document.getElementById('imageInput');
    
    container.style.display = 'none';
    if (input) {
        input.value = '';
    }
}

// Form Submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Handle success message from session
    const sessionSuccessAlert = document.getElementById('sessionSuccessAlert');
    if (sessionSuccessAlert) {
        const message = sessionSuccessAlert.querySelector('.success-message').textContent;
        showNotification('success', 'Berhasil!', message);
        
        // Auto hide session alert after 5 seconds
        setTimeout(() => {
            sessionSuccessAlert.style.opacity = '0';
            sessionSuccessAlert.style.transform = 'translateY(-10px)';
            sessionSuccessAlert.style.transition = 'all 0.3s ease';
            setTimeout(() => {
                sessionSuccessAlert.style.display = 'none';
            }, 300);
        }, 5000);
    }
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Simple validation
            const title = form.querySelector('input[name="title"]').value.trim();
            const content = form.querySelector('textarea[name="content"]').value.trim();
            const category = form.querySelector('select[name="category_id"]').value;
            
            let hasError = false;
            
            if (!title) {
                showNotification('error', 'Judul Kosong', 'Judul berita wajib diisi');
                form.querySelector('input[name="title"]').focus();
                hasError = true;
            }
            
            if (!category) {
                showNotification('error', 'Kategori Kosong', 'Kategori berita wajib dipilih');
                if (!hasError) form.querySelector('select[name="category_id"]').focus();
                hasError = true;
            }
            
            if (!content) {
                showNotification('error', 'Konten Kosong', 'Isi berita wajib diisi');
                if (!hasError) form.querySelector('textarea[name="content"]').focus();
                hasError = true;
            }
            
            if (hasError) {
                e.preventDefault();
                return;
            }
            
            // Show loading state
            if (submitBtn) {
                submitBtn.classList.add('btn-loading');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '';
                
                // Show success notification after form submission
                // This will trigger after the page reloads from the server
                // The actual success notification comes from session flash data
            }
        });
    }
    
    // Auto resize textarea
    const textarea = document.querySelector('textarea[name="content"]');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Trigger initial resize
        setTimeout(() => {
            textarea.style.height = textarea.scrollHeight + 'px';
        }, 100);
    }
    
    // Check if there's already an image from old input
    const imageInput = document.getElementById('imageInput');
    if (imageInput && imageInput.files.length > 0) {
        const event = new Event('change');
        imageInput.dispatchEvent(event);
    }
});

// AJAX Form Submission (Optional - uncomment if you want AJAX)
/*
document.getElementById('newsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('submitBtn');
    
    // Show loading
    if (submitBtn) {
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
    }
    
    // AJAX request
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success notification
            showNotification('success', 'Berhasil!', 'Berita berhasil ditambahkan.');
            
            // Reset form
            form.reset();
            removeImage();
            
            // Redirect after 2 seconds
            setTimeout(() => {
                window.location.href = data.redirect || '{{ route("staff.news.index") }}';
            }, 2000);
        } else {
            // Show error notification
            showNotification('error', 'Error!', data.message || 'Terjadi kesalahan.');
            
            // Re-enable submit button
            if (submitBtn) {
                submitBtn.classList.remove('btn-loading');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Berita';
            }
        }
    })
    .catch(error => {
        showNotification('error', 'Error!', 'Terjadi kesalahan jaringan.');
        
        // Re-enable submit button
        if (submitBtn) {
            submitBtn.classList.remove('btn-loading');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Berita';
        }
    });
});
*/
</script>
@endsection