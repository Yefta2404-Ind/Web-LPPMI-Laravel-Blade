@extends('layouts.admin')

@section('content')
<div class="staff-create-page">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">👤 Tambah Staff Baru</h1>
        <p class="page-subtitle">Isi data staff dengan lengkap</p>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert-error">
            <div class="alert-icon">⚠️</div>
            <div class="alert-content">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf

            <!-- Nama Field -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       class="form-input @error('name') is-invalid @enderror" 
                       placeholder="Masukkan nama lengkap"
                       required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email <span class="required">*</span></label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       class="form-input @error('email') is-invalid @enderror" 
                       placeholder="contoh@email.com"
                       required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">Password <span class="required">*</span></label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-input @error('password') is-invalid @enderror" 
                       placeholder="Minimal 8 karakter"
                       required>
                <p class="field-hint">Minimal 8 karakter</p>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required">*</span></label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-input" 
                       placeholder="Ketik ulang password"
                       required>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <span>💾</span> Simpan Staff
                </button>
                <a href="{{ route('admin.staff.index') }}" class="btn-secondary">
                    <span>✖</span> Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="info-card">
        <div class="info-icon">ℹ️</div>
        <div class="info-content">
            <strong>Informasi:</strong>
            <p>Staff yang ditambahkan akan mendapatkan akses ke sistem. Password harus diingat oleh staff bersangkutan.</p>
        </div>
    </div>
</div>

<style>
/* ===== VARIABLES ===== */
:root {
    --blue: #0066CC;
    --blue-light: #E6F0FF;
    --red: #CC0000;
    --red-light: #FFE6E6;
    --yellow: #FFCC00;
    --yellow-light: #FFF7E6;
    --gray: #666666;
    --gray-light: #F5F5F5;
    --gray-border: #DDDDDD;
    --gray-dark: #333333;
    --white: #FFFFFF;
}

/* ===== BASE ===== */
.staff-create-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 30px 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--gray-light);
    min-height: 100vh;
}

/* ===== HEADER ===== */
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: var(--gray-dark);
    margin: 0 0 5px 0;
}

.page-subtitle {
    font-size: 14px;
    color: var(--gray);
    margin: 0;
}

/* ===== ALERT ERROR ===== */
.alert-error {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px 20px;
    background: var(--red-light);
    border: 1px solid var(--red);
    border-radius: 4px;
    margin-bottom: 25px;
}

.alert-icon {
    font-size: 20px;
}

.alert-content {
    flex: 1;
}

.alert-content strong {
    display: block;
    margin-bottom: 8px;
    color: var(--red);
}

.alert-content ul {
    margin: 0;
    padding-left: 20px;
    color: var(--red);
}

.alert-content li {
    margin-bottom: 3px;
    font-size: 13px;
}

.alert-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--red);
    opacity: 0.5;
}

.alert-close:hover {
    opacity: 1;
}

/* ===== FORM CARD ===== */
.form-card {
    background: var(--white);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    padding: 30px;
    margin-bottom: 20px;
}

/* Form Group */
.form-group {
    margin-bottom: 25px;
}

.form-group:last-child {
    margin-bottom: 0;
}

/* Form Label */
.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--gray-dark);
    font-size: 14px;
}

.required {
    color: var(--red);
    margin-left: 3px;
}

/* Form Input */
.form-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    font-size: 14px;
    transition: all 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-light);
}

.form-input.is-invalid {
    border-color: var(--red);
    background: var(--red-light);
}

/* Field Hint */
.field-hint {
    margin-top: 5px;
    font-size: 12px;
    color: var(--gray);
}

/* Error Message */
.error-message {
    margin-top: 5px;
    font-size: 12px;
    color: var(--red);
}

/* ===== FORM ACTIONS ===== */
.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--gray-border);
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: var(--blue);
    color: var(--white);
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
}

.btn-primary:hover {
    background: #0052a3;
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: var(--white);
    color: var(--gray);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
}

.btn-secondary:hover {
    background: var(--gray-light);
    border-color: var(--gray);
}

/* ===== INFO CARD ===== */
.info-card {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px 20px;
    background: var(--yellow-light);
    border: 1px solid var(--yellow);
    border-radius: 4px;
}

.info-icon {
    font-size: 20px;
}

.info-content {
    flex: 1;
    font-size: 13px;
    color: var(--gray-dark);
}

.info-content strong {
    display: block;
    margin-bottom: 5px;
    color: #996600;
}

.info-content p {
    margin: 0;
    line-height: 1.5;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .staff-create-page {
        padding: 20px 15px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .form-card {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .staff-create-page {
        padding: 15px 10px;
    }
    
    .form-card {
        padding: 15px;
    }
    
    .alert-error {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .alert-close {
        align-self: flex-end;
    }
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-card {
    animation: fadeIn 0.3s ease;
}
</style>

<script>
// Auto close alert after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert-error');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
});
</script>
@endsection