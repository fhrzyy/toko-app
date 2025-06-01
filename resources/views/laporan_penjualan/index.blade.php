@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Laporan Penjualan</h1>
    </div>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="{{ route('laporan-penjualan.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row sm:space-x-4 items-start sm:items-end space-y-4 sm:space-y-0">
            <div class="w-full sm:w-auto">
                <label for="tanggal_awal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
                <input id="tanggal_awal" type="date" name="tanggal_awal" value="{{ $tanggal_awal ?? '' }}" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>
            <div class="w-full sm:w-auto">
                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input id="tanggal_akhir" type="date" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">Filter</button>
                <a href="{{ route('laporan-penjualan.export-pdf', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-200">Cetak PDF</a>
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Penjualan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pembeli</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Detail  Detail Barang</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Harga</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($penjualans as $penjualan)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->tanggal_penjualan }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->pembeli->nama }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900">
                            <ul class="list-disc list-inside">
                                @foreach ($penjualan->details as $detail)
                                    <li>{{ $detail->barang->nama }} ({{ $detail->jumlah }} x Rp {{ number_format($detail->barang->harga, 3, ',', '.') }}) = Rp {{ number_format($detail->total_harga, 3, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($penjualan->details->sum('total_harga'), 3, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
            @if ($penjualans->count() > 0)
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-right font-semibold text-sm text-gray-900">Grand Total:</td>
                        <td class="px-4 py-4 font-semibold text-sm text-gray-900">Rp {{ number_format($penjualans->sum(fn($penjualan) => $penjualan->details->sum('total_harga')), 3, ',', '.') }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection