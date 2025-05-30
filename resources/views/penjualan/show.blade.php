@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Penjualan</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <p><strong>Pembeli:</strong> {{ $penjualan->pembeli->nama }}</p>
            <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->tanggal_penjualan }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($penjualan->details->sum('total_harga'), 2, ',', '.') }}</p>
        </div>

        <h2 class="text-lg font-semibold mb-2">Daftar Barang</h2>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Barang</th>
                    <th class="border px-4 py-2">Jumlah</th>
                    <th class="border px-4 py-2">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualan->details as $detail)
                    <tr>
                        <td class="border px-4 py-2">{{ $detail->barang->nama }}</td>
                        <td class="border px-4 py-2">{{ $detail->jumlah }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($detail->total_harga, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border px-4 py-2 text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('penjualan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
</div>
@endsection