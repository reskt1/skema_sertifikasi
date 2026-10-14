
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | Skema Sertifikasi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at 50% 40%,
                #ffffff 0%, #f4f8fb 65%, #e9f1f7 100%);
            color: #0D1C42;
            overflow: hidden;
            position: relative;
        }

        .decoration {
            position: absolute;
            width: 300px;
            height: 300px;
            background: linear-gradient(
                135deg, #3cafcf, #1bbaf4
            );
            opacity: 0.85;
            border-radius: 45% 55% 70% 30%;
            z-index: -1;
        }
        .decoration.top {
            top: -190px;
            left: -100px;
            transform: rotate(25deg);
        }

        .decoration.bottom {
            right: -120px;
            bottom: -200px;
            transform: rotate(45deg);
        }

        .welcome {
            text-align: center;
            padding: 35px 24px;
            max-width: 650px;
            width: 100%;
            animation: fadeIn 0.8s ease;
        }

        .icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 28px;
            background-color: #e3f0f8;
            color: #247bad;
            font-size: 44px;
            box-shadow: 0 10px 30px rgba(36, 123, 173, 0.10);
        }

        h1 {
            margin: 0 0 14px;
            font-size: clamp(32px, 6vw, 48px);
            font-weight: 700;
            letter-spacing: -1.5px;
        }

        p {
            margin: 0 0 32px;
            color: #6597b8;
            font-size: 16px;
            line-height: 1.7;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
            min-width: 145px;
            padding: 13px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.25s ease;
        }

        .btn-login {
            color: white;
            background: linear-gradient(
                135deg, #247bad, #17638e
            );
            box-shadow: 0 6px 16px rgba(36, 123, 173, 0.18);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(36, 123, 173, 0.25);
        }

        .btn-register {
            color: #247bad;
            border: 1px solid #247bad;
            background-color: rgba(255, 255, 255, 0.6);
        }

        .btn-register:hover {
            background-color: #e3f0f8;
            transform: translateY(-3px);
        }

        .arrow {
            margin-left: 7px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .decoration {
                width: 200px;
                height: 200px;
            }

            .icon {
                width: 75px;
                height: 75px;
                font-size: 36px;
            }

            .buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 260px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="decoration top"></div>
    <div class="decoration bottom"></div>

    <main class="welcome">

        <div class="icon" aria-hidden="true">
            📋
        </div>

        <h1>Selamat Datang</h1>

        <p>
            Di Aplikasi Skema Sertifikasi Peserta
        </p>

        <div class="buttons">
            <a href="{{ route('login') }}" class="btn btn-login">
                Login <span class="arrow">&rarr;</span>
            </a>

            <a href="{{ route('register') }}" class="btn btn-register">
                Register <span class="arrow">&rarr;</span>
            </a>
        </div>

    </main>

</body>
</html>
