<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('backend.tracking.tracking');
    }

    public function cari(Request $request)
    {
        $resi = strtoupper(trim($request->resi));

        $pengiriman = Pengiriman::with(['trackingHistory'])
            ->where('resi', $resi)
            ->where('is_deleted', false)
            ->first();

        if (!$pengiriman) {
            return response()->json([
                'ditemukan' => false,
                'pesan' => 'Nomor resi tidak ditemukan.'
            ]);
        }

        $progress = match ($pengiriman->status) {
            'pending'   => 10,
            'gudang'    => 40,
            'transit'   => 65,
            'delivered' => 100,
            'problem'   => 60,
            default     => 50,
        };

        return response()->json([
            'ditemukan'  => true,
            'pengiriman' => [
                'resi'          => $pengiriman->resi,
                'jenis_barang'  => $pengiriman->jenis_barang,
                'jumlah_koli'   => $pengiriman->jumlah_koli,
                'berat_kg'      => $pengiriman->berat_kg,
                'kota_tujuan'   => $pengiriman->kota_tujuan,
                'pulau_tujuan'  => $pengiriman->pulau_tujuan,
                'status'        => $pengiriman->status,
                'status_label'  => $pengiriman->status_label,
                'estimasi_tiba' => $pengiriman->estimasi_tiba?->format('d M Y'),
                'tarif_format'  => $pengiriman->tarif_format,
                'progress'      => $progress,
            ],
            'history' => $pengiriman->trackingHistory->map(fn($h) => [
                'waktu'      => $h->waktu->locale('id')->isoFormat('D MMM YYYY, HH:mm'),
                'keterangan' => $h->keterangan,
                'lokasi'     => $h->lokasi,
                'is_done'    => $h->is_done,
                'is_current' => $h->is_current,
            ]),
        ]);
    }

    public function create(Pengiriman $pengiriman)
    {
        return view('backend.tracking.create', compact('pengiriman'));
    }

    public function tambahHistory(Request $request, Pengiriman $pengiriman)
    {
        $request->validate([
            'status' => 'required',
            'keterangan' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255'
        ]);

        $pengiriman->update([
            'status' => $request->status
        ]);

        TrackingHistory::where('pengiriman_id', $pengiriman->id)
            ->update(['is_current' => false]);

        TrackingHistory::create([
            'pengiriman_id' => $pengiriman->id,
            'waktu' => now(),
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'is_done' => true,
            'is_current' => true
        ]);

        return back()->with('sukses', 'Tracking berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengiriman_id' => 'required',
            'lokasi' => 'required|string|max:255',
            'status' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        TrackingHistory::where('pengiriman_id', $request->pengiriman_id)
            ->update(['is_current' => false]);

        TrackingHistory::create([
            'pengiriman_id' => $request->pengiriman_id,
            'waktu' => now(),
            'keterangan' => $request->status . ' - ' . $request->keterangan,
            'lokasi' => $request->lokasi,
            'is_current' => true,
            'is_done' => $request->status == 'Delivered'
        ]);

        return redirect()
            ->route('pengiriman.show', $request->pengiriman_id)
            ->with('sukses', 'Posisi barang diperbarui');
    }
    public function public()
    {
        return view('frontend.live-tracking');
    }
    public function show($resi)
    {
        $pengiriman = Pengiriman::with('trackingHistory')
            ->where('resi', $resi)
            ->first();

        if (!$pengiriman) {
            abort(404, 'Resi tidak ditemukan');
        }

        $history = $pengiriman->trackingHistory;

        return view('frontend.tracking-result', compact(
            'pengiriman',
            'history'
        ));
    }
}
