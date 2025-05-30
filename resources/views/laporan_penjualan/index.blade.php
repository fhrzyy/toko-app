@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Laporan Penjualan</h1>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="{{ route('laporan-penjualan.index') }}" class="mb-6">
        <div class="flex space-x-4 items-end">
            <div>
                <label for="tanggal_awal" class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                <input id="tanggal_awal" type="date" name="tanggal_awal" value="{{ $tanggal_awal ?? '' }}" class="border rounded w-full p-2">
            </div>
            <div>
                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input id="tanggal_akhir" type="date" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}" class="border rounded w-full p-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            <a href="{{ route('laporan-penjualan.export-pdf', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cetak PDF</a>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Tanggal Penjualan</th>
                <th class="border px-4 py-2">Pembeli</th>
                <th class="border px-4 py-2">Detail Barang</th>
                <th class="border px-4 py-2">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualans as $penjualan)
                <tr>
                    <td class="border px-4 py-2">{{ $penjualan->tanggal_penjualan }}</td>
                    <td class="border px-4 py-2">{{ $penjualan->pembeli->nama }}</td>
                    <td class="border px-4 py-2">
                        <ul>
                            @foreach ($penjualan->details as $detail)
                                <li>{{ $detail->barang->nama }} ({{ $detail->jumlah }} x Rp {{ number_format($detail->barang->harga, 3, ',', '.') }}) = Rp {{ number_format($detail->total_harga, 3, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border px-4 py-2">Rp {{ number_format($penjualan->details->sum('total_harga'), 3, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($penjualans->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="3" class="border px-4 py-2 text-right font-semibold">Grand Total:</td>
                    <td class="border px-4 py-2 font-semibold">Rp {{ number_format($penjualans->sum(fn($penjualan) => $penjualan->details->sum('total_harga')), 3, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
@endsection