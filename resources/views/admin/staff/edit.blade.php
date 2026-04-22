@extends('layouts.admin')

@section('page-title', 'Edit Staff')

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

/* ── OUTER WRAP ── */
.sc-outer {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .sc-outer { padding: 32px 24px 64px; } }
@media (min-width: 1024px) { .sc-outer { padding: 44px 24px 80px; } }

/* ── BREADCRUMB ── */
.sc-crumb {
    width: 100%; max-width: 700px;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 16px;
    flex-wrap: wrap;
}
@media (min-width: 640px) {
    .sc-crumb { font-size: 0.78rem; margin-bottom: 20px; }
}
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ── CARD ── */
.sc-card {
    width: 100%; max-width: 700px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(12, 14, 20, 0.06);
    animation: cardIn 0.4s ease;
}
@media (min-width: 640px) {
    .sc-card { border-radius: var(--r-2xl); }
}
@keyframes cardIn { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

/* ── CARD HEADER ── */
.sc-head {
    padding: 20px 20px 18px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start; gap: 14px;
    background: linear-gradient(135deg, var(--surface) 0%, var(--blue-bg) 100%);
    position: relative;
    overflow: hidden;
}
@media (min-width: 640px) {
    .sc-head { padding: 28px 32px 24px; gap: 16px; }
}
.sc-head::after {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 140px; height: 140px;
    border-radius: 50%;
    background: rgba(37, 99, 235, 0.06);
    pointer-events: none;
}
@media (min-width: 640px) {
    .sc-head::after { width: 160px; height: 160px; }
}
.sc-head-ico {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    background: var(--blue);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.1rem;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
@media (min-width: 640px) {
    .sc-head-ico { width: 52px; height: 52px; font-size: 1.25rem; border-radius: var(--r-lg); }
}
.sc-head-text h1 {
    font-family: 'Sora', sans-serif;
    font-size: 1.1rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.03em;
    line-height: 1.25; margin-bottom: 4px;
}
@media (min-width: 640px) {
    .sc-head-text h1 { font-size: 1.25rem; margin-bottom: 5px; }
}
.sc-head-text p { font-size: 0.8rem; color: var(--ink-3); line-height: 1.4; }
@media (min-width: 640px) {
    .sc-head-text p { font-size: 0.85rem; line-height: 1.5; }
}

/* ── BODY ── */
.sc-body { padding: 20px; }
@media (min-width: 640px) { .sc-body { padding: 32px; } }

/* ── ERROR ALERT ── */
.sc-err {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--red-bg);
    border: 1px solid rgba(220,38,38,0.2);
    border-radius: var(--r-md);
    padding: 12px 14px;
    margin-bottom: 20px;
    font-size: 0.8rem; color: var(--red);
}
@media (min-width: 640px) {
    .sc-err { padding: 14px 16px; margin-bottom: 28px; font-size: 0.85rem; }
}
.sc-err i { flex-shrink: 0; margin-top: 2px; }
.sc-err ul { margin: 0; padding-left: 16px; }
.sc-err li { margin-bottom: 2px; }

/* ── SUCCESS ALERT ── */
.sc-success {
    display: flex; align-items: center; gap: 10px;
    background: var(--green-bg);
    border: 1px solid rgba(5,150,105,0.2);
    border-radius: var(--r-md);
    padding: 12px 14px;
    margin-bottom: 20px;
    font-size: 0.8rem; color: var(--green);
    font-weight: 500;
}
@media (min-width: 640px) {
    .sc-success { padding: 14px 16px; margin-bottom: 28px; font-size: 0.85rem; }
}
.sc-success i { flex-shrink: 0; font-size: 1rem; }

/* ── FORM ── */
.sc-form { display: flex; flex-direction: column; gap: 20px; }
@media (min-width: 640px) { .sc-form { gap: 24px; } }

/* ── FORM GROUP ── */
.fg { display: flex; flex-direction: column; gap: 6px; }
@media (min-width: 640px) { .fg { gap: 7px; } }

.fg-label {
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2); display: flex; align-items: center; gap: 5px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .fg-label { font-size: 0.84rem; } }
.fg-label .req { color: var(--red); font-size: 0.9em; }
.fg-label .opt {
    font-size: 0.65rem; font-weight: 500; color: var(--ink-4);
    background: var(--surface-3);
    border: 1px solid var(--border-md);
    padding: 1px 6px; border-radius: 99px;
}
@media (min-width: 640px) {
    .fg-label .opt { font-size: 0.68rem; padding: 1px 7px; }
}

.fg-hint {
    font-size: 0.74rem; color: var(--ink-4); line-height: 1.4;
    display: flex; align-items: flex-start; gap: 6px;
}
@media (min-width: 640px) {
    .fg-hint { font-size: 0.78rem; line-height: 1.5; }
}
.fg-hint i { margin-top: 2px; font-size: 0.7rem; flex-shrink: 0; color: var(--blue); }

/* ── INPUTS ── */
.fc {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid var(--border-md);
    border-radius: var(--r-md);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem; color: var(--ink);
    background: var(--surface);
    transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
    outline: none;
}
@media (min-width: 640px) {
    .fc { padding: 11px 15px; font-size: 0.9rem; }
}
.fc::placeholder { color: var(--ink-4); }
.fc:hover  { border-color: rgba(37,99,235,0.35); }
.fc:focus  { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-ring); }
.fc.error  { border-color: var(--red); background: var(--red-bg); }
.fc.error:focus { box-shadow: 0 0 0 3px var(--red-ring); }

/* ── DIVIDER ── */
.sc-divider {
    height: 1px; background: var(--border); margin: 2px 0;
}
@media (min-width: 640px) { .sc-divider { margin: 4px 0; } }

/* ── INFO BLOCK ── */
.info-block {
    display: flex; align-items: flex-start; gap: 12px;
    background: var(--surface-2);
    border: 1.5px solid var(--border);
    border-radius: var(--r-md);
    padding: 14px;
    margin-top: 8px;
}
@media (min-width: 640px) {
    .info-block { gap: 16px; border-radius: var(--r-lg); padding: 18px; margin-top: 12px; }
}
.info-block-ico {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    background: var(--surface-3);
    border: 1px dashed var(--border-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; color: var(--ink-4);
    flex-shrink: 0;
}
@media (min-width: 640px) {
    .info-block-ico { width: 52px; height: 52px; font-size: 1.3rem; }
}
.info-block-text h4 {
    font-family: 'Sora', sans-serif;
    font-size: 0.8rem; font-weight: 700; color: var(--ink);
    margin-bottom: 4px;
}
@media (min-width: 640px) {
    .info-block-text h4 { font-size: 0.875rem; margin-bottom: 5px; }
}
.info-block-text p { font-size: 0.72rem; color: var(--ink-3); line-height: 1.4; }
@media (min-width: 640px) {
    .info-block-text p { font-size: 0.78rem; line-height: 1.5; }
}

/* ── FOOTER ── */
.sc-foot {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
    padding: 16px 20px;
    background: var(--surface-2);
    border-top: 1px solid var(--border);
}
@media (min-width: 640px) {
    .sc-foot { padding: 22px 32px; gap: 16px; }
}
.sc-foot-hint { 
    font-size: 0.7rem; color: var(--ink-4); 
    display: flex; align-items: center; gap: 5px;
    order: 2;
}
@media (min-width: 640px) {
    .sc-foot-hint { font-size: 0.75rem; order: 1; }
}

.sc-foot-btns { 
    display: flex; 
    gap: 10px; 
    width: 100%;
    order: 1;
}
@media (min-width: 640px) {
    .sc-foot-btns { width: auto; order: 2; }
}

.btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 8px;
    padding: 9px 16px; 
    border-radius: var(--r-md);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.8rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: all 0.2s; border: 1.5px solid transparent;
    white-space: nowrap;
    flex: 1;
}
@media (min-width: 640px) {
    .btn { 
        padding: 10px 20px; 
        border-radius: var(--r-lg);
        font-size: 0.875rem;
        flex: initial;
    }
}
.btn-cancel {
    background: var(--surface); color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-cancel:hover { border-color: var(--ink-4); background: var(--surface-3); }

.btn-submit {
    background: var(--blue); color: #fff;
    border-color: var(--blue);
    box-shadow: 0 3px 12px rgba(37,99,235,0.3);
}
.btn-submit:hover { background: var(--blue-2); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37,99,235,0.4); }
.btn-submit:disabled { opacity: 0.65; cursor: not-allowed; transform: none; box-shadow: none; }

/* Better touch targets for mobile */
@media (max-width: 640px) {
    .btn, .fc {
        touch-action: manipulation;
    }
    .fc {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}
</style>

<div class="sc-outer">

    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.staff.index') }}"><i class="fas fa-users"></i> Manajemen Staff</a>
        <i class="fas fa-chevron-right"></i>
        <span>Edit Staff</span>
    </div>

    {{-- CARD --}}
    <div class="sc-card">

        {{-- HEAD --}}
        <div class="sc-head">
            <div class="sc-head-ico"><i class="fas fa-user-edit"></i></div>
            <div class="sc-head-text">
                <h1>Edit Staff</h1>
                <p>Edit informasi staff dan perbaharui password jika diperlukan.</p>
            </div>
        </div>

        {{-- BODY --}}
        <div class="sc-body">

            {{-- Status notifikasi --}}
            @if(session('status'))
                <div class="sc-success" id="status-alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="sc-err">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.update', $staff) }}" method="POST" class="sc-form" id="staffForm">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="fg">
                    <label for="staffName" class="fg-label">
                        Nama Lengkap <span class="req">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="staffName"
                        name="name" 
                        value="{{ old('name', $staff->name) }}" 
                        class="fc {{ $errors->has('name') ? 'error' : '' }}"
                        placeholder="Masukkan nama lengkap staff"
                        required 
                        autofocus
                    >
                </div>

                {{-- EMAIL --}}
                <div class="fg">
                    <label for="staffEmail" class="fg-label">
                        Alamat Email <span class="req">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="staffEmail"
                        name="email" 
                        value="{{ old('email', $staff->email) }}" 
                        class="fc {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="staff@example.com"
                        required
                    >
                    <div class="fg-hint">
                        <i class="fas fa-info-circle"></i>
                        Email akan digunakan untuk login staff.
                    </div>
                </div>

                <div class="sc-divider"></div>

                {{-- PASSWORD --}}
                <div class="fg">
                    <label for="staffPassword" class="fg-label">
                        Password Baru <span class="opt">Opsional</span>
                    </label>
                    <input 
                        type="password" 
                        id="staffPassword"
                        name="password" 
                        class="fc"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >
                    <div class="fg-hint">
                        <i class="fas fa-lock"></i>
                        Minimal 8 karakter untuk keamanan yang lebih baik.
                    </div>
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="fg">
                    <label for="staffPasswordConfirm" class="fg-label">
                        Konfirmasi Password Baru
                    </label>
                    <input 
                        type="password" 
                        id="staffPasswordConfirm"
                        name="password_confirmation" 
                        class="fc"
                        placeholder="Masukkan ulang password baru"
                    >
                </div>

                {{-- INFO BLOCK --}}
                <div class="info-block">
                    <div class="info-block-ico"><i class="fas fa-shield-alt"></i></div>
                    <div class="info-block-text">
                        <h4>Informasi Keamanan</h4>
                        <p>Password akan dienkripsi sebelum disimpan ke database. Pastikan staff menyimpan password baru dengan aman.</p>
                    </div>
                </div>

            </form>
        </div>

        {{-- FOOTER --}}
        <div class="sc-foot">
            <div class="sc-foot-hint">
                <i class="fas fa-clock"></i>
                Perubahan akan langsung berlaku setelah disimpan.
            </div>
            <div class="sc-foot-btns">
                <a href="{{ route('admin.staff.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="staffForm" class="btn btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i> Update Staff
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Script for auto fade & form handling --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusAlert = document.getElementById('status-alert');
    const form = document.getElementById('staffForm');
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.getElementById('staffPassword');
    const passwordConfirmInput = document.getElementById('staffPasswordConfirm');

    // Auto fade & redirect for success message
    if(statusAlert){
        // Auto fade
        setTimeout(() => {
            statusAlert.style.transition = "opacity 0.5s";
            statusAlert.style.opacity = 0;
            // Remove element after fade
            setTimeout(() => statusAlert.remove(), 500);

            // Optional: redirect ke index staff setelah fade
            setTimeout(() => {
                window.location.href = "{{ route('admin.staff.index') }}";
            }, 1000); // delay 1 detik setelah fade
        }, 5000); // muncul 5 detik
    }

    // Password validation before submit
    if (form) {
        form.addEventListener('submit', function(e) {
            const password = passwordInput ? passwordInput.value : '';
            const passwordConfirm = passwordConfirmInput ? passwordConfirmInput.value : '';

            // If password is filled, check confirmation
            if (password && password !== passwordConfirm) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                if (passwordConfirmInput) passwordConfirmInput.focus();
                return false;
            }

            // Check password length if filled
            if (password && password.length < 8) {
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

    // Real-time password confirmation validation (optional enhancement)
    if (passwordConfirmInput && passwordInput) {
        function validatePasswordMatch() {
            if (passwordInput.value && passwordConfirmInput.value) {
                if (passwordInput.value !== passwordConfirmInput.value) {
                    passwordConfirmInput.classList.add('error');
                    passwordConfirmInput.setCustomValidity('Password tidak cocok');
                } else {
                    passwordConfirmInput.classList.remove('error');
                    passwordConfirmInput.setCustomValidity('');
                }
            } else {
                passwordConfirmInput.classList.remove('error');
                passwordConfirmInput.setCustomValidity('');
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        passwordConfirmInput.addEventListener('input', validatePasswordMatch);
    }

    // Fix for iOS zoom on input focus
    var inputs = document.querySelectorAll('.fc');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                setTimeout(function() {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });
});
</script>
@endsection