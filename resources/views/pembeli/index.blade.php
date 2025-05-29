@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pembeli</h1>
    <a href="{{ route('pembeli.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">Tambah Pembeli</a>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Jenis Kelamin</th>
                <th class="border px-4 py-2">Alamat</th>
                <th class="border px-4 py-2">No HP</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelis as $pembeli)
                <tr>
                    <td class="border px-4 py-2">{{ $pembeli->nama }}</td>
                    <td class="border px-4 py-2">{{ $pembeli->jenis_kelamin }}</td>
                    <td class="border px-4 py-2">{{ $pembeli->alamat }}</td>
                    <td class="border px-4 py-2">{{ $pembeli->no_hp }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('pembeli.edit', $pembeli) }}" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2 hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('pembeli.destroy', $pembeli) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection