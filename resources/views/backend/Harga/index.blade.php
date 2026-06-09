@extends('backend.layouts.app')

@section('title', 'Daftar Harga')
@section('page-title', 'Data Harga')

@section('content')

{{-- FORM TAMBAH --}}
@if(in_array(auth()->user()->role->nama, ['admin','operasional']))
<div class="card" style="margin-bottom:20px;">

    <form action="{{ route('harga.store') }}" method="POST">
        @csrf

        <div class="grid-2">

            <div>
                <label>Kota Tujuan</label>
                <input type="text" name="kota_tujuan" class="input">
            </div>

            <div>
                <label>Pulau Tujuan</label>
                <input type="text" name="pulau_tujuan" class="input">
            </div>

            <div>
                <label>Harga / KG</label>
                <input type="number" name="harga_per_kg" class="input">
            </div>

            <div>
                <label>Catatan</label>
                <input type="text" name="catatan" class="input">
            </div>

        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:15px;">
            Simpan
        </button>

    </form>

</div>
@endif

{{-- TABLE --}}
<div class="card">

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kota</th>
                <th>Pulau</th>
                <th>Harga/KG</th>
                <th>Catatan</th>

                @if(in_array(auth()->user()->role->nama, ['admin','operasional']))
                <th>Aksi</th>
                @endif

            </tr>
        </thead>

        <tbody>

            @forelse($harga as $h)
            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $h->kota_tujuan }}</td>

                <td>{{ $h->pulau_tujuan }}</td>

                <td>
                    Rp {{ number_format($h->harga_per_kg,0,',','.') }}
                </td>

                <td>{{ $h->catatan }}</td>

                {{-- ADMIN + OPERASIONAL --}}
                @if(in_array(auth()->user()->role->nama, ['admin','operasional']))
                <td>

                    {{-- EDIT --}}
                    <a href="{{ route('harga.edit', $h->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    {{-- HAPUS ADMIN ONLY --}}
                    @if(auth()->user()->role->nama == 'admin')
                    <form action="{{ route('harga.destroy', $h->id) }}" method="POST" style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Hapus
                        </button>

                    </form>
                    @endif

                </td>
                @endif

            </tr>

            @empty
            <tr>

                <td colspan="6" style="text-align:center;">
                    Belum ada data harga
                </td>

            </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection