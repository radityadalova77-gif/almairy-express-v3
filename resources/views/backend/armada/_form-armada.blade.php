<div class="form-grid">
  <div class="form-group">
    <label>No Plat *</label>
    <input type="text" name="no_plat" value="{{ $a?->no_plat }}" placeholder="B-1234-AE" required>
  </div>
  <div class="form-group">
    <label>Jenis Kendaraan *</label>
    <input type="text" name="jenis_kendaraan" value="{{ $a?->jenis_kendaraan }}" placeholder="Truk Fuso, Truk Engkel..." required>
  </div>
  <div class="form-group">
    <label>Kapasitas *</label>
    <input type="text" name="kapasitas" value="{{ $a?->kapasitas }}" placeholder="5 Ton, 10 Ton..." required>
  </div>
  <div class="form-group">
    <label>Merk</label>
    <input type="text" name="merk" value="{{ $a?->merk }}" placeholder="Mitsubishi, Hino...">
  </div>
  <div class="form-group">
    <label>Tahun</label>
    <input type="number" name="tahun" value="{{ $a?->tahun }}" placeholder="2020" min="2000" max="{{ date('Y')+1 }}">
  </div>
  <div class="form-group">
    <label>KM Terakhir</label>
    <input type="number" name="km_terakhir" value="{{ $a?->km_terakhir ?? 0 }}" min="0">
  </div>
  <div class="form-group">
    <label>Assign Driver</label>
    <select name="driver_id">
      <option value="">— Tidak Ada —</option>
      @foreach($drivers as $d)
        <option value="{{ $d->id }}" {{ $a?->driver_id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Status</label>
    <select name="status">
      @foreach(['aktif'=>'Aktif','standby'=>'Standby','servis'=>'Servis','nonaktif'=>'Non-Aktif'] as $v => $l)
        <option value="{{ $v }}" {{ ($a?->status ?? 'standby') == $v ? 'selected' : '' }}>{{ $l }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group full">
    <label>Tanggal Servis Berikutnya</label>
    <input type="date" name="tanggal_servis_berikutnya" value="{{ $a?->tanggal_servis_berikutnya?->format('Y-m-d') }}">
  </div>
</div>
