<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengirimanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengiriman::query()
            ->where(function ($q) {
                $q->where('is_deleted', false)
                    ->orWhereNull('is_deleted');
            });

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('resi', 'like', "%$cari%")
                    ->orWhere('kota_tujuan', 'like', "%$cari%")
                    ->orWhere('jenis_barang', 'like', "%$cari%")
                    ->orWhere('nama_pengirim', 'like', "%$cari%");
            });
        }

        if ($request->filled('pulau')) {
            $query->where('pulau_tujuan', $request->pulau);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ✅ FILTER TANGGAL
        if ($request->filled('dari')) {
            $query->whereDate('tanggal_kirim', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_kirim', '<=', $request->sampai);
        }

        $pengiriman = $query->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('backend.pengiriman.pengiriman', compact('pengiriman'));
    }

    public function riwayatHapus()
    {
        $pengiriman = Pengiriman::where('is_deleted', true)
            ->orderByDesc('deleted_at')
            ->paginate(15);

        return view('backend.pengiriman.pengiriman-hapus', compact('pengiriman'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_barang' => 'nullable|string|max:100',
            'jumlah_koli'  => 'required|integer|min:1',
            'berat_kg'     => 'required|numeric|min:0.1',

            'harga_per_kg'   => 'required|numeric|min:0',

            'nama_pengirim'  => 'required|string|max:100',
            'hp_pengirim'    => 'nullable|string|max:20',
            'nama_penerima'  => 'required|string|max:100',
            'hp_penerima'    => 'nullable|string|max:20',
            'kota_tujuan'    => 'required|string|max:100',
            'pulau_tujuan'   => 'required|string',

            'tanggal_kirim'  => 'required|date',
            'estimasi_tiba'  => 'nullable|date',
            'catatan'        => 'nullable|string',
        ]);

        // ✅ HITUNG TARIF
        $tarif = $validated['berat_kg'] * $validated['harga_per_kg'];

        DB::transaction(function () use ($validated, $tarif) {

            $pengiriman = Pengiriman::create([

                'created_by' => auth()->id(),
                'resi' => Pengiriman::generateResi(),

                'jenis_barang' => $validated['jenis_barang'],
                'jumlah_koli'  => $validated['jumlah_koli'],
                'berat_kg'     => $validated['berat_kg'],
                'harga_per_kg' => $validated['harga_per_kg'],
                'tarif'        => $tarif,

                'nama_pengirim' => $validated['nama_pengirim'],
                'hp_pengirim'   => $validated['hp_pengirim'],
                'nama_penerima' => $validated['nama_penerima'],
                'hp_penerima'   => $validated['hp_penerima'],

                'kota_tujuan'  => $validated['kota_tujuan'],
                'pulau_tujuan' => $validated['pulau_tujuan'],

                'tanggal_kirim' => $validated['tanggal_kirim'],
                'estimasi_tiba' => $validated['estimasi_tiba'],
                'catatan'       => $validated['catatan'],

                'status' => 'pending',
            ]);

            TrackingHistory::create([
                'pengiriman_id' => $pengiriman->id,
                'waktu'         => now(),
                'keterangan'    => 'Pesanan diterima sistem AlmairyExpress',
                'lokasi'        => 'Kantor AlmairyExpress',
                'is_done'       => true,
                'is_current'    => true,
            ]);
        });

        return redirect()->route('pengiriman.index')
            ->with('sukses', 'Pengiriman berhasil ditambahkan!');
    }

    public function show(Pengiriman $pengiriman)
    {
        $pengiriman->load(['trackingHistory']);

        return view('backend.pengiriman.show', compact('pengiriman'));
    }

    public function edit(Pengiriman $pengiriman)
    {
        return view('backend.pengiriman.pengiriman-edit', compact('pengiriman'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
        $validated = $request->validate([
            'jenis_barang'   => 'nullable|string|max:100',
            'jumlah_koli'    => 'required|integer|min:1',
            'berat_kg'       => 'required|numeric|min:0.1',
            'harga_per_kg'   => 'required|numeric|min:0',

            'nama_pengirim'  => 'required|string|max:100',
            'hp_pengirim'    => 'nullable|string|max:20',
            'nama_penerima'  => 'required|string|max:100',
            'hp_penerima'    => 'nullable|string|max:20',
            'kota_tujuan'    => 'required|string|max:100',
            'pulau_tujuan'   => 'required|string',

            'tanggal_kirim'  => 'required|date',
            'estimasi_tiba'  => 'nullable|date',
            'catatan'        => 'nullable|string',
        ]);

        $validated['tarif'] = $validated['berat_kg'] * $validated['harga_per_kg'];

        $pengiriman->update($validated);

        return redirect()->route('pengiriman.index')
            ->with('sukses', 'Pengiriman berhasil diperbarui!');
    }

    public function destroy(Pengiriman $pengiriman)
    {
        DB::transaction(function () use ($pengiriman) {

            $pengiriman->is_deleted = true;
            $pengiriman->deleted_at = now();
            $pengiriman->deleted_by = auth()->id();
            $pengiriman->save();
        });

        return redirect()->route('pengiriman.index')
            ->with('sukses', 'Pengiriman ' . $pengiriman->resi . ' berhasil dihapus.');
    }

    public function restore($id)
    {
        $pengiriman = Pengiriman::where('id', $id)
            ->where('is_deleted', true)
            ->firstOrFail();

        $pengiriman->update([
            'is_deleted' => false,
            'deleted_at' => null
        ]);

        return redirect()->route('pengiriman.riwayat-hapus')
            ->with('sukses', 'Pengiriman berhasil dipulihkan.');
    }

    public function updateStatus(Request $request, Pengiriman $pengiriman)
    {
        $request->validate([
            'status' => 'required|in:pending,gudang,transit,delivered,problem'
        ]);

        DB::transaction(function () use ($request, $pengiriman) {

            $pengiriman->update([
                'status' => $request->status
            ]);

            TrackingHistory::where('pengiriman_id', $pengiriman->id)
                ->update(['is_current' => false]);

            $keterangan = [
                'gudang'    => 'Barang tiba di gudang AlmairyExpress',
                'transit'   => 'Kendaraan berangkat menuju ' . $pengiriman->kota_tujuan,
                'delivered' => 'Barang telah sampai di ' . $pengiriman->kota_tujuan,
                'problem'   => 'Terjadi masalah pada pengiriman',
                'pending'   => 'Status dikembalikan ke Menunggu',
            ][$request->status] ?? 'Status diperbarui';

            TrackingHistory::create([
                'pengiriman_id' => $pengiriman->id,
                'waktu'         => now(),
                'keterangan'    => $keterangan,
                'lokasi'        => $pengiriman->kota_tujuan,
                'is_done'       => in_array($request->status, ['delivered']),
                'is_current'    => true,
            ]);
        });

        return response()->json([
            'sukses' => true,
            'status' => $request->status
        ]);
    }

    public function exportData(Request $request)
    {
        $query = Pengiriman::where(function ($q) {
            $q->where('is_deleted', false)
                ->orWhereNull('is_deleted');
        });

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_kirim', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_kirim', '<=', $request->sampai);
        }

        $data = $query->orderByDesc('tanggal_kirim')->get();

        $csv = "Resi,Jenis Barang,Berat (kg),Harga/KG,Total,Pengirim,Penerima,Kota,Pulau,Status\n";

        foreach ($data as $p) {
            $csv .= implode(',', [
                $p->resi,
                $p->jenis_barang,
                $p->berat_kg,
                $p->harga_per_kg,
                $p->tarif,
                $p->nama_pengirim,
                $p->nama_penerima,
                $p->kota_tujuan,
                $p->pulau_tujuan,
                $p->status_label,
            ]) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=pengiriman_' . now()->format('Ymd') . '.csv',
        ]);
    }
}
