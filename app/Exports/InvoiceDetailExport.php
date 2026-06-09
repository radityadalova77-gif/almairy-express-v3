<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceDetailExport implements FromView
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $invoice = Invoice::with(['pelanggan', 'pengirimans'])->findOrFail($this->id);

        return view('backend.exports.invoice_excel', compact('invoice'));
    }
}
