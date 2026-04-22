@extends('layouts.admin')

@section('page-title', 'Profil Saya')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Sora:wght@300;400;600&display=swap" rel="stylesheet">

<div class="profile-wrapper">

    {{-- ALERTS --}}
    @if(session('success') || session('status'))
    <div class="alert alert-success animate-slide-down">
        <div class="alert-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <span>{{ session('success') ?? session('status') }}</span>
        <button class="alert-close" onclick="this.closest('.alert').remove()">×</button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger animate-slide-down">
        <div class="alert-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="alert-close" onclick="this.closest('.alert').remove()">×</button>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="profile-header animate-fade-up" style="--delay: 0ms">
        <div class="avatar-ring">
            <div class="avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        </div>
        <div class="header-info">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
        </div>
    </div>

    <div class="cards-grid">

        {{-- PROFIL CARD --}}
        <div class="card animate-fade-up" style="--delay: 80ms">
            <div class="card-header">
                <div class="card-icon icon-blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <h3>Informasi Profil</h3>
                    <p>Perbarui nama dan email akun Anda</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}" class="card-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Nama Lengkap
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Alamat Email
                    </label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Masukkan email">
                    </div>
                </div>

                <button type="submit" class="btn btn-blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- PASSWORD CARD --}}
        <div class="card animate-fade-up" style="--delay: 160ms">
            <div class="card-header">
                <div class="card-icon icon-rose">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                    <h3>Ganti Password</h3>
                    <p>Pastikan gunakan password yang kuat</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.password') }}" class="card-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
                        Password Lama
                    </label>
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="current_password" name="current_password" required placeholder="Masukkan password saat ini">
                        <button type="button" class="toggle-pass" onclick="togglePassword(this)">
                            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Password Baru
                    </label>
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Masukkan password baru">
                        <button type="button" class="toggle-pass" onclick="togglePassword(this)">
                            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="strength-bar" id="strengthBar">
                        <div class="strength-fill"></div>
                    </div>
                    <span class="strength-label" id="strengthLabel"></span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        Konfirmasi Password
                    </label>
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password baru">
                        <button type="button" class="toggle-pass" onclick="togglePassword(this)">
                            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-rose">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Perbarui Password
                </button>
            </form>
        </div>

    </div>
</div>

<style>
*, *::before, *::after { box-sizing: border-box; }

.profile-wrapper {
    font-family: 'Plus Jakarta Sans', sans-serif;
    max-width: 860px;
    margin: 0 auto;
    padding: 8px 0 40px;
}

/* ── ANIMATIONS ── */
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-14px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes pulseRing {
    0%   { box-shadow: 0 0 0 0 rgba(29,78,216,.35); }
    70%  { box-shadow: 0 0 0 12px rgba(29,78,216,0); }
    100% { box-shadow: 0 0 0 0 rgba(29,78,216,0); }
}
@keyframes shimmer {
    0%   { background-position: -200% center; }
    100% { background-position:  200% center; }
}

.animate-slide-down { animation: slideDown .35s ease both; }
.animate-fade-up    { animation: fadeUp .5s ease both; animation-delay: var(--delay, 0ms); }

/* ── ALERTS ── */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 18px;
    font-size: 14px;
    font-weight: 500;
    position: relative;
}
.alert ul { margin: 0; padding-left: 18px; }
.alert-icon {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    margin-top: 1px;
}
.alert-icon svg { width: 100%; height: 100%; }
.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
    opacity: .6;
    padding: 0 2px;
    color: inherit;
    flex-shrink: 0;
}
.alert-close:hover { opacity: 1; }
.alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
.alert-danger  { background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3; }

/* ── HEADER ── */
.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;
    background: #1d4ed8;
    border-radius: 18px;
    padding: 28px 32px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    color: white;
}
.profile-header::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
}
.profile-header::after {
    content: '';
    position: absolute;
    bottom: -60px; left: 30%;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
}
.avatar-ring {
    animation: pulseRing 2.5s ease infinite;
    border-radius: 50%;
    flex-shrink: 0;
}
.avatar {
    width: 64px; height: 64px;
    background: rgba(255,255,255,.2);
    backdrop-filter: blur(4px);
    border: 2.5px solid rgba(255,255,255,.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 600;
    color: white;
    position: relative;
    z-index: 1;
}
.header-info { position: relative; z-index: 1; }
.header-info h1 {
    margin: 0 0 4px;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -.3px;
}
.header-info p {
    margin: 0;
    font-size: 14px;
    opacity: .8;
    font-weight: 400;
}

/* ── CARDS GRID ── */
.cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
@media (max-width: 680px) {
    .cards-grid { grid-template-columns: 1fr; }
    .profile-header { padding: 22px 20px; gap: 16px; }
    .profile-header h1 { font-size: 18px; }
    .avatar { width: 52px; height: 52px; font-size: 20px; }
    .profile-wrapper { padding: 6px 0 32px; }
}

/* ── CARD ── */
.card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #f0f0f5;
    box-shadow: 0 2px 16px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.04);
    overflow: hidden;
    transition: box-shadow .3s ease, transform .3s ease;
}
.card:hover {
    box-shadow: 0 8px 32px rgba(0,0,0,.1), 0 2px 8px rgba(0,0,0,.06);
    transform: translateY(-2px);
}

/* ── CARD HEADER ── */
.card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 24px 0;
}
.card-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.card-icon svg { width: 20px; height: 20px; }
.icon-blue  { background: #dbeafe; color: #1d4ed8; }
.icon-rose  { background: #fee2e2; color: #dc2626; }
.card-header h3 {
    margin: 0 0 2px;
    font-size: 15px;
    font-weight: 700;
    color: #111827;
}
.card-header p {
    margin: 0;
    font-size: 12px;
    color: #9ca3af;
}

/* ── FORM ── */
.card-form {
    padding: 20px 24px 24px;
}
.form-group {
    margin-bottom: 16px;
}
.form-group label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 7px;
    letter-spacing: .01em;
    text-transform: uppercase;
}
.form-group label svg {
    width: 13px; height: 13px;
    opacity: .6;
}
.input-wrapper { position: relative; }
.input-wrapper input {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-family: inherit;
    font-size: 14px;
    color: #111827;
    background: #fafafa;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    outline: none;
}
.input-wrapper input:focus {
    border-color: #1d4ed8;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(29,78,216,.12);
}
.input-wrapper input::placeholder { color: #c4c9d4; }
.password-wrapper input { padding-right: 42px; }
.toggle-pass {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    transition: color .2s;
}
.toggle-pass:hover { color: #1d4ed8; }
.toggle-pass svg { width: 16px; height: 16px; }

/* ── STRENGTH BAR ── */
.strength-bar {
    height: 4px;
    background: #f0f0f5;
    border-radius: 99px;
    margin-top: 8px;
    overflow: hidden;
    display: none;
}
.strength-bar.visible { display: block; }
.strength-fill {
    height: 100%;
    width: 0%;
    border-radius: 99px;
    transition: width .4s ease, background .4s ease;
}
.strength-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    margin-top: 4px;
    transition: color .3s;
}

/* ── BUTTONS ── */
.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 4px;
    position: relative;
    overflow: hidden;
    transition: transform .15s ease, box-shadow .2s ease, opacity .2s;
}
.btn svg { width: 16px; height: 16px; flex-shrink: 0; }
.btn::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,.2) 50%, transparent 100%);
    background-size: 200% 100%;
    opacity: 0;
    transition: opacity .3s;
}
.btn:hover::after {
    opacity: 1;
    animation: shimmer .8s ease;
}
.btn:active { transform: scale(.97); }
.btn-blue {
    background: #1d4ed8;
    color: white;
    box-shadow: 0 4px 14px rgba(29,78,216,.3);
}
.btn-blue:hover { background: #1e40af; box-shadow: 0 6px 20px rgba(29,78,216,.45); }
.btn-rose {
    background: #dc2626;
    color: white;
    box-shadow: 0 4px 14px rgba(220,38,38,.3);
}
.btn-rose:hover { background: #b91c1c; box-shadow: 0 6px 20px rgba(220,38,38,.45); }

/* ── DIVIDER ── */
.card-form .form-group:last-of-type { margin-bottom: 20px; }

@media (max-width: 400px) {
    .card-header { padding: 18px 18px 0; }
    .card-form { padding: 18px 18px 20px; }
    .btn { font-size: 13px; }
}
</style>

<script>
function togglePassword(btn) {
    const input = btn.previousElementSibling;
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.querySelector('svg').style.opacity = isPass ? '0.4' : '1';
}

// Password strength
const pwdInput = document.getElementById('password');
const bar = document.getElementById('strengthBar');
const label = document.getElementById('strengthLabel');
const fill = bar?.querySelector('.strength-fill');

if (pwdInput) {
    pwdInput.addEventListener('input', function () {
        const val = this.value;
        if (!val) {
            bar.classList.remove('visible');
            label.textContent = '';
            return;
        }
        bar.classList.add('visible');

        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { w: '25%', bg: '#f43f5e', text: 'Lemah',   color: '#f43f5e' },
            { w: '50%', bg: '#fb923c', text: 'Cukup',   color: '#fb923c' },
            { w: '75%', bg: '#facc15', text: 'Baik',    color: '#ca8a04' },
            { w: '100%',bg: '#22c55e', text: 'Kuat 💪', color: '#16a34a' },
        ];
        const lvl = levels[score - 1] || levels[0];
        fill.style.width = lvl.w;
        fill.style.background = lvl.bg;
        label.textContent = lvl.text;
        label.style.color = lvl.color;
    });
}

// Auto-dismiss alerts after 5s
document.querySelectorAll('.alert').forEach(el => {
    setTimeout(() => {
        el.style.transition = 'opacity .4s ease, transform .4s ease';
        el.style.opacity = '0';
        el.style.transform = 'translateY(-8px)';
        setTimeout(() => el.remove(), 400);
    }, 5000);
});
</script>

@endsection