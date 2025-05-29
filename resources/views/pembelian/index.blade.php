@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pembelian</h1>
    <a href="{{ route('pembelian.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">Tambah Pembelian</a>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Barang</th>
                <th class="border px-4 py-2">Supplier</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelians as $pembelian)
                <tr>
                    <td class="border px-4 py-2">{{ $pembelian->barang->nama }}</td>
                    <td class="border px-4 py-2">{{ $pembelian->supplier->nama }}</td>
                    <td class="border px-4 py-2">{{ $pembelian->jumlah }}</td>
                    <td class="border px-4 py-2">{{ $pembelian->tanggal }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($pembelian->status) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('pembelian.edit', $pembelian) }}" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2 hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('pembelian.destroy', $pembelian) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection