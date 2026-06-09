<style>
    html,
    body {
        margin: 0;
        padding: 0;
        overflow-y: auto;
        overflow-x: hidden;
        min-height: 100%;
    }

    .current-dot {
        background: linear-gradient(135deg, #2563eb, #60a5fa);
    }

    .done-dot {
        background: linear-gradient(135deg, #22c55e, #4ade80);
    }
</style>

@extends('frontend.layouts.app')

@section('content')

<div style="
    min-height:calc(100vh - 80px);
    background:
    linear-gradient(rgba(255,255,255,.94), rgba(255,255,255,.94)),
    url('https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1600&auto=format&fit=crop');
    background-size:cover;
    background-position:center;
    padding:10px;
    display:flex;
    align-items:center;
    justify-content:center;
">

    <div style="
        width:100%;
        max-width:520px;
    ">

        {{-- MAIN CARD --}}
        <div style="
            background:rgba(255,255,255,.97);
            border-radius:18px;
            padding:18px;
            box-shadow:0 6px 20px rgba(0,0,0,.05);
            border:1px solid #e5e7eb;
        ">

            {{-- HEADER --}}
            <div style="
                display:flex;
                align-items:center;
                gap:10px;
                margin-bottom:16px;
            ">

                <div style="
                    width:40px;
                    height:40px;
                    border-radius:12px;
                    background:#eff6ff;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                ">
                    📦
                </div>

                <div>

                    <h1 style="
                        font-size:20px;
                        color:#0f172a;
                        margin:0;
                        font-weight:800;
                        line-height:1.2;
                    ">
                        Tracking Pengiriman
                    </h1>

                    <div style="
                        color:#64748b;
                        font-size:10px;
                    ">
                        Pantau status realtime
                    </div>

                </div>

            </div>

            {{-- INFO --}}
            <div style="
                background:#f8fafc;
                border-radius:14px;
                padding:14px;
                margin-bottom:16px;
                border:1px solid #e2e8f0;
            ">

                <h2 style="
                    font-size:18px;
                    color:#0f172a;
                    margin:0 0 14px 0;
                    font-weight:800;
                ">
                    {{ $pengiriman['resi'] }}
                </h2>

                <div style="
                    display:grid;
                    grid-template-columns:repeat(3,1fr);
                    gap:10px;
                ">

                    <div>

                        <div style="
                            color:#64748b;
                            font-size:9px;
                            margin-bottom:3px;
                            font-weight:700;
                        ">
                            STATUS
                        </div>

                        <div style="
                            font-size:13px;
                            font-weight:800;
                            color:#16a34a;
                        ">
                            {{ $pengiriman['status_label'] }}
                        </div>

                    </div>

                    <div>

                        <div style="
                            color:#64748b;
                            font-size:9px;
                            margin-bottom:3px;
                            font-weight:700;
                        ">
                            TUJUAN
                        </div>

                        <div style="
                            font-size:13px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            {{ $pengiriman['kota_tujuan'] }}
                        </div>

                    </div>

                    <div>

                        <div style="
                            color:#64748b;
                            font-size:9px;
                            margin-bottom:3px;
                            font-weight:700;
                        ">
                            TARIF
                        </div>

                        <div style="
                            font-size:13px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            {{ $pengiriman['tarif_format'] }}
                        </div>

                    </div>

                </div>

            </div>

            {{-- TITLE --}}
            <div style="
                margin-bottom:14px;
            ">

                <h2 style="
                    font-size:20px;
                    color:#0f172a;
                    margin:0 0 2px 0;
                    font-weight:800;
                ">
                    Riwayat Tracking
                </h2>

                <div style="
                    color:#64748b;
                    font-size:10px;
                ">
                    Riwayat perjalanan barang
                </div>

            </div>

            {{-- TIMELINE --}}
            <div style="
                position:relative;
                padding-left:24px;
            ">

                {{-- LINE --}}
                <div style="
                    position:absolute;
                    left:8px;
                    top:0;
                    bottom:0;
                    width:2px;
                    background:#dbeafe;
                    border-radius:999px;
                "></div>

                @foreach($history as $item)

                <div style="
                    position:relative;
                    margin-bottom:14px;
                ">

                    @php
                    $dotClass = $item['is_current'] ? 'current-dot' : 'done-dot';
                    @endphp

                    {{-- DOT --}}
                    <div
                        class="{{ $dotClass }}"
                        style="
                            position:absolute;
                            left:-24px;
                            top:2px;
                            width:18px;
                            height:18px;
                            border-radius:999px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:white;
                            font-size:9px;
                            font-weight:bold;
                        ">
                        ✓
                    </div>

                    {{-- CARD --}}
                    <div style="
                        background:white;
                        padding:10px;
                        border-radius:12px;
                        border-left:3px solid #2563eb;
                        box-shadow:0 2px 8px rgba(0,0,0,.03);
                    ">

                        <div style="
                            font-size:9px;
                            color:#64748b;
                            margin-bottom:3px;
                        ">
                            {{ $item['waktu'] }}
                        </div>

                        <div style="
                            font-size:13px;
                            font-weight:800;
                            color:#0f172a;
                            margin-bottom:3px;
                            line-height:1.3;
                        ">
                            {{ $item['keterangan'] }}
                        </div>

                        @if($item['lokasi'])

                        <div style="
                            color:#64748b;
                            font-size:10px;
                        ">
                            📍 {{ $item['lokasi'] }}
                        </div>

                        @endif

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection