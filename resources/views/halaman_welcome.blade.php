<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang di Aplikasi Skema Sertifikasi</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .welcome-card {
            max-width: 550px;
            width: 90%;
            text-align: center;
            padding: 50px 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .icon-header {
            font-size: 50px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 12px;
            color: #111;
            font-weight: 700;
        }

        p.description {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .action-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .btn-login {
            display: inline-block;
            width: 100%;
            max-width: 200px;
            padding: 14px 0;
            background-color: #247bad;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: #555;
        }

        .register-text {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .link-register {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border-bottom: 1px solid #333;
            padding-bottom: 2px;
            transition: color 0.2s ease, border-color 0.2s ease;
        }

        .link-register:hover {
            color: #008bfc;
            border-color: #008bfc;
        }

        @media (max-width: 480px) {
            .welcome-card {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="welcome-card">
        <div class="icon-header">📋</div>
        <h1>Selamat Datang di Aplikasi<br>Skema Sertifikasi</h1>
        <p class="description">Silakan masuk ke akun Anda untuk mengelola data skema, memantau ringkasan informasi, dan melihat data peserta sertifikasi.</p>

        <div class="action-container">
            @if (Route::has('login'))
                @auth

                    <a href="{{ url('/dashboard') }}" class="btn-login">Ke Dashboard →</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Masuk / Login</a>

                    @if (Route::has('register'))
                        <p class="register-text">
                            Belum punya akun? <a href="{{ route('register') }}" class="link-register">Daftar Sekarang</a>
                        </p>
                    @endif
                @endauth
            @endif
        </div>
    </div>

</body>
</html>
