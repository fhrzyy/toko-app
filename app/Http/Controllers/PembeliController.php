<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembeli::query();

        // Filter berdasarkan pencarian
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('jenis_kelamin', 'LIKE', "%{$search}%")
                  ->orWhere('alamat', 'LIKE', "%{$search}%")
                  ->orWhere('no_hp', 'LIKE', "%{$search}%");
            });
        }

        $pembelis = $query->paginate(10);
        return view('pembeli.index', compact('pembelis'));
    }

    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:pembelis,nama',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        Pembeli::create($request->all());

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil ditambahkan.');
    }

    public function show(Pembeli $pembeli)
    {
        return view('pembeli.show', compact('pembeli'));
    }

    public function edit(Pembeli $pembeli)
    {
        return view('pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, Pembeli $pembeli)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:pembelis,nama,' . $pembeli->id,
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        $pembeli->update($request->all());

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil diperbarui.');
    }

    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil dihapus.');
    }
}