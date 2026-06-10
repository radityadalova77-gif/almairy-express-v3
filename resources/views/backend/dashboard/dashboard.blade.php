@extends('backend.layouts.app')
@section('title','Beranda')
@section('page-title','Beranda TMS')

@section('content')

{{-- ================= KPI ================= --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Pengiriman Aktif</div>
        <div class="stat-value text-blue">{{ $totalAktif ?? 0 }}</div>
        <div class="stat-change text-muted">sedang berjalan</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Pengiriman Bermasalah</div>
        <div class="stat-value text-red">{{ $problem ?? 0 }}</div>
        <div class="stat-change">perlu tindak lanjut</div>
    </div>

</div>



{{-- ================= GRID ================= --}}
<div class="grid-2">

    {{-- ===== CHART ===== --}}
    <div class="card">

        <div class="card-title">
            Volume Pengiriman 7 Hari Terakhir
        </div>

        @php
        $chartData = collect($chart ?? []);
        $values = $chartData->pluck('value')->map(fn($v)=>(int)$v);
        $maxVal = $values->max();

        if($maxVal == 0){
        $maxVal = 1;
        }
        @endphp

        <div class="mini-bars">

            @forelse($chartData as $c)

            @php
            $val = (int)($c['value'] ?? 0);
            $label = $c['label'] ?? '';

            $h = ($val / $maxVal) * 100;
            $h = max(10, $h);
            @endphp

            @php
            $height = $h . '%';
            $tooltip = $label . ' : ' . $val;
            @endphp

            <div class="bar" style="--h: {{ $h }};" title="{{ $label }} : {{ $val }}">
            </div>

            @empty
            <div class="text-muted">
                Tidak ada data grafik
            </div>
            @endforelse

        </div>

        <div class="bar-lbl">
            @foreach($chartData as $c)
            <span>{{ $c['label'] ?? '-' }}</span>
            @endforeach
        </div>

    </div>




    {{-- ===== STATUS SUMMARY ===== --}}
    <div class="card">

        <div class="card-title">
            Ringkasan Status
        </div>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $pending ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Di Gudang</div>
                <div class="stat-value">{{ $gudang ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Dalam Perjalanan</div>
                <div class="stat-value">{{ $transit ?? 0 }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Kendala</div>
                <div class="stat-value">{{ $problem ?? 0 }}</div>
            </div>


        </div>

    </div>

</div>



{{-- ================= TABLE ================= --}}
<div class="card">

    <div class="flex-between mb12">
        <div class="card-title">Pengiriman Terbaru</div>

        <a href="{{ route('pengiriman.index') }}" class="btn btn-sm">
            Lihat Semua
        </a>
    </div>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Tujuan</th>
                    <th>Pulau</th>
                    <th>Berat</th>
                    <th>Tanggal Kirim</th>
                    <th>ETA</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pengirimanTerbaru ?? [] as $p)

                @php
                $statusMap = [
                'pending' => ['Menunggu','s-pending'],
                'gudang' => ['Di Gudang','s-gudang'],
                'transit' => ['Dalam Perjalanan','s-transit'],
                'delivered' => ['Terkirim','s-delivered'],
                'problem' => ['Kendala','s-problem'],
                ];

                $label = $statusMap[$p->status][0] ?? '-';
                $cls = $statusMap[$p->status][1] ?? 's-gudang';
                @endphp

                <tr>
                    <td><strong>{{ $p->resi }}</strong></td>
                    <td>{{ $p->kota_tujuan }}</td>
                    <td>{{ $p->pulau_tujuan }}</td>
                    <td>{{ number_format($p->berat_kg,0,',','.') }} kg</td>
                    <td>{{ optional($p->tanggal_kirim)->format('d M Y') ?? '-' }}</td>
                    <td>{{ optional($p->estimasi_tiba)->format('d M Y') ?? '-' }}</td>
                    <td><span class="status {{ $cls }}">{{ $label }}</span></td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:30px;color:#9ca3af;">
                        Tidak ada data pengiriman
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection