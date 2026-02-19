@extends('layouts.cms')

@section('title', 'Upload Hero Banner')

@section('content')
<div class="upload-banner-container">
    <div class="upload-header">
        <h2><i class="fas fa-cloud-upload-alt"></i> Upload Hero Banner</h2>
        <div class="upload-steps">
            <span class="step">1. Upload</span>
            <i class="fas fa-chevron-right"></i>
            <span class="step">2. Review</span>
            <i class="fas fa-chevron-right"></i>
            <span class="step active">3. Approval</span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-2 mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="upload-card">
        <form action="{{ route('staff.hero-banners.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="upload-form">
            @csrf

            <div class="upload-section">
                <div class="section-header">
                    <i class="fas fa-image"></i>
                    <h4>Upload Gambar</h4>
                </div>
                <div class="file-upload-area" id="dropArea">
                    <div class="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt fa-2x"></i>
                        <p>Drag & drop gambar atau klik untuk memilih</p>
                        <span class="file-types">Format: JPG, PNG, GIF</span>
                    </div>
                    <input type="file" 
                           name="image" 
                           id="fileInput" 
                           class="file-input" 
                           accept=".jpg,.jpeg,.png,.gif"
                           required>
                </div>
                <div class="upload-preview" id="previewContainer"></div>
                <div class="upload-info">
                    <div class="info-item">
                        <i class="fas fa-info-circle"></i>
                        <span>Rekomendasi ukuran: <strong>1920 × 600 px</strong></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-weight-hanging"></i>
                        <span>Maksimum ukuran file: <strong>5 MB</strong></span>
                    </div>
                </div>
            </div>

            <div class="upload-section">
                <div class="section-header">
                    <i class="fas fa-info-circle"></i>
                    <h4>Informasi Banner</h4>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-heading"></i>
                        Judul Banner
                        <span class="optional">(Opsional)</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           class="form-control"
                           placeholder="Masukkan judul banner"
                           value="{{ old('title') }}">
                    <div class="form-help">Judul akan ditampilkan di atas banner</div>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-link"></i>
                        Tautan
                        <span class="optional">(Opsional)</span>
                    </label>
                    <input type="url" 
                           name="link" 
                           class="form-control"
                           placeholder="https://example.com"
                           value="{{ old('link') }}">
                    <div class="form-help">URL yang akan dibuka saat banner diklik</div>
                </div>
            </div>

            <div class="upload-note">
                <div class="note-header">
                    <i class="fas fa-clock"></i>
                    <h5>Proses Approval</h5>
                </div>
                <div class="note-content">
                    <p>Banner yang diupload akan masuk ke daftar <strong>Pending</strong> dan membutuhkan persetujuan Admin sebelum ditampilkan.</p>
                    <div class="process-flow">
                        <div class="flow-step">
                            <div class="step-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <span>Menunggu</span>
                        </div>
                        <div class="flow-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="flow-step">
                            <div class="step-icon reviewing">
                                <i class="fas fa-eye"></i>
                            </div>
                            <span>Review</span>
                        </div>
                        <div class="flow-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="flow-step">
                            <div class="step-icon approved">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Disetujui</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    Submit untuk Approval
                </button>
                <a href="{{ route('dashboard') }}" class="btn-cancel">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.upload-banner-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.upload-header {
    margin-bottom: 32px;
}

.upload-header h2 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.upload-header h2 i {
    color: #4361ee;
}

.upload-steps {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #666;
    font-size: 14px;
}

.step {
    padding: 6px 12px;
    border-radius: 20px;
    background: #f8f9fa;
    color: #999;
}

.step.active {
    background: #4361ee;
    color: white;
}

.upload-steps i {
    color: #dee2e6;
    font-size: 12px;
}

.upload-card {
    background: #fff;
    border-radius: 10px;
}

.upload-section {
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid #f0f0f0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.section-header i {
    color: #4361ee;
    font-size: 18px;
}

.section-header h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.file-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
    position: relative;
    overflow: hidden;
}

.file-upload-area:hover {
    border-color: #4361ee;
    background: #f0f7ff;
}

.file-upload-area.drag-over {
    border-color: #4361ee;
    background: #e8f4ff;
}

.upload-placeholder {
    pointer-events: none;
}

.upload-placeholder i {
    font-size: 48px;
    color: #adb5bd;
    margin-bottom: 16px;
}

.upload-placeholder p {
    color: #666;
    margin-bottom: 8px;
    font-size: 16px;
}

.file-types {
    color: #999;
    font-size: 14px;
}

.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}

.upload-preview {
    margin-top: 20px;
    display: none;
}

.preview-image {
    max-width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.upload-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 12px;
    margin-top: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    background: #f8f9fa;
    border-radius: 6px;
    font-size: 14px;
    color: #666;
}

.info-item i {
    color: #4361ee;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i {
    color: #4361ee;
}

.optional {
    color: #999;
    font-weight: normal;
    font-size: 13px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #4361ee;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.form-help {
    font-size: 13px;
    color: #999;
    margin-top: 6px;
}

.upload-note {
    background: #fff9e6;
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 32px;
}

.note-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.note-header i {
    color: #ffb300;
    font-size: 18px;
}

.note-header h5 {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.note-content p {
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
}

.process-flow {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.flow-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.step-icon.pending {
    background: #ffb300;
    color: white;
}

.step-icon.reviewing {
    background: #3498db;
    color: white;
}

.step-icon.approved {
    background: #28a745;
    color: white;
}

.flow-step span {
    font-size: 12px;
    color: #666;
    font-weight: 500;
}

.flow-arrow {
    color: #dee2e6;
}

.form-actions {
    display: flex;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid #f0f0f0;
}

.btn-submit {
    flex: 1;
    padding: 14px 24px;
    background: #4361ee;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}

.btn-submit:hover {
    background: #3651d4;
}

.btn-cancel {
    padding: 14px 24px;
    background: white;
    color: #666;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-cancel:hover {
    background: #f8f9fa;
    color: #333;
}

.alert {
    border-radius: 8px;
    border: none;
    margin-bottom: 24px;
    padding: 16px 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.alert ul {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .upload-banner-container {
        padding: 20px;
    }
    
    .upload-steps {
        font-size: 12px;
        gap: 8px;
    }
    
    .process-flow {
        flex-direction: column;
        gap: 12px;
    }
    
    .flow-arrow {
        transform: rotate(90deg);
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .upload-info {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropArea.classList.add('drag-over');
    }

    function unhighlight() {
        dropArea.classList.remove('drag-over');
    }

    dropArea.addEventListener('drop', handleDrop, false);
    fileInput.addEventListener('change', handleFileSelect, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFileSelect() {
        const files = this.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            
            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak didukung. Silakan upload gambar JPG, PNG, atau GIF.');
                return;
            }
            
            // Validasi ukuran file (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                return;
            }
            
            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" class="preview-image" alt="Preview">
                    <div class="mt-2 text-center text-muted">
                        <small>${file.name} (${(file.size / 1024).toFixed(0)} KB)</small>
                    </div>
                `;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Click pada drop area untuk trigger file input
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });
});
</script>
@endsection