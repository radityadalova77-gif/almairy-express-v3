@extends('backend.layouts.app')
@section('title','Pelanggan')
@section('page-title','Data Pelanggan')

@section('topbar-actions')
<a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
    + Tambah Pelanggan
</a>
@endsection

@section('content')

<div class="card">

    <div class="card-title">
        Daftar Pelanggan
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>Kontak</th>
                    <th>No HP</th>
                    <th>Kota</th>
                    <th>Total Kirim</th>
                    <th>Total Nilai</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @forelse($pelanggan as $p)
                <tr>
                    <td>{{ $p->nama_perusahaan }}</td>
                    <td>{{ $p->nama_kontak }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->kota }}</td>
                    <td>{{ $p->total_pengiriman }}</td>
                    <td>Rp {{ number_format($p->total_nilai,0,',','.') }}</td>

                    <td class="flex gap4">
                        <a href="{{ route('pelanggan.show',$p) }}" class="btn btn-xs">
                            Detail
                        </a>

                        <a href="{{ route('pelanggan.edit',$p) }}" class="btn btn-xs btn-warn">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('pelanggan.destroy',$p) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt8">
        {{ $pelanggan->links() }}
    </div>

</div>

@endsection