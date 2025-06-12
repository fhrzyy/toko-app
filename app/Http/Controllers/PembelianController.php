<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembelian::with('barang', 'supplier');

        if ($start_date = $request->query('start_date')) {
            $query->where('tanggal', '>=', $start_date);
        }
        if ($end_date = $request->query('end_date')) {
            $query->where('tanggal', '<=', $end_date);
        }

        $pembelians = $query->paginate(10);
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

        $data = $request->all();
        $pembelian = Pembelian::create($data);

        // Hanya tambah stok jika status adalah "selesai"
        if ($pembelian->status === 'selesai') {
            $barang = Barang::find($request->barang_id);
            $barang->stok += $request->jumlah;
            $barang->save();
        }

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

        // Simpan status lama untuk perbandingan
        $oldStatus = $pembelian->status;
        $oldBarangId = $pembelian->barang_id;
        $oldJumlah = $pembelian->jumlah;

        // Update pembelian
        $pembelian->update($request->all());

        // Kurangi stok barang lama jika status sebelumnya "selesai"
        if ($oldStatus === 'selesai') {
            $barang = Barang::find($oldBarangId);
            $barang->stok -= $oldJumlah;
            $barang->save();
        }

        // Tambah stok barang baru hanya jika status berubah menjadi "selesai"
        if ($pembelian->status === 'selesai' && $pembelian->status !== $oldStatus) {
            $barang = Barang::find($request->barang_id);
            $barang->stok += $request->jumlah;
            $barang->save();
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui.');
    }

    public function destroy(Pembelian $pembelian)
    {
        // Kurangi stok barang jika status adalah "selesai"
        if ($pembelian->status === 'selesai') {
            $barang = Barang::find($pembelian->barang_id);
            $barang->stok -= $pembelian->jumlah;
            $barang->save();
        }

        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus.');
    }

    // Metode baru untuk mengubah status
    public function updateStatus(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'status' => 'required|in:pending,selesai',
        ]);

        $oldStatus = $pembelian->status;
        $pembelian->update(['status' => $request->status]);

        // Kurangi stok jika status berubah dari "selesai" ke "pending"
        if ($oldStatus === 'selesai' && $request->status === 'pending') {
            $barang = Barang::find($pembelian->barang_id);
            $barang->stok -= $pembelian->jumlah;
            $barang->save();
        }

        // Tambah stok jika status berubah dari "pending" ke "selesai"
        if ($oldStatus === 'pending' && $request->status === 'selesai') {
            $barang = Barang::find($pembelian->barang_id);
            $barang->stok += $pembelian->jumlah;
            $barang->save();
        }

        return redirect()->route('pembelian.index')->with('success', 'Status pembelian berhasil diperbarui.');
    }
}