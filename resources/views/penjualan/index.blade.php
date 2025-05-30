@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Penjualan</h1>
    <a href="{{ route('penjualan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">Tambah Penjualan</a>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Pembeli</th>
                <th class="border px-4 py-2">Tanggal Penjualan</th>
                <th class="border px-4 py-2">Total Harga</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualans as $penjualan)
                <tr>
                    <td class="border px-4 py-2">{{ $penjualan->pembeli->nama }}</td>
                    <td class="border px-4 py-2">{{ $penjualan->tanggal_penjualan }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($penjualan->details->sum('total_harga'), 3, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('penjualan.show', $penjualan) }}" class="bg-green-500 text-white px-2 py-1 rounded mr-2 hover:bg-green-600">Detail</a>
                        <a href="{{ route('penjualan.edit', $penjualan) }}" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2 hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('penjualan.destroy', $penjualan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection