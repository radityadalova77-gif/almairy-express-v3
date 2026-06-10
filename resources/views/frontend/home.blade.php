@extends('frontend.layouts.app')

@section('content')

<!-- HERO -->

<section style="
    background:linear-gradient(135deg,#f8fafc,#eff6ff);
    padding:80px 0;
">

    <div class="container">

        <div style="
        max-width:750px;
    ">

            <span style="
            background:#dbeafe;
            color:#2563eb;
            padding:8px 16px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
        ">
                🚚 Transportation Management System
            </span>

            <h1 style="
            font-size:64px;
            font-weight:800;
            color:#0f172a;
            line-height:1.1;
            margin:25px 0;
        ">
                Fast, Safe & Trusted Delivery
            </h1>

            <p style="
            font-size:22px;
            color:#64748b;
            line-height:1.8;
            margin-bottom:35px;
        ">
                AlmairyExpress adalah layanan pengiriman barang terpercaya
                dengan sistem tracking realtime dan pengiriman cepat
                ke seluruh Indonesia.
            </p>

            <div style="
            display:flex;
            gap:15px;
            flex-wrap:wrap;
        ">


                <a href="{{ route('frontend.kontak') }}"
                    class="btn btn-success">
                    Hubungi Kami
                </a>

            </div>

        </div>

    </div>

</section>

<!-- STATISTIK -->

<section class="section" style="background:white;">


    <div class="container">

        <div class="grid">

            <div class="card" style="text-align:center;">
                <h2 style="font-size:42px;color:#2563eb;">5000+</h2>
                <p>Pengiriman Berhasil</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="font-size:42px;color:#2563eb;">38+</h2>
                <p>Kota Tujuan</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="font-size:42px;color:#2563eb;">98%</h2>
                <p>Tingkat Ketepatan</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="font-size:42px;color:#2563eb;">24/7</h2>
                <p>Customer Support</p>
            </div>

        </div>

    </div>
    ```

</section>

<!-- TENTANG SINGKAT -->

<section class="section">

    ```
    <div class="container">

        <div style="
        text-align:center;
        max-width:800px;
        margin:auto;
    ">

            <h2 class="section-title">
                Tentang AlmairyExpress
            </h2>

            <p style="
            color:#64748b;
            line-height:1.9;
            font-size:18px;
        ">
                AlmairyExpress merupakan perusahaan jasa transportasi dan logistik
                yang menyediakan layanan pengiriman barang antar kota dan antar pulau.
                Dengan dukungan sistem tracking realtime dan manajemen pengiriman
                terintegrasi, kami berkomitmen memberikan layanan yang cepat,
                aman dan terpercaya.
            </p>

        </div>

    </div>
    ```

</section>

<!-- LAYANAN -->

<section class="section" style="background:white;">

    ```
    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Layanan Kami
        </h2>

        <div class="grid">

            <div class="service-card">
                <div class="service-icon">📦</div>
                <h3>Pengiriman Retail</h3>
                <p>
                    Pengiriman paket kecil hingga besar
                    dengan proses yang cepat, aman dan terpercaya.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">🚚</div>
                <h3>Antar Kota</h3>
                <p>
                    Distribusi barang antar kota dengan
                    jadwal pengiriman yang teratur.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">🌊</div>
                <h3>Antar Pulau</h3>
                <p>
                    Solusi logistik antar pulau melalui
                    jalur laut dan darat.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">📍</div>
                <h3>Tracking Realtime</h3>
                <p>
                    Pantau status pengiriman secara realtime
                    melalui nomor resi.
                </p>
            </div>

        </div>
    </div>
    ```

</section>

<!-- KEUNGGULAN -->

<section class="section">

    ```
    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Mengapa Memilih Kami?
        </h2>

        <div class="grid">

            <div class="adv-card">
                <div class="adv-icon">⚡</div>
                <h3>Cepat</h3>
                <p>
                    Proses pengiriman yang efisien
                    dan tepat waktu.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">🛡️</div>
                <h3>Aman</h3>
                <p>
                    Barang terlindungi selama proses
                    pengiriman.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">💰</div>
                <h3>Kompetitif</h3>
                <p>
                    Tarif transparan dan kompetitif
                    untuk semua pelanggan.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">💬</div>
                <h3>Support</h3>
                <p>
                    Customer support siap membantu
                    kebutuhan Anda.
                </p>
            </div>

        </div>

    </div>
    ```

</section>

<!-- CTA -->

<section style="
    background:#2563eb;
    color:white;
    padding:80px 0;
    text-align:center;
">

    ```
    <div class="container">

        <h2 style="
        font-size:42px;
        margin-bottom:20px;
    ">
            Siap Mengirim Barang Anda?
        </h2>

        <p style="
        max-width:700px;
        margin:auto;
        margin-bottom:30px;
        line-height:1.8;
    ">
            Gunakan layanan AlmairyExpress dan nikmati
            pengalaman pengiriman yang cepat,
            aman dan terpercaya.
        </p>

        <a href="{{ route('frontend.tracking') }}"
            class="btn"
            style="
            background:white;
            color:#2563eb;
            font-weight:bold;
       ">
            Lacak Paket Sekarang
        </a>

    </div>
    ```

</section>

@endsection