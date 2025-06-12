@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Pembelian</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pembelian.update', $pembelian) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="barang_id" class="block text-sm font-medium text-gray-700">Barang</label>
            <select id="barang_id" name="barang_id" required class="border rounded w-full p-2 @error('barang_id') border-red-500 @enderror">
                <option value="">Pilih Barang</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}" {{ old('barang_id', $pembelian->barang_id) == $barang->id ? 'selected' : '' }}>{{ $barang->nama }}</option>
                @endforeach
            </select>
            @error('barang_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
            <select id="supplier_id" name="supplier_id" required class="border rounded w-full p-2 @error('supplier_id') border-red-500 @enderror">
                <option value="">Pilih Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $pembelian->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->nama }}</option>
                @endforeach
            </select>
            @error('supplier_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input id="jumlah" type="number" name="jumlah" value="{{ old('jumlah', $pembelian->jumlah) }}" required class="border rounded w-full p-2 @error('jumlah') border-red-500 @enderror">
            @error('jumlah')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $pembelian->tanggal) }}" required class="border rounded w-full p-2 @error('tanggal') border-red-500 @enderror">
            @error('tanggal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
@endsection