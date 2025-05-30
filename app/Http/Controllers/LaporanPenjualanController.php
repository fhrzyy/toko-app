<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $query = Penjualan::with('pembeli', 'details.barang');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal_penjualan', [$tanggal_awal, $tanggal_akhir]);
        }

        $penjualans = $query->get();

        return view('laporan_penjualan.index', compact('penjualans', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPdf(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $query = Penjualan::with('pembeli', 'details.barang');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal_penjualan', [$tanggal_awal, $tanggal_akhir]);
        }

        $penjualans = $query->get();

        $pdf = Pdf::loadView('laporan_penjualan.pdf', compact('penjualans', 'tanggal_awal', 'tanggal_akhir'));
        return $pdf->download('laporan-penjualan-' . ($tanggal_awal ?? 'all') . '-' . ($tanggal_akhir ?? 'all') . '.pdf');
    }
}