<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pembeli')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pembelis = Pembeli::all();
        return view('penjualan.create', compact('pembelis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'tanggal_penjualan' => 'required|date',
        ]);

        Penjualan::create([
            'pembeli_id' => $request->pembeli_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $pembelis = Pembeli::all();
        return view('penjualan.edit', compact('penjualan', 'pembelis'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'tanggal_penjualan' => 'required|date',
        ]);

        $penjualan->update([
            'pembeli_id' => $request->pembeli_id,
            'kasir_id' => Auth::id(), // Update otomatis dengan ID user yang login
            'tanggal_penjualan' => $request->tanggal_penjualan,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}