<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Sertifikasi')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
            color: #333;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background-color: #6597b8;
            color: white;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 21px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .menu a:hover {
            background-color: #4384ad;
        }

        .menu .active {
            background-color: #247bad;
        }

        /* AREA UTAMA */
        .main-area {
            margin-left: 230px;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            min-height: 76px;
            background-color: white;
            padding: 15px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid #ddd;
        }

        .navbar-title {
            font-size: 30px;
            font-weight: bold;
            color: #000000;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            text-align: right;
        }

        .user-name {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        .user-email {
            font-size: 12px;
            color: #777;
        }

        .user-role {
            display: inline-block;
            width: fit-content;
            margin-left: auto;
            padding: 4px 9px;
            border-radius: 12px;
            background-color: #e4f1fa;
            color: #247bad;
            font-size: 11px;
            font-weight: bold;
        }

        .logout-button {
            padding: 10px 15px;
            background-color: #380808;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout-button:hover {
            background-color: #6b2020;
        }

        /* CONTENT */
        .content {
            padding: 35px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            .sidebar {
                width: 180px;
                padding: 20px 10px;
            }

            .sidebar h2 {
                font-size: 17px;
            }

            .main-area {
                margin-left: 180px;
            }

            .navbar {
                padding: 15px;
                align-items: flex-start;
                flex-direction: column;
            }

            .navbar-user {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .user-info {
                text-align: left;
            }

            .user-role {
                margin-left: 0;
            }

            .content {
                padding: 20px 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    @auth
    <aside class="sidebar">
        <h2>Skema Sertifikasi</h2>

        <nav class="menu">
            <!-- ================= TAMPILAN SIDEBAR JIKA ADMIN ================= -->
            @if(Auth::user()->role === 'admin')

                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard Admin
                </a>

                <a href="{{ route('skema.index') }}"
                    class="{{ request()->routeIs('skema.*') ? 'active' : '' }}">
                    Data Skema
                </a>

                <a href="{{ route('peserta.index') }}"
                    class="{{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                    Data Peserta
                </a>

            <!-- ================= TAMPILAN SIDEBAR JIKA PESERTA ================= -->
            @else

                <a href="{{ route('peserta.profile') }}"
                    class="{{ request()->routeIs('peserta.profile') ? 'active' : '' }}">
                    Profil Saya
                </a>

                <a href="{{ route('skema.index') }}"
                    class="{{ request()->routeIs('skema.*') ? 'active' : '' }}">
                    Data Skema
                </a>

                <a href="{{ route('peserta.index') }}"
                    class="{{ request()->routeIs('peserta.index') || request()->routeIs('peserta.show') ? 'active' : '' }}">
                    Data Peserta
                </a>

            @endif
        </nav>
    </aside>
    @endauth

    <!-- AREA UTAMA -->
    <div class="main-area" style="{{ !auth()->check() ? 'margin-left: 0;' : '' }}">

        <!-- NAVBAR -->
        <header class="navbar">
            <div class="navbar-title">
                 @yield('title', 'Dashboard')
            </div>

            <div class="navbar-user">
                @auth
                    <!-- Tampilan Info Pengguna jika Sudah Login -->
                    <div class="user-info">
                        <span class="user-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="user-email">
                            {{ auth()->user()->email }}
                        </span>

                        <span class="user-role">
                            {{ strtoupper(auth()->user()->role) }}
                        </span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Tampilan Tombol Navigasi jika Belum Login -->
                    @if(request()->routeIs('register'))
                        <a href="{{ route('login') }}" class="logout-button" style="background-color: #247bad; text-decoration: none;">Login</a>
                    @else
                        <a href="{{ route('register') }}" class="logout-button" style="background-color: #247bad; text-decoration: none;">Daftar</a>
                    @endif
                @endauth
            </div>
        </header>

        <!-- CONTENT -->
        <main class="content">
            @yield('content')
        </main>

    </div>

    @stack('scripts')

</body>
</html>
