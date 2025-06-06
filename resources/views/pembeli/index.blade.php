@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Daftar Pembeli</h1>
        <a href="{{ route('pembeli.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">Tambah Pembeli</a>
    </div>

    <!-- Form Pencarian -->
    <div class="mb-6">
        <form action="{{ route('pembeli.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pembeli berdasarkan nama, alamat, atau no HP..." class="w-full sm:w-96 border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">Cari</button>
            @if (request('search'))
                <a href="{{ route('pembeli.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-600 transition duration-200">Reset</a>
            @endif
        </form>
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
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No HP</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($pembelis as $pembeli)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembeli->nama }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembeli->jenis_kelamin }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembeli->alamat }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembeli->no_hp }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('pembeli.edit', $pembeli) }}" class="bg-yellow-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-yellow-600 transition duration-200">Edit</a>
                            <form action="{{ route('pembeli.destroy', $pembeli) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-red-600 transition duration-200" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $pembelis->appends(request()->query())->links('pagination::tailwind') }}
    </div>
</div>
@endsection