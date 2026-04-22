@extends('layouts.admin')

@section('page-title', 'Tambah Staff Baru')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

:root {
    --ink:        #0c0e14;
    --ink-2:      #1e2130;
    --ink-3:      #4a5068;
    --ink-4:      #8891aa;
    --surface:    #ffffff;
    --surface-2:  #f6f7fb;
    --surface-3:  #eef0f8;
    --border:     rgba(30, 33, 48, 0.09);
    --border-md:  rgba(30, 33, 48, 0.15);

    --blue:       #2563eb;
    --blue-2:     #1d4ed8;
    --blue-bg:    #eff4ff;
    --blue-text:  #1a3ea8;
    --blue-ring:  rgba(37, 99, 235, 0.2);

    --green:      #059669;
    --green-bg:   #ecfdf5;
    --green-ring: rgba(5, 150, 105, 0.2);

    --red:        #dc2626;
    --red-bg:     #fff1f2;
    --red-ring:   rgba(220, 38, 38, 0.2);

    --amber:      #d97706;
    --amber-bg:   #fffbeb;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl: 28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface-2); color: var(--ink-2); }

/* ── MAIN CONTAINER ── */
.staff-create-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .staff-create-page { padding: 32px 24px 64px; } }

/* ── BREADCRUMB ── */
.sc-crumb {
    width: 100%;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 20px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .sc-crumb { font-size: 0.78rem; margin-bottom: 24px; } }
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ── HEADER ── */
.page-header {
    margin-bottom: 24px;
}
@media (min-width: 640px) { .page-header { margin-bottom: 28px; } }

.page-title {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.02em;
    margin-bottom: 6px;
}
@media (min-width: 640px) { .page-title { font-size: 1.5rem; margin-bottom: 8px; } }

.page-subtitle {
    font-size: 0.8rem; color: var(--ink-3);
}
@media (min-width: 640px) { .page-subtitle { font-size: 0.85rem; } }

/* ── ALERT ERROR ── */
.alert-error {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    background: var(--red-bg);
    border: 1px solid rgba(220,38,38,0.2);
    border-radius: var(--r-md);
    margin-bottom: 24px;
    animation: slideDown 0.3s ease-out;
}
@media (min-width: 640px) { .alert-error { padding: 16px 20px; margin-bottom: 28px; } }
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
.alert-icon { font-size: 1.1rem; flex-shrink: 0; }
.alert-content { flex: 1; }
.alert-content strong {
    display: block;
    margin-bottom: 8px;
    color: var(--red);
    font-size: 0.8rem;
}
.alert-content ul {
    margin: 0;
    padding-left: 20px;
    color: var(--red);
    font-size: 0.75rem;
}
.alert-content li { margin-bottom: 4px; }
.alert-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--red);
    opacity: 0.5;
    transition: opacity 0.2s;
    line-height: 1;
}
.alert-close:hover { opacity: 1; }

/* ── FORM CARD ── */
.form-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    padding: 20px;
    margin-bottom: 20px;
    animation: fadeIn 0.4s ease;
}
@media (min-width: 640px) {
    .form-card { padding: 32px; border-radius: var(--r-2xl); margin-bottom: 24px; }
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Form Group */
.form-group {
    margin-bottom: 24px;
}
@media (min-width: 640px) { .form-group { margin-bottom: 28px; } }
.form-group:last-of-type { margin-bottom: 0; }

/* Form Label */
.form-label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
}
@media (min-width: 640px) { .form-label { font-size: 0.84rem; margin-bottom: 10px; } }
.required {
    color: var(--red);
    margin-left: 4px;
}

/* Form Input */
.form-input {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid var(--border-md);
    border-radius: var(--r-md);
    font-size: 0.85rem;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
    background: var(--surface);
}
@media (min-width: 640px) {
    .form-input { padding: 11px 15px; font-size: 0.9rem; }
}
.form-input:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-ring);
}
.form-input.is-invalid {
    border-color: var(--red);
    background: var(--red-bg);
}
.form-input.is-invalid:focus {
    box-shadow: 0 0 0 3px var(--red-ring);
}

/* Field Hint */
.field-hint {
    margin-top: 6px;
    font-size: 0.7rem;
    color: var(--ink-4);
    display: flex;
    align-items: center;
    gap: 6px;
}
@media (min-width: 640px) { .field-hint { font-size: 0.75rem; margin-top: 8px; } }
.field-hint i { font-size: 0.65rem; color: var(--blue); }

/* Error Message */
.error-message {
    margin-top: 6px;
    font-size: 0.7rem;
    color: var(--red);
    display: flex;
    align-items: center;
    gap: 6px;
}
@media (min-width: 640px) { .error-message { font-size: 0.75rem; margin-top: 8px; } }

/* ── FORM ACTIONS ── */
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}
@media (min-width: 640px) {
    .form-actions { gap: 16px; margin-top: 32px; padding-top: 28px; }
}
@media (max-width: 640px) {
    .form-actions { flex-direction: column; }
}

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    border: 1.5px solid transparent;
}
@media (min-width: 640px) {
    .btn-primary, .btn-secondary { padding: 12px 28px; font-size: 0.875rem; }
}
@media (max-width: 640px) {
    .btn-primary, .btn-secondary { width: 100%; }
}

.btn-primary {
    background: var(--blue);
    color: white;
    border-color: var(--blue);
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.btn-primary:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.4);
}
.btn-primary:active { transform: translateY(0); }

.btn-secondary {
    background: var(--surface);
    color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-secondary:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
}

/* ── INFO CARD ── */
.info-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-lg);
}
@media (min-width: 640px) {
    .info-card { gap: 16px; padding: 18px 24px; border-radius: var(--r-xl); }
}
.info-icon {
    font-size: 1.1rem;
    flex-shrink: 0;
}
.info-content {
    flex: 1;
    font-size: 0.75rem;
    color: var(--ink-3);
    line-height: 1.5;
}
@media (min-width: 640px) { .info-content { font-size: 0.8rem; } }
.info-content strong {
    display: block;
    margin-bottom: 6px;
    color: var(--ink-2);
    font-weight: 700;
}
.info-content p { margin: 0; }

/* Touch-friendly for mobile */
@media (max-width: 640px) {
    .form-input, .btn-primary, .btn-secondary {
        font-size: 16px;
        touch-action: manipulation;
    }
}
</style>

<div class="staff-create-page">
    
    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('admin.staff.index') }}"><i class="fas fa-users"></i> Manajemen Staff</a>
        <i class="fas fa-chevron-right"></i>
        <span>Tambah Staff Baru</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-plus" style="margin-right: 8px; color: var(--blue);"></i>
            Tambah Staff Baru
        </h1>
        <p class="page-subtitle">Isi data staff dengan lengkap untuk memberikan akses ke sistem</p>
    </div>

    {{-- ERROR ALERT --}}
    @if($errors->any())
        <div class="alert-error" id="errorAlert">
            <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
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

    {{-- FORM CARD --}}
    <div class="form-card">
        <form action="{{ route('admin.staff.store') }}" method="POST" id="staffForm">
            @csrf

            {{-- Nama Field --}}
            <div class="form-group">
                <label for="name" class="form-label">
                    Nama Lengkap <span class="required">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       class="form-input @error('name') is-invalid @enderror" 
                       placeholder="Masukkan nama lengkap"
                       autofocus
                       required>
                @error('name')
                    <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="form-group">
                <label for="email" class="form-label">
                    Alamat Email <span class="required">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       class="form-input @error('email') is-invalid @enderror" 
                       placeholder="staff@example.com"
                       required>
                <div class="field-hint">
                    <i class="fas fa-info-circle"></i>
                    Email akan digunakan untuk login staff
                </div>
                @error('email')
                    <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="form-group">
                <label for="password" class="form-label">
                    Password <span class="required">*</span>
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-input @error('password') is-invalid @enderror" 
                       placeholder="Minimal 8 karakter"
                       required>
                <div class="field-hint">
                    <i class="fas fa-lock"></i>
                    Password minimal 8 karakter untuk keamanan
                </div>
                @error('password')
                    <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Password Confirmation Field --}}
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password <span class="required">*</span>
                </label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-input" 
                       placeholder="Ketik ulang password"
                       required>
            </div>

            {{-- Form Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Simpan Staff
                </button>
                <a href="{{ route('admin.staff.index') }}" class="btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    {{-- INFO CARD --}}
    <div class="info-card">
        <div class="info-icon"><i class="fas fa-info-circle"></i></div>
        <div class="info-content">
            <strong>Informasi Penting:</strong>
            <p>Staff yang ditambahkan akan mendapatkan akses ke sistem. Password harus diingat oleh staff bersangkutan. Staff dapat mengubah password mereka setelah login pertama kali.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto close alert after 5 seconds
    const alert = document.getElementById('errorAlert');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }

    // Form validation and submission
    const form = document.getElementById('staffForm');
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Password validation
            const password = passwordInput ? passwordInput.value : '';
            const passwordConfirm = passwordConfirmInput ? passwordConfirmInput.value : '';

            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                if (passwordConfirmInput) passwordConfirmInput.focus();
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter!');
                if (passwordInput) passwordInput.focus();
                return false;
            }

            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            }
        });
    }

    // Real-time password confirmation validation
    if (passwordConfirmInput && passwordInput) {
        function validatePasswordMatch() {
            if (passwordInput.value && passwordConfirmInput.value) {
                if (passwordInput.value !== passwordConfirmInput.value) {
                    passwordConfirmInput.classList.add('is-invalid');
                    passwordConfirmInput.style.borderColor = 'var(--red)';
                    
                    // Add error message if not exists
                    let errorMsg = passwordConfirmInput.parentElement.querySelector('.password-match-error');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message password-match-error';
                        errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Password tidak cocok';
                        passwordConfirmInput.parentElement.appendChild(errorMsg);
                    }
                } else {
                    passwordConfirmInput.classList.remove('is-invalid');
                    passwordConfirmInput.style.borderColor = '';
                    const errorMsg = passwordConfirmInput.parentElement.querySelector('.password-match-error');
                    if (errorMsg) errorMsg.remove();
                }
            } else {
                passwordConfirmInput.classList.remove('is-invalid');
                passwordConfirmInput.style.borderColor = '';
                const errorMsg = passwordConfirmInput.parentElement.querySelector('.password-match-error');
                if (errorMsg) errorMsg.remove();
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        passwordConfirmInput.addEventListener('input', validatePasswordMatch);
    }

    // Real-time password strength indicator (optional enhancement)
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const hint = this.parentElement.querySelector('.field-hint');
            
            if (password.length > 0 && password.length < 8) {
                hint.style.color = 'var(--red)';
                hint.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Password minimal 8 karakter';
            } else if (password.length >= 8) {
                hint.style.color = 'var(--green)';
                hint.innerHTML = '<i class="fas fa-check-circle"></i> Password kuat (minimal 8 karakter)';
            } else {
                hint.style.color = '';
                hint.innerHTML = '<i class="fas fa-lock"></i> Password minimal 8 karakter untuk keamanan';
            }
        });
    }

    // Fix for iOS zoom on input focus
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });
});
</script>
@endsection