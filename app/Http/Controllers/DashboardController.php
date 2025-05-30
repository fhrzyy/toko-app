<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Pembeli;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Dasar
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();
        $totalPembeli = Pembeli::count();
        $totalPenjualan = Penjualan::count();

        // Total Pendapatan dari Penjualan
        $totalPendapatan = DetailPenjualan::sum('total_harga') ?? 0;

        // Stok Barang Rendah (misalnya kurang dari 5)
        $stokRendah = Barang::where('stok', '<', 5)->count();

        return view('dashboard.index', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'totalPembeli',
            'totalPenjualan',
            'totalPendapatan',
            'stokRendah'
        ));
    }
}