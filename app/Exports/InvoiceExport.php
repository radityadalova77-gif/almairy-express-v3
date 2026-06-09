<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $rows = [];

        $invoices = Invoice::with(['pelanggan', 'pengirimans'])->get();

        foreach ($invoices as $inv) {
            $pengirimans = $inv->pengirimans ?? collect();

            // total invoice (sum tarif)
            $total = $pengirimans->sum('tarif');

            if ($pengirimans->count()) {
                foreach ($pengirimans as $p) {
                    $rows[] = [
                        'no_invoice' => $inv->no_invoice,
                        'pelanggan' => $inv->pelanggan?->nama_perusahaan,
                        'resi' => $p->resi,
                        'kota_tujuan' => $p->kota_tujuan,
                        'tarif' => $p->tarif,
                        'total_invoice' => $total,
                        'tanggal' => optional($inv->tanggal_invoice)->format('d/m/Y'),
                        'status' => $inv->status,
                    ];
                }
            } else {
                $rows[] = [
                    'no_invoice' => $inv->no_invoice,
                    'pelanggan' => $inv->pelanggan?->nama_perusahaan,
                    'resi' => '-',
                    'kota_tujuan' => '-',
                    'tarif' => 0,
                    'total_invoice' => $total,
                    'tanggal' => optional($inv->tanggal_invoice)->format('d/m/Y'),
                    'status' => $inv->status,
                ];
            }
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'No Invoice',
            'Pelanggan',
            'Resi',
            'Kota Tujuan',
            'Tarif',
            'Total Invoice',
            'Tanggal',
            'Status',
        ];
    }
}
