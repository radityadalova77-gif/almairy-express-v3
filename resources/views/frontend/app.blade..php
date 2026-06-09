<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlmairyExpress</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .navbar {
            background: white;
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #111827;
            font-weight: 500;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-success {
            background: #22c55e;
            color: white;
        }

        .hero {
            padding: 90px 0;
        }

        .hero h1 {
            font-size: 52px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            color: #6b7280;
            max-width: 700px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 34px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
        }

        .footer {
            padding: 30px 0;
            text-align: center;
            color: #6b7280;
        }

        /* TRACKING CLIENT */
        .tracking-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            margin-top: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
        }

        .tracking-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .tracking-sub {
            color: #6b7280;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .tracking-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .tracking-form input {
            flex: 1;
            min-width: 250px;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
        }

        .tracking-form button {
            border: none;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <nav class="navbar">

        <div class="container nav-wrap">

            <div>

                <div style="
                font-size:28px;
                font-weight:700;
                color:#2563eb;
            ">
                    🚚 AlmairyExpress
                </div>

                <div style="
                font-size:13px;
                color:#6b7280;
                margin-top:4px;
            ">
                    Transportation Management System
                </div>

            </div>

            {{-- MENU CLIENT --}}
            <div class="nav-menu">
                <a href="{{ route('frontend.home') }}">Beranda</a>
            </div>

        </div>

    </nav>

    <div class="container">

        {{-- TRACKING SECTION --}}
        <div class="tracking-box">

            <div class="tracking-title">
                Lacak Paket Anda
            </div>

            <div class="tracking-sub">
                Masukkan nomor resi pengiriman untuk melihat status dan lokasi paket secara realtime.
            </div>

            <form action="{{ route('tracking.cari') }}" method="GET" class="tracking-form">

                <input
                    type="text"
                    name="resi"
                    placeholder="Masukkan nomor resi...">

                <button type="submit" class="btn btn-primary">
                    Lacak Paket
                </button>

            </form>

        </div>

        @yield('content')

    </div>

    <div class="footer">
        © {{ date('Y') }} AlmairyExpress
    </div>

</body>

</html>