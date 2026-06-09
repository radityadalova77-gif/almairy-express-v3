@extends('backend.layouts.app')

@section('title','Update Posisi')
@section('page-title','Update Posisi Barang')

@section('content')

<div class="card">

    <div class="card-title">
        Tracking Update
    </div>

    <form method="POST" action="{{ route('tracking.store') }}">

        @csrf

        <input type="hidden" name="pengiriman_id" value="{{ $pengiriman->id }}">

        <div class="form-grid">

            <div class="form-group">
                <label>No Resi</label>

                <input value="{{ $pengiriman->resi }}" readonly>

            </div>

            <div class="form-group">
                <label>Lokasi Saat Ini</label>
                <input name="lokasi" placeholder="Contoh: Cirebon">
            </div>

            <div class="form-group">
                <label>Status Update</label>

                <select name="status">
                    <option>Pickup</option>
                    <option>In Transit</option>
                    <option>Arrived Hub</option>
                    <option>Delivered</option>
                </select>

            </div>


            <div class="form-group full">
                <label>Keterangan</label>
                <textarea name="keterangan"></textarea>
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-primary">
                Simpan Update Posisi
            </button>
        </div>

    </form>

</div>

@endsection