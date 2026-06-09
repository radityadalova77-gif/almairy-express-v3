@extends('backend.layouts.app')
@section('title', 'Manajemen Armada')
@section('page-title', 'Manajemen Armada')

@section('topbar-actions')
<button class="btn btn-primary" onclick="openModal('add-armada')">+ Tambah Kendaraan</button>
@endsection

@section('content')
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr)">
  <div class="stat-card">
    <div class="stat-label">Total Armada</div>
    <div class="stat-value">{{ $totalArmada }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Beroperasi</div>
    <div class="stat-value" style="color:#16a34a">{{ $beroperasi }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Perlu Servis</div>
    <div class="stat-value" style="color:#d97706">{{ $perluServis }}</div>
  </div>
</div>

<div class="card">
  <div class="card-title">Data Armada</div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>No Plat</th>
          <th>Jenis</th>
          <th>Kapasitas</th>
          <th>Driver</th>
          <th>Status</th>
          <th>KM Terakhir</th>
          <th>Servis Berikutnya</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($armada as $a)
        @php $cls = ['aktif'=>'s-aktif','standby'=>'s-standby','servis'=>'s-servis','nonaktif'=>'s-nonaktif'][$a->status] ?? 's-gudang'; @endphp
        <tr>
          <td><span class="fw600">{{ $a->no_plat }}</span></td>
          <td>{{ $a->jenis_kendaraan }}</td>
          <td>{{ $a->kapasitas }}</td>
          <td>{{ $a->driver?->nama ?? '—' }}</td>
          <td><span class="status {{ $cls }}">{{ $a->status_label }}</span></td>
          <td class="text-muted">{{ number_format($a->km_terakhir, 0, ',', '.') }} km</td>
          <td class="text-sm @if($a->tanggal_servis_berikutnya?->isPast()) text-danger @endif">
            {{ $a->tanggal_servis_berikutnya?->format('d M Y') ?? '—' }}
          </td>
          <td>
            <button class="btn btn-sm btn-warn" @php
              $map=['aktif'=>'s-aktif','standby'=>'s-standby','servis'=>'s-servis','nonaktif'=>'s-nonaktif'];
              $cls = $map[$a->status] ?? 's-gudang';
              @endphp>Edit</button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:20px;color:#9ca3af">Belum ada data armada.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt8">{{ $armada->links() }}</div>
</div>
@endsection

@section('modals')
{{-- Modal Tambah --}}
<div class="modal-overlay hidden" id="modal-add-armada">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Tambah Kendaraan</div>
      <button class="modal-close" onclick="closeModal('add-armada')">&times;</button>
    </div>
    <form method="POST" action="{{ route('armada.store') }}">
      @csrf
      @include('backend.armada._form-armada', ['a' => null, 'drivers' => $drivers])
      <div class="modal-footer">
        <button type="button" class="btn" onclick="closeModal('add-armada')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal-overlay hidden" id="modal-edit-armada">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Kendaraan</div>
      <button class="modal-close" onclick="closeModal('edit-armada')">&times;</button>
    </div>
    <form method="POST" id="form-edit-armada">
      @csrf @method('PUT')
      @include('backend.armada._form-armada', ['a' => null, 'drivers' => $drivers])
      <div class="modal-footer">
        <button type="button" class="btn" onclick="closeModal('edit-armada')">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function editArmada(id, noPlat, jenis, kap, driverId, status, km, servis, merk, tahun) {
    const form = document.getElementById('form-edit-armada');
    form.action = `/armada/${id}`;
    form.querySelector('[name=no_plat]').value = noPlat;
    form.querySelector('[name=jenis_kendaraan]').value = jenis;
    form.querySelector('[name=kapasitas]').value = kap;
    form.querySelector('[name=driver_id]').value = driverId || '';
    form.querySelector('[name=status]').value = status;
    form.querySelector('[name=km_terakhir]').value = km;
    form.querySelector('[name=tanggal_servis_berikutnya]').value = servis;
    form.querySelector('[name=merk]').value = merk;
    form.querySelector('[name=tahun]').value = tahun;
    openModal('edit-armada');
  }
</script>
@endsection