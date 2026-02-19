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
        font-size: 16px;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 16px;
        min-height: 100vh;
    }

    @media (min-width: 768px) {
        .container {
            padding: 24px;
        }
    }

    /* Header */
    .page-header {
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    .page-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    @media (min-width: 768px) {
        .page-title {
            font-size: 24px;
        }
    }

    .page-description {
        color: var(--gray-500);
        font-size: 14px;
        line-height: 1.5;
        max-width: 100%;
    }

    /* Form */
    .form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .form-content {
        padding: 20px;
    }

    @media (min-width: 640px) {
        .form-content {
            padding: 32px;
        }
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    @media (min-width: 640px) {
        .form-group {
            margin-bottom: 24px;
        }
    }

    .form-label {
        display: block;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
        font-size: 15px;
        line-height: 1.4;
    }

    .form-label .required {
        color: var(--danger);
        font-size: 13px;
        font-weight: 400;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--gray-300);
        border-radius: 8px;
        font-size: 16px;
        color: var(--gray-800);
        font-family: 'Inter', -apple-system, sans-serif;
        background: white;
        transition: all 0.2s ease;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    @media (min-width: 768px) {
        .form-input {
            padding: 12px 14px;
            font-size: 14px;
        }
    }

    .form-input:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .form-input:hover {
        border-color: var(--gray-400);
    }

    .form-input::placeholder {
        color: var(--gray-400);
        font-size: 15px;
    }

    @media (min-width: 768px) {
        .form-input::placeholder {
            font-size: 14px;
        }
    }

    /* File Input */
    .file-upload {
        position: relative;
        touch-action: manipulation;
    }

    .file-input-wrapper {
        width: 100%;
        padding: 20px;
        border: 2px dashed var(--gray-300);
        border-radius: 8px;
        background: var(--gray-50);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-input-wrapper:active {
        transform: scale(0.98);
    }

    .file-input-wrapper:hover {
        border-color: var(--gray-400);
        background: var(--gray-100);
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        font-size: 100px;
    }

    .upload-content {
        pointer-events: none;
        text-align: center;
    }

    .upload-icon {
        font-size: 28px;
        color: var(--gray-400);
        margin-bottom: 8px;
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
        line-height: 1.4;
    }

    /* Image Preview */
    .image-preview {
        margin-top: 12px;
        display: none;
        text-align: center;
    }

    .preview-container {
        position: relative;
        display: inline-block;
        max-width: 100%;
    }

    .preview-image {
        max-width: 100%;
        max-height: 150px;
        border-radius: 8px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    @media (min-width: 768px) {
        .preview-image {
            max-height: 200px;
        }
    }

    .remove-preview {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 32px;
        height: 32px;
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
        touch-action: manipulation;
    }

    .remove-preview:active {
        transform: scale(0.9);
    }

    .remove-preview:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    /* Members Section */
    .members-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--gray-200);
    }

    .members-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-800);
    }

    .members-count {
        font-size: 14px;
        color: var(--gray-500);
        background: var(--gray-100);
        padding: 4px 10px;
        border-radius: 12px;
    }

    /* Member Card */
    .members-container {
        margin-bottom: 24px;
    }

    .member-card {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 16px;
        position: relative;
        transition: all 0.2s ease;
    }

    @media (min-width: 640px) {
        .member-card {
            padding: 24px;
        }
    }

    .member-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .member-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-200);
    }

    .member-number {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-600);
        background: var(--gray-200);
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .remove-member {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid var(--gray-300);
        background: white;
        color: var(--gray-600);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        touch-action: manipulation;
    }

    .remove-member:active {
        transform: scale(0.9);
    }

    .remove-member:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    .member-fields {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .member-fields {
            grid-template-columns: 1fr 1fr;
        }
        
        .member-fields .file-upload {
            grid-column: span 2;
        }
    }

    /* Buttons */
    .buttons-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-200);
    }

    @media (min-width: 640px) {
        .buttons-container {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    @media (max-width: 639px) {
        .action-buttons {
            flex-direction: column;
        }
    }

    .btn {
        padding: 16px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-family: 'Inter', -apple-system, sans-serif;
        touch-action: manipulation;
        min-height: 54px;
        width: 100%;
        text-align: center;
    }

    @media (min-width: 768px) {
        .btn {
            padding: 12px 20px;
            font-size: 14px;
            min-height: 44px;
            width: auto;
        }
    }

    .btn:active {
        transform: scale(0.98);
    }

    .btn-primary {
        background: var(--secondary);
        color: white;
        border-color: var(--secondary);
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    @media (min-width: 768px) {
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-secondary:hover {
        background: var(--gray-200);
        border-color: var(--gray-400);
    }

    .btn-success {
        background: var(--success);
        color: white;
        border-color: var(--success);
    }

    .btn-success:hover {
        background: #0da271;
    }

    /* Error State */
    .has-error .form-input,
    .has-error .file-input-wrapper {
        border-color: var(--danger);
    }

    .has-error .form-input:focus,
    .has-error .file-input-wrapper:focus-within {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
    }

    .error-text {
        display: block;
        font-size: 13px;
        color: var(--danger);
        margin-top: 6px;
        line-height: 1.4;
    }

    /* Error Alert */
    .error-alert {
        background: #fef2f2;
        border: 1px solid #fee2e2;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .error-title {
        color: #991b1b;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .error-list {
        margin: 0;
        padding-left: 20px;
        color: #991b1b;
        font-size: 14px;
        line-height: 1.5;
    }

    .error-list li {
        margin-bottom: 4px;
    }

    /* Loading State */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s linear infinite;
    }

    .btn-secondary.btn-loading::after {
        border: 3px solid rgba(107, 114, 128, 0.3);
        border-top-color: var(--gray-600);
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Empty State for Members */
    .empty-members {
        text-align: center;
        padding: 40px 20px;
        background: var(--gray-50);
        border: 2px dashed var(--gray-300);
        border-radius: var(--border-radius);
        margin-bottom: 20px;
    }

    .empty-icon {
        font-size: 36px;
        color: var(--gray-400);
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .empty-text {
        color: var(--gray-500);
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    /* Keyboard Navigation */
    .form-input:focus-visible,
    .btn:focus-visible {
        outline: 2px solid var(--secondary);
        outline-offset: 2px;
    }

    /* Disabled state */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Buat Struktur Organisasi</h1>
        <p class="page-description">
            Tambahkan anggota organisasi beserta informasi detail mereka.
        </p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="error-alert">
            <div class="error-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
        <form id="orgForm" action="{{ route('staff.organization-structure.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            <div class="form-content">
                <!-- Judul Struktur -->
                <div class="form-group @error('title') has-error @enderror">
                    <label class="form-label">
                        Judul Struktur Organisasi
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}"
                        required
                        class="form-input"
                        placeholder="Contoh: Struktur Organisasi Fakultas Teknik 2024"
                        maxlength="200"
                        autocomplete="off"
                    >
                    @error('title')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Anggota Section -->
                <div class="members-header">
                    <h3 class="members-title">Anggota Organisasi</h3>
                    <span class="members-count" id="membersCount">1 Anggota</span>
                </div>

                <div class="members-container" id="membersContainer">
                    <!-- Initial Member -->
                    <div class="member-card" data-index="0">
                        <div class="member-header">
                            <div class="member-number">1</div>
                            <button type="button" class="remove-member" onclick="removeMember(this)" aria-label="Hapus anggota">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="member-fields">
                            <!-- Nama -->
                            <div class="form-group @error('members.0.name') has-error @enderror">
                                <label class="form-label">
                                    Nama Lengkap
                                    <span class="required">*</span>
                                </label>
                                <input 
                                    type="text"
                                    name="members[0][name]"
                                    value="{{ old('members.0.name') }}"
                                    required
                                    class="form-input"
                                    placeholder="Masukkan nama lengkap"
                                    autocomplete="off"
                                >
                                @error('members.0.name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div class="form-group @error('members.0.position') has-error @enderror">
                                <label class="form-label">
                                    Jabatan
                                    <span class="required">*</span>
                                </label>
                                <input 
                                    type="text"
                                    name="members[0][position]"
                                    value="{{ old('members.0.position') }}"
                                    required
                                    class="form-input"
                                    placeholder="Contoh: Ketua, Sekretaris, Bendahara"
                                    autocomplete="off"
                                >
                                @error('members.0.position')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div class="form-group file-upload @error('members.0.photo') has-error @enderror">
                                <label class="form-label">
                                    Foto Profil
                                </label>
                                <div class="file-input-wrapper" role="button" tabindex="0" aria-label="Unggah foto">
                                    <input 
                                        type="file"
                                        name="members[0][photo]"
                                        accept="image/*"
                                        class="file-input member-photo-input"
                                        onchange="previewMemberImage(this)"
                                    >
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <div class="upload-text">Unggah Foto</div>
                                        <div class="upload-hint">Format: JPG, PNG | Maks: 2MB</div>
                                    </div>
                                </div>
                                
                                <div class="image-preview">
                                    <div class="preview-container">
                                        <img class="preview-image" alt="Preview foto">
                                        <button type="button" class="remove-preview" onclick="removeMemberImage(this)" aria-label="Hapus foto">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                @error('members.0.photo')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Member Button -->
                <button type="button" class="btn btn-success" onclick="addMember()">
                    <i class="fas fa-user-plus"></i> Tambah Anggota
                </button>

                <!-- Form Actions -->
                <div class="buttons-container">
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Struktur
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                    
                    <div class="form-help">
                        <small>Pastikan semua informasi yang dimasukkan sudah benar.</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Global variables
let memberIndex = 1;
const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateMembersCount();
    
    // Mobile optimizations
    if (isMobile) {
        setupMobileOptimizations();
    }
    
    // Form submission handler
    const form = document.getElementById('orgForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate at least one member
            const members = document.querySelectorAll('.member-card');
            if (members.length === 0) {
                e.preventDefault();
                showToast('Minimal harus ada 1 anggota', 'error');
                return;
            }
            
            // Validate all required fields
            let isValid = true;
            members.forEach((member, index) => {
                const nameInput = member.querySelector('input[name*="[name]"]');
                const positionInput = member.querySelector('input[name*="[position]"]');
                
                if (!nameInput.value.trim() || !positionInput.value.trim()) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showToast('Semua anggota harus memiliki nama dan jabatan', 'error');
                return;
            }
            
            // Show loading state
            if (submitBtn) {
                submitBtn.classList.add('btn-loading');
                submitBtn.disabled = true;
                submitBtn.setAttribute('aria-busy', 'true');
            }
        });
    }
});

// Add new member
function addMember() {
    const container = document.getElementById('membersContainer');
    const memberCard = document.createElement('div');
    memberCard.className = 'member-card';
    memberCard.setAttribute('data-index', memberIndex);
    
    memberCard.innerHTML = `
        <div class="member-header">
            <div class="member-number">${memberIndex + 1}</div>
            <button type="button" class="remove-member" onclick="removeMember(this)" aria-label="Hapus anggota">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="member-fields">
            <!-- Nama -->
            <div class="form-group">
                <label class="form-label">
                    Nama Lengkap
                    <span class="required">*</span>
                </label>
                <input 
                    type="text"
                    name="members[${memberIndex}][name]"
                    required
                    class="form-input"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="off"
                >
            </div>

            <!-- Jabatan -->
            <div class="form-group">
                <label class="form-label">
                    Jabatan
                    <span class="required">*</span>
                </label>
                <input 
                    type="text"
                    name="members[${memberIndex}][position]"
                    required
                    class="form-input"
                    placeholder="Contoh: Ketua, Sekretaris, Bendahara"
                    autocomplete="off"
                >
            </div>

            <!-- Foto -->
            <div class="form-group file-upload">
                <label class="form-label">
                    Foto Profil
                </label>
                <div class="file-input-wrapper" role="button" tabindex="0" aria-label="Unggah foto">
                    <input 
                        type="file"
                        name="members[${memberIndex}][photo]"
                        accept="image/*"
                        class="file-input member-photo-input"
                        onchange="previewMemberImage(this)"
                    >
                    <div class="upload-content">
                        <div class="upload-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="upload-text">Unggah Foto</div>
                        <div class="upload-hint">Format: JPG, PNG | Maks: 2MB</div>
                    </div>
                </div>
                
                <div class="image-preview">
                    <div class="preview-container">
                        <img class="preview-image" alt="Preview foto">
                        <button type="button" class="remove-preview" onclick="removeMemberImage(this)" aria-label="Hapus foto">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.appendChild(memberCard);
    memberIndex++;
    updateMembersCount();
    showToast('Anggota baru ditambahkan', 'success');
    
    // Scroll to new member (smooth on desktop)
    if (!isMobile) {
        memberCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

// Remove member
function removeMember(button) {
    const memberCard = button.closest('.member-card');
    const members = document.querySelectorAll('.member-card');
    
    // Don't allow removing the last member
    if (members.length <= 1) {
        showToast('Minimal harus ada 1 anggota', 'warning');
        return;
    }
    
    if (confirm('Hapus anggota ini?')) {
        memberCard.remove();
        updateMembersCount();
        renumberMembers();
        showToast('Anggota dihapus', 'info');
    }
}

// Renumber members after removal
function renumberMembers() {
    const members = document.querySelectorAll('.member-card');
    members.forEach((member, index) => {
        member.setAttribute('data-index', index);
        const numberElement = member.querySelector('.member-number');
        if (numberElement) {
            numberElement.textContent = index + 1;
        }
    });
    memberIndex = members.length;
}

// Update members count display
function updateMembersCount() {
    const members = document.querySelectorAll('.member-card');
    const count = members.length;
    const countElement = document.getElementById('membersCount');
    
    if (countElement) {
        countElement.textContent = `${count} Anggota${count > 1 ? '' : ''}`;
    }
}

// Preview member image
function previewMemberImage(input) {
    const file = input.files[0];
    const memberCard = input.closest('.member-card');
    const previewContainer = memberCard.querySelector('.image-preview');
    const previewImage = memberCard.querySelector('.preview-image');
    
    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            showToast('Ukuran file maksimal 2MB', 'error');
            input.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            showToast('Format file harus JPG, PNG, GIF, atau WebP', 'error');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Remove member image preview
function removeMemberImage(button) {
    const previewContainer = button.closest('.image-preview');
    const memberCard = button.closest('.member-card');
    const fileInput = memberCard.querySelector('.member-photo-input');
    
    previewContainer.style.display = 'none';
    if (fileInput) {
        fileInput.value = '';
    }
}

// Toast notification
function showToast(message, type = 'info') {
    // Remove existing toast
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }
    
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        left: 20px;
        padding: 12px 16px;
        background: ${type === 'error' ? '#fef2f2' : type === 'success' ? '#d1fae5' : type === 'warning' ? '#fef3c7' : '#eff6ff'};
        color: ${type === 'error' ? '#991b1b' : type === 'success' ? '#065f46' : type === 'warning' ? '#92400e' : '#1e40af'};
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        text-align: center;
        font-weight: 500;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(-20px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Mobile optimizations
function setupMobileOptimizations() {
    // Larger touch targets for mobile
    const inputs = document.querySelectorAll('input, textarea, select, button');
    inputs.forEach(input => {
        input.style.minHeight = '44px';
    });
    
    // Prevent zoom on iOS
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
        document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="number"]').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.fontSize = '16px';
            });
        });
    }
    
    // Better touch feedback
    const touchElements = document.querySelectorAll('.btn, .file-input-wrapper, .remove-member, .remove-preview');
    touchElements.forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.opacity = '0.8';
        }, { passive: true });
        
        el.addEventListener('touchend', function() {
            this.style.opacity = '1';
        }, { passive: true });
    });
    
    // Prevent double tap zoom
    document.addEventListener('touchstart', function(e) {
        if (e.touches.length > 1) {
            e.preventDefault();
        }
    }, { passive: false });
}

// Handle orientation change
window.addEventListener('orientationchange', function() {
    setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
    }, 100);
});

// Handle keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.type !== 'textarea') {
        e.preventDefault();
    }
    
    // Escape key to remove focus
    if (e.key === 'Escape') {
        document.activeElement.blur();
    }
});
</script>
@endsection