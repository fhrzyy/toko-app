<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pembeli;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pembeli', 'details.barang')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pembelis = Pembeli::all();
        $barangs = Barang::all();
        return view('penjualan.create', compact('pembelis', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'tanggal_penjualan' => 'required|date',
            'items' => 'required|array',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        // Buat penjualan
        $penjualan = Penjualan::create([
            'pembeli_id' => $request->pembeli_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
        ]);

        // Simpan detail penjualan dan kurangi stok
        foreach ($request->items as $item) {
            $barang = Barang::find($item['barang_id']);
            if ($barang->stok < $item['jumlah']) {
                $penjualan->delete();
                return back()->withErrors(['items' => 'Stok barang ' . $barang->nama . ' tidak cukup.']);
            }

            $total_harga = $barang->harga * $item['jumlah'];
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'total_harga' => $total_harga,
            ]);

            // Kurangi stok barang
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('pembeli', 'details.barang');
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $pembelis = Pembeli::all();
        $barangs = Barang::all();
        $penjualan->load('details');
        return view('penjualan.edit', compact('penjualan', 'pembelis', 'barangs'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'tanggal_penjualan' => 'required|date',
            'items' => 'required|array',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        // Kembalikan stok barang lama
        foreach ($penjualan->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            $barang->stok += $detail->jumlah;
            $barang->save();
        }

        // Hapus detail penjualan lama
        $penjualan->details()->delete();

        // Update penjualan
        $penjualan->update([
            'pembeli_id' => $request->pembeli_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
        ]);

        // Simpan detail penjualan baru dan kurangi stok
        foreach ($request->items as $item) {
            $barang = Barang::find($item['barang_id']);
            if ($barang->stok < $item['jumlah']) {
                return back()->withErrors(['items' => 'Stok barang ' . $barang->nama . ' tidak cukup.']);
            }

            $total_harga = $barang->harga * $item['jumlah'];
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'total_harga' => $total_harga,
            ]);

            // Kurangi stok barang
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        // Kembalikan stok barang
        foreach ($penjualan->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            $barang->stok += $detail->jumlah;
            $barang->save();
        }

        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}