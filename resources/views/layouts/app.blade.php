<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'Sistem Sertifikasi') </title>
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
            background-color: #333;
            color: white;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
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
        }

        .menu a:hover {
            background-color: #555;
        }

        .menu .active {
            background-color: #555;
        }

        /* LOGOUT */
        .logout-form {
            margin-top: 20px;
        }

        .logout-button {
            width: 100%;
            padding: 12px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #666;
        }

        /* CONTENT */
        .content {
            margin-left: 230px;
            padding: 40px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            .sidebar {
                width: 180px;
            }

            .content {
                margin-left: 180px;
                padding: 25px;
            }
        }
    </style> @stack('styles')
</head>

<body> <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Admin</h2>
        <nav class="menu"> <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"> Dashboard </a> <a
                href="{{ route('skema.index') }}" class="{{ request()->routeIs('skema.*') ? 'active' : '' }}"> Data Skema
            </a> <a href="{{ route('peserta.index') }}" class="{{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                Data Peserta </a> </nav>
        <form action="{{ route('logout') }}" method="POST" class="logout-form"> @csrf <button type="submit"
                class="logout-button"> Logout </button> </form>
    </aside> <!-- CONTENT -->
    <main class="content"> @yield('content') </main> @stack('scripts')
</body>

</html>
