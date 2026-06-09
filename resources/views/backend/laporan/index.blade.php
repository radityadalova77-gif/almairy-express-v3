@extends('backend.layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan & Analytics')

@section('content')

{{-- ================= FILTER ================= --}}
<div class="card" style="margin-bottom: 20px;">
    <form method="GET" class="flex gap8" style="align-items: center; flex-wrap: wrap;">
        <label>Dari</label>
        <input type="date" name="dari" value="{{ $from }}">

        <label>Sampai</label>
        <input type="date" name="sampai" value="{{ $to }}">

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

{{-- ================= KPI ================= --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Total Pengiriman</div>
        <div class="stat-value">{{ $totalPengiriman }}</div>
        <div class="{{ $growthPengiriman >= 0 ? 'text-green' : 'text-red' }}">
            {{ $growthPengiriman >= 0 ? '+' : '' }}{{ $growthPengiriman }}%
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">Rp {{ number_format($revenue,0,',','.') }}</div>
        <div class="{{ $growthRevenue >= 0 ? 'text-green' : 'text-red' }}">
            {{ $growthRevenue >= 0 ? '+' : '' }}{{ $growthRevenue }}%
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">On-Time Delivery</div>
        <div class="stat-value">{{ $onTimePct }}%</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Problem</div>
        <div class="stat-value text-red">{{ $problem }}</div>
    </div>

</div>

{{-- ================= GRID ================= --}}
<div class="grid-2" style="margin-top:20px;">

    {{-- TREND --}}
    <div class="card">
        <div class="card-title">Trend Pengiriman</div>

        @php
        $chartData = collect($chart ?? []);
        $maxVal = $chartData->max('value') ?: 1;
        @endphp

        @if($chartData->isNotEmpty())
        <div class="mini-bars">
            @foreach($chartData as $c)
            @php
            $val = (int)($c['value'] ?? 0);
            $h = max(10, ($val / $maxVal) * 100);
            @endphp
            <div class="bar" style="--h: {{ $h }};" title="{{ $c['label'] }}: {{ $val }}"></div>
            @endforeach
        </div>

        <div class="bar-lbl">
            @foreach($chartData as $c)
            <span>{{ $c['label'] }}</span>
            @endforeach
        </div>
        @else
        <p class="text-muted">Tidak ada data</p>
        @endif
    </div>

    {{-- TOP KOTA --}}
    <div class="card">
        <div class="card-title">Top Kota</div>
        <div class="top-kota">
            @foreach($topKota as $i => $k)
            <div class="top-item">
                <div class="rank">#{{ $i+1 }}</div>

                <div class="kota">
                    {{ ucfirst($k->kota_tujuan) }}
                </div>

                <div class="total">
                    {{ $k->total }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

{{-- ================= SUMMARY STATUS ================= --}}
<div class="card" style="margin-top:20px;">
    <div class="card-title">Ringkasan Status Pengiriman</div>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Menunggu</td>
                <td>{{ $pending }}</td>
            </tr>
            <tr>
                <td>Di Gudang</td>
                <td>{{ $gudang }}</td>
            </tr>
            <tr>
                <td>Transit</td>
                <td>{{ $transit }}</td>
            </tr>
            <tr>
                <td>Terkirim</td>
                <td>{{ $delivered }}</td>
            </tr>
            <tr>
                <td>Kendala</td>
                <td>{{ $problem }}</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- ================= SUMMARY PER KOTA ================= --}}
<div class="card" style="margin-top:20px;">
    <div class="card-title">Ringkasan Per Kota</div>
    <table>
        <thead>
            <tr>
                <th>Kota</th>
                <th>Total</th>
                <th>Delivered</th>
                <th>Problem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summaryKota ?? [] as $s)
            <tr>
                <td>{{ $s->kota_tujuan }}</td>
                <td>{{ $s->total }}</td>
                <td>{{ $s->delivered }}</td>
                <td>{{ $s->problem }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection