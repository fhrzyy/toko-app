@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Barang</h1>

    <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="border rounded w-full p-2 @error('nama') border-red-500 @enderror" value="{{ old('nama', $barang->nama) }}">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="border rounded w-full p-2 @error('kategori_id') border-red-500 @enderror">
                <option value="">Pilih Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" id="stok" class="border rounded w-full p-2 @error('stok') border-red-500 @enderror" value="{{ old('stok', $barang->stok) }}">
            @error('stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" step="0.01" name="harga" id="harga" class="border rounded w-full p-2 @error('harga') border-red-500 @enderror" value="{{ old('harga', $barang->harga) }}">
            @error('harga')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="border rounded w-full p-2 @error('gambar') border-red-500 @enderror">
            @if ($barang->gambar)
                <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama }}" class="w-32 mt-2">
            @endif
            @error('gambar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection