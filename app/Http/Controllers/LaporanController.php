<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // ================= FILTER =================
        $from = $request->dari
            ? Carbon::parse($request->dari)->startOfDay()
            : now()->startOfMonth();

        $to = $request->sampai
            ? Carbon::parse($request->sampai)->endOfDay()
            : now()->endOfDay();

        // ================= DATA =================
        $pengiriman = Pengiriman::whereBetween('tanggal_kirim', [$from, $to])->get();

        $totalPengiriman = $pengiriman->count();

        $pending   = $pengiriman->where('status', 'pending')->count();
        $gudang    = $pengiriman->where('status', 'gudang')->count();
        $transit   = $pengiriman->where('status', 'transit')->count();
        $delivered = $pengiriman->where('status', 'delivered')->count();
        $problem   = $pengiriman->where('status', 'problem')->count();

        $onTimePct = $totalPengiriman
            ? round(($delivered / $totalPengiriman) * 100)
            : 0;

        $revenue = Invoice::whereBetween('tanggal_invoice', [$from, $to])->sum('nominal');

        // ================= PERIODE SEBELUMNYA =================
        $days = $from->diffInDays($to) + 1;

        $prevFrom = (clone $from)->subDays($days);
        $prevTo   = (clone $to)->subDays($days);

        $prevTotal = Pengiriman::whereBetween('tanggal_kirim', [$prevFrom, $prevTo])->count();
        $prevRevenue = Invoice::whereBetween('tanggal_invoice', [$prevFrom, $prevTo])->sum('nominal');

        $growthPengiriman = $prevTotal
            ? round((($totalPengiriman - $prevTotal) / $prevTotal) * 100)
            : 0;

        $growthRevenue = $prevRevenue
            ? round((($revenue - $prevRevenue) / $prevRevenue) * 100)
            : 0;

        // ================= CHART =================
        $chart = Pengiriman::select(
            DB::raw('DATE(tanggal_kirim) as tgl'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('tanggal_kirim', [$from, $to])
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => Carbon::parse($item->tgl)->format('d M'),
                    'value' => $item->total
                ];
            });

        // ================= TOP KOTA =================
        $topKota = Pengiriman::select(
            'kota_tujuan',
            DB::raw('count(*) as total')
        )
            ->whereBetween('tanggal_kirim', [$from, $to])
            ->groupBy('kota_tujuan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ================= SUMMARY PER KOTA =================
        $summaryKota = Pengiriman::select(
            'kota_tujuan',
            DB::raw('count(*) as total'),
            DB::raw("sum(case when status='delivered' then 1 else 0 end) as delivered"),
            DB::raw("sum(case when status='problem' then 1 else 0 end) as problem")
        )
            ->whereBetween('tanggal_kirim', [$from, $to])
            ->groupBy('kota_tujuan')
            ->get();

        // ================= RETURN =================
        return view('backend.laporan.index', [
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),

            'totalPengiriman' => $totalPengiriman,
            'onTimePct' => $onTimePct,
            'problem' => $problem,
            'revenue' => $revenue,

            'growthPengiriman' => $growthPengiriman,
            'growthRevenue' => $growthRevenue,

            'pending' => $pending,
            'gudang' => $gudang,
            'transit' => $transit,
            'delivered' => $delivered,

            'chart' => $chart,

            // 🔥 INI YANG KAMU BUTUH
            'topKota' => $topKota,
            'summaryKota' => $summaryKota,
        ]);
    }
}
