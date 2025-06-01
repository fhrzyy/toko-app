@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Daftar Penjualan</h1>
        <a href="{{ route('penjualan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">Tambah Penjualan</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pembeli</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Penjualan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($penjualans as $penjualan)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->pembeli->nama }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->tanggal_penjualan }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($penjualan->details->sum('total_harga'), 3, ',', '.') }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('penjualan.show', $penjualan) }}" class="bg-green-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-green-600 transition duration-200">Detail</a>
                            <a href="{{ route('penjualan.edit', $penjualan) }}" class="bg-yellow-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-yellow-600 transition duration-200">Edit</a>
                            <form action="{{ route('penjualan.destroy', $penjualan) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-red-600 transition duration-200" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection