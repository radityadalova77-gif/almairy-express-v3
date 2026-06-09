@extends('backend.layouts.app')
@section('title','Dispatch Control')
@section('page-title','Edit / Dispatch Pengiriman')

@section('topbar-actions')
<a href="{{ route('pengiriman.show',$pengiriman) }}" class="btn btn-primary">
    Tracking
</a>

<a href="{{ route('pengiriman.index') }}" class="btn">
    Kembali
</a>
@endsection


@section('content')

<form method="POST" action="{{ route('pengiriman.update',$pengiriman) }}">
    @csrf
    @method('PUT')


    <div class="card">
        <div class="flex justify-between align-center">
            <div>
                <div class="text-muted text-sm">
                    Nomor Resi
                </div>

                <h2 style="margin-top:6px">
                    {{ $pengiriman->resi }}
                </h2>
            </div>

            <span class="status s-transit">
                Dispatch Control
            </span>

        </div>
    </div>



    <div class="card">
        <div class="card-title">
            Data Pengiriman
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Tanggal Kirim</label>
                <input type="date" name="tanggal_kirim"
                    value="{{ old('tanggal_kirim',$pengiriman->tanggal_kirim?->format('Y-m-d')) }}">
            </div>


            <div class="form-group">
                <label>Estimasi Tiba</label>
                <input type="date" name="estimasi_tiba"
                    value="{{ old('estimasi_tiba',$pengiriman->estimasi_tiba?->format('Y-m-d')) }}">
            </div>


            <div class="form-group">
                <label>Nama Pengirim</label>
                <input name="nama_pengirim" value="{{ old('nama_pengirim',$pengiriman->nama_pengirim) }}">
            </div>


            <div class="form-group">
                <label>Nama Penerima</label>
                <input name="nama_penerima" value="{{ old('nama_penerima',$pengiriman->nama_penerima) }}">
            </div>


            <div class="form-group">
                <label>Kota Tujuan</label>
                <input name="kota_tujuan" value="{{ old('kota_tujuan',$pengiriman->kota_tujuan) }}">
            </div>


            <div class="form-group">
                <label>Pulau Tujuan</label>

                <select name="pulau_tujuan">
                    @foreach([
                    'Jawa',
                    'Sumatera',
                    'Kalimantan',
                    'Sulawesi',
                    'Bali',
                    'Papua'
                    ] as $pulau)

                    <option value="{{ $pulau }}" {{ $pengiriman->pulau_tujuan==$pulau ? 'selected':'' }}>
                        {{ $pulau }}
                    </option>

                    @endforeach
                </select>

            </div>

        </div>
    </div>



    <div class="card">
        <div class="card-title">
            Informasi Muatan
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Jenis Barang</label>
                <input name="jenis_barang" value="{{ old('jenis_barang',$pengiriman->jenis_barang) }}">
            </div>


            <div class="form-group">
                <label>Jumlah Koli</label>
                <input type="number" name="jumlah_koli" value="{{ old('jumlah_koli',$pengiriman->jumlah_koli) }}">
            </div>


            <div class="form-group">
                <label>Berat (Kg)</label>
                <input type="number" step="0.1" id="berat" name="berat_kg"
                    value="{{ old('berat_kg',$pengiriman->berat_kg) }}">
            </div>


            {{-- ✅ TAMBAHAN --}}
            <div class="form-group">
                <label>Harga per KG</label>
                <input type="number" id="harga" name="harga_per_kg"
                    value="{{ old('harga_per_kg',$pengiriman->harga_per_kg) }}">
            </div>


            {{-- ✅ TARIF (AUTO RESULT) --}}
            <div class="form-group">
                <label>Total Tarif</label>
                <input type="text" id="total" value="{{ number_format($pengiriman->tarif ?? 0,0,',','.') }}" readonly>
            </div>

        </div>
    </div>




    <div class="card">

        <div class="card-title">
            Catatan Operasional
        </div>

        <div class="form-group">
            <label>Catatan</label>

            <textarea name="catatan" rows="5">{{ old('catatan',$pengiriman->catatan) }}</textarea>

        </div>

    </div>



    <div class="card">

        <div class="flex justify-between">

            <a href="{{ route('pengiriman.show',$pengiriman) }}" class="btn">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </div>

    </div>


</form>

@endsection



@push('scripts')
<script>
    function hitung() {
        let berat = parseFloat(document.getElementById('berat').value) || 0;
        let harga = parseFloat(document.getElementById('harga').value) || 0;

        let total = berat * harga;

        document.getElementById('total').value = total.toLocaleString('id-ID');
    }

    document.getElementById('berat').addEventListener('input', hitung);
    document.getElementById('harga').addEventListener('input', hitung);
</script>
@endpush