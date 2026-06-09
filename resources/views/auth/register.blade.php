<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Reservasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            color: #495057;
            background: #fff;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }

        input:hover {
            border-color: #b8c5d6;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0;
            width: auto;
            font-size: 14px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #1e3c72;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            margin-top: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 60, 114, 0.3);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 60, 114, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
            text-decoration: none;
        }

        .login-link a {
            color: #1e3c72;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 25px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Register</h2>
    <p class="subtitle">Buat akun baru Anda</p>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label>Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleText1')">
                    <span id="toggleText1">Lihat</span>
                </button>
            </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="password-wrapper">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan ulang password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleText2')">
                    <span id="toggleText2">Lihat</span>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit">Daftar</button>

        <!-- Login Link -->
        <p class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
        </p>
    </form>
</div>

<script>
    function togglePassword(inputId, textId) {
        const passwordInput = document.getElementById(inputId);
        const toggleText = document.getElementById(textId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleText.textContent = 'Sembunyikan';
        } else {
            passwordInput.type = 'password';
            toggleText.textContent = 'Lihat';
        }
    }
</script>

</body>
</html>