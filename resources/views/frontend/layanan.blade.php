@extends('frontend.layouts.app')

@section('content')

<!-- HERO -->

<section style="
    background:linear-gradient(135deg,#eff6ff,#f8fafc);
    padding:100px 0;
">

    ```
    <div class="container" style="text-align:center;">

        <span style="
        background:#dbeafe;
        color:#2563eb;
        padding:8px 18px;
        border-radius:999px;
        font-size:14px;
        font-weight:600;
    ">
            Layanan PT AlmairyExpress
        </span>

        <h1 style="
        font-size:56px;
        font-weight:800;
        color:#0f172a;
        margin:25px 0;
    ">
            Solusi Pengiriman Barang
            yang Cepat dan Terpercaya
        </h1>

        <p style="
        max-width:850px;
        margin:auto;
        color:#64748b;
        line-height:1.9;
        font-size:18px;
    ">
            PT Almairy Express menyediakan berbagai layanan pengiriman
            barang yang didukung oleh sistem Transportation Management
            System (TMS) untuk memastikan proses distribusi berjalan
            lebih efektif, aman, dan transparan.
        </p>

    </div>
    ```

</section>

<!-- LAYANAN -->

<section class="section">

    ```
    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Layanan Utama Kami
        </h2>

        <div class="grid">

            <div class="service-card">

                <div class="service-icon">📦</div>

                <h3>Pengiriman Retail</h3>

                <p>
                    Melayani pengiriman paket dan barang
                    dalam berbagai ukuran dengan proses
                    yang cepat dan aman.
                </p>

            </div>

            <div class="service-card">

                <div class="service-icon">🚚</div>

                <h3>Pengiriman Antar Kota</h3>

                <p>
                    Distribusi barang antar kota dengan
                    jadwal pengiriman yang teratur dan
                    dapat dipantau.
                </p>

            </div>

            <div class="service-card">

                <div class="service-icon">🌊</div>

                <h3>Pengiriman Antar Pulau</h3>

                <p>
                    Solusi pengiriman barang antar pulau
                    menggunakan jalur darat dan laut
                    ke berbagai wilayah Indonesia.
                </p>

            </div>

            <div class="service-card">

                <div class="service-icon">📍</div>

                <h3>Live Tracking</h3>

                <p>
                    Pantau status pengiriman secara realtime
                    menggunakan nomor resi yang tersedia.
                </p>

            </div>

        </div>

    </div>
    ```

</section>


<!-- BENEFIT -->

<section class="section">

    ```
    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Manfaat Bagi Pelanggan
        </h2>

        <div class="grid">

            <div class="adv-card">

                <div class="adv-icon">⏱️</div>

                <h3>Estimasi Jelas</h3>

                <p>
                    Informasi pengiriman lebih jelas
                    dan mudah dipantau.
                </p>

            </div>

            <div class="adv-card">

                <div class="adv-icon">📍</div>

                <h3>Monitoring Realtime</h3>

                <p>
                    Status barang dapat diketahui
                    kapan saja dan di mana saja.
                </p>

            </div>

            <div class="adv-card">

                <div class="adv-icon">📄</div>

                <h3>Dokumentasi Digital</h3>

                <p>
                    Data pengiriman tersimpan
                    secara terpusat dan aman.
                </p>

            </div>

            <div class="adv-card">

                <div class="adv-icon">💳</div>

                <h3>Invoice Terintegrasi</h3>

                <p>
                    Mendukung proses penagihan
                    yang lebih cepat dan akurat.
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
    padding:90px 0;
    text-align:center;
">

    ```
    <div class="container">

        <h2 style="
        font-size:42px;
        margin-bottom:20px;
    ">
            Siap Menggunakan Layanan Kami?
        </h2>

        <p style="
        max-width:700px;
        margin:auto;
        line-height:1.8;
        margin-bottom:30px;
    ">
            PT Almairy Express siap membantu kebutuhan
            distribusi dan pengiriman barang Anda dengan
            dukungan sistem yang modern dan terpercaya.
        </p>

        <a href="{{ route('frontend.kontak') }}"
            class="btn"
            style="
            background:white;
            color:#2563eb;
            font-weight:bold;
       ">
            Hubungi Kami
        </a>

    </div>
    ```

</section>

@endsection