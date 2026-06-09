@extends('backend.layouts.app')

@section('title', 'Edit Daftar Harga')
@section('page-title', 'Edit Daftar Harga')

@section('content')

<div class="card" style="max-width:700px;">

    <div class="card-title">
        Edit Daftar Harga
    </div>

    <form action="{{ route('harga.update', $harga->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>Kota Tujuan *</label>

                <input type="text" name="kota_tujuan" value="{{ old('kota_tujuan', $harga->kota_tujuan) }}" required>
            </div>

            <div class="form-group">
                <label>Pulau *</label>

                <select name="pulau_tujuan" required>

                    @foreach([
                    'Jawa',
                    'Sumatera',
                    'Kalimantan',
                    'Sulawesi',
                    'Bali',
                    'Papua',
                    'NTT',
                    'NTB',
                    'Maluku'
                    ] as $pulau)

                    <option value="{{ $pulau }}" {{ $harga->pulau == $pulau ? 'selected' : '' }}>
                        {{ $pulau }}
                    </option>

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Harga per KG *</label>

                <input type="number" name="harga_per_kg" value="{{ old('harga_per_kg', $harga->harga_per_kg) }}"
                    required>
            </div>

        </div>

        <div class="modal-footer" style="margin-top:20px;">

            <a href="{{ route('harga.index') }}" class="btn">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                Update Harga
            </button>

        </div>

    </form>

</div>

@endsection