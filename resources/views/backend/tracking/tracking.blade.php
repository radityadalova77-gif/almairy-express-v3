@extends('backend.layouts.app')
@section('title', 'Live Tracking')
@section('page-title', 'Live Tracking')

@section('content')

<div class="card">

  <div class="card-title">Cek Status Pengiriman</div>

  <div class="flex gap8 align-center mb8">
    <input type="text" id="resi" placeholder="Masukkan nomor resi..." style="max-width:260px">
    <button class="btn btn-primary" onclick="cariResi()">Cek</button>
  </div>

  <div id="hasil" class="mt8 hidden">

    <div class="card mb8">
      <div class="fw600" id="resi-text"></div>
      <div class="text-sm text-muted" id="tujuan-text"></div>

      <div class="route-bar mt8">
        <div class="route-fill" id="progress-bar" style="width:0%"></div>
      </div>

      <div class="text-xs mt4" id="status-text"></div>
    </div>

    <div class="card">
      <div class="card-title">Riwayat Perjalanan</div>
      <div class="timeline" id="timeline"></div>
    </div>

  </div>

</div>

@endsection


@section('scripts')
<script>
  function cariResi() {
    let resi = document.getElementById('resi').value;

    fetch(`/tracking/cari?resi=${resi}`)
      .then(res => res.json())
      .then(data => {

        if (!data.ditemukan) {
          alert(data.pesan);
          return;
        }

        document.getElementById('hasil').classList.remove('hidden');

        let p = data.pengiriman;

        document.getElementById('resi-text').innerText = p.resi;
        document.getElementById('tujuan-text').innerText = p.kota_tujuan + ' (' + p.pulau_tujuan + ')';
        document.getElementById('status-text').innerText = p.status_label;

        document.getElementById('progress-bar').style.width = p.progress + '%';

        let html = '';

        data.history.forEach(h => {
          html += `
          <div class="tl-item">
            <div class="tl-dot ${h.is_current ? 'current' : (h.is_done ? 'done' : '')}"></div>
            <div class="tl-line"></div>
            <div class="tl-time">${h.waktu}</div>
            <div class="tl-text">${h.keterangan}</div>
            <div class="tl-loc">${h.lokasi ?? ''}</div>
          </div>
        `;
        });

        document.getElementById('timeline').innerHTML = html;

      })
      .catch(err => console.log(err));
  }
</script>
@endsection