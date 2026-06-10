@extends('backend.layouts.app')

@section('title', 'Pengiriman Selesai')
@section('page-title', 'Pengiriman Selesai')

@section('content')

<div class="card">

    {{-- Tabs --}}
    <div class="tabs">

        <a href="{{ route('pengiriman.index') }}"
            class="tab">
            Pengiriman Aktif
        </a>

        <a href="{{ route('pengiriman.selesai') }}"
            class="tab active">
            Pengiriman Selesai
        </a>

        <a href="{{ route('pengiriman.riwayat-hapus') }}"
            class="tab"
            style="color:#dc2626">
            Riwayat Hapus
        </a>

    </div>

    {{-- Filter --}}
    <form method="GET" class="flex gap8 align-center" style="margin-bottom:12px">

        <input type="text"
            name="cari"
            placeholder="Cari resi, pengirim, tujuan..."
            style="max-width:240px"
            value="{{ request('cari') }}">

        <button class="btn btn-sm btn-primary">
            Cari
        </button>

        @if(request('cari'))
        <a href="{{ route('pengiriman.selesai') }}"
            class="btn btn-sm">
            Reset
        </a>
        @endif

    </form>

    {{-- TABLE --}}
    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Pengirim</th>
                    <th>Asal Kota</th>
                    <th>Penerima</th>
                    <th>Tujuan</th>
                    <th>Berat</th>
                    <th>Tarif</th>
                    <th>Tanggal Kirim</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pengiriman as $p)

                <tr>

                    <td>
                        <span class="fw600">
                            {{ $p->resi }}
                        </span>
                    </td>

                    <td>
                        {{ $p->nama_pengirim }}
                    </td>

                    <td>
                        {{ $p->asal_kota ?? '-' }}
                    </td>

                    <td>
                        {{ $p->nama_penerima }}
                    </td>

                    <td>
                        {{ $p->kota_tujuan }}
                    </td>

                    <td>
                        {{ number_format($p->berat_kg,0,',','.') }} Kg
                    </td>

                    <td>
                        <b>
                            Rp {{ number_format($p->tarif ?? 0,0,',','.') }}
                        </b>
                    </td>

                    <td>
                        {{ $p->tanggal_kirim?->format('d M Y') ?? '-' }}
                    </td>

                    <td>
                        <span class="status s-delivered">
                            Selesai
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('pengiriman.show',$p) }}"
                            class="btn btn-sm btn-primary">
                            Detail
                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="10"
                        style="text-align:center;padding:24px;color:#9ca3af">
                        Belum ada pengiriman selesai.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt8">
        {{ $pengiriman->links() }}
    </div>

</div>

@endsection