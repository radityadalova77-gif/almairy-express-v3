@extends('backend.layouts.app')
@section('title', 'Data Pengiriman')
@section('page-title', 'Data Pengiriman')

@section('topbar-actions')

@if(in_array(auth()->user()->role->nama, ['Admin','Operasional']))
<button class="btn btn-primary" onclick="openModal('add-pengiriman')">
    + Tambah Pengiriman
</button>
@endif

@endsection


@section('content')
<div class="card">

    {{-- Tabs --}}
    <div class="tabs">
        <a href="{{ route('pengiriman.index') }}"
            class="tab {{ !request()->routeIs('pengiriman.riwayat-hapus') ? 'active' : '' }}"
            style="text-decoration:none">
            Pengiriman Aktif ({{ $pengiriman->total() }})
        </a>

        <a href="{{ route('pengiriman.riwayat-hapus') }}" class="tab" style="text-decoration:none;color:#dc2626">
            Riwayat Hapus
        </a>
    </div>


    {{-- Filter --}}
    <form method="GET" class="flex gap8 align-center" style="margin-bottom:12px">

        <input type="text" name="cari" placeholder="Cari resi, tujuan, barang..." style="max-width:240px"
            value="{{ request('cari') }}">

        <select name="pulau" style="max-width:140px">
            <option value="">Semua Pulau</option>
            @foreach(['Jawa','Sumatera','Kalimantan','Sulawesi','Bali','Papua'] as $p)
            <option value="{{ $p }}" {{ request('pulau')==$p ? 'selected' : '' }}>
                {{ $p }}
            </option>
            @endforeach
        </select>

        <select name="status" style="max-width:160px">
            <option value="">Semua Status</option>

            @foreach([
            'pending'=>'Menunggu',
            'gudang'=>'Di Gudang',
            'transit'=>'Dalam Perjalanan',
            'delivered'=>'Terkirim',
            'problem'=>'Masalah'
            ] as $v=>$l)

            <option value="{{ $v }}" {{ request('status')==$v ? 'selected' : '' }}>
                {{ $l }}
            </option>

            @endforeach
        </select>

        <button class="btn btn-sm btn-primary">
            Cari
        </button>

        @if(request()->anyFilled(['cari','pulau','status']))
        <a href="{{ route('pengiriman.index') }}" class="btn btn-sm">
            Reset
        </a>
        @endif

    </form>


    {{-- Export Periode --}}
    <div style="
        padding:10px;
        background:#f9fafb;
        border-radius:8px;
        margin-bottom:12px;
        border:1px solid #f3f4f6">

        <div class="text-sm fw600" style="margin-bottom:6px">
            Filter
        </div>

        <form method="GET" action="{{ route('pengiriman.index') }}"
            style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin-top:15px;">

            <input type="date" name="dari" value="{{ request('dari') }}" class="input">

            <input type="date" name="sampai" value="{{ request('sampai') }}" class="input">

            <button type="submit" class="btn btn-primary">
                Filter
            </button>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-wrap">
        <table>

            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Pengirim</th>
                    <th>Tujuan</th>
                    <th>Pulau</th>
                    <th>Jml/Berat</th>
                    <th>Tarif</th> {{-- ✅ TAMBAHAN --}}
                    <th>Status</th>
                    <th>Tanggal Kirim</th>
                    <th>ETA</th>
                    <th>Dibuat Oleh</th>
                    @if(in_array(auth()->user()->role->nama, ['admin','operasional']))
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @forelse($pengiriman as $p)

                @php
                $cls = [
                'pending'=>'s-pending',
                'transit'=>'s-transit',
                'gudang'=>'s-gudang',
                'delivered'=>'s-delivered',
                'problem'=>'s-problem'
                ][$p->status] ?? 's-gudang';
                @endphp

                <tr>

                    <td>
                        <span class="fw600">
                            {{ $p->resi }}
                        </span>
                    </td>

                    <td class="text-sm">
                        {{ $p->nama_pengirim }}
                    </td>

                    <td>
                        {{ $p->kota_tujuan }}
                    </td>

                    <td>
                        <span class="chip">
                            {{ $p->pulau_tujuan }}
                        </span>
                    </td>

                    <td>
                        {{ $p->jumlah_koli }} koli
                        <br>
                        <span class="text-muted text-sm">
                            {{ number_format($p->berat_kg,0,',','.') }} kg
                        </span>
                    </td>

                    {{-- ✅ TARIF + BREAKDOWN --}}
                    <td>
                        <b>Rp {{ number_format($p->tarif ?? 0,0,',','.') }}</b>
                        <br>
                        <small class="text-muted">
                            {{ number_format($p->berat_kg ?? 0,0,',','.') }} kg ×
                            Rp{{ number_format($p->harga_per_kg ?? 0,0,',','.') }}
                        </small>
                    </td>

                    <td>
                        <span class="status {{ $cls }}">
                            {{ $p->status_label }}
                        </span>
                    </td>

                    <td>
                        {{ $p->tanggal_kirim?->format('d M Y') ?? '—' }}
                    </td>

                    <td class="text-muted text-sm">
                        {{ $p->estimasi_tiba?->format('d M Y') ?? '—' }}
                    </td>

                    <td class="text-sm">
                        {{ $p->creator?->name ?? '-' }}
                    </td>

                    <td>
                        <div class="flex gap4">

                            @if(in_array(auth()->user()->role->nama, ['Admin','Operasional']))
                            <a href="{{ route('pengiriman.show',$p) }}" class="btn btn-sm btn-primary">
                                Tracking
                            </a>
                            @endif

                            @if(in_array(auth()->user()->role->nama, ['Admin','Operasional']))
                            <a href="{{ route('pengiriman.edit',$p) }}" class="btn btn-sm btn-warn">
                                Edit
                            </a>
                            @endif


                            @if(auth()->user()->role->nama == 'Admin')
                            <form id="del-{{ $p->id }}" method="POST" action="{{ route('pengiriman.destroy',$p) }}"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('del-{{ $p->id }}')">
                                    Hapus
                                </button>

                            </form>
                            @endif

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="11" style="text-align:center;padding:24px;color:#9ca3af">
                        Tidak ada data pengiriman.
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



@section('modals')
@if(in_array(auth()->user()->role->nama, ['Admin','Operasional']))

<div class="modal-overlay hidden" id="modal-add-pengiriman">

    <div class="modal">

        <div class="modal-header">
            <div class="modal-title">
                Tambah Pengiriman Baru
            </div>

            <button class="modal-close" onclick="closeModal('add-pengiriman')">
                &times;
            </button>
        </div>

        <form method="POST" action="{{ route('pengiriman.store') }}">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Tanggal Kirim *</label>
                    <input type="date" name="tanggal_kirim" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Estimasi Tiba</label>
                    <input type="date" name="estimasi_tiba">
                </div>

                <div class="form-group">
                    <label>Nama Pengirim *</label>
                    <input type="text" name="nama_pengirim" required>
                </div>

                <div class="form-group">
                    <label>No HP Pengirim</label>
                    <input name="hp_pengirim">
                </div>

                <div class="form-group">
                    <label>Nama Penerima *</label>
                    <input name="nama_penerima" required>
                </div>

                <div class="form-group">
                    <label>No HP Penerima</label>
                    <input name="hp_penerima">
                </div>

                <div class="form-group">
                    <label>Kota Tujuan *</label>
                    <input name="kota_tujuan" required>
                </div>

                <div class="form-group">
                    <label>Pulau Tujuan *</label>
                    <select name="pulau_tujuan">
                        @foreach(['Jawa','Sumatera','Kalimantan','Sulawesi','Bali','Papua','NTT','NTB','Maluku'] as $p)
                        <option>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- ✅ TAMBAHAN --}}

                <div class="form-group">
                    <label>Jumlah Koli *</label>
                    <input type="number" name="jumlah_koli" required>
                </div>

                <div class="form-group">
                    <label>Total Berat *</label>
                    <input type="number" name="berat_kg" required>
                </div>


                <div class="form-group">
                    <label>Harga per KG *</label>
                    <input type="number" name="harga_per_kg" required>
                </div>


                <div class="form-group">
                    <label>Total</label>
                    <input type="text" id="total" readonly>
                </div>

                <div class="form-group">
                    <label>Jenis Barang</label>
                    <input name="jenis_barang" required>
                </div>

                <div class="form-group full">
                    <label>Catatan</label>
                    <textarea name="catatan"></textarea>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn" onclick="closeModal('add-pengiriman')">
                    Batal
                </button>

                <button class="btn btn-primary">
                    Simpan Pengiriman
                </button>

            </div>

        </form>

    </div>
</div>

@endif

@endsection


@push('scripts')
<script>
    function hitung() {
        let berat = parseFloat(document.querySelector('[name="berat_kg"]').value) || 0;
        let harga = parseFloat(document.querySelector('[name="harga_per_kg"]').value) || 0;

        let total = berat * harga;

        document.getElementById('total').value = total.toLocaleString('id-ID');
    }



    document.querySelector('[name="berat_kg"]').addEventListener('input', hitung);
    document.querySelector('[name="harga_per_kg"]').addEventListener('input', hitung);
</script>

<script>
    let indexBarang = 1;

    function tambahBarang() {
        let wrapper = document.getElementById('barang-wrapper');

        let html = `
    <div class="barang-item flex gap8" style="margin-bottom:8px">
        <input name="barang[${indexBarang}][jenis_barang]" placeholder="Jenis Barang" style="flex:2">
        <input type="number" name="barang[${indexBarang}][jumlah_koli]" placeholder="Koli" style="flex:1">
        <input type="number" name="barang[${indexBarang}][berat_kg]" placeholder="Berat (kg)" step="0.1" style="flex:1">
        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">✕</button>
    </div>
    `;

        wrapper.insertAdjacentHTML('beforeend', html);
        indexBarang++;
    }

    function hapusBarang(btn) {
        btn.parentElement.remove();
    }
</script>
@endpush