@extends('backend.layouts.app')
@section('title','Pelanggan')
@section('page-title','Form Pelanggan')

@section('content')

<form method="POST" action="{{ isset($pelanggan) ? route('pelanggan.update',$pelanggan) : route('pelanggan.store') }}">
    @csrf
    @if(isset($pelanggan)) @method('PUT') @endif

    <div class="card">

        <div class="card-title">
            Data Pelanggan
        </div>

        <div class="form-grid">

            <div>
                <label>Nama Perusahaan</label>
                <input name="nama_perusahaan" value="{{ old('nama_perusahaan',$pelanggan->nama_perusahaan ?? '') }}">
            </div>

            <div>
                <label>Nama Kontak</label>
                <input name="nama_kontak" value="{{ old('nama_kontak',$pelanggan->nama_kontak ?? '') }}">
            </div>

            <div>
                <label>No HP</label>
                <input name="no_hp" value="{{ old('no_hp',$pelanggan->no_hp ?? '') }}">
            </div>

            <div>
                <label>Email</label>
                <input name="email" value="{{ old('email',$pelanggan->email ?? '') }}">
            </div>

            <div>
                <label>Kota</label>
                <input name="kota" value="{{ old('kota',$pelanggan->kota ?? '') }}">
            </div>

            <div class="form-group full">
                <label>Alamat</label>
                <textarea name="alamat">{{ old('alamat',$pelanggan->alamat ?? '') }}</textarea>
            </div>

            <div>
                <label>Status</label>
                <select name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

        </div>

    </div>

    <div class="card">
        <div class="flex justify-between">
            <a href="{{ route('pelanggan.index') }}" class="btn">Batal</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>

@endsection