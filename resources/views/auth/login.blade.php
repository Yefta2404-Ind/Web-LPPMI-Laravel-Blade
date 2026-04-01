<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>LPPMI · Akses Staf | Portal Mutu</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-deep: #0a0f1c;
            --bg-card: #ffffff;
            --primary-dark: #0B2B40;
            --primary-deep: #144d5c;
            --accent-gold: #C9A03D;
            --accent-gold-light: #e0b354;
            --accent-gold-glow: rgba(201, 160, 61, 0.2);
            --text-main: #1f2a3a;
            --text-secondary: #4a5b6e;
            --text-muted: #7c8b9c;
            --border-light: #eef2f6;
            --border-focus: #c9a03d;
            --input-bg: #ffffff;
            --shadow-sm: 0 8px 30px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.02);
            --shadow-md: 0 20px 35px -12px rgba(0, 0, 0, 0.15);
            --radius-xl: 28px;
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: var(--bg-deep);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 1.5rem;
        }

        /* refined background with depth & texture */
        .bg-ambient {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: radial-gradient(circle at 20% 30%, rgba(11, 43, 64, 0.6), #050a14 80%);
        }

        .bg-grain {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='1' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.045'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* floating organic blur */
        .blob-1, .blob-2 {
            position: fixed;
            width: 55vw;
            height: 55vw;
            background: radial-gradient(circle, rgba(201,160,61,0.08) 0%, rgba(11,43,64,0) 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }
        .blob-1 { top: -20vh; right: -15vw; }
        .blob-2 { bottom: -25vh; left: -10vw; background: radial-gradient(circle, rgba(20,77,92,0.12) 0%, rgba(0,0,0,0) 70%); }

        /* main card */
        .card-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            margin: 0 auto;
        }

        .glass-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            padding: 2.5rem 2.2rem 2.2rem;
            backdrop-filter: blur(0px);
            box-shadow: var(--shadow-md), 0 1px 2px rgba(0,0,0,0.02);
            transition: transform 0.3s ease, box-shadow 0.3s;
            border: 1px solid rgba(201, 160, 61, 0.18);
            position: relative;
        }

        .glass-card:hover {
            box-shadow: 0 30px 45px -20px rgba(0, 0, 0, 0.3);
        }

        /* subtle gold line decor */
        .card-ornament {
            position: absolute;
            top: 0;
            left: 2rem;
            right: 2rem;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-gold), var(--accent-gold-light), transparent);
            border-radius: 4px;
        }

        /* emblem with refined style */
        .emblem-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .emblem-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-deep));
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 18px -8px rgba(0,0,0,0.2), 0 0 0 1px rgba(201,160,61,0.25);
        }
        .emblem-icon i {
            font-size: 2rem;
            color: var(--accent-gold-light);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .title-section {
            text-align: center;
            margin-bottom: 1rem;
        }
        .title-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            font-weight: 500;
            color: var(--text-main);
            letter-spacing: -0.3px;
        }
        .title-section h1 span {
            color: var(--accent-gold);
            font-weight: 600;
        }
        .org-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(201, 160, 61, 0.1);
            backdrop-filter: blur(4px);
            padding: 0.25rem 0.9rem;
            border-radius: 40px;
            margin-top: 0.7rem;
            border: 1px solid rgba(201, 160, 61, 0.25);
        }
        .org-badge i {
            font-size: 0.7rem;
            color: var(--accent-gold);
        }
        .org-badge span {
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--primary-deep);
            letter-spacing: 0.2px;
        }
        .tagline {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.65rem;
            font-weight: 400;
        }

        /* divider minimal */
        .elegant-divider {
            margin: 1.6rem 0 1.8rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-light), #e2e8f0, transparent);
        }

        /* alerts: polished */
        .alert-modern {
            display: flex;
            align-items: flex-start;
            gap: 0.7rem;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.45;
            border-left: 3px solid;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .alert-modern.alert-success {
            border-left-color: #2b7a4b;
            background: #f0faf5;
            color: #1a5a3a;
        }
        .alert-modern.alert-error {
            border-left-color: #b91c1c;
            background: #fef2f2;
            color: #991b1b;
        }
        .close-alert {
            margin-left: auto;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            font-size: 0.75rem;
        }
        .close-alert:hover { opacity: 1; }

        /* form groups */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .input-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }
        .input-label i {
            font-size: 0.7rem;
            color: var(--accent-gold);
        }
        .input-field {
            position: relative;
        }
        .input-field input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            border: 1.5px solid var(--border-light);
            border-radius: var(--radius-md);
            background: var(--input-bg);
            color: var(--text-main);
            transition: all 0.2s ease;
            outline: none;
        }
        .input-field input:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px var(--accent-gold-glow);
        }
        .input-field .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.9rem;
            color: #9aaebf;
            transition: color 0.2s;
        }
        .input-field input:focus + .input-icon {
            color: var(--accent-gold);
        }
        .toggle-visibility {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9aaebf;
            font-size: 0.85rem;
            padding: 0;
            transition: color 0.2s;
        }
        .toggle-visibility:hover {
            color: var(--primary-dark);
        }

        /* primary CTA */
        .btn-login {
            width: 100%;
            background: linear-gradient(105deg, var(--primary-dark) 0%, var(--primary-deep) 100%);
            border: none;
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            cursor: pointer;
            margin-top: 0.3rem;
            transition: all 0.25s;
            box-shadow: 0 4px 12px rgba(11, 43, 64, 0.25);
            letter-spacing: 0.3px;
        }
        .btn-login i {
            font-size: 0.85rem;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            background: linear-gradient(105deg, #0f3a4f, #1a6075);
            transform: translateY(-2px);
            box-shadow: 0 12px 22px -8px rgba(0, 0, 0, 0.3);
        }
        .btn-login:active {
            transform: translateY(1px);
        }
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        /* footer clean (only help desk? but we keep minimal without forget password extraneous links) */
        .footer-minimal {
            margin-top: 1.8rem;
            text-align: center;
            border-top: 1px solid var(--border-light);
            padding-top: 1.4rem;
        }
        .support-text {
            font-size: 0.7rem;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
        }
        .support-text i {
            color: var(--accent-gold);
            font-size: 0.65rem;
        }
        .badge-version {
            margin-top: 1rem;
            font-size: 0.65rem;
            font-weight: 500;
            color: var(--text-muted);
            background: #f8f9fc;
            display: inline-block;
            padding: 0.2rem 0.9rem;
            border-radius: 40px;
        }

        /* no extra links */
        .no-extra-links {
            margin: 0;
        }

        /* toast custom */
        .custom-toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: #1e293b;
            backdrop-filter: blur(12px);
            color: #f1f5f9;
            padding: 0.7rem 1.5rem;
            border-radius: 60px;
            font-size: 0.75rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 5px 18px rgba(0,0,0,0.25);
            border: 1px solid rgba(201,160,61,0.4);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s, transform 0.2s;
            z-index: 2000;
            white-space: nowrap;
        }

        @media (max-width: 500px) {
            .glass-card { padding: 1.8rem 1.5rem; }
            .title-section h1 { font-size: 1.6rem; }
            .custom-toast { white-space: normal; max-width: 85%; text-align: center; }
        }
    </style>
</head>
<body>

<div class="bg-ambient"></div>
<div class="bg-grain"></div>
<div class="blob-1"></div>
<div class="blob-2"></div>

<div class="card-container">
    <div class="glass-card">
        <div class="card-ornament"></div>

        <!-- branding -->
        <div class="emblem-wrapper">
            <div class="emblem-icon">
                <i class="fas fa-building-columns"></i>
            </div>
        </div>
        <div class="title-section">
            <h1>LPMI<span> Access</span></h1>
            <div class="org-badge">
                <i class="fas fa-certificate"></i>
                <span>UNIVERSITAS GUNUNG KIDUL</span>
            </div>
            
        </div>

        <div class="elegant-divider"></div>

        <!-- backend session/error alerts -->
        @if (session('status'))
            <div class="alert-modern alert-success" id="sessionAlert">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
                <i class="fas fa-times close-alert" onclick="this.closest('.alert-modern').remove()"></i>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-modern alert-error" id="errorAlert">
                <i class="fas fa-exclamation-triangle"></i>
                <div style="flex:1">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                <i class="fas fa-times close-alert" onclick="this.closest('.alert-modern').remove()"></i>
            </div>
        @endif

        <!-- LOGIN FORM: hanya email & password, tanpa forget password dll -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <div class="input-label">
                    <i class="fas fa-envelope"></i>
                    <span>Alamat Email</span>
                </div>
                <div class="input-field">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="nama.staff@lppmi.ac.id" required autofocus>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <div class="input-label">
                    <i class="fas fa-key"></i>
                    <span>Kata Sandi</span>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="toggle-visibility" id="togglePasswordBtn" aria-label="Tampilkan sandi">
                        <i class="fas fa-eye-slash" id="pwIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login" id="submitLoginBtn">
                <i class="fas fa-arrow-right-to-bracket"></i>
                <span>Masuk ke Dashboard</span>
            </button>

        </form>

        <!-- footer sangat minimal: tanpa forget password, tanpa link tambahan yg mengganggu, hanya info dukungan & versi -->
        <div class="footer-minimal">
            
        </div>
    </div>
</div>

<div id="toastMessage" class="custom-toast"></div>

<script>
    (function() {
        // --- toggle password visibility
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordField = document.getElementById('password');
        const pwIcon = document.getElementById('pwIcon');

        if (toggleBtn && passwordField) {
            toggleBtn.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                if (type === 'text') {
                    pwIcon.classList.remove('fa-eye-slash');
                    pwIcon.classList.add('fa-eye');
                } else {
                    pwIcon.classList.remove('fa-eye');
                    pwIcon.classList.add('fa-eye-slash');
                }
            });
        }

        // --- auto-hide alerts with smooth removal
        const sessionAlertDiv = document.getElementById('sessionAlert');
        if (sessionAlertDiv) {
            setTimeout(() => {
                sessionAlertDiv.style.transition = 'opacity 0.35s ease';
                sessionAlertDiv.style.opacity = '0';
                setTimeout(() => {
                    if(sessionAlertDiv && sessionAlertDiv.remove) sessionAlertDiv.remove();
                }, 400);
            }, 4500);
        }

        const errorAlertDiv = document.getElementById('errorAlert');
        if (errorAlertDiv) {
            setTimeout(() => {
                errorAlertDiv.style.transition = 'opacity 0.35s ease';
                errorAlertDiv.style.opacity = '0';
                setTimeout(() => {
                    if(errorAlertDiv && errorAlertDiv.remove) errorAlertDiv.remove();
                }, 5500);
            }, 6000);
        }

        // --- submit loading state & simple frontend validation
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitLoginBtn');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function showToastMessage(message, duration = 2800) {
            const toast = document.getElementById('toastMessage');
            toast.textContent = message;
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
            clearTimeout(toast._hideTimer);
            toast._hideTimer = setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-50%) translateY(10px)';
            }, duration);
        }

        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                let emailVal = emailInput ? emailInput.value.trim() : '';
                let passVal = passwordInput ? passwordInput.value : '';

                if (!emailVal) {
                    e.preventDefault();
                    showToastMessage('Email institusi harus diisi');
                    emailInput?.focus();
                    return false;
                }
                if (!passVal) {
                    e.preventDefault();
                    showToastMessage('Kata sandi tidak boleh kosong');
                    passwordInput?.focus();
                    return false;
                }
                // simple email format reminder (opsional)
                if (!emailVal.includes('@') || !emailVal.includes('.')) {
                    e.preventDefault();
                    showToastMessage('Masukkan email yang valid (contoh: nama@lppmi.ac.id)');
                    return false;
                }

                // show loading state
                submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> <span>Memproses...</span>';
                submitBtn.classList.add('loading');
                // form akan tetap submit secara normal ke Laravel
            });
        }

        // optional: jika ada tombol close alert secara manual, sudah ditangani onclick inline
        // TIDAK ADA LINK "lupa password" atau "forget password" / bantuan ti / dll sesuai permintaan
        // namun kita sudah hapus semua link ekstra (termasuk yang sebelumnya footer-link dll)
        // Pastikan tidak ada elemen dengan class footer-link yang mengganggu
        // Semua ekstra link yang tidak diperlukan dihilangkan dari HTML.

        // small style for auto-fill
        const styleNode = document.createElement('style');
        styleNode.textContent = `
            input:-webkit-autofill,
            input:-webkit-autofill:focus {
                transition: background-color 600000s 0s, color 600000s 0s;
            }
            input:focus {
                outline: none;
            }
        `;
        document.head.appendChild(styleNode);
    })();
</script>

</body>
</html>