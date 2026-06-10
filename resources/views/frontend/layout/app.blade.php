<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Khaidardeeva — Ekspedisi & Logistik Terpercaya')</title>
    <meta name="description"
        content="PT Khaidardeeva adalah perusahaan ekspedisi dan logistik terpercaya yang melayani pengiriman ke seluruh Indonesia.">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
        rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <style>
        /* ─── CSS VARIABLES ──────────────────────────── */
        :root {
            --c-bg: #0A0C10;
            --c-surface: #111318;
            --c-surface2: #181B22;
            --c-border: rgba(255, 255, 255, 0.07);
            --c-primary: #E8A020;
            --c-primary-d: #C4841A;
            --c-primary-glow: rgba(232, 160, 32, 0.18);
            --c-text: #F0F2F5;
            --c-muted: #7A8394;
            --c-muted2: #4A5160;
            --c-success: #22C55E;
            --c-danger: #EF4444;
            --c-info: #3B82F6;
            --f-display: 'Syne', sans-serif;
            --f-body: 'DM Sans', sans-serif;
            --radius: 14px;
            --radius-sm: 8px;
            --shadow-glow: 0 0 40px rgba(232, 160, 32, 0.12);
        }

        /* ─── RESET ──────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--f-body);
            background: var(--c-bg);
            color: var(--c-text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* ─── SCROLLBAR ──────────────────────────────── */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: var(--c-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--c-muted2);
            border-radius: 3px;
        }

        /* ─── NAVBAR ─────────────────────────────────── */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
            transition: background .3s, backdrop-filter .3s, border-bottom .3s;
        }

        #navbar.scrolled {
            background: rgba(10, 12, 16, 0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--c-border);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--c-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-logo-icon svg {
            width: 20px;
            height: 20px;
            fill: #0A0C10;
        }

        .nav-logo-text {
            font-family: var(--f-display);
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .5px;
        }

        .nav-logo-text span {
            color: var(--c-primary);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .nav-links a {
            padding: 6px 14px;
            font-size: 13.5px;
            color: var(--c-muted);
            border-radius: var(--radius-sm);
            transition: color .2s, background .2s;
            font-weight: 400;
        }

        .nav-links a:hover {
            color: var(--c-text);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-links a.active {
            color: var(--c-text);
        }

        .btn-track-nav {
            padding: 8px 20px;
            background: var(--c-primary);
            color: #0A0C10 !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            border-radius: var(--radius-sm);
            transition: background .2s, transform .15s !important;
        }

        .btn-track-nav:hover {
            background: var(--c-primary-d) !important;
            transform: translateY(-1px) !important;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }

        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--c-text);
            border-radius: 2px;
            transition: .3s;
        }

        /* ─── MOBILE NAV ─────────────────────────────── */
        .mobile-nav {
            display: none;
            position: fixed;
            top: 68px;
            left: 0;
            right: 0;
            background: rgba(10, 12, 16, 0.97);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--c-border);
            padding: 16px 5% 20px;
            z-index: 99;
            flex-direction: column;
            gap: 4px;
        }

        .mobile-nav.open {
            display: flex;
        }

        .mobile-nav a {
            padding: 10px 14px;
            font-size: 14px;
            color: var(--c-muted);
            border-radius: var(--radius-sm);
            transition: .2s;
        }

        .mobile-nav a:hover {
            color: var(--c-text);
            background: rgba(255, 255, 255, 0.05);
        }

        /* ─── SECTIONS ───────────────────────────────── */
        section {
            padding: 80px 5%;
        }

        /* ─── FOOTER ─────────────────────────────────── */
        footer {
            background: var(--c-surface);
            border-top: 1px solid var(--c-border);
            padding: 48px 5% 28px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand p {
            font-size: 13.5px;
            color: var(--c-muted);
            line-height: 1.7;
            margin-top: 12px;
            max-width: 280px;
        }

        .footer-col h4 {
            font-family: var(--f-display);
            font-size: 13px;
            font-weight: 600;
            color: var(--c-text);
            letter-spacing: .5px;
            margin-bottom: 14px;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-col ul li a {
            font-size: 13px;
            color: var(--c-muted);
            transition: color .2s;
        }

        .footer-col ul li a:hover {
            color: var(--c-primary);
        }

        .footer-bottom {
            border-top: 1px solid var(--c-border);
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: var(--c-muted2);
        }

        .footer-bottom span b {
            color: var(--c-primary);
        }

        /* ─── UTILITIES ──────────────────────────────── */
        .container {
            max-width: 1180px;
            margin: 0 auto;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            background: rgba(232, 160, 32, 0.1);
            border: 1px solid rgba(232, 160, 32, 0.25);
            border-radius: 20px;
            font-size: 11.5px;
            color: var(--c-primary);
            font-weight: 500;
            letter-spacing: .3px;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--c-primary);
            display: inline-block;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .5;
                transform: scale(.7);
            }
        }

        /* ─── TOAST ──────────────────────────────────── */
        #toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            font-weight: 500;
            z-index: 9999;
            transform: translateY(80px);
            opacity: 0;
            transition: .3s cubic-bezier(.34, 1.56, .64, 1);
            pointer-events: none;
        }

        #toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        #toast.success {
            background: #14532d;
            border: 1px solid #22c55e;
            color: #86efac;
        }

        #toast.error {
            background: #450a0a;
            border: 1px solid #ef4444;
            color: #fca5a5;
        }

        /* ─── RESPONSIVE ─────────────────────────────── */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 28px;
            }
        }

        @media (max-width: 600px) {
            section {
                padding: 60px 5%;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    {{-- ─── NAVBAR ──────────────────────────────────────── --}}
    <nav id="navbar">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                </svg>
            </div>
            <span class="nav-logo-text">PT <span>KHAIDARDEEVA</span></span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}#tentang">Tentang</a></li>
            <li><a href="{{ route('home') }}#layanan">Layanan</a></li>
            <li><a href="{{ route('home') }}#jangkauan">Jangkauan</a></li>
            <li><a href="{{ route('home') }}#kontak">Kontak</a></li>
            <li><a href="{{ route('tracking.index') }}" class="btn-track-nav">🔍 Lacak Kiriman</a></li>
        </ul>

        <div class="hamburger" id="hamburger" onclick="toggleMobileNav()">
            <span></span><span></span><span></span>
        </div>
    </nav>

    {{-- Mobile Nav --}}
    <div class="mobile-nav" id="mobile-nav">
        <a href="{{ route('home') }}#tentang" onclick="toggleMobileNav()">Tentang</a>
        <a href="{{ route('home') }}#layanan" onclick="toggleMobileNav()">Layanan</a>
        <a href="{{ route('home') }}#jangkauan" onclick="toggleMobileNav()">Jangkauan</a>
        <a href="{{ route('home') }}#kontak" onclick="toggleMobileNav()">Kontak</a>
        <a href="{{ route('tracking.index') }}" style="color: var(--c-primary); font-weight:600;">🔍 Lacak Kiriman</a>
    </div>

    {{-- ─── MAIN CONTENT ────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ─── FOOTER ──────────────────────────────────────── --}}
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="nav-logo">
                        <div class="nav-logo-icon">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path
                                    d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                            </svg>
                        </div>
                        <span class="nav-logo-text" style="font-size:14px;">PT <span>KHAIDARDEEVA</span></span>
                    </div>
                    <p>Mitra logistik terpercaya Anda — menghadirkan pengiriman cepat, aman, dan transparan ke seluruh
                        nusantara sejak 2018.</p>
                    <div style="display:flex;gap:10px;margin-top:16px;">
                        @foreach(['facebook','instagram','whatsapp'] as $soc)
                        <a href="#"
                            style="width:34px;height:34px;border-radius:8px;background:rgba(255,255,255,0.06);border:1px solid var(--c-border);display:flex;align-items:center;justify-content:center;transition:.2s;"
                            onmouseover="this.style.borderColor='var(--c-primary)'"
                            onmouseout="this.style.borderColor='var(--c-border)'">
                            <span
                                style="font-size:14px;">{{ ['facebook'=>'f','instagram'=>'ig','whatsapp'=>'wa'][$soc] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="footer-col">
                    <h4>PERUSAHAAN</h4>
                    <ul>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#jangkauan">Area Jangkauan</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>LAYANAN</h4>
                    <ul>
                        <li><a href="#">Pengiriman Reguler</a></li>
                        <li><a href="#">Pengiriman Express</a></li>
                        <li><a href="#">Kargo Besar</a></li>
                        <li><a href="#">Door-to-Door</a></li>
                        <li><a href="#">Pengiriman COD</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>BANTUAN</h4>
                    <ul>
                        <li><a href="{{ route('tracking.index') }}">Lacak Kiriman</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#kontak">Hubungi CS</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© {{ date('Y') }} <b>PT Khaidardeeva</b>. Seluruh hak cipta dilindungi.</span>
                <span>Dibuat dengan ❤ untuk logistik Indonesia</span>
            </div>
        </div>
    </footer>

    {{-- Toast --}}
    <div id="toast"></div>

    <script>
        // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile nav
        function toggleMobileNav() {
            document.getElementById('mobile-nav').classList.toggle('open');
        }

        // Toast
        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.className = `show ${type}`;
            setTimeout(() => t.className = type, 3200);
        }

        // Animate on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12
        });
        document.querySelectorAll('.anim').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>

</html>