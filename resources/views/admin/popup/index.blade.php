{{-- resources/views/admin/popup/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
    /* ============================================
       ENTERPRISE PROFESSIONAL STYLES
       Color Scheme: Navy + Gray + White
       Inspired by: Stripe, Salesforce, Microsoft
    ============================================ */
    
    :root {
        --primary: #0066FF;
        --primary-dark: #0052CC;
        --primary-light: #E6F0FF;
        --secondary: #00A3FF;
        --success: #00A86B;
        --warning: #FFB800;
        --danger: #FF3B30;
        --info: #5E5CE6;
        
        --gray-25: #FCFCFD;
        --gray-50: #F9FAFB;
        --gray-100: #F2F4F7;
        --gray-200: #EAECF0;
        --gray-300: #D0D5DD;
        --gray-400: #98A2B3;
        --gray-500: #667085;
        --gray-600: #475467;
        --gray-700: #344054;
        --gray-800: #1D2939;
        --gray-900: #101828;
        
        --white: #FFFFFF;
        --black: #000000;
    }
    
    /* Container Utama */
    .popup-manager {
        padding: 0;
        background: var(--gray-50);
        min-height: calc(100vh - 200px);
    }
    
    /* Header Section - Clean & Professional */
    .page-header {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 28px 32px;
        margin-bottom: 28px;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0 0 6px 0;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.01em;
    }
    
    .page-title i {
        color: var(--primary);
        font-size: 24px;
    }
    
    .page-description {
        color: var(--gray-600);
        font-size: 14px;
        margin: 0;
        line-height: 1.5;
    }
    
    /* Grid Layout */
    .popup-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        padding: 0 32px 32px 32px;
    }
    
    @media (max-width: 992px) {
        .popup-grid {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 0 24px 24px 24px;
        }
    }
    
    /* Cards - Clean Border Style */
    .card-enterprise {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: box-shadow 0.2s ease;
    }
    
    .card-enterprise:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    
    .card-header-enterprise {
        background: var(--white);
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .card-header-enterprise h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .card-header-enterprise h3 i {
        color: var(--primary);
        font-size: 18px;
    }
    
    .card-body-enterprise {
        padding: 24px;
    }
    
    /* Form Styles - Clean Typography */
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
    }
    
    .form-label i {
        margin-right: 8px;
        color: var(--gray-500);
        font-size: 12px;
    }
    
    /* File Upload - Simple & Clean */
    .file-upload {
        border: 1px solid var(--gray-300);
        border-radius: 8px;
        background: var(--white);
        transition: all 0.2s;
        position: relative;
    }
    
    .file-upload:hover {
        border-color: var(--primary);
        background: var(--gray-25);
    }
    
    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .file-upload-placeholder {
        padding: 32px 24px;
        text-align: center;
    }
    
    .file-upload-placeholder i {
        font-size: 32px;
        color: var(--gray-400);
        margin-bottom: 12px;
    }
    
    .file-upload-placeholder p {
        font-size: 14px;
        color: var(--gray-600);
        margin: 0;
    }
    
    .file-upload-placeholder small {
        font-size: 12px;
        color: var(--gray-500);
        display: block;
        margin-top: 6px;
    }
    
    .file-name {
        margin-top: 12px;
        padding: 8px 12px;
        background: var(--gray-50);
        border-radius: 6px;
        font-size: 13px;
        color: var(--gray-700);
        display: none;
    }
    
    .file-name.active {
        display: block;
    }
    
    /* Toggle Switch - Clean Design */
    .toggle-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-top: 1px solid var(--gray-200);
        border-bottom: 1px solid var(--gray-200);
        margin-bottom: 24px;
    }
    
    .toggle-info h4 {
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-900);
        margin: 0 0 4px 0;
    }
    
    .toggle-info p {
        font-size: 12px;
        color: var(--gray-600);
        margin: 0;
    }
    
    /* Toggle Switch */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
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
        transition: 0.2s;
        border-radius: 24px;
    }
    
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: 0.2s;
        border-radius: 50%;
    }
    
    input:checked + .toggle-slider {
        background-color: var(--primary);
    }
    
    input:checked + .toggle-slider:before {
        transform: translateX(20px);
    }
    
    /* Button - Clean & Professional */
    .btn-primary-enterprise {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-primary-enterprise:hover {
        background: var(--primary-dark);
    }
    
    .btn-primary-enterprise:active {
        transform: scale(0.98);
    }
    
    /* Preview Section */
    .preview-container {
        background: var(--gray-50);
        border-radius: 8px;
        padding: 20px;
    }
    
    .preview-image-wrapper {
        background: var(--white);
        border-radius: 8px;
        padding: 16px;
        border: 1px solid var(--gray-200);
        margin-bottom: 20px;
        text-align: center;
    }
    
    .preview-image {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
    }
    
    /* Status Badge - Clean */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-active {
        background: #ECFDF3;
        color: #067647;
    }
    
    .status-inactive {
        background: #FEF3F2;
        color: #B42318;
    }
    
    /* Info Box - Clean */
    .info-box {
        background: var(--gray-50);
        border-radius: 8px;
        padding: 16px;
        margin-top: 20px;
        display: flex;
        gap: 12px;
    }
    
    .info-box i {
        color: var(--primary);
        font-size: 18px;
        margin-top: 2px;
    }
    
    .info-box p {
        margin: 0;
        font-size: 13px;
        color: var(--gray-700);
        line-height: 1.5;
    }
    
    .info-box.warning {
        background: #FFFBEB;
    }
    
    .info-box.warning i {
        color: var(--warning);
    }
    
    /* Alert - Clean */
    .alert-enterprise {
        margin: 0 32px 28px 32px;
        padding: 14px 20px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeIn 0.3s ease;
    }
    
    .alert-enterprise.success {
        background: #ECFDF3;
        color: #067647;
    }
    
    .alert-enterprise i {
        font-size: 18px;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
    }
    
    .empty-state i {
        font-size: 48px;
        color: var(--gray-300);
        margin-bottom: 16px;
    }
    
    .empty-state h4 {
        font-size: 16px;
        font-weight: 500;
        color: var(--gray-700);
        margin: 0 0 6px 0;
    }
    
    .empty-state p {
        font-size: 13px;
        color: var(--gray-500);
        margin: 0;
    }
    
    /* Divider */
    .divider {
        height: 1px;
        background: var(--gray-200);
        margin: 20px 0;
    }
    
    /* Helper Text */
    .helper-text {
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .helper-text i {
        font-size: 12px;
    }
</style>

<div class="popup-manager">
    <!-- Header -->
    <div class="page-header">
        <div class="page-title">
            <i class="fas fa-window-maximize"></i>
            Pop-up Banner
        </div>
        <p class="page-description">
            Kelola banner pop-up yang akan ditampilkan kepada pengunjung website.
        </p>
    </div>
    
    <!-- Alert -->
    @if(session('success'))
    <div class="alert-enterprise success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    
    <!-- Grid -->
    <div class="popup-grid">
        <!-- Form Upload -->
        <div class="card-enterprise">
            <div class="card-header-enterprise">
                <h3>
                    <i class="fas fa-upload"></i>
                    Upload Banner
                </h3>
            </div>
            <div class="card-body-enterprise">
                <form action="{{ route('admin.popup.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-image"></i>
                            File Gambar
                        </label>
                        <div class="file-upload" onclick="document.getElementById('imageInput').click()">
                            <div class="file-upload-placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Klik untuk upload</p>
                                <small>JPG, PNG, WEBP (Max 2MB)</small>
                            </div>
                            <input type="file" name="image" id="imageInput" class="file-upload-input" accept="image/*" required onchange="showFileName(this)">
                        </div>
                        <div class="file-name" id="fileName">
                            <i class="fas fa-file-image"></i>
                            <span></span>
                        </div>
                        <div class="helper-text">
                            <i class="fas fa-info-circle"></i>
                            Rekomendasi ukuran: 800x600 pixels
                        </div>
                    </div>
                    
                    <div class="toggle-container">
                        <div class="toggle-info">
                            <h4>Status Pop-up</h4>
                            <p>Aktifkan untuk menampilkan banner</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" id="is_active" {{ optional($popup)->is_active ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-primary-enterprise">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Preview -->
        <div class="card-enterprise">
            <div class="card-header-enterprise">
                <h3>
                    <i class="fas fa-eye"></i>
                    Preview Banner
                </h3>
            </div>
            <div class="card-body-enterprise">
                @if($popup && $popup->image_path)
                    <div class="preview-container">
                        <div class="preview-image-wrapper">
                            <img src="{{ Storage::url($popup->image_path) }}" 
                                 class="preview-image" 
                                 alt="Banner Preview">
                        </div>
                        
                        <div style="text-align: center;">
                            <span class="status-badge {{ $popup->is_active ? 'status-active' : 'status-inactive' }}">
                                <i class="fas {{ $popup->is_active ? 'fa-circle' : 'fa-circle' }}"></i>
                                {{ $popup->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        
                        <div class="divider"></div>
                        
                        @if($popup->is_active)
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <p>Banner aktif dan akan ditampilkan kepada pengunjung website saat halaman dimuat.</p>
                            </div>
                        @else
                            <div class="info-box warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>Banner sedang nonaktif. Aktifkan toggle switch di samping untuk menampilkan banner.</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-image"></i>
                        <h4>Belum ada banner</h4>
                        <p>Upload banner melalui form di samping</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function showFileName(input) {
        const fileNameDiv = document.getElementById('fileName');
        const fileNameSpan = fileNameDiv.querySelector('span');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                input.value = '';
                fileNameDiv.classList.remove('active');
                return;
            }
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Format file harus JPG, PNG, atau WEBP');
                input.value = '';
                fileNameDiv.classList.remove('active');
                return;
            }
            
            fileNameSpan.innerHTML = `<strong>${file.name}</strong> (${(file.size / 1024).toFixed(1)} KB)`;
            fileNameDiv.classList.add('active');
        } else {
            fileNameDiv.classList.remove('active');
        }
    }
</script>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
@endsection