@extends('layouts.app')

@section('content')
<div class="simple-video-upload">
    <div class="upload-container">
        <div class="page-header">
            <h1 class="page-title">Tambah Video Baru</h1>
            <p class="page-subtitle">Lengkapi formulir di bawah untuk menambahkan video</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <div class="error-icon">!</div>
                <div class="error-content">
                    <strong>Perhatian:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('staff.videos.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">
                    <span class="label-text">Judul Video</span>
                    <span class="required">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title"
                       class="form-control @error('title') error @enderror"
                       value="{{ old('title') }}"
                       placeholder="Contoh: Tutorial Laravel 10"
                       required>
                @error('title')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" 
                          id="description"
                          class="form-control textarea @error('description') error @enderror"
                          rows="4"
                          placeholder="Tambahkan deskripsi video (opsional)...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="source" class="form-label">
                    <span class="label-text">Sumber Video</span>
                    <span class="required">*</span>
                </label>
                <div class="source-select-wrapper">
                    <select name="source" 
                            id="source" 
                            class="form-control select @error('source') error @enderror"
                            required>
                        <option value="">-- Pilih Sumber --</option>
                        <option value="youtube" {{ old('source') == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
                        <option value="upload" {{ old('source') == 'upload' ? 'selected' : '' }}>Upload File</option>
                    </select>
                </div>
                @error('source')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="dynamic-field" id="youtube-field" style="display: none;">
                <div class="form-group">
                    <label for="url" class="form-label">
                        <span class="label-text">URL YouTube</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-with-icon">
                        <div class="input-icon">🔗</div>
                        <input type="url" 
                               name="url" 
                               id="url"
                               class="form-control @error('url') error @enderror"
                               value="{{ old('url') }}"
                               placeholder="https://youtube.com/watch?v=..."
                               disabled>
                    </div>
                    <div class="form-hint">
                        <span class="hint-icon">💡</span>
                        <span>Masukkan link lengkap video YouTube</span>
                    </div>
                    @error('url')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="dynamic-field" id="upload-field" style="display: none;">
                <div class="form-group">
                    <label for="video" class="form-label">
                        <span class="label-text">File Video</span>
                        <span class="required">*</span>
                    </label>
                    <div class="file-upload-wrapper">
                        <input type="file" 
                               name="video" 
                               id="video"
                               class="file-input @error('video') error @enderror"
                               accept="video/mp4"
                               disabled>
                        <label for="video" class="file-label">
                            <div class="file-icon">📁</div>
                            <div class="file-content">
                                <div class="file-title">Pilih file video</div>
                                <div class="file-info">
                                    <span class="file-size">MP4, maks. 50MB</span>
                                    <span class="file-status" id="file-status">Belum ada file</span>
                                </div>
                            </div>
                            <div class="file-button">Browse</div>
                        </label>
                    </div>
                    @error('video')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="notification">
                <div class="notification-icon">ⓘ</div>
                <div class="notification-content">
                    <div class="notification-title">Status Verifikasi</div>
                    <div class="notification-text">
                        Video akan berstatus <strong>Pending</strong> dan menunggu persetujuan admin sebelum ditayangkan.
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <span class="btn-icon">←</span>
                    <span class="btn-text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary" id="submit-btn">
                    <span class="btn-text">Simpan Video</span>
                    <span class="btn-loading" style="display: none;">
                        <span class="spinner"></span>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* CSS Reset for Mobile First */
    .simple-video-upload * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Base Container - Mobile First */
    .simple-video-upload {
        min-height: 100vh;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-container {
        width: 100%;
        max-width: 100%;
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 1.5rem;
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .page-subtitle {
        font-size: 0.9rem;
        color: #718096;
        line-height: 1.5;
    }

    /* Error Message */
    .error-message {
        background: #fff5f5;
        border: 1px solid #fc8181;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .error-icon {
        width: 24px;
        height: 24px;
        background: #f56565;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
        font-size: 0.875rem;
    }

    .error-content {
        flex: 1;
    }

    .error-content strong {
        color: #c53030;
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .error-content ul {
        list-style: none;
        padding-left: 0;
    }

    .error-content li {
        color: #718096;
        font-size: 0.875rem;
        padding: 0.25rem 0;
        position: relative;
        padding-left: 1.25rem;
    }

    .error-content li::before {
        content: "•";
        color: #f56565;
        position: absolute;
        left: 0;
        font-size: 1.2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .label-text {
        color: #4a5568;
        font-weight: 500;
    }

    .required {
        color: #e53e3e;
        font-size: 0.875rem;
    }

    /* Form Controls */
    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
        transition: all 0.2s ease;
        color: #2d3748;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #4299e1;
        background: white;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    }

    .form-control.error {
        border-color: #fc8181;
        background: #fff5f5;
    }

    .form-control.textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.5;
    }

    /* Select Wrapper */
    .source-select-wrapper {
        position: relative;
    }

    .source-select-wrapper::after {
        content: "▼";
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #718096;
        pointer-events: none;
        font-size: 0.75rem;
    }

    .form-control.select {
        appearance: none;
        cursor: pointer;
        padding-right: 2.5rem;
    }

    /* Input with Icon */
    .input-with-icon {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.125rem;
        color: #718096;
    }

    .input-with-icon .form-control {
        padding-left: 3rem;
    }

    /* Form Hint */
    .form-hint {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #718096;
    }

    .hint-icon {
        font-size: 0.875rem;
    }

    /* Error Text */
    .error-text {
        display: block;
        margin-top: 0.5rem;
        color: #e53e3e;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .error-text::before {
        content: "⚠";
        font-size: 0.875rem;
    }

    /* File Upload */
    .file-upload-wrapper {
        position: relative;
    }

    .file-input {
        position: absolute;
        width: 0;
        height: 0;
        opacity: 0;
    }

    .file-label {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-wrap: wrap;
    }

    .file-label:hover {
        border-color: #4299e1;
        background: #ebf8ff;
    }

    .file-icon {
        font-size: 1.5rem;
        color: #718096;
    }

    .file-content {
        flex: 1;
        min-width: 0;
    }

    .file-title {
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .file-info {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #718096;
    }

    .file-size {
        background: #edf2f7;
        padding: 0.125rem 0.5rem;
        border-radius: 4px;
    }

    .file-status {
        color: #38a169;
    }

    .file-button {
        padding: 0.5rem 1.25rem;
        background: #4299e1;
        color: white;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: background 0.2s ease;
    }

    .file-label:hover .file-button {
        background: #3182ce;
    }

    /* Dynamic Field Animation */
    .dynamic-field {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Notification */
    .notification {
        background: #ebf8ff;
        border: 1px solid #bee3f8;
        border-radius: 12px;
        padding: 1rem;
        margin: 2rem 0;
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .notification-icon {
        font-size: 1.25rem;
        color: #3182ce;
        flex-shrink: 0;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .notification-text {
        color: #4a5568;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .notification-text strong {
        color: #2d3748;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
        flex: 1;
        min-width: 120px;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        min-height: 56px;
    }

    .btn-secondary {
        background: #f8fafc;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        border-color: #cbd5e0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-icon {
        font-size: 1.125rem;
        line-height: 1;
    }

    .btn-loading {
        display: none;
        align-items: center;
        gap: 0.5rem;
    }

    .spinner {
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* ===== RESPONSIVE BREAKPOINTS ===== */

    /* Tablet (≥ 640px) */
    @media (min-width: 640px) {
        .upload-container {
            padding: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .form-label {
            font-size: 1rem;
        }

        .btn {
            min-width: 140px;
            padding: 1rem 2rem;
        }

        .form-actions {
            flex-wrap: nowrap;
        }
    }

    /* Small Desktop (≥ 768px) */
    @media (min-width: 768px) {
        .simple-video-upload {
            padding: 2rem;
        }

        .upload-container {
            max-width: 768px;
            padding: 2.5rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .notification {
            padding: 1.25rem;
        }

        .file-label {
            padding: 1.25rem;
        }
    }

    /* Desktop (≥ 1024px) */
    @media (min-width: 1024px) {
        .simple-video-upload {
            padding: 3rem;
        }

        .upload-container {
            max-width: 800px;
        }

        .page-header {
            margin-bottom: 2.5rem;
        }

        .form-control {
            padding: 1rem 1.25rem;
        }

        .form-control.textarea {
            min-height: 140px;
        }

        .btn {
            min-height: 60px;
        }
    }

    /* Large Desktop (≥ 1280px) */
    @media (min-width: 1280px) {
        .upload-container {
            max-width: 900px;
        }

        .page-title {
            font-size: 2.25rem;
        }
    }

    /* Extra Large (≥ 1536px) */
    @media (min-width: 1536px) {
        .upload-container {
            max-width: 1000px;
        }
    }

    /* ===== MOBILE SPECIFIC ADJUSTMENTS ===== */
    
    /* Small Mobile (≤ 360px) */
    @media (max-width: 360px) {
        .simple-video-upload {
            padding: 0.5rem;
        }
        
        .upload-container {
            padding: 1rem;
            border-radius: 12px;
        }
        
        .page-title {
            font-size: 1.25rem;
        }
        
        .form-control {
            padding: 0.75rem;
        }
        
        .btn {
            min-height: 48px;
            padding: 0.75rem 1rem;
        }
        
        .file-label {
            flex-direction: column;
            text-align: center;
        }
        
        .file-icon {
            margin-bottom: 0.5rem;
        }
        
        .file-button {
            width: 100%;
            margin-top: 0.5rem;
        }
    }

    /* Landscape Mode */
    @media (max-height: 500px) and (orientation: landscape) {
        .simple-video-upload {
            padding: 1rem;
            align-items: flex-start;
        }
        
        .upload-container {
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .simple-video-upload {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
        }
        
        .upload-container {
            background: #1a202c;
            color: #e2e8f0;
        }
        
        .page-title {
            color: #f7fafc;
        }
        
        .page-subtitle {
            color: #cbd5e0;
        }
        
        .form-control {
            background: #2d3748;
            border-color: #4a5568;
            color: #e2e8f0;
        }
        
        .form-control:focus {
            border-color: #4299e1;
            background: #2d3748;
        }
        
        .error-message {
            background: #2d2222;
            border-color: #f56565;
        }
        
        .notification {
            background: #2d3748;
            border-color: #4a5568;
        }
        
        .btn-secondary {
            background: #2d3748;
            border-color: #4a5568;
            color: #e2e8f0;
        }
        
        .file-label {
            background: #2d3748;
            border-color: #4a5568;
        }
        
        .file-size {
            background: #4a5568;
        }
    }

    /* High Contrast Mode */
    @media (prefers-contrast: high) {
        .form-control {
            border-width: 3px;
        }
        
        .btn {
            border-width: 2px;
        }
        
        .error-message {
            border-width: 2px;
        }
    }

    /* Reduce Motion */
    @media (prefers-reduced-motion: reduce) {
        .form-control,
        .btn,
        .file-label,
        .dynamic-field {
            transition: none;
            animation: none;
        }
        
        .btn-primary:hover {
            transform: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const sourceSelect = document.getElementById('source');
        const youtubeField = document.getElementById('youtube-field');
        const uploadField = document.getElementById('upload-field');
        const youtubeInput = document.getElementById('url');
        const videoInput = document.getElementById('video');
        const fileStatus = document.getElementById('file-status');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const form = document.querySelector('.upload-form');
        const fileLabel = document.querySelector('.file-label');

        // Function to toggle fields
        function toggleFields() {
            // Hide both fields first
            youtubeField.style.display = 'none';
            uploadField.style.display = 'none';
            
            // Disable both inputs
            youtubeInput.disabled = true;
            youtubeInput.removeAttribute('required');
            videoInput.disabled = true;
            videoInput.removeAttribute('required');
            
            // Remove required attribute from all
            youtubeInput.required = false;
            videoInput.required = false;
            
            // Show and enable selected field
            if (sourceSelect.value === 'youtube') {
                youtubeField.style.display = 'block';
                youtubeInput.disabled = false;
                youtubeInput.required = true;
                setTimeout(() => youtubeInput.focus(), 100);
            } else if (sourceSelect.value === 'upload') {
                uploadField.style.display = 'block';
                videoInput.disabled = false;
                videoInput.required = true;
            }
        }

        // Handle file selection
        function handleFileSelect() {
            if (videoInput.files && videoInput.files[0]) {
                const file = videoInput.files[0];
                const fileName = file.name.length > 30 
                    ? file.name.substring(0, 27) + '...' 
                    : file.name;
                const fileSize = (file.size / (1024 * 1024)).toFixed(1);
                
                fileStatus.textContent = `${fileName} (${fileSize}MB)`;
                fileStatus.style.color = '#38a169';
                
                // Add visual feedback
                fileLabel.style.borderColor = '#38a169';
                fileLabel.style.background = '#f0fff4';
                
                // Validate file size
                if (file.size > 50 * 1024 * 1024) {
                    fileStatus.textContent = 'File terlalu besar (max 50MB)';
                    fileStatus.style.color = '#e53e3e';
                    fileLabel.style.borderColor = '#e53e3e';
                    fileLabel.style.background = '#fff5f5';
                    videoInput.value = '';
                }
            } else {
                fileStatus.textContent = 'Belum ada file';
                fileStatus.style.color = '#718096';
                fileLabel.style.borderColor = '#cbd5e0';
                fileLabel.style.background = '#f8fafc';
            }
        }

        // Handle form submission
        function handleSubmit(e) {
            if (!sourceSelect.value) {
                e.preventDefault();
                sourceSelect.focus();
                sourceSelect.style.borderColor = '#e53e3e';
                return;
            }
            
            if (sourceSelect.value === 'youtube' && !youtubeInput.value.trim()) {
                e.preventDefault();
                youtubeInput.focus();
                return;
            }
            
            if (sourceSelect.value === 'upload' && !videoInput.files.length) {
                e.preventDefault();
                videoInput.focus();
                return;
            }
            
            // Show loading state
            btnText.style.display = 'none';
            btnLoading.style.display = 'flex';
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.8';
        }

        // Drag and drop functionality
        function handleDragDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (e.type === 'dragover') {
                fileLabel.style.borderColor = '#4299e1';
                fileLabel.style.background = '#ebf8ff';
            } else {
                fileLabel.style.borderColor = '#cbd5e0';
                fileLabel.style.background = '#f8fafc';
                
                if (e.type === 'drop' && e.dataTransfer.files.length) {
                    videoInput.files = e.dataTransfer.files;
                    handleFileSelect();
                }
            }
        }

        // Event Listeners
        sourceSelect.addEventListener('change', toggleFields);
        videoInput.addEventListener('change', handleFileSelect);
        form.addEventListener('submit', handleSubmit);
        
        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, handleDragDrop);
        });
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, (e) => e.preventDefault());
        });

        // Initialize on page load
        toggleFields();
        
        // Handle browser back/forward
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                toggleFields();
                handleFileSelect();
            }
        });

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Adjust any layout if needed
            }, 250);
        });
    });
</script>
@endsection