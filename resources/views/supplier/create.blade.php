@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Supplier</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('supplier.store') }}" class="space-y-4">
        @csrf
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required class="border rounded w-full p-2 @error('nama') border-red-500 @enderror">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" required class="border rounded w-full p-2 @error('alamat') border-red-500 @enderror">
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
            <input id="kode_pos" type="text" name="kode_pos" value="{{ old('kode_pos') }}" required class="border rounded w-full p-2 @error('kode_pos') border-red-500 @enderror">
            @error('kode_pos')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>
@endsection