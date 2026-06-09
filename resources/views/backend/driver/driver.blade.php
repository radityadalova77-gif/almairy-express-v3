@extends('backend.layouts.app')
@section('title', 'Data Driver')
@section('page-title', 'Data Driver')

@section('topbar-actions')
<button class="btn btn-primary" onclick="openModal('add-driver')">
  + Tambah Driver
</button>
@endsection

@section('content')
<div class="card">
  <div class="card-title">Daftar Driver</div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>No HP</th>
          <th>Lisensi</th>
          <th>Rute Aktif</th>
          <th>Total Trip</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse($drivers as $d)

        @php
        $cls = [
        'aktif'=>'s-aktif',
        'libur'=>'s-gudang',
        'nonaktif'=>'s-nonaktif'
        ][$d->status] ?? 's-gudang';
        @endphp

        <tr>
          <td><span class="fw600">{{ $d->nama }}</span></td>
          <td class="text-sm">{{ $d->no_hp }}</td>
          <td class="text-sm">{{ $d->jenis_sim }}</td>
          <td class="text-sm">{{ $d->rute_aktif ?? '—' }}</td>
          <td>{{ $d->total_trip }}</td>
          <td>{{ $d->rating }} ★</td>
          <td>
            <span class="status {{ $cls }}">
              {{ $d->status_label }}
            </span>
          </td>
          <td>
            <button class="btn btn-sm btn-warn btn-edit-driver" data-driver='@json($d)'>
              Edit
            </button>
          </td>
        </tr>

        @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:20px;color:#9ca3af">
            Belum ada data driver.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt8">{{ $drivers->links() }}</div>
</div>
@endsection


@section('modals')

{{-- ADD --}}
<div class="modal-overlay hidden" id="modal-add-driver">
  <div class="modal" style="width:420px">
    <div class="modal-header">
      <div class="modal-title">Tambah Driver</div>
      <button class="modal-close" onclick="closeModal('add-driver')">&times;</button>
    </div>

    <form method="POST" action="{{ route('driver.store') }}">
      @csrf
      @include('backend.driver._form-driver')

      <div class="modal-footer">
        <button type="button" class="btn" onclick="closeModal('add-driver')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>


{{-- EDIT --}}
<div class="modal-overlay hidden" id="modal-edit-driver">
  <div class="modal" style="width:420px">
    <div class="modal-header">
      <div class="modal-title">Edit Driver</div>
      <button class="modal-close" onclick="closeModal('edit-driver')">&times;</button>
    </div>

    <form method="POST" id="form-edit-driver">
      @csrf
      @method('PUT')

      @include('backend.driver._form-driver')

      <div class="modal-footer">
        <button type="button" class="btn" onclick="closeModal('edit-driver')">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

@endsection


@section('scripts')
<script>
  function editDriver(data) {
    const form = document.getElementById('form-edit-driver');

    // set action
    form.action = `/driver/${data.id}`;

    // isi form
    form.querySelector('[name=nama]').value = data.nama ?? '';
    form.querySelector('[name=no_hp]').value = data.no_hp ?? '';
    form.querySelector('[name=jenis_sim]').value = data.jenis_sim ?? '';
    form.querySelector('[name=rute_aktif]').value = data.rute_aktif ?? '';
    form.querySelector('[name=status]').value = data.status ?? '';
    form.querySelector('[name=rating]').value = data.rating ?? '';

    openModal('edit-driver');
  }
</script>
@endsection