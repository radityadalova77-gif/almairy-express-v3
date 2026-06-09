@extends('backend.layouts.app')
@section('title','Tracking Pengiriman')
@section('page-title','Live Tracking Shipment')
@section('topbar-actions')

<a href="{{ route('pengiriman.index') }}" class="btn">
    Kembali
</a>
@endsection

@section('content')

@php
$progress = match($pengiriman->status){
'pending'=>15,
'gudang'=>35,
'transit'=>70,
'delivered'=>100,
'problem'=>60,
default=>50
};

$cls = [
'pending'=>'s-pending',
'gudang'=>'s-gudang',
'transit'=>'s-transit',
'delivered'=>'s-delivered',
'problem'=>'s-problem'
][$pengiriman->status] ?? 's-gudang';
@endphp


{{-- ================= HEADER SHIPMENT ================= --}}
<div class="card">

    <div class="flex justify-between align-center">
        <div>
            <div class="text-muted text-sm">Nomor Resi</div>
            <h2 style="margin-top:6px">
                {{ $pengiriman->resi }}
            </h2>
        </div>

        <span class="status {{ $cls }}">
            {{ $pengiriman->status_label }}
        </span>
    </div>


    <div style="margin-top:25px">

        <div class="fw600 mb8">
            Progress Pengiriman
        </div>

        <div style="
            background:#edf2f7;
            height:14px;
            border-radius:20px;
            overflow:hidden">

            <div class="route-fill" data-progress="{{ $progress }}">
            </div>

            <script>
                document.querySelectorAll('.route-fill').forEach(el => {
                    el.style.width = el.dataset.progress + '%';
                });
            </script>

        </div>

        <div class="text-sm text-muted mt8">
            {{ $progress }}% perjalanan selesai
        </div>

    </div>

</div>



{{-- ================= SHIPMENT INFO ================= --}}
<div class="card">

    <div class="card-title">
        Informasi Pengiriman
    </div>

    <div class="form-grid">

        <div>
            <label>Pengirim</label>
            <input readonly value="{{ $pengiriman->nama_pengirim }}">
        </div>

        <div>
            <label>Penerima</label>
            <input readonly value="{{ $pengiriman->nama_penerima }}">
        </div>

        <div>
            <label>Barang</label>
            <input readonly value="{{ $pengiriman->jenis_barang }}">
        </div>

        <div>
            <label>Jumlah / Berat</label>
            <input readonly value="{{ $pengiriman->jumlah_koli }} koli / {{ $pengiriman->berat_kg }} Kg">
        </div>

        <div>
            <label>Driver</label>
            <input readonly value="{{ $pengiriman->driver->nama ?? '-' }}">
        </div>

        <div>
            <label>Armada</label>
            <input readonly value="{{ $pengiriman->armada->no_plat ?? '-' }}">
        </div>

        <div>
            <label>Tujuan</label>
            <input readonly value="{{ $pengiriman->kota_tujuan }}">
        </div>

        <div>
            <label>ETA</label>
            <input readonly value="{{ $pengiriman->estimasi_tiba?->format('d M Y') }}">
        </div>

    </div>

</div>




{{-- ================= UPDATE POSISI DARI TIMELINE ================= --}}
<div class="card">

    <div class="card-title">
        Update Posisi Barang
    </div>

    <form method="POST" action="{{ route('tracking.tambah-history',$pengiriman) }}">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Status Update *</label>
                <select name="status" required>
                    <option value="gudang">Di Gudang</option>
                    <option value="transit">Dalam Perjalanan</option>
                    <option value="delivered">Sampai</option>
                    <option value="problem">Kendala</option>
                </select>
            </div>


            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" placeholder="Jakarta Hub">
            </div>


            <div class="form-group full">
                <label>Keterangan Timeline</label>
                <textarea name="keterangan" required placeholder="Contoh: Barang tiba di sorting center">
</textarea>
            </div>

        </div>

        <button class="btn btn-primary">
            Simpan Update
        </button>

    </form>

</div>




{{-- ================= TIMELINE ================= --}}
<div class="card">

    <div class="card-title">
        Timeline Tracking
    </div>

    <hr class="divider">


    @forelse($pengiriman->trackingHistory as $t)

    <div style="
padding:18px 0;
border-bottom:1px solid #eee">

        <div class="flex justify-between">

            <div>

                <div class="fw600">
                    {{ $t->keterangan }}
                </div>

                <div class="text-sm text-muted">
                    {{ $t->lokasi }}
                </div>

            </div>


            <div class="text-sm text-muted">
                {{ $t->waktu->format('d M Y H:i') }}
            </div>

        </div>

        @if($t->is_current)
        <span class="status s-transit mt8">
            Current Position
        </span>
        @endif

    </div>

    @empty

    <div style="padding:25px;text-align:center;color:#9ca3af">
        Belum ada histori tracking
    </div>

    @endforelse

</div>





{{-- ================= COST SUMMARY ================= --}}
<div class="card">

    <div class="card-title">
        Ringkasan Shipment
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">
                Tarif
            </div>

            <div class="stat-value">
                Rp {{ number_format($pengiriman->tarif,0,',','.') }}
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-label">
                Berat
            </div>

            <div class="stat-value">
                {{ $pengiriman->berat_kg }} Kg
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-label">
                Koli
            </div>

            <div class="stat-value">
                {{ $pengiriman->jumlah_koli }}
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-label">
                Status
            </div>

            <div class="stat-value">
                {{ $pengiriman->status_label }}
            </div>
        </div>

    </div>

</div>

@endsection