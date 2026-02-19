@extends('layouts.cms')

@section('content')
<style>
/* ============================================
   CMS PASSWORD MANAGEMENT - UNIQUE STYLES v3.0
   Prefix: pwd-cms-xxx (anti collision)
   Background: White
   ============================================ */

/* ----- CONTAINER & LAYOUT ----- */
.pwd-cms-wrapper {
    max-width: 720px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.pwd-cms-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 4px 20px -8px rgba(0, 0, 0, 0.06);
    padding: 2.5rem;
    border: 1px solid #edf2f7;
    transition: all 0.2s ease;
}

/* ----- HEADER ----- */
.pwd-cms-header {
    margin-bottom: 2.25rem;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 1.75rem;
}

.pwd-cms-title {
    font-size: 1.875rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #0f172a;
    margin-bottom: 0.5rem;
    line-height: 1.2;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pwd-cms-title i {
    color: #2563eb;
    font-size: 1.75rem;
}

.pwd-cms-subtitle {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0;
    line-height: 1.5;
}

/* ----- ALERT ----- */
.pwd-cms-alert {
    display: flex;
    align-items: flex-start;
    gap: 0.875rem;
    padding: 1rem 1.25rem;
    border-radius: 16px;
    margin-bottom: 1.75rem;
    font-size: 0.9375rem;
    animation: pwdSlideIn 0.25s ease-out;
}

.pwd-cms-alert-success {
    background: #f0fdf4;
    border: 1px solid #dcfce7;
    color: #166534;
}

.pwd-cms-alert-error {
    background: #fef2f2;
    border: 1px solid #fee2e2;
    color: #991b1b;
}

.pwd-cms-alert i {
    font-size: 1.125rem;
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.pwd-cms-error-list {
    margin-top: 0.5rem;
    margin-left: 1.25rem;
    list-style-type: disc;
}

.pwd-cms-error-list li {
    margin-bottom: 0.25rem;
}

/* ----- FORM ----- */
.pwd-cms-form-group {
    margin-bottom: 1.75rem;
}

.pwd-cms-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.pwd-cms-label span {
    color: #ef4444;
    margin-left: 0.25rem;
}

.pwd-cms-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.pwd-cms-input-icon {
    position: absolute;
    left: 1rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.25rem;
    height: 1.25rem;
    pointer-events: none;
}

.pwd-cms-input-icon i {
    font-size: 1.125rem;
}

.pwd-cms-input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    font-size: 0.9375rem;
    color: #0f172a;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    transition: all 0.2s ease;
}

.pwd-cms-input:hover {
    border-color: #94a3b8;
}

.pwd-cms-input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
}

.pwd-cms-input::placeholder {
    color: #94a3b8;
    font-weight: 400;
    font-size: 0.875rem;
}

.pwd-cms-input-error {
    border-color: #ef4444;
}

.pwd-cms-input-error:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
}

.pwd-cms-error-message {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    margin-top: 0.5rem;
    font-size: 0.8125rem;
    color: #ef4444;
}

.pwd-cms-error-message i {
    font-size: 0.875rem;
}

/* ----- TOGGLE PASSWORD ----- */
.pwd-cms-toggle {
    position: absolute;
    right: 1rem;
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    padding: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    border-radius: 8px;
}

.pwd-cms-toggle:hover {
    color: #2563eb;
    background: rgba(37, 99, 235, 0.04);
}

.pwd-cms-toggle i {
    font-size: 1.125rem;
}

/* ----- PASSWORD STRENGTH ----- */
.pwd-cms-strength {
    margin-top: 0.875rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.pwd-cms-meter {
    flex: 1;
    height: 6px;
    background: #e2e8f0;
    border-radius: 100px;
    overflow: hidden;
}

.pwd-cms-bar {
    height: 100%;
    width: 0;
    border-radius: 100px;
    transition: all 0.3s ease;
}

.pwd-cms-bar.weak { 
    width: 25%; 
    background: #ef4444; 
}
.pwd-cms-bar.fair { 
    width: 50%; 
    background: #f59e0b; 
}
.pwd-cms-bar.good { 
    width: 75%; 
    background: #3b82f6; 
}
.pwd-cms-bar.strong { 
    width: 100%; 
    background: #22c55e; 
}

.pwd-cms-strength-text {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #475569;
    min-width: 70px;
    text-align: right;
}

/* ----- BUTTONS ----- */
.pwd-cms-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.pwd-cms-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 0.75rem 1.75rem;
    font-size: 0.9375rem;
    font-weight: 600;
    border-radius: 14px;
    transition: all 0.2s ease;
    cursor: pointer;
    border: 1.5px solid transparent;
    text-decoration: none;
    line-height: 1;
    white-space: nowrap;
}

.pwd-cms-btn i {
    font-size: 1.125rem;
}

.pwd-cms-btn-primary {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

.pwd-cms-btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.pwd-cms-btn-primary:active {
    transform: translateY(0);
}

.pwd-cms-btn-secondary {
    background: white;
    color: #475569;
    border-color: #e2e8f0;
}

.pwd-cms-btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #0f172a;
}

/* ----- SECURITY TIPS ----- */
.pwd-cms-tips {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
}

.pwd-cms-tips-title {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1.25rem;
}

.pwd-cms-tips-title i {
    color: #2563eb;
    font-size: 1.125rem;
}

.pwd-cms-tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.pwd-cms-tips-list li {
    display: flex;
    align-items: baseline;
    gap: 0.625rem;
    font-size: 0.875rem;
    color: #475569;
}

.pwd-cms-tips-list li i {
    color: #22c55e;
    font-size: 0.875rem;
    flex-shrink: 0;
}

/* ----- LOADING SPINNER ----- */
.pwd-cms-spin {
    animation: pwdSpin 0.8s linear infinite;
}

@keyframes pwdSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes pwdSlideIn {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ----- RESPONSIVE BREAKPOINTS ----- */
@media (max-width: 768px) {
    .pwd-cms-wrapper {
        margin: 1rem auto;
        padding: 0 1rem;
    }
    
    .pwd-cms-card {
        padding: 1.75rem;
        border-radius: 20px;
    }
    
    .pwd-cms-title {
        font-size: 1.75rem;
    }
    
    .pwd-cms-actions {
        flex-direction: column;
    }
    
    .pwd-cms-btn {
        width: 100%;
        padding: 0.875rem;
    }
}

@media (max-width: 480px) {
    .pwd-cms-card {
        padding: 1.25rem;
    }
    
    .pwd-cms-title {
        font-size: 1.5rem;
    }
    
    .pwd-cms-subtitle {
        font-size: 0.8125rem;
    }
    
    .pwd-cms-input {
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        font-size: 0.875rem;
    }
    
    .pwd-cms-input-icon {
        left: 0.875rem;
    }
    
    .pwd-cms-input-icon i {
        font-size: 1rem;
    }
    
    .pwd-cms-strength {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.375rem;
    }
    
    .pwd-cms-strength-text {
        text-align: left;
    }
    
    .pwd-cms-tips {
        padding: 1.25rem;
    }
    
    .pwd-cms-tips-list li {
        font-size: 0.8125rem;
    }
}

/* ----- PRINT STYLES ----- */
@media print {
    .pwd-cms-card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .pwd-cms-btn,
    .pwd-cms-toggle,
    .pwd-cms-tips {
        display: none;
    }
}
</style>

<div class="pwd-cms-wrapper">
    <div class="pwd-cms-card">
        <!-- Header -->
        <div class="pwd-cms-header">
            <h2 class="pwd-cms-title">
                <i class="fas fa-lock"></i>
                Ubah Password
            </h2>
            <p class="pwd-cms-subtitle">
                Gunakan password yang kuat dan berbeda dari akun lain
            </p>
        </div>

        <!-- Alert Status -->
        @if(session('status'))
            <div class="pwd-cms-alert pwd-cms-alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Error Summary -->
        @if($errors->any())
            <div class="pwd-cms-alert pwd-cms-alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div style="flex:1">
                    <strong style="display:block; margin-bottom:0.25rem;">Terdapat kesalahan:</strong>
                    <ul class="pwd-cms-error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('staff.password.update') }}" id="pwdCmsForm">
            @csrf

            <!-- Current Password -->
            <div class="pwd-cms-form-group">
                <label class="pwd-cms-label" for="current_password">
                    Password Lama <span>*</span>
                </label>
                <div class="pwd-cms-input-wrapper">
                    <span class="pwd-cms-input-icon">
                        <i class="fas fa-key"></i>
                    </span>
                    <input 
                        type="password" 
                        name="current_password" 
                        id="current_password"
                        class="pwd-cms-input @error('current_password') pwd-cms-input-error @enderror" 
                        required 
                        placeholder="Masukkan password lama"
                        autocomplete="current-password"
                    >
                    <button type="button" class="pwd-cms-toggle" onclick="pwdTogglePassword(this)" aria-label="Tampilkan password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                    <div class="pwd-cms-error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="pwd-cms-form-group">
                <label class="pwd-cms-label" for="password">
                    Password Baru <span>*</span>
                </label>
                <div class="pwd-cms-input-wrapper">
                    <span class="pwd-cms-input-icon">
                        <i class="fas fa-shield-alt"></i>
                    </span>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="pwd-cms-input @error('password') pwd-cms-input-error @enderror" 
                        required 
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        onkeyup="pwdCheckStrength(this.value)"
                    >
                    <button type="button" class="pwd-cms-toggle" onclick="pwdTogglePassword(this)" aria-label="Tampilkan password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <!-- Strength Meter -->
                <div class="pwd-cms-strength" id="pwdStrengthContainer" style="display: none;">
                    <div class="pwd-cms-meter">
                        <div class="pwd-cms-bar" id="pwdStrengthBar"></div>
                    </div>
                    <span class="pwd-cms-strength-text" id="pwdStrengthText"></span>
                </div>
                
                @error('password')
                    <div class="pwd-cms-error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="pwd-cms-form-group">
                <label class="pwd-cms-label" for="password_confirmation">
                    Konfirmasi Password Baru <span>*</span>
                </label>
                <div class="pwd-cms-input-wrapper">
                    <span class="pwd-cms-input-icon">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="pwd-cms-input" 
                        required 
                        placeholder="Ketik ulang password baru"
                        autocomplete="new-password"
                        onkeyup="pwdValidateMatch()"
                    >
                    <button type="button" class="pwd-cms-toggle" onclick="pwdTogglePassword(this)" aria-label="Tampilkan password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div id="pwdMatchMessage" style="font-size:0.8125rem; margin-top:0.375rem;"></div>
            </div>

            <!-- Actions -->
            <div class="pwd-cms-actions">
                <button type="submit" class="pwd-cms-btn pwd-cms-btn-primary" id="pwdSubmitBtn">
                    <i class="fas fa-save"></i>
                    Simpan Password
                </button>
                <a href="{{ url()->previous() }}" class="pwd-cms-btn pwd-cms-btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>

        <!-- Security Tips -->
        <div class="pwd-cms-tips">
            <div class="pwd-cms-tips-title">
                <i class="fas fa-shield-alt"></i>
                Tips Keamanan Password
            </div>
            <ul class="pwd-cms-tips-list">
                <li>
                    <i class="fas fa-check"></i>
                    Gunakan minimal 8 karakter
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Kombinasikan huruf besar, huruf kecil, angka, dan simbol
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Jangan gunakan password yang sama dengan akun lain
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Hindari informasi pribadi (tanggal lahir, nama)
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Ganti password secara berkala (3-6 bulan)
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
// ============================================
// PASSWORD MANAGEMENT - UNIQUE SCRIPT
// Prefix: pwd (anti collision)
// Version: 3.0
// ============================================

(function() {
    'use strict';

    // Check strength on page load if there's value
    window.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('password');
        if (password && password.value) {
            pwdCheckStrength(password.value);
        }
    });

    // Toggle password visibility
    window.pwdTogglePassword = function(button) {
        const wrapper = button.closest('.pwd-cms-input-wrapper');
        const input = wrapper.querySelector('input');
        const icon = button.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            button.setAttribute('aria-label', 'Sembunyikan password');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            button.setAttribute('aria-label', 'Tampilkan password');
        }
    };

    // Check password strength
    window.pwdCheckStrength = function(password) {
        const container = document.getElementById('pwdStrengthContainer');
        const bar = document.getElementById('pwdStrengthBar');
        const text = document.getElementById('pwdStrengthText');
        
        if (!password) {
            container.style.display = 'none';
            return;
        }
        
        container.style.display = 'flex';
        
        let strength = 0;
        
        // Length checks
        if (password.length >= 8) strength += 1;
        if (password.length >= 12) strength += 2;
        
        // Character variety
        if (/[a-z]/.test(password)) strength += 1;
        if (/[A-Z]/.test(password)) strength += 1;
        if (/[0-9]/.test(password)) strength += 1;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 2;
        
        // Cap at 6
        strength = Math.min(strength, 6);
        
        // Set class and text
        bar.className = 'pwd-cms-bar';
        
        if (strength <= 2) {
            bar.classList.add('weak');
            text.textContent = 'Lemah';
        } else if (strength <= 3) {
            bar.classList.add('fair');
            text.textContent = 'Cukup';
        } else if (strength <= 4) {
            bar.classList.add('good');
            text.textContent = 'Baik';
        } else {
            bar.classList.add('strong');
            text.textContent = 'Kuat';
        }
        
        // Adjust width
        if (bar.classList.contains('weak')) bar.style.width = '25%';
        else if (bar.classList.contains('fair')) bar.style.width = '50%';
        else if (bar.classList.contains('good')) bar.style.width = '75%';
        else if (bar.classList.contains('strong')) bar.style.width = '100%';
    };

    // Validate password match
    window.pwdValidateMatch = function() {
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const message = document.getElementById('pwdMatchMessage');
        
        if (!confirm.value) {
            message.innerHTML = '';
            return;
        }
        
        if (password.value !== confirm.value) {
            message.innerHTML = '<i class="fas fa-times-circle" style="color:#ef4444; margin-right:4px;"></i><span style="color:#ef4444;">Password tidak cocok</span>';
            confirm.setCustomValidity('Password tidak cocok');
        } else {
            message.innerHTML = '<i class="fas fa-check-circle" style="color:#22c55e; margin-right:4px;"></i><span style="color:#22c55e;">Password cocok</span>';
            confirm.setCustomValidity('');
        }
    };

    // Form submission handling
    const form = document.getElementById('pwdCmsForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('pwdSubmitBtn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner pwd-cms-spin"></i> Memproses...';
            }
        });
    }

    // Auto-hide success alert
    setTimeout(function() {
        const alerts = document.querySelectorAll('.pwd-cms-alert-success');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(function() { 
                if (alert.parentNode) alert.remove(); 
            }, 300);
        });
    }, 5000);

})();
</script>

<!-- Font Awesome 6 (Free) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection