<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pelanggan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\InvoiceExport;
use App\Exports\InvoiceDetailExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['pelanggan', 'pengiriman'])
            ->orderByDesc('tanggal_invoice');

        $invoice = Invoice::with(['pengiriman', 'pelanggan'])
            ->latest()
            ->paginate(10);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('no_invoice', 'like', "%{$request->search}%")
                    ->orWhereHas('pelanggan', function ($q2) use ($request) {
                        $q2->where('nama_perusahaan', 'like', "%{$request->search}%");
                    });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $invoice = $query->paginate(15);

        return view('backend.invoice.index', [
            'invoice' => $invoice,
            'pelanggan' => Pelanggan::where('status', 'aktif')->get(),
            'pengiriman' => Pengiriman::where('is_deleted', false)
                ->whereDoesntHave('invoices')
                ->get(),

            'totalInvoice' => Invoice::count(),
            'lunas' => Invoice::where('status', 'lunas')->count(),
            'outstanding' => Invoice::whereIn('status', ['pending', 'overdue'])->sum('nominal'),
            'revenue' => Invoice::where('status', 'lunas')->sum('nominal'),
            'pctLunas' => Invoice::count() > 0
                ? round((Invoice::where('status', 'lunas')->count() / Invoice::count()) * 100)
                : 0,

            'aging' => $this->agingData()
        ]);
    }

    private function agingData()
    {
        return [
            [
                'range' => '0 - 30 Hari',
                'count' => Invoice::where('status', '!=', 'lunas')
                    ->whereDate('jatuh_tempo', '>=', now()->subDays(30))->count(),
                'nominal' => Invoice::where('status', '!=', 'lunas')
                    ->whereDate('jatuh_tempo', '>=', now()->subDays(30))->sum('nominal'),
                'status' => 'Current',
                'class' => 's-pending',
            ],
            [
                'range' => '31 - 60 Hari',
                'count' => Invoice::where('status', '!=', 'lunas')
                    ->whereBetween('jatuh_tempo', [now()->subDays(60), now()->subDays(31)])->count(),
                'nominal' => Invoice::where('status', '!=', 'lunas')
                    ->whereBetween('jatuh_tempo', [now()->subDays(60), now()->subDays(31)])->sum('nominal'),
                'status' => 'Warning',
                'class' => 's-warn',
            ],
            [
                'range' => '> 60 Hari',
                'count' => Invoice::where('status', '!=', 'lunas')
                    ->whereDate('jatuh_tempo', '<', now()->subDays(60))->count(),
                'nominal' => Invoice::where('status', '!=', 'lunas')
                    ->whereDate('jatuh_tempo', '<', now()->subDays(60))->sum('nominal'),
                'status' => 'Overdue',
                'class' => 's-overdue',
            ],
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'nullable|exists:pelanggan,id',
            'pengiriman_ids' => 'required|array',
            'pengiriman_ids.*' => 'exists:pengiriman,id',
            'tanggal_invoice' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_invoice',
            'status' => 'nullable|in:pending,lunas,overdue'
        ]);

        // ambil pengiriman yang dipilih
        $pengirimans = Pengiriman::whereIn('id', $request->pengiriman_ids)->get();

        // ✅ FIX TOTAL (FINAL)
        $total = $pengirimans->sum('tarif');

        $validated['nominal'] = $total;

        $validated['no_invoice'] = Invoice::generateNomor();
        $validated['status'] = $request->status ?? 'pending';

        $validated['pengiriman_id'] = $request->pengiriman_ids[0] ?? null;

        $invoice = Invoice::create($validated);

        $invoice->pengirimans()->sync($request->pengiriman_ids);

        return redirect()->route('invoice.index')
            ->with('sukses', 'Invoice berhasil dibuat (total otomatis)');
    }

    public function bayar($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['status' => 'lunas']);

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice berhasil dilunaskan');
    }

    public function void($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice di-void']);
    }

    public function export($id)
    {
        return Excel::download(
            new InvoiceDetailExport($id),
            'invoice-' . $id . '.xlsx'
        );
    }
    public function show($id)
    {
        $invoice = Invoice::with(['pengirimans', 'pelanggan'])->findOrFail($id);
        return view('backend.invoice.print', compact('invoice'));
    }

    public function pdf($id)
    {
        $invoice = Invoice::with(['pelanggan', 'pengiriman'])->findOrFail($id);
        $pdf = Pdf::loadView('backend.invoice.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->no_invoice . '.pdf');
    }
}
