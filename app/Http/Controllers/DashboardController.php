<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= KPI UTAMA =================
        $totalAktif = Pengiriman::where('is_deleted', false)
            ->whereNotIn('status', ['delivered'])
            ->count();

        // ================= RINGKASAN STATUS =================
        $statusCounts = Pengiriman::selectRaw('status, COUNT(*) as total')
            ->where('is_deleted', false)
            ->groupBy('status')
            ->pluck('total', 'status');

        $pending = $statusCounts['pending'] ?? 0;
        $gudang  = $statusCounts['gudang'] ?? 0;
        $transit = $statusCounts['transit'] ?? 0;
        $problemCount = $statusCounts['problem'] ?? 0;

        // ================= CHART 7 HARI =================
        $chart = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $chart[] = [
                'label' => $date->locale('id')->isoFormat('dd'),
                'value' => Pengiriman::whereDate('tanggal_kirim', $date->toDateString())
                    ->where('is_deleted', false)
                    ->count(),
            ];
        }

        // ================= PENGIRIMAN TERBARU =================
        $pengirimanTerbaru = Pengiriman::where('is_deleted', false)
            ->latest()
            ->limit(5)
            ->get();

        // ================= RETURN =================
        return view('backend.dashboard.dashboard', compact(
            'totalAktif',
            'pending',
            'gudang',
            'transit',
            'problemCount',
            'chart',
            'pengirimanTerbaru'
        ));
    }

    // ================= CLIENT DASHBOARD =================
    public function client()
    {
        $totalPengiriman = Pengiriman::count();

        $transit = Pengiriman::where('status', 'transit')->count();

        $delivered = Pengiriman::where('status', 'delivered')->count();

        return view('backend.dashboard.dashboard', compact(
            'totalPengiriman',
            'transit',
            'delivered'
        ));
    }
}
