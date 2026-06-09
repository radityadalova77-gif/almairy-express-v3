@extends('backend.layouts.app')

@section('title', 'Riwayat Pengiriman Dihapus')
@section('page-title', 'Riwayat Pengiriman Dihapus')

@section('content')

<div class="card">
    <div class="card-title">
        Data Pengiriman Terhapus
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Status</th>
                    <th>Tanggal Hapus</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengiriman as $p)
                <tr>
                    <td>{{ $p->resi }}</td>
                    <td>{{ $p->nama_pengirim }}</td>
                    <td>{{ $p->nama_penerima }}</td>
                    <td>{{ $p->kota_tujuan }}</td>
                    <td>
                        <span class="status s-problem">Dihapus</span>
                    </td>
                    <td>
                        {{ $p->deleted_at ? $p->deleted_at->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="flex gap4">

                        {{-- RESTORE --}}
                        <form action="{{ route('pengiriman.restore', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-xs btn-success">
                                Restore
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:var(--muted);">
                        Tidak ada data yang dihapus
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection