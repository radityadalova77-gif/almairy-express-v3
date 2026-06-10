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

        .adv-card {
            background: white;
            padding: 35px 30px;
            border-radius: 20px;
            text-align: center;
            transition: .3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        .adv-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .1);
        }

        .adv-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .adv-card h3 {
            margin-bottom: 10px;
            color: #0f172a;
        }

        .adv-card p {
            color: #64748b;
            line-height: 1.7;
        }

        .service-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: left;
            border: 1px solid #e5e7eb;
            transition: .3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, .15);
            border-color: #2563eb;
        }

        .service-icon {
            width: 65px;
            height: 65px;
            background: #eff6ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            font-size: 22px;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .service-card p {
            color: #64748b;
            line-height: 1.8;
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

        .tombol-biru {
            background: #2563eb;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
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
                <a href="{{ route('frontend.tentang') }}">Tentang</a>
                <a href="{{ route('frontend.layanan') }}">Layanan</a>
                <a href="{{ route('frontend.kontak') }}">Kontak</a>
                <div class="tombol-biru">
                    <a href="{{ route('frontend.tracking') }}" style="color:white;">Lacak Paket</a>
                </div>
            </div>

        </div>

    </nav>

    <div class="container">
        @yield('content')
    </div>

    <div class="footer">
        © {{ date('Y') }} AlmairyExpress
    </div>

</body>

</html>