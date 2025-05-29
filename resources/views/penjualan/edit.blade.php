@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Penjualan</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('penjualan.update', $penjualan) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="pembeli_id" class="block text-sm font-medium text-gray-700">Pembeli</label>
            <select id="pembeli_id" name="pembeli_id" required class="border rounded w-full p-2 @error('pembeli_id') border-red-500 @enderror">
                <option value="">Pilih Pembeli</option>
                @foreach ($pembelis as $pembeli)
                    <option value="{{ $pembeli->id }}" {{ old('pembeli_id', $penjualan->pembeli_id) == $pembeli->id ? 'selected' : '' }}>{{ $pembeli->nama }}</option>
                @endforeach
            </select>
            @error('pembeli_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="tanggal_penjualan" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
            <input id="tanggal_penjualan" type="date" name="tanggal_penjualan" value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}" required class="border rounded w-full p-2 @error('tanggal_penjualan') border-red-500 @enderror">
            @error('tanggal_penjualan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
@endsection