<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter berdasarkan pencarian
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhereHas('kategori', function ($q) use ($search) {
                      $q->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }

        $barangs = $query->paginate(10);
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama', 'kategori_id', 'stok', 'harga']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/barang', $filename);
            $data['gambar'] = $filename;
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama', 'kategori_id', 'stok', 'harga']);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar && Storage::exists('public/barang/' . $barang->gambar)) {
                Storage::delete('public/barang/' . $barang->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/barang', $filename);
            $data['gambar'] = $filename;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar && Storage::exists('public/barang/' . $barang->gambar)) {
            Storage::delete('public/barang/' . $barang->gambar);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function exportPdf()
    {
        $barangs = Barang::with('kategori')->get();
        $pdf = PDF::loadView('barang.pdf', compact('barangs'));
        return $pdf->download('daftar-barang.pdf');
    }
}