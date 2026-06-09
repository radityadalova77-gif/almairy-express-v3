@extends('frontend.layouts.app')

@section('content')

<!-- HERO -->
<section style="
    background:linear-gradient(135deg,#eff6ff,#f8fafc);
    padding:100px 0;
">

    <div class="container" style="text-align:center;">

        <span style="
            background:#dbeafe;
            color:#2563eb;
            padding:8px 18px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
        ">
            Hubungi Kami
        </span>

        <h1 style="
            font-size:56px;
            font-weight:800;
            color:#0f172a;
            margin:25px 0;
        ">
            Kontak PT AlmairyExpress
        </h1>

        <p style="
            max-width:800px;
            margin:auto;
            color:#64748b;
            line-height:1.9;
            font-size:18px;
        ">
            Kami siap membantu kebutuhan pengiriman dan distribusi
            barang Anda melalui layanan yang cepat, aman,
            dan terpercaya.
        </p>

    </div>

</section>

<!-- INFORMASI -->
<section class="section">

    <div class="container">

        <div class="grid">

            <!-- ALAMAT -->
            <div class="service-card">

                <div class="service-icon">
                    📍
                </div>

                <h3>Alamat Kantor</h3>

                <p>
                    Jl. Britania Raya No. 10<br>
                    United Kingdom, London
                </p>

            </div>

            <!-- TELEPON -->
            <div class="service-card">

                <div class="service-icon">
                    📞
                </div>

                <h3>Telepon</h3>

                <p>
                    19-24-07-90
                </p>

            </div>

            <!-- EMAIL -->
            <div class="service-card">

                <div class="service-icon">
                    ✉️
                </div>

                <h3>Email</h3>

                <p>
                    dikaganteng@gmail.com
                </p>

            </div>

            <!-- JAM -->
            <div class="service-card">

                <div class="service-icon">
                    🕒
                </div>

                <h3>Jam Operasional</h3>

                <p>
                    Senin - Sabtu<br>
                    08:00 - 17:00 WIB
                </p>

            </div>

        </div>

    </div>

</section>

<!-- MAPS -->
<section class="section" style="background:white;">

    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Lokasi Kami
        </h2>

        <div class="card" style="padding:10px;">

            <iframe
                src="https://maps.google.com/maps?q=jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed"
                width="100%"
                height="450"
                style="
                    border:none;
                    border-radius:15px;
                ">
            </iframe>

        </div>

    </div>

</section>

<!-- CTA -->
<section style="
    background:#2563eb;
    color:white;
    padding:80px 0;
    text-align:center;
">

    <div class="container">

        <h2 style="
            font-size:42px;
            margin-bottom:20px;
        ">
            Siap Mengirim Barang?
        </h2>

        <p style="
            max-width:700px;
            margin:auto;
            margin-bottom:30px;
            line-height:1.8;
        ">
            Hubungi tim PT AlmairyExpress dan dapatkan
            solusi pengiriman terbaik untuk kebutuhan Anda.
        </p>

        <a
            href="https://wa.me/6281234567890"
            target="_blank"
            class="btn"
            style="
                background:white;
                color:#2563eb;
                font-weight:bold;
            ">
            Hubungi via WhatsApp
        </a>

    </div>

</section>

@endsection