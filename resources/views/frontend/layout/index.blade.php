@extends('layouts.app')

@section('title', 'PT Khaidardeeva — Ekspedisi & Logistik Terpercaya')

@push('styles')
<style>
    /* ─── HERO ─────────────────────────────────────────────── */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 0 5%;
        position: relative;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        background:
            radial-gradient(ellipse 80% 60% at 65% 50%, rgba(232, 160, 32, 0.08) 0%, transparent 65%),
            radial-gradient(ellipse 40% 40% at 20% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 60%);
    }

    .hero-grid-lines {
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
        background-size: 60px 60px;
        mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 30%, transparent 100%);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 640px;
        padding-top: 80px;
    }

    .hero-eyebrow {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .hero-title {
        font-family: var(--f-display);
        font-size: clamp(2.4rem, 5.5vw, 4rem);
        font-weight: 800;
        line-height: 1.12;
        letter-spacing: -1px;
        margin-bottom: 20px;
    }

    .hero-title .accent {
        color: var(--c-primary);
    }

    .hero-title .line2 {
        display: block;
        background: linear-gradient(90deg, #F0F2F5 30%, rgba(240, 242, 245, 0.4));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-desc {
        font-size: 16px;
        color: var(--c-muted);
        line-height: 1.75;
        margin-bottom: 36px;
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 48px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        background: var(--c-primary);
        color: #0A0C10;
        font-weight: 700;
        font-size: 14px;
        border-radius: var(--radius-sm);
        border: none;
        cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s;
        font-family: var(--f-body);
        text-decoration: none;
    }

    .btn-primary:hover {
        background: var(--c-primary-d);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(232, 160, 32, 0.3);
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        background: transparent;
        color: var(--c-text);
        font-weight: 500;
        font-size: 14px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--c-border);
        cursor: pointer;
        transition: .2s;
        font-family: var(--f-body);
        text-decoration: none;
    }

    .btn-ghost:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.15);
    }

    /* Hero quick-track card */
    .hero-track-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 20px;
        max-width: 460px;
        position: relative;
    }

    .hero-track-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--c-primary), transparent);
    }

    .hero-track-label {
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--c-muted);
        margin-bottom: 10px;
        font-weight: 500;
    }

    .hero-track-input-wrap {
        display: flex;
        gap: 8px;
    }

    .hero-track-input {
        flex: 1;
        padding: 10px 14px;
        background: var(--c-surface2);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        color: var(--c-text);
        font-size: 13.5px;
        font-family: var(--f-body);
        outline: none;
        transition: border-color .2s;
    }

    .hero-track-input:focus {
        border-color: var(--c-primary);
    }

    .hero-track-input::placeholder {
        color: var(--c-muted2);
    }

    .btn-track {
        padding: 10px 18px;
        background: var(--c-primary);
        color: #0A0C10;
        font-weight: 700;
        font-size: 13px;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        white-space: nowrap;
        font-family: var(--f-body);
        transition: .2s;
    }

    .btn-track:hover {
        background: var(--c-primary-d);
    }

    .hero-track-hint {
        font-size: 11px;
        color: var(--c-muted2);
        margin-top: 8px;
    }

    /* Hero right — floating stats */
    .hero-right {
        position: absolute;
        right: 5%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 220px;
    }

    .hero-stat-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 16px 18px;
        animation: float 4s ease-in-out infinite;
    }

    .hero-stat-card:nth-child(2) {
        animation-delay: 1.3s;
        margin-left: 28px;
    }

    .hero-stat-card:nth-child(3) {
        animation-delay: 2.6s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .stat-num {
        font-family: var(--f-display);
        font-size: 26px;
        font-weight: 800;
        color: var(--c-primary);
    }

    .stat-lbl {
        font-size: 11.5px;
        color: var(--c-muted);
        margin-top: 2px;
    }

    /* ─── MARQUEE ───────────────────────────────────────────── */
    .marquee-section {
        padding: 0;
        border-top: 1px solid var(--c-border);
        border-bottom: 1px solid var(--c-border);
        overflow: hidden;
        background: var(--c-surface);
    }

    .marquee-track {
        display: flex;
        align-items: center;
        padding: 14px 0;
        animation: marquee 28s linear infinite;
        white-space: nowrap;
    }

    .marquee-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0 32px;
        font-size: 12.5px;
        color: var(--c-muted);
        font-weight: 500;
        letter-spacing: .3px;
    }

    .marquee-item::before {
        content: '→';
        color: var(--c-primary);
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* ─── SECTION HEADER ────────────────────────────────────── */
    .section-header {
        text-align: center;
        margin-bottom: 52px;
    }

    .section-header h2 {
        font-family: var(--f-display);
        font-size: clamp(1.7rem, 3.5vw, 2.4rem);
        font-weight: 800;
        line-height: 1.2;
        margin-top: 12px;
        margin-bottom: 12px;
        letter-spacing: -.5px;
    }

    .section-header p {
        color: var(--c-muted);
        font-size: 15px;
        max-width: 480px;
        margin: 0 auto;
    }

    /* ─── STATS BAND ────────────────────────────────────────── */
    .stats-band {
        padding: 48px 5%;
        background: var(--c-surface);
        border-top: 1px solid var(--c-border);
        border-bottom: 1px solid var(--c-border);
    }

    .stats-grid {
        max-width: 900px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2px;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        border-right: 1px solid var(--c-border);
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-item .n {
        font-family: var(--f-display);
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--c-primary);
    }

    .stat-item .l {
        font-size: 12.5px;
        color: var(--c-muted);
        margin-top: 4px;
    }

    /* ─── LAYANAN ───────────────────────────────────────────── */
    #layanan {
        background: var(--c-bg);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .service-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 28px;
        transition: border-color .25s, transform .25s, box-shadow .25s;
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .service-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--c-primary), transparent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .3s;
    }

    .service-card:hover {
        border-color: rgba(232, 160, 32, 0.3);
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    .service-card:hover::after {
        transform: scaleX(1);
    }

    .service-icon {
        width: 44px;
        height: 44px;
        background: var(--c-primary-glow);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 18px;
    }

    .service-card h3 {
        font-family: var(--f-display);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .service-card p {
        font-size: 13.5px;
        color: var(--c-muted);
        line-height: 1.65;
    }

    .service-tag {
        display: inline-block;
        margin-top: 14px;
        font-size: 11px;
        color: var(--c-primary);
        background: var(--c-primary-glow);
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* ─── KENAPA KAMI ───────────────────────────────────────── */
    #tentang {
        background: var(--c-surface);
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .about-visual {
        position: relative;
        background: var(--c-surface2);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 32px;
        overflow: hidden;
    }

    .about-visual::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(232, 160, 32, 0.12), transparent 70%);
    }

    .about-feature-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .about-feature {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .about-feature-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        background: var(--c-primary-glow);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .about-feature h4 {
        font-family: var(--f-display);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .about-feature p {
        font-size: 12.5px;
        color: var(--c-muted);
    }

    .about-text {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .about-text h2 {
        font-family: var(--f-display);
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        letter-spacing: -.5px;
        line-height: 1.2;
    }

    .about-text h2 span {
        color: var(--c-primary);
    }

    .about-text p {
        font-size: 14.5px;
        color: var(--c-muted);
        line-height: 1.75;
    }

    .about-bullets {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .about-bullets li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        color: var(--c-text);
        list-style: none;
    }

    .about-bullets li::before {
        content: '✓';
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        background: var(--c-primary-glow);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: var(--c-primary);
        font-weight: 700;
    }

    /* ─── JANGKAUAN ─────────────────────────────────────────── */
    #jangkauan {
        background: var(--c-bg);
    }

    .islands-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-top: 8px;
    }

    .island-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 22px 18px;
        text-align: center;
        transition: .25s;
    }

    .island-card:hover {
        border-color: rgba(232, 160, 32, 0.3);
        transform: translateY(-3px);
    }

    .island-emoji {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .island-name {
        font-family: var(--f-display);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .island-cities {
        font-size: 11.5px;
        color: var(--c-muted);
        line-height: 1.6;
    }

    /* ─── CTA TRACK ─────────────────────────────────────────── */
    .cta-track {
        margin: 0 5%;
        background: linear-gradient(135deg, #1A1208 0%, #0D1020 100%);
        border: 1px solid rgba(232, 160, 32, 0.2);
        border-radius: var(--radius);
        padding: 60px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-track::before {
        content: '';
        position: absolute;
        top: -60px;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        height: 200px;
        background: radial-gradient(ellipse, rgba(232, 160, 32, 0.15), transparent 70%);
        pointer-events: none;
    }

    .cta-track h2 {
        font-family: var(--f-display);
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800;
        letter-spacing: -.5px;
        margin: 12px 0 16px;
    }

    .cta-track h2 span {
        color: var(--c-primary);
    }

    .cta-track p {
        color: var(--c-muted);
        font-size: 15px;
        margin-bottom: 32px;
    }

    .cta-track-form {
        display: flex;
        gap: 10px;
        justify-content: center;
        max-width: 480px;
        margin: 0 auto;
    }

    .cta-track-input {
        flex: 1;
        padding: 13px 18px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: var(--radius-sm);
        color: var(--c-text);
        font-size: 14px;
        font-family: var(--f-body);
        outline: none;
        transition: border-color .2s;
    }

    .cta-track-input:focus {
        border-color: var(--c-primary);
    }

    .cta-track-input::placeholder {
        color: rgba(255, 255, 255, 0.25);
    }

    /* ─── KONTAK ────────────────────────────────────────────── */
    #kontak {
        background: var(--c-surface);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 18px;
        background: var(--c-surface2);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
    }

    .contact-item-icon {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        background: var(--c-primary-glow);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .contact-item h4 {
        font-size: 12px;
        color: var(--c-muted);
        margin-bottom: 3px;
        font-weight: 400;
    }

    .contact-item p {
        font-size: 14px;
        font-weight: 500;
    }

    .contact-form {
        background: var(--c-surface2);
        border: 1px solid var(--c-border);
        border-radius: var(--radius);
        padding: 28px;
    }

    .contact-form h3 {
        font-family: var(--f-display);
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
    }

    .form-group.full {
        grid-column: 1/-1;
    }

    .form-group label {
        font-size: 12px;
        color: var(--c-muted);
        font-weight: 500;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        padding: 10px 14px;
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        color: var(--c-text);
        font-size: 13.5px;
        font-family: var(--f-body);
        outline: none;
        transition: border-color .2s;
        width: 100%;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: var(--c-primary);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 90px;
    }

    .form-group select option {
        background: var(--c-surface2);
    }

    /* ─── ANIMATIONS ────────────────────────────────────────── */
    .anim {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s ease, transform .6s ease;
    }

    .anim.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .anim-delay-1 {
        transition-delay: .1s;
    }

    .anim-delay-2 {
        transition-delay: .2s;
    }

    .anim-delay-3 {
        transition-delay: .3s;
    }

    .anim-delay-4 {
        transition-delay: .4s;
    }

    /* ─── RESPONSIVE ────────────────────────────────────────── */
    @media (max-width: 1100px) {
        .hero-right {
            display: none;
        }

        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .islands-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .about-grid {
            grid-template-columns: 1fr;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-item {
            border-right: none;
            border-bottom: 1px solid var(--c-border);
        }

        .services-grid {
            grid-template-columns: 1fr;
        }

        .cta-track-form {
            flex-direction: column;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .cta-track {
            margin: 0 3%;
            padding: 40px 20px;
        }
    }

    @media (max-width: 480px) {
        .hero-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-ghost {
            justify-content: center;
        }

        .islands-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endpush

@section('content')

{{-- ─── HERO ──────────────────────────────────────────── --}}
<section class="hero" id="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid-lines"></div>

    <div class="hero-content">
        <div class="hero-eyebrow">
            <span class="chip"><span class="badge-dot"></span> Beroperasi 24/7</span>
            <span style="font-size:12px;color:var(--c-muted)">Sejak 2018</span>
        </div>

        <h1 class="hero-title">
            Kirim Lebih <span class="accent">Cepat</span>,
            <span class="line2">Sampai Lebih Pasti.</span>
        </h1>

        <p class="hero-desc">
            PT Khaidardeeva — mitra ekspedisi dan logistik terpercaya yang menghadirkan pengiriman
            ke seluruh Indonesia dengan sistem tracking real-time.
        </p>

        <div class="hero-actions">
            <a href="{{ route('tracking.index') }}" class="btn-primary">
                🔍 Lacak Kiriman Sekarang
            </a>
            <a href="#layanan" class="btn-ghost">
                Lihat Layanan →
            </a>
        </div>

        {{-- Quick Track --}}
        <div class="hero-track-card">
            <div class="hero-track-label">⚡ Cek Resi Cepat</div>
            <div class="hero-track-input-wrap">
                <input class="hero-track-input" id="quick-resi" type="text"
                    placeholder="Masukkan nomor resi... (MIKA-EXP-XXXXXX)"
                    onkeydown="if(event.key==='Enter') quickTrack()">
                <button class="btn-track" onclick="quickTrack()">Lacak</button>
            </div>
            <div class="hero-track-hint">Contoh: MIKA-EXP-000917 · SBY-EXP-000023</div>
        </div>
    </div>

    {{-- Floating stat cards --}}
    <div class="hero-right">
        <div class="hero-stat-card">
            <div class="stat-num">{{ number_format($stats['pengiriman_aktif'] ?? 247) }}</div>
            <div class="stat-lbl">Pengiriman Aktif Hari Ini</div>
        </div>
        <div class="hero-stat-card">
            <div class="stat-num">{{ $stats['on_time_pct'] ?? '94' }}%</div>
            <div class="stat-lbl">Ketepatan Waktu</div>
        </div>
        <div class="hero-stat-card">
            <div class="stat-num">{{ number_format($stats['kota_terjangkau'] ?? 280) }}</div>
            <div class="stat-lbl">Kota Terjangkau</div>
        </div>
    </div>
</section>

{{-- ─── MARQUEE ────────────────────────────────────────── --}}
<div class="marquee-section">
    <div class="marquee-track" id="marquee">
        @php
        $cities =
        ['Jakarta','Surabaya','Bandung','Medan','Makassar','Balikpapan','Palembang','Semarang','Yogyakarta','Batam','Manado','Pontianak','Banjarmasin','Pekanbaru','Padang','Denpasar','Mataram','Kupang','Ambon','Jayapura'];
        @endphp
        @foreach(array_merge($cities, $cities) as $city)
        <span class="marquee-item">{{ $city }}</span>
        @endforeach
    </div>
</div>

{{-- ─── STATS BAND ─────────────────────────────────────── --}}
<div class="stats-band">
    <div class="stats-grid">
        <div class="stat-item anim">
            <div class="n" data-count="{{ $stats['total_pengiriman'] ?? 28400 }}">0</div>
            <div class="l">Total Pengiriman</div>
        </div>
        <div class="stat-item anim anim-delay-1">
            <div class="n">280+</div>
            <div class="l">Kota Terjangkau</div>
        </div>
        <div class="stat-item anim anim-delay-2">
            <div class="n">{{ $stats['total_pelanggan'] ?? '1.200' }}+</div>
            <div class="l">Pelanggan Aktif</div>
        </div>
        <div class="stat-item anim anim-delay-3">
            <div class="n">6+</div>
            <div class="l">Tahun Pengalaman</div>
        </div>
    </div>
</div>

{{-- ─── LAYANAN ─────────────────────────────────────────── --}}
<section id="layanan">
    <div class="container">
        <div class="section-header anim">
            <div class="chip">Layanan Kami</div>
            <h2>Solusi Pengiriman<br>untuk Setiap Kebutuhan</h2>
            <p>Dari paket kecil hingga kargo besar, kami siap melayani dengan standar terbaik</p>
        </div>

        <div class="services-grid">
            @php
            $services = [
            ['icon'=>'📦','title'=>'Pengiriman Reguler','desc'=>'Pengiriman hemat dengan estimasi 2–5 hari kerja. Cocok
            untuk pengiriman non-urgent dengan harga kompetitif.','tag'=>'Hemat & Aman'],
            ['icon'=>'⚡','title'=>'Pengiriman Express','desc'=>'Sampai dalam 1–2 hari! Prioritas penanganan untuk
            kiriman mendesak ke seluruh kota besar Indonesia.','tag'=>'1–2 Hari'],
            ['icon'=>'🚛','title'=>'Kargo & LTL/FTL','desc'=>'Solusi angkut barang dalam jumlah besar. Tersedia layanan
            LTL (muatan gabung) dan FTL (sewa penuh).','tag'=>'Kapasitas Besar'],
            ['icon'=>'🏠','title'=>'Door-to-Door','desc'=>'Layanan jemput dan antar langsung dari pintu ke pintu. Tidak
            perlu repot ke agen atau drop point.','tag'=>'Langsung ke Tujuan'],
            ['icon'=>'💵','title'=>'Pengiriman COD','desc'=>'Bayar saat barang tiba. Solusi terpercaya untuk transaksi
            e-commerce dan bisnis online Anda.','tag'=>'Bayar di Tujuan'],
            ['icon'=>'❄️','title'=>'Cold Chain Logistics','desc'=>'Pengiriman barang sensitif suhu — makanan, farmasi,
            dan produk segar dengan kontrol temperatur ketat.','tag'=>'Suhu Terkontrol'],
            ];
            @endphp
            @foreach($services as $i => $svc)
            <div class="service-card anim anim-delay-{{ $i % 3 }}">
                <div class="service-icon">{{ $svc['icon'] }}</div>
                <h3>{{ $svc['title'] }}</h3>
                <p>{{ $svc['desc'] }}</p>
                <span class="service-tag">{{ $svc['tag'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── TENTANG / KENAPA KAMI ──────────────────────────── --}}
<section id="tentang">
    <div class="container">
        <div class="about-grid">
            <div class="about-visual anim">
                <div class="about-feature-list">
                    @php
                    $features = [
                    ['icon'=>'🛡️','title'=>'Keamanan Terjamin','desc'=>'Setiap kiriman diasuransikan dan dipantau
                    sepanjang perjalanan'],
                    ['icon'=>'📍','title'=>'Tracking Real-Time','desc'=>'Pantau posisi paket Anda kapan saja, di mana
                    saja melalui website atau WhatsApp'],
                    ['icon'=>'🤝','title'=>'Tim CS Responsif','desc'=>'Customer service siap membantu 24/7 via WhatsApp,
                    telepon, dan email'],
                    ['icon'=>'🏆','title'=>'Berpengalaman Sejak 2018','desc'=>'Lebih dari 6 tahun melayani ribuan
                    pelanggan dari Sabang sampai Merauke'],
                    ];
                    @endphp
                    @foreach($features as $feat)
                    <div class="about-feature">
                        <div class="about-feature-icon">{{ $feat['icon'] }}</div>
                        <div>
                            <h4>{{ $feat['title'] }}</h4>
                            <p>{{ $feat['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="about-text anim anim-delay-1">
                <div class="chip">Kenapa PT Khaidardeeva?</div>
                <h2>Logistik Handal, <span>Partner Bisnis</span> Terpercaya</h2>
                <p>
                    Kami bukan sekadar jasa pengiriman — kami adalah mitra strategis bisnis Anda.
                    Dengan armada modern, teknologi tracking mutakhir, dan tim profesional,
                    kami memastikan setiap paket sampai tepat waktu dan dalam kondisi sempurna.
                </p>
                <ul class="about-bullets">
                    <li>Jangkauan ke 280+ kota di seluruh Indonesia</li>
                    <li>Armada kendaraan modern dan terawat</li>
                    <li>Sistem tracking digital berbasis nomor resi</li>
                    <li>Harga transparan tanpa biaya tersembunyi</li>
                    <li>Asuransi pengiriman tersedia untuk semua layanan</li>
                    <li>Terintegrasi dengan marketplace & platform e-commerce</li>
                </ul>
                <div>
                    <a href="#kontak" class="btn-primary" style="display:inline-flex;">
                        Hubungi Kami Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ─── JANGKAUAN ───────────────────────────────────────── --}}
<section id="jangkauan">
    <div class="container">
        <div class="section-header anim">
            <div class="chip">Area Jangkauan</div>
            <h2>Melayani Seluruh<br>Nusantara</h2>
            <p>Pengiriman ke semua pulau besar dan ratusan kota di Indonesia</p>
        </div>

        <div class="islands-grid">
            @php
            $islands = [
            ['emoji'=>'🗺️','name'=>'Jawa','cities'=>'Jakarta, Surabaya, Bandung, Semarang, Yogyakarta, Malang, Bogor,
            Bekasi, Depok +50 kota'],
            ['emoji'=>'🌋','name'=>'Sumatera','cities'=>'Medan, Palembang, Pekanbaru, Padang, Batam, Bandar Lampung,
            Jambi +40 kota'],
            ['emoji'=>'🌴','name'=>'Kalimantan','cities'=>'Balikpapan, Samarinda, Banjarmasin, Pontianak, Palangkaraya
            +25 kota'],
            ['emoji'=>'🏝️','name'=>'Sulawesi','cities'=>'Makassar, Manado, Palu, Kendari, Gorontalo +20 kota'],
            ['emoji'=>'🌺','name'=>'Bali & NTB','cities'=>'Denpasar, Mataram, Bima, Sumbawa +15 kota'],
            ['emoji'=>'🦅','name'=>'Papua','cities'=>'Jayapura, Sorong, Manokwari, Timika, Merauke +10 kota'],
            ['emoji'=>'🐚','name'=>'Maluku & NTT','cities'=>'Ambon, Kupang, Ende, Maumere, Ternate +12 kota'],
            ['emoji'=>'⭐','name'=>'Seluruh Indonesia','cities'=>'280+ kota dan terus berkembang. Hubungi kami untuk area
            lainnya.'],
            ];
            @endphp
            @foreach($islands as $i => $island)
            <div class="island-card anim anim-delay-{{ $i % 4 }}">
                <div class="island-emoji">{{ $island['emoji'] }}</div>
                <div class="island-name">{{ $island['name'] }}</div>
                <div class="island-cities">{{ $island['cities'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── CTA TRACK ───────────────────────────────────────── --}}
<div class="cta-track">
    <div class="chip">Tracking Kiriman</div>
    <h2>Dimana Paket<br><span>Anda Sekarang?</span></h2>
    <p>Lacak status pengiriman real-time dengan nomor resi Anda</p>
    <div class="cta-track-form">
        <input class="cta-track-input" id="cta-resi" type="text" placeholder="Masukkan nomor resi Anda..."
            onkeydown="if(event.key==='Enter') ctaTrack()">
        <button class="btn-primary" onclick="ctaTrack()" style="white-space:nowrap;">
            🔍 Lacak Sekarang
        </button>
    </div>
    <p style="font-size:12px;color:var(--c-muted);margin-top:12px;">
        Atau <a href="{{ route('tracking.index') }}" style="color:var(--c-primary);">buka halaman tracking lengkap →</a>
    </p>
</div>

{{-- ─── KONTAK ──────────────────────────────────────────── --}}
<section id="kontak">
    <div class="container">
        <div class="section-header anim">
            <div class="chip">Hubungi Kami</div>
            <h2>Ada Pertanyaan?<br>Kami Siap Membantu</h2>
            <p>Tim customer service kami siap melayani Anda 24 jam sehari, 7 hari seminggu</p>
        </div>

        <div class="contact-grid">
            <div class="contact-info anim">
                @php
                $contacts = [
                ['icon'=>'📍','label'=>'Alamat Kantor','value'=>'Jl. Industri Raya No. 88, Cakung, Jakarta Timur
                13910'],
                ['icon'=>'📞','label'=>'Telepon / WhatsApp','value'=>'+62 812-3456-7890'],
                ['icon'=>'📧','label'=>'Email','value'=>'info@khaidardeeva.com'],
                ['icon'=>'🕐','label'=>'Jam Operasional','value'=>'Senin–Sabtu: 08.00–17.00 WIB | Darurat: 24/7'],
                ];
                @endphp
                @foreach($contacts as $c)
                <div class="contact-item">
                    <div class="contact-item-icon">{{ $c['icon'] }}</div>
                    <div>
                        <h4>{{ $c['label'] }}</h4>
                        <p>{{ $c['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="contact-form anim anim-delay-1">
                <h3>Kirim Pesan</h3>
                <form action="{{ route('kontak.kirim') }}" method="POST" onsubmit="submitKontak(event)">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="nama" placeholder="Nama Anda" required>
                        </div>
                        <div class="form-group">
                            <label>No. WhatsApp *</label>
                            <input type="text" name="telepon" placeholder="08xx-xxxx-xxxx" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@anda.com">
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <select name="perihal">
                            <option>Pertanyaan Pengiriman</option>
                            <option>Komplain / Keluhan</option>
                            <option>Kerjasama Bisnis</option>
                            <option>Permintaan Penawaran</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pesan *</label>
                        <textarea name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">
                        Kirim Pesan →
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function quickTrack() {
        const resi = document.getElementById('quick-resi').value.trim();
        if (!resi) {
            showToast('Masukkan nomor resi terlebih dahulu', 'error');
            return;
        }
        window.location.href = `{{ route('tracking.index') }}?resi=${encodeURIComponent(resi)}`;
    }

    function ctaTrack() {
        const resi = document.getElementById('cta-resi').value.trim();
        if (!resi) {
            showToast('Masukkan nomor resi terlebih dahulu', 'error');
            return;
        }
        window.location.href = `{{ route('tracking.index') }}?resi=${encodeURIComponent(resi)}`;
    }

    function submitKontak(e) {
        e.preventDefault();
        const form = e.target;
        const data = new FormData(form);
        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: data
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    showToast('✅ Pesan terkirim! Kami akan menghubungi Anda segera.', 'success');
                    form.reset();
                } else {
                    showToast('❌ Gagal mengirim pesan. Coba lagi.', 'error');
                }
            })
            .catch(() => showToast('❌ Terjadi kesalahan. Coba lagi.', 'error'));
    }

    // Counter animation
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-count'));
        if (!target) return;
        let current = 0;
        const step = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = current.toLocaleString('id-ID');
            if (current >= target) clearInterval(timer);
        }, 25);
    }

    // Trigger counters on visible
    const counterObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('[data-count]').forEach(animateCounter);
                counterObs.unobserve(e.target);
            }
        });
    }, {
        threshold: 0.3
    });
    document.querySelectorAll('.stats-grid').forEach(el => counterObs.observe(el));
</script>
@endpush