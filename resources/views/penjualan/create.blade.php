@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Penjualan</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('penjualan.store') }}" class="space-y-4">
        @csrf
        <div>
            <label for="pembeli_id" class="block text-sm font-medium text-gray-700">Pembeli</label>
            <select id="pembeli_id" name="pembeli_id" required class="border rounded w-full p-2 @error('pembeli_id') border-red-500 @enderror">
                <option value="">Pilih Pembeli</option>
                @foreach ($pembelis as $pembeli)
                    <option value="{{ $pembeli->id }}" {{ old('pembeli_id') == $pembeli->id ? 'selected' : '' }}>{{ $pembeli->nama }}</option>
                @endforeach
            </select>
            @error('pembeli_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="tanggal_penjualan" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
            <input id="tanggal_penjualan" type="date" name="tanggal_penjualan" value="{{ old('tanggal_penjualan') }}" required class="border rounded w-full p-2 @error('tanggal_penjualan') border-red-500 @enderror">
            @error('tanggal_penjualan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Daftar Barang -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Daftar Barang</h2>
            <div id="items-container" class="space-y-4">
                <div class="item flex space-x-4 items-end">
                    <div class="flex-1">
                        <label for="items[0][barang_id]" class="block text-sm font-medium text-gray-700">Barang</label>
                        <select name="items[0][barang_id]" required class="border rounded w-full p-2">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-32">
                        <label for="items[0][jumlah]" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="items[0][jumlah]" required class="border rounded w-full p-2" min="1">
                    </div>
                    <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                </div>
            </div>
            <button type="button" id="add-item" class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Barang</button>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>

<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('item', 'flex', 'space-x-4', 'items-end');
        newItem.innerHTML = `
            <div class="flex-1">
                <label for="items[${itemIndex}][barang_id]" class="block text-sm font-medium text-gray-700">Barang</label>
                <select name="items[${itemIndex}][barang_id]" required class="border rounded w-full p-2">
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div class="w-32">
                <label for="items[${itemIndex}][jumlah]" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="items[${itemIndex}][jumlah]" required class="border rounded w-full p-2" min="1">
            </div>
            <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
        `;
        container.appendChild(newItem);
        itemIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection