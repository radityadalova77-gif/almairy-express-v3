@extends('backend.layouts.app')

@section('title','Detail Pengiriman')
@section('page-title','Detail Pengiriman')

@section('topbar-actions')
<a href="{{ route('pengiriman.index') }}" class="btn">
    ← Kembali
</a>
@endsection


@section('content')

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Status</div>
        <div class="stat-value">
            {{ $pengiriman->status }}
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Driver</div>
        <div class="stat-value">
            {{ $pengiriman->driver->nama_driver ?? '-' }}
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Armada</div>
        <div class="stat-value">
            {{ $pengiriman->armada->plat_nomor ?? '-' }}
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Resi</div>
        <div class="stat-value">
            {{ $pengiriman->kode_pengiriman }}
        </div>
    </div>

</div>



<div class="card">

    <div class="card-title">
        Informasi Shipment
    </div>

    <div class="form-grid">

        <div class="form-group">
            <label>Kode Pengiriman</label>
            <input value="{{ $pengiriman->kode_pengiriman }}" readonly>
        </div>

        <div class="form-group">
            <label>Status</label>
            <input value="{{ $pengiriman->status }}" readonly>
        </div>

        <div class="form-group">
            <label>Asal</label>
            <input value="{{ $pengiriman->asal }}" readonly>
        </div>

        <div class="form-group">
            <label>Tujuan</label>
            <input value="{{ $pengiriman->tujuan }}" readonly>
        </div>

        <div class="form-group">
            <label>Driver</label>
            <input value="{{ $pengiriman->driver->nama_driver ?? '-' }}" readonly>
        </div>

        <div class="form-group">
            <label>Armada</label>
            <input value="{{ $pengiriman->armada->plat_nomor ?? '-' }}" readonly>
        </div>

        <div class="form-group full">
            <label>Keterangan Barang</label>
            <textarea readonly>
            {{ $pengiriman->deskripsi_barang }}
            </textarea>
        </div>

    </div>

</div>



<div class="card">

    <div class="card-title">
        Progress Tracking
    </div>

    <div class="timeline">

        @forelse($pengiriman->trackingHistory as $track)

        <div class="tl-item">

            <div class="tl-dot
@if($track->is_current)
current
@elseif($track->is_done)
done
@endif
"></div>

            @if(!$loop->last)
            <div class="tl-line"></div>
            @endif

            <div class="tl-time">
                {{ $track->waktu }}
            </div>

            <div class="tl-text">
                {{ $track->keterangan }}
            </div>

            <div class="tl-loc">
                {{ $track->lokasi }}
            </div>

        </div>

        @empty

        Tracking belum tersedia

        @endforelse

    </div>

</div>




<div class="card">

    <div class="card-title">
        Progress Rute
    </div>

    <div class="route-bar">
        <div class="route-fill" style="width:70%">
        </div>
    </div>

    <div class="text-sm text-muted">
        70% perjalanan selesai
    </div>

</div>

@endsection