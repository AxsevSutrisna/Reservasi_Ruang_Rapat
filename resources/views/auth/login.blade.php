<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Reservasi</title>
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

        .password-wrapper {
            position: relative;
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

        .register-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
            text-decoration: none;
        }

        .register-link a {
            color: #1e3c72;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Login</h2>
    <p class="subtitle">Masuk ke akun Anda</p>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- FIXED FORM ACTION -->
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="nama@email.com"
                   required autofocus>
        </div>

        <!-- Password dengan Toggle -->
        <div class="form-group">
            <label>Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password"
                       placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <span id="toggleText">Lihat</span>
                </button>
            </div>
        </div>

        <!-- Tombol -->
        <button type="submit">Masuk</button>

        <!-- Link Register -->
        <p class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleText = document.getElementById('toggleText');

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
