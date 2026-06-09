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
            Tentang Perusahaan
        </span>

        <h1 style="
            font-size:58px;
            font-weight:800;
            color:#0f172a;
            margin:25px 0;
        ">
            Tentang AlmairyExpress
        </h1>

        <p style="
    max-width:850px;
    margin:auto;
    color:#64748b;
    line-height:1.9;
    font-size:18px;
">
            PT Almairy Express merupakan perusahaan yang bergerak di bidang jasa
            ekspedisi dan logistik yang berperan sebagai perantara antara pengirim
            dan penerima barang. Dalam menjalankan proses bisnisnya, perusahaan
            bekerja sama dengan client dan vendor pengiriman untuk memastikan
            barang dapat diterima pelanggan dengan aman, tepat waktu, dan sesuai
            dengan tujuan pengiriman.
        </p>

        <p style="
        max-width:850px;
        margin:25px auto 0;
        color:#64748b;
        line-height:1.9;
        font-size:18px;
">
            Seiring meningkatnya kebutuhan akan pengelolaan distribusi yang lebih
            efektif dan efisien, PT Almairy Express mengimplementasikan
            Transportation Management System (TMS) sebagai solusi digital untuk
            mendukung proses pengiriman barang, monitoring distribusi secara
            realtime, pengelolaan data terpusat, serta penyusunan laporan yang
            lebih cepat dan akurat guna meningkatkan kualitas pelayanan kepada
            pelanggan.
        </p>

    </div>

</section>

<!-- PROFIL -->
<section class="section">

    <div class="container">

        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:50px;
            align-items:center;
        ">

            <div>

                <h2 class="section-title">
                    Siapa Kami?
                </h2>

                <p style="
    color:#64748b;
    line-height:2;
">
                    PT Almairy Express merupakan perusahaan jasa ekspedisi dan logistik
                    yang berfokus pada layanan distribusi barang antar kota maupun antar
                    pulau di Indonesia. Perusahaan berkomitmen memberikan pelayanan yang
                    cepat, aman, dan terpercaya melalui dukungan teknologi informasi yang
                    terintegrasi.
                </p>

                <br>

                <p style="
    color:#64748b;
    line-height:2;
">
                    Untuk mendukung efektivitas operasional, PT Almairy Express menerapkan
                    Transportation Management System (TMS) yang memungkinkan proses
                    pengelolaan pengiriman, monitoring status barang secara realtime,
                    pengelolaan dokumen pengiriman, serta penyusunan laporan operasional
                    dilakukan secara lebih terstruktur dan efisien.
                </p>

            </div>

            <div>

                <div style="
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
">

                    <div style="
        background:#f8fafc;
        padding:20px;
        border-radius:14px;
        text-align:center;
        border:1px solid #e2e8f0;
        transition:.3s;
    ">
                        <div style="font-size:30px;margin-bottom:10px;">📦</div>
                        <div style="font-weight:700;color:#0f172a;">
                            Pengiriman Retail
                        </div>
                    </div>

                    <div style="
        background:#f8fafc;
        padding:20px;
        border-radius:14px;
        text-align:center;
        border:1px solid #e2e8f0;
    ">
                        <div style="font-size:30px;margin-bottom:10px;">🚚</div>
                        <div style="font-weight:700;color:#0f172a;">
                            Antar Kota
                        </div>
                    </div>

                    <div style="
        background:#f8fafc;
        padding:20px;
        border-radius:14px;
        text-align:center;
        border:1px solid #e2e8f0;
    ">
                        <div style="font-size:30px;margin-bottom:10px;">🌊</div>
                        <div style="font-weight:700;color:#0f172a;">
                            Antar Pulau
                        </div>
                    </div>

                    <div style="
        background:#f8fafc;
        padding:20px;
        border-radius:14px;
        text-align:center;
        border:1px solid #e2e8f0;
    ">
                        <div style="font-size:30px;margin-bottom:10px;">📍</div>
                        <div style="font-weight:700;color:#0f172a;">
                            Tracking Realtime
                        </div>
                    </div>

                </div>

            </div>

</section>

<!-- VISI MISI -->
<section class="section" style="background:white;">

    <div class="container">

        <div class="grid">

            <div class="card">

                <h2 style="color:#2563eb;">
                    Visi
                </h2>

                <p style="
                    margin-top:15px;
                    color:#64748b;
                    line-height:1.9;
                ">
                    Menjadi perusahaan logistik dan transportasi
                    terpercaya yang memberikan layanan terbaik
                    bagi pelanggan di seluruh Indonesia.
                </p>

            </div>

            <div class="card">

                <h2 style="color:#2563eb;">
                    Misi
                </h2>

                <ul style="
                    margin-top:15px;
                    color:#64748b;
                    line-height:2;
                ">
                    <li>Memberikan layanan cepat dan tepat waktu.</li>
                    <li>Menjamin keamanan barang pelanggan.</li>
                    <li>Mengembangkan teknologi tracking realtime.</li>
                    <li>Meningkatkan kualitas pelayanan pelanggan.</li>
                </ul>

            </div>

        </div>

    </div>

</section>

<!-- NILAI -->
<section class="section">

    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Nilai Perusahaan
        </h2>

        <div class="grid">

            <div class="adv-card">
                <div class="adv-icon">🤝</div>
                <h3>Integritas</h3>
                <p>
                    Menjunjung tinggi kejujuran dan tanggung jawab.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">⚡</div>
                <h3>Profesional</h3>
                <p>
                    Memberikan pelayanan terbaik dengan standar tinggi.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">🎯</div>
                <h3>Komitmen</h3>
                <p>
                    Fokus pada kepuasan pelanggan.
                </p>
            </div>

            <div class="adv-card">
                <div class="adv-icon">🚀</div>
                <h3>Inovasi</h3>
                <p>
                    Terus berkembang mengikuti kemajuan teknologi.
                </p>
            </div>

        </div>

    </div>

</section>

<!-- TIMELINE -->
<section class="section" style="background:white;">

    <div class="container">

        <h2 class="section-title" style="text-align:center;">
            Perjalanan AlmairyExpress
        </h2>

        <div class="grid">

            <div class="card" style="text-align:center;">
                <h2 style="color:#2563eb;">2025</h2>
                <p>Pendirian Perusahaan</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="color:#2563eb;">2026</h2>
                <p>Implementasi Sistem Tracking</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="color:#2563eb;">2027</h2>
                <p>Ekspansi Antar Pulau</p>
            </div>

            <div class="card" style="text-align:center;">
                <h2 style="color:#2563eb;">2028</h2>
                <p>Pengembangan TMS Terintegrasi</p>
            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section style="
    background:#2563eb;
    color:white;
    text-align:center;
    padding:80px 0;
">

    <div class="container">

        <h2 style="
            font-size:40px;
            margin-bottom:20px;
        ">
            Bersama Kami Menghubungkan Indonesia
        </h2>

        <p style="
            max-width:700px;
            margin:auto;
            line-height:1.8;
            margin-bottom:30px;
        ">
            AlmairyExpress siap menjadi mitra logistik terpercaya
            untuk kebutuhan pengiriman Anda.
        </p>



    </div>

</section>

@endsection