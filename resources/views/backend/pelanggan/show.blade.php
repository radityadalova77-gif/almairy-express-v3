@extends('backend.layouts.app')
@section('title','Detail Pelanggan')
@section('page-title','Detail Pelanggan')

@section('content')

<div class="card">

    <div class="flex justify-between align-center">
        <div>
            <h2>{{ $pelanggan->nama_perusahaan }}</h2>
            <div class="text-muted">{{ $pelanggan->nama_kontak }}</div>
        </div>

        <span class="status {{ $pelanggan->status=='aktif'?'s-aktif':'s-nonaktif' }}">
            {{ $pelanggan->status }}
        </span>
    </div>

</div>


<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Total Pengiriman</div>
        <div class="stat-value">{{ $pelanggan->total_pengiriman }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Nilai</div>
        <div class="stat-value">
            Rp {{ number_format($pelanggan->total_nilai,0,',','.') }}
        </div>
    </div>

</div>


<div class="card">
    <div class="card-title">Informasi Kontak</div>

    <div class="form-grid">

        <div>
            <label>No HP</label>
            <input readonly value="{{ $pelanggan->no_hp }}">
        </div>

        <div>
            <label>Email</label>
            <input readonly value="{{ $pelanggan->email }}">
        </div>

        <div>
            <label>Kota</label>
            <input readonly value="{{ $pelanggan->kota }}">
        </div>

        <div class="form-group full">
            <label>Alamat</label>
            <textarea readonly>{{ $pelanggan->alamat }}</textarea>
        </div>

    </div>

</div>

@endsection