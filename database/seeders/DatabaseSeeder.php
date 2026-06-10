<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // === PELANGGAN ===
        $pelanggan = [
            ['nama_perusahaan' => 'PT Mika Jaya',       'nama_kontak' => 'Pak Andi',  'no_hp' => '0812-111-2222', 'kota' => 'Jakarta',  'status' => 'aktif'],
            ['nama_perusahaan' => 'CV Berkah Makmur',   'nama_kontak' => 'Bu Sari',   'no_hp' => '0813-222-3333', 'kota' => 'Bandung',  'status' => 'aktif'],
            ['nama_perusahaan' => 'PT Fashion Indo',    'nama_kontak' => 'Pak Rizal', 'no_hp' => '0811-333-4444', 'kota' => 'Jakarta',  'status' => 'aktif'],
            ['nama_perusahaan' => 'CV Mesin Jaya',      'nama_kontak' => 'Pak Doni',  'no_hp' => '0815-444-5555', 'kota' => 'Surabaya', 'status' => 'aktif'],
            ['nama_perusahaan' => 'PT Rumah Indah',     'nama_kontak' => 'Bu Wati',   'no_hp' => '0812-555-6666', 'kota' => 'Jakarta',  'status' => 'aktif'],
            ['nama_perusahaan' => 'PT Kimia Nusantara', 'nama_kontak' => 'Pak Hasan', 'no_hp' => '0813-666-7777', 'kota' => 'Surabaya', 'status' => 'aktif'],
        ];
        foreach ($pelanggan as $p) {
            DB::table('pelanggan')->insert(array_merge($p, ['created_at' => now(), 'updated_at' => now()]));
        }
        $pel1 = DB::table('pelanggan')->where('nama_perusahaan', 'PT Mika Jaya')->value('id');
        $pel2 = DB::table('pelanggan')->where('nama_perusahaan', 'CV Berkah Makmur')->value('id');
        $pel3 = DB::table('pelanggan')->where('nama_perusahaan', 'PT Fashion Indo')->value('id');
        $pel4 = DB::table('pelanggan')->where('nama_perusahaan', 'CV Mesin Jaya')->value('id');
        $pel5 = DB::table('pelanggan')->where('nama_perusahaan', 'PT Rumah Indah')->value('id');
        $pel6 = DB::table('pelanggan')->where('nama_perusahaan', 'PT Kimia Nusantara')->value('id');

        // === PENGIRIMAN ===
        $pengiriman = [
            ['resi' => 'AE-EXP-000917', 'jenis_barang' => 'Elektronik',   'jumlah_koli' => 10,  'berat_kg' => 1000, 'nama_pengirim' => 'PT Mika Jaya',       'hp_pengirim' => '0812-111-2222', 'nama_penerima' => 'Toko Elektronik Bandung', 'hp_penerima' => '0811-999-0000', 'kota_tujuan' => 'Bandung',    'pulau_tujuan' => 'Jawa',       'status' => 'gudang',    'tanggal_kirim' => '2026-04-27', 'estimasi_tiba' => '2026-04-28', 'tarif' => 2500000, 'catatan' => 'Fragile'],
            ['resi' => 'AE-EXP-000918', 'jenis_barang' => 'Sembako',      'jumlah_koli' => 50,  'berat_kg' => 5000, 'nama_pengirim' => 'CV Berkah Makmur',   'hp_pengirim' => '0813-222-3333', 'nama_penerima' => 'Distributor Surabaya',    'hp_penerima' => '0812-888-9999', 'kota_tujuan' => 'Surabaya',   'pulau_tujuan' => 'Jawa',       'status' => 'transit',   'tanggal_kirim' => '2026-04-26', 'estimasi_tiba' => '2026-04-29', 'tarif' => 7500000, 'catatan' => ''],
            ['resi' => 'AE-EXP-000919', 'jenis_barang' => 'Garment',      'jumlah_koli' => 200, 'berat_kg' => 800,  'nama_pengirim' => 'PT Fashion Indo',    'hp_pengirim' => '0811-333-4444', 'nama_penerima' => 'Gudang Medan',            'hp_penerima' => '0813-777-8888', 'kota_tujuan' => 'Medan',      'pulau_tujuan' => 'Sumatera',   'status' => 'pending',   'tanggal_kirim' => '2026-04-28', 'estimasi_tiba' => '2026-05-02', 'tarif' => 3200000, 'catatan' => ''],
            ['resi' => 'AE-EXP-000920', 'jenis_barang' => 'Spare Part',   'jumlah_koli' => 5,   'berat_kg' => 300,  'nama_pengirim' => 'CV Mesin Jaya',      'hp_pengirim' => '0815-444-5555', 'nama_penerima' => 'Workshop Makassar',       'hp_penerima' => '0814-666-7777', 'kota_tujuan' => 'Makassar',   'pulau_tujuan' => 'Sulawesi',   'status' => 'problem',   'tanggal_kirim' => '2026-04-24', 'estimasi_tiba' => '2026-04-26', 'tarif' => 4100000, 'catatan' => 'Keterlambatan'],
            ['resi' => 'AE-EXP-000921', 'jenis_barang' => 'Furniture',    'jumlah_koli' => 15,  'berat_kg' => 2000, 'nama_pengirim' => 'PT Rumah Indah',     'hp_pengirim' => '0812-555-6666', 'nama_penerima' => 'Showroom Semarang',       'hp_penerima' => '0812-111-3333', 'kota_tujuan' => 'Semarang',   'pulau_tujuan' => 'Jawa',       'status' => 'delivered', 'tanggal_kirim' => '2026-04-23', 'estimasi_tiba' => '2026-04-25', 'tarif' => 5000000, 'catatan' => ''],
            ['resi' => 'AE-EXP-000922', 'jenis_barang' => 'Bahan Kimia',  'jumlah_koli' => 30,  'berat_kg' => 1500, 'nama_pengirim' => 'PT Kimia Nusantara', 'hp_pengirim' => '0813-666-7777', 'nama_penerima' => 'Pabrik Balikpapan',       'hp_penerima' => '0815-222-4444', 'kota_tujuan' => 'Balikpapan', 'pulau_tujuan' => 'Kalimantan', 'status' => 'transit',   'tanggal_kirim' => '2026-04-25', 'estimasi_tiba' => '2026-05-01', 'tarif' => 6800000, 'catatan' => 'Handling khusus'],
        ];
        foreach ($pengiriman as $p) {
            DB::table('pengiriman')->insert(array_merge($p, ['created_at' => now(), 'updated_at' => now()]));
        }
        $p1 = DB::table('pengiriman')->where('resi', 'AE-EXP-000917')->value('id');
        $p2 = DB::table('pengiriman')->where('resi', 'AE-EXP-000918')->value('id');
        $p3 = DB::table('pengiriman')->where('resi', 'AE-EXP-000919')->value('id');
        $p4 = DB::table('pengiriman')->where('resi', 'AE-EXP-000920')->value('id');
        $p5 = DB::table('pengiriman')->where('resi', 'AE-EXP-000921')->value('id');
        $p6 = DB::table('pengiriman')->where('resi', 'AE-EXP-000922')->value('id');

        // === INVOICE ===
        $invoices = [
            ['no_invoice' => 'INV-2026-042', 'pelanggan_id' => $pel1, 'pengiriman_id' => $p1, 'nominal' => 2500000, 'tanggal_invoice' => '2026-04-22', 'jatuh_tempo' => '2026-04-29', 'status' => 'pending'],
            ['no_invoice' => 'INV-2026-041', 'pelanggan_id' => $pel2, 'pengiriman_id' => $p2, 'nominal' => 7500000, 'tanggal_invoice' => '2026-04-21', 'jatuh_tempo' => '2026-04-28', 'status' => 'pending'],
            ['no_invoice' => 'INV-2026-040', 'pelanggan_id' => $pel3, 'pengiriman_id' => $p3, 'nominal' => 3200000, 'tanggal_invoice' => '2026-04-20', 'jatuh_tempo' => '2026-04-27', 'status' => 'lunas'],
            ['no_invoice' => 'INV-2026-039', 'pelanggan_id' => $pel4, 'pengiriman_id' => $p4, 'nominal' => 4100000, 'tanggal_invoice' => '2026-04-19', 'jatuh_tempo' => '2026-04-26', 'status' => 'overdue'],
            ['no_invoice' => 'INV-2026-038', 'pelanggan_id' => $pel5, 'pengiriman_id' => $p5, 'nominal' => 5000000, 'tanggal_invoice' => '2026-04-18', 'jatuh_tempo' => '2026-04-25', 'status' => 'lunas'],
            ['no_invoice' => 'INV-2026-037', 'pelanggan_id' => $pel6, 'pengiriman_id' => $p6, 'nominal' => 6800000, 'tanggal_invoice' => '2026-04-17', 'jatuh_tempo' => '2026-04-24', 'status' => 'lunas'],
        ];
        foreach ($invoices as $inv) {
            DB::table('invoice')->insert(array_merge($inv, ['created_at' => now(), 'updated_at' => now()]));
        }

        // === TRACKING HISTORY ===
        $tracks = [
            ['pengiriman_id' => $p1, 'waktu' => '2026-04-27 09:15:00', 'keterangan' => 'Barang diterima di gudang AlmairyExpress Jakarta',     'lokasi' => 'Gudang AlmairyExpress, Jakarta', 'is_done' => true,  'is_current' => false],
            ['pengiriman_id' => $p1, 'waktu' => '2026-04-27 14:30:00', 'keterangan' => 'Barang dimuat ke kendaraan B-1234-AE',                  'lokasi' => 'Gudang AlmairyExpress, Jakarta', 'is_done' => true,  'is_current' => false],
            ['pengiriman_id' => $p1, 'waktu' => '2026-04-27 16:00:00', 'keterangan' => 'Kendaraan berangkat menuju Bandung',                    'lokasi' => 'Jakarta Selatan',               'is_done' => true,  'is_current' => false],
            ['pengiriman_id' => $p1, 'waktu' => '2026-04-27 18:45:00', 'keterangan' => 'Melewati pos pemeriksaan Cikampek',                     'lokasi' => 'Tol Cipularang KM 64',          'is_done' => false, 'is_current' => true],
            ['pengiriman_id' => $p1, 'waktu' => '2026-04-28 08:00:00', 'keterangan' => 'Estimasi tiba di tujuan',                               'lokasi' => 'Bandung, Jawa Barat',           'is_done' => false, 'is_current' => false],
            ['pengiriman_id' => $p2, 'waktu' => '2026-04-26 08:00:00', 'keterangan' => 'Barang diterima di gudang AlmairyExpress Jakarta',     'lokasi' => 'Gudang AlmairyExpress, Jakarta', 'is_done' => true,  'is_current' => false],
            ['pengiriman_id' => $p2, 'waktu' => '2026-04-26 13:00:00', 'keterangan' => 'Kendaraan berangkat menuju Surabaya',                   'lokasi' => 'Jakarta Timur',                 'is_done' => true,  'is_current' => false],
            ['pengiriman_id' => $p2, 'waktu' => '2026-04-27 07:00:00', 'keterangan' => 'Sedang dalam perjalanan, melewati Semarang',            'lokasi' => 'Semarang, Jawa Tengah',         'is_done' => false, 'is_current' => true],
            ['pengiriman_id' => $p2, 'waktu' => '2026-04-29 10:00:00', 'keterangan' => 'Estimasi tiba di Surabaya',                             'lokasi' => 'Surabaya, Jawa Timur',          'is_done' => false, 'is_current' => false],
        ];
        foreach ($tracks as $t) {
            DB::table('tracking_history')->insert(array_merge($t, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
};