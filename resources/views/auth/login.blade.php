<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LPPMI UNIVERSITAS GUNUNG KIDUL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .logo i {
            font-size: 32px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .login-body {
            padding: 30px;
        }

        h2 {
            color: #1e293b;
            margin-bottom: 25px;
            text-align: center;
            font-size: 20px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        input {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .checkbox input {
            width: auto;
            accent-color: #3b82f6;
        }

        .checkbox label {
            color: #475569;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            background: #2563eb;
        }

        .links {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .links a {
            color: #3b82f6;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #64748b;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-box {
                max-width: 100%;
            }

            .login-header {
                padding: 25px 20px;
            }

            .login-body {
                padding: 25px 20px;
            }

            .logo {
                flex-direction: column;
                gap: 8px;
            }

            .logo i {
                font-size: 28px;
            }

            .logo h1 {
                font-size: 20px;
            }

            .links {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <!-- Header -->
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-university"></i>
                <h1>LPPMI UGK</h1>
            </div>
            <p>Lembaga Pengendalian dan Penjaminan Mutu Internal</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            <h2>Masuk ke Akun</h2>

            <!-- Session Status -->
            @if (session('status'))
    <div class="alert alert-success" id="status-alert">
        <i class="fas fa-check-circle"></i>
        {{ session('status') }}
    </div>
@endif


            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="Email" 
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Password" 
                            required
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="checkbox">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        
            // Auto focus email field
    document.querySelector('input[name="email"]').focus();

    // Auto hide status alert setelah 5 detik
    const statusAlert = document.getElementById('status-alert');
    if (statusAlert) {
        setTimeout(() => {
            statusAlert.style.transition = "opacity 0.5s";
            statusAlert.style.opacity = 0;
            setTimeout(() => statusAlert.remove(), 500);
        }, 5000); // 5 detik
    }
    </script>
</body>
</html>