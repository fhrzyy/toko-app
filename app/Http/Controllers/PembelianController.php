<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with('barang', 'supplier')->get();
        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('pembelian.create', compact('barangs', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,selesai',
        ]);

        Pembelian::create($request->all());

        // Update stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan.');
    }

    public function show(Pembelian $pembelian)
    {
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('pembelian.edit', compact('pembelian', 'barangs', 'suppliers'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,selesai',
        ]);

        // Kurangi stok barang lama
        $barang = Barang::find($pembelian->barang_id);
        $barang->stok -= $pembelian->jumlah;
        $barang->save();

        // Update pembelian
        $pembelian->update($request->all());

        // Tambah stok barang baru
        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui.');
    }

    public function destroy(Pembelian $pembelian)
    {
        // Kurangi stok barang sebelum hapus
        $barang = Barang::find($pembelian->barang_id);
        $barang->stok -= $pembelian->jumlah;
        $barang->save();

        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus.');
    }
}